<?php

namespace App\Http\Controllers\Front;

use Exception;
use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\StripePaymentService;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Controllers\Front\BaseController;
use App\Http\Services\MyfatoorahPaymentService;
use App\Models\Product;

class CheckoutController extends BaseController
{
    //

    protected $payments_gateway = ['stripe', 'myfatoorah'];


    private function myCart()
    {
        if (session()->has('cart')) {

            $cart = new Cart(session('cart'));
        } else {
            $cart = new Cart();
        }

        return $cart;
    }


    private function checkCartNotEmpty()
    {


        $cart = $this->myCart(); // service class

        $total_products_count = (int) $cart->getTotalProductsQuanityt();

        $total_price =  (int) $cart->getTotalProductsPrice();

        if ($total_products_count > 0 && $total_price > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function index(Request $request, $gateway)
    {


        if (!in_array($gateway, $this->payments_gateway)) {
            abort(404);
        }


        if (!$this->checkCartNotEmpty()) {

            return redirect()->route('front.home');
        }


        $cart = $this->myCart(); // service class

        $total_products_count = (int) $cart->getTotalProductsQuanityt();

        $total_price =  $cart->getTotalProductsPrice();

        switch ($gateway) {
            case 'stripe':

                return StripePaymentService::init();

            case 'myfatoorah':
                return $this->paymentWithMyfatoorahInit();
            default:

                return redirect()->route('front.home');
        }
    }


    // ----------------payment with myfatoorah-------

    /**
     * first we will save invoice id in column charge id
     * and save order with out decremnt quantity products
     * and set status pending
     *
     * in callback if succes will change charge id to reponse paymentd
     *
     * and deceremcnt products quantity
     */

    private function paymentWithMyfatoorahInit()
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

            $cart->resetCart();

            return redirect($payment_link);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::alert($th);
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }


    //------------------------------------------------
    public function chargeStripe(Request $request)
    {


        $cart = $this->myCart(); // service class

        try {

            DB::beginTransaction();


            $charge_id = Str::random();

            $order = $this->saveOrder($charge_id, 'stripe', 'card', $cart);

            if (!$order instanceof Model) {
                throw new Exception('order not saved ');
            }


            // ----------------------------------------
            $description = 'payment for order id ' . $order->id;
            $user_address_details = user()->addressDetails;
            $charge =  StripePaymentService::charge($request->stripeToken, $description, $user_address_details);

            if (!$charge || !is_array($charge)) {
                throw new Exception('payment dosent return success');
            }


            // -----------------success--------------------

            $order->update([
                'charge_id' => $charge['charge_id'],
                'status' => $charge['status'] == 'succeeded' ? 'paid' : 'pending',
                'payment_method' => $charge['payment_method'],
            ]);

            //forget the session
            $cart->resetCart();

            DB::commit();

            return redirect()->route('front.home')->with(['success' =>  __('front.order_success')]);
        } catch (\Throwable $th) {

            Log::alert($th);
            DB::rollback();
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }


        // ------------------------------------------
        // ------------------------------------------
        // ------------------------------------------
        // ------------------------------------------



    }
    //------------------------------------------------
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

                // abort(404);
                throw new Exception('myfatoorah callback invoice id ' . $invoice_id . " dosent exist in database orders");
            }

            if ((int) substr($amount, 0, 1)  != (int) substr($order->amount, 0, 1)) {
                throw new Exception('myfatoorah payemnts dosent equals');
            }


            $order->update([
                'charge_id' => $request->paymentId,
                'status' =>  'paid',
                'payment_method' => $gateway_method
            ]);

            $this->myCart()->resetCart();

            DB::commit();

            return redirect()->route('front.home')->with(['success' =>  __('front.order_success')]);

        } catch (\Throwable $th) {

            Log::alert($th);
            DB::rollback();
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }
    //------------------------------------------------
    //------------------------------------------------


    protected function saveOrder($charge_id, $payment_gateway, $payment_method, Cart $cart)
    {



        $products = $cart->getProducts();
        $total_price =  $cart->getTotalProductsPrice();  //total amount


        //---save order and charge id

        //payment status =>>>> 'pending','paid','refused'
        //and default pending

        $order = Order::create([
            'user_id' => user()->id,
            'charge_id' => $charge_id,
            'amount' => $total_price,
            'payment_gateway' => $payment_gateway,
            'payment_method' => $payment_method,
            'note' => ' ',
            'created_at' => now(),
        ]);


        //---------------save order products---------
        $order_products = [];

        foreach ($products as $product) {

            //---------get real price by check if the product has offer------
            if ($product->attribute->hasOffer) {
                $real_price = $product->attribute->price_offer;
            } else {
                $real_price = $product->attribute->price;
            } //-----end check if has offer----------

            $user_count_selected = $product->user_select_quantity ?? 1;
            $check_quantity = $product->attribute->qty > 0 ? 1 : 0;

            //check the user select found in stock
            if ($user_count_selected <= $product->attribute->qty) {
                $check_quantity = $user_count_selected;
            }


            if ($check_quantity > 0) {

                $order_products[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_attribute_id' => $product->attribute->id,
                    'quantity' => $check_quantity,
                    'price' => $real_price,
                    'created_at' => now(),

                ];

                //---------decrement the quantity-------------

                $product->attribute->decrement('qty', $check_quantity);
            }
        } //---end of foreach

        //--------save order products in database----

        OrderProduct::insert($order_products);

        return $order;
    }

    //------------------------------------------------





    //------------------------------------------------
}
