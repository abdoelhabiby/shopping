<?php

namespace App\Http\Traits;

use Exception;
use App\Cart\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\MyfatoorahPaymentService;

trait MyfatoorahTrait
{

    private function myCart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }



    // ----------------payment with myfatoorah-------

    /**
     * first we will save invoice id in column charge id
     * and set status pending
     *
     * in callback if succes will change charge id to reponse paymentd
     *
     *
     */


    protected function paymentWithMyfatoorahInit()
    {


        try {

            $cart = $this->myCart(); // service class
            $total_price = $cart->getTotalProductsPrice();
            $total_products_count = $cart->getTotalProductsQuanityt();

            $data = MyfatoorahPaymentService::init($total_price);

            $save_insession = $data;
            $save_insession['cart'] = $cart;

            $data['total_price'] = $total_price;
            $data['total_products_count'] = $total_products_count;

            session()->flash('fatoorah_' . user()->id, $save_insession);
            return view('front.checkout.myfatoorah', compact('data'));
        } catch (\Throwable $th) {

            Log::alert($th);
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }


    public function myfatoorahSaveOrderAndRedirect()
    {

        try {


            DB::beginTransaction();

            $key = 'fatoorah_' . user()->id;
            if (!session()->has($key) || !isset(session()->get($key)['payment_link']) ||  !isset(session()->get($key)['invoice_id']) ||  !isset(session()->get($key)['cart'])) {

                return redirect()->back();
            }

            $payment_link = session()->get($key)['payment_link'];
            $invoice_id = session()->get($key)['invoice_id'];
            $cart = session()->get($key)['cart'];


            /**
             * check if some other users paying order before the current user still dosent doing action
             *
             */
            if (!$cart->getTotalProductsQuanityt() > 0 && !$cart->getTotalProductsPrice() > 0) {
                return redirect()->route('cart.index');
            }

            $order = $this->saveOrder($invoice_id, 'myfatoorah', 'card', $cart);

            if (!$order instanceof Model) {
                throw new Exception('order not saved ');
            }

            DB::commit();

            // $cart->resetCart();

            return redirect($payment_link);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::alert($th);
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }

    public function callbackMyfatoorah(Request $request)
    {
        abort_if(!$request->paymentId, 404);


        try {

            DB::beginTransaction();
            $payment = MyfatoorahPaymentService::getPaymentData($request->paymentId);

            $status = $payment->InvoiceStatus; //Paid or Pending
            $amount = $payment->InvoiceDisplayValue;
            $invoice_id = $payment->InvoiceId;

            if ($status != 'Paid') {
                return redirect()->route('cart.index')->with(['error' => __('front.myfat_callback_not_paid')]);
            }

            if (count($payment->InvoiceTransactions) > 1) {
                foreach ($payment->InvoiceTransactions as $transaction) {
                    if ($transaction->TransactionStatus == 'Succss') {
                        $gateway_method = $transaction->PaymentGateway;
                        break;
                    }
                }
            } else {
                $gateway_method =  ($payment->InvoiceTransactions[0])->PaymentGateway;
            }


            $order = Order::where('charge_id', $invoice_id)->where('status', 'pending')->first();



            if (!$order) {
                throw new Exception('myfatoorah callback invoice id ' . $invoice_id . " dosent exist in database orders");
            }

            if ((int) substr($amount, 0, 1)  != (int) substr($order->amount, 0, 1)) {
                throw new Exception('myfatoorah payemnts dosent equals');
            }


            $order->update([
                'status' =>  'paid',
                'payment_method' => $gateway_method
            ]);

            $this->myCart()->resetCart();

            DB::commit();

            return redirect()->route('front.user.orders')->with(['success' =>  __('front.order_success')]);

        } catch (\Throwable $th) {

            Log::alert($th);
            DB::rollback();
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }


}
