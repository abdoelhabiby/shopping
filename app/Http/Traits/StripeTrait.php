<?php
namespace App\Http\Traits;


use Exception;
use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Http\Services\StripePaymentService;
use App\Http\Services\AdminNotificationService;

trait StripeTrait
{


    protected function paymentWithSrtipeInit()
    {


        try {

           $data = StripePaymentService::init();
           return view('front.checkout.stripe', compact('data'));


        } catch (\Throwable $th) {

            Log::alert($th);
            return redirect()->back()->with(['error' => __('front.exception_error')]);
        }
    }


    // --------------------------

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


           AdminNotificationService::notificationNewOrder($order);


            //forget the session
            $cart->resetCart();

            DB::commit();

            return redirect()->route('front.user.orders')->with(['success' =>  __('front.order_success')]);
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





}
