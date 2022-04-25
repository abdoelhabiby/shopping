<?php

namespace App\Console\Commands;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Services\MyfatoorahPaymentService;
use App\Models\Product;

class CheckOrdersPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check orders pending and expire date payment to return product quantity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            DB::beginTransaction();


            $orders = Order::where('payment_gateway', 'myfatoorah')
                ->where('status', 'pending')
                // ->whereHas('orderProducts')
                ->with('orderProducts')
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get();

            if (!$orders->count() > 0) {
                $this->info('not found record oreders pending to fetch');
                return;
            }

            foreach ($orders as $order) {


                $id = $order->charge_id;
                $payment = MyfatoorahPaymentService::getPaymentData($id, 'invoiceId'); // if will not found will throw excption

                $status = $payment->InvoiceStatus; //Paid or Pending
                $invoice_id = $payment->InvoiceId;

                if ($status == 'Paid') {

                    //---change to paid------------


                    $this->updateWithStatusPaid($payment, $order);
                } else {

                    $this->updateWithStatusPending($payment, $order);

                    //------------ init with pending--------------------


                }
            }

            DB::commit();

            //--------finishd

            $this->info('success updated orders pending ');



            // $this->info('success updated orders pending ');


        } catch (\Throwable $th) {

            DB::rollBack();
            $this->error($th->getMessage());
            return;
        }

         $this->log('fisre scedual check myfatoorah status and handel payment');
    }

    /**
     * if user paid but dsent return callback
     */
    public function updateWithStatusPaid($payment, Order $order)
    {

        if (count($payment->InvoiceTransactions) > 1) {
            foreach ($payment->InvoiceTransactions as $transaction) {
                if ($transaction->TransactionStatus == 'Succss') {
                    $gateway_method = $transaction->PaymentGateway;
                    $payment_id = $transaction->PaymentId;

                    break;
                }
            }
        } else {
            $gateway_method =  ($payment->InvoiceTransactions[0])->PaymentGateway;
            $payment_id = ($payment->InvoiceTransactions[0])->PaymentId;
        }



        $order->update([
            // 'charge_id' => $payment_id,
            'payment_method' => $gateway_method,
            'status' =>  'paid',
            'note' => 'updated to paid after check '
        ]);
    }
    // --------------------------------------------

    public function updateWithStatusPending($payment, Order $order)
    {

        $amount = $payment->InvoiceDisplayValue;
        $str_to_time = strtotime($payment->ExpiryDate . ' ' .  $payment->ExpiryTime);

        $tz = 'Asia/Kuwait';
        // $timestamp =  $str_to_time; // expire after from now
        $dt = new DateTime('now', new DateTimeZone($tz)); //first argument "must" be a string
        $now =  $dt->format('Y-m-d H:i:s'); // in time kuwait
        $expire_date =  date('Y-m-d H:i:s', $str_to_time); // from api payment by date in kuwait

        $expir = Carbon::createFromFormat('Y-m-d H:i:s', $expire_date);
        $now = Carbon::createFromFormat('Y-m-d H:i:s', $now);

        $result = $now->gt($expir); // true it expire

        // -------------if expired make order status refused and return quantity products ----


        if ($result) {

            $products_returned_quantity = 0; //slug_slug

            foreach ($order->orderProducts as $order_product) {
                $product = Product::where('id', $order_product->product_id)
                    ->whereHas('attribute', function ($q) use ($order_product) {
                        return $q->where('id', $order_product->product_attribute_id);
                    })
                    ->with(['attribute' => function ($q) use ($order_product) {
                        return $q->where('id', $order_product->product_attribute_id);
                    }])->first();

                $product->attribute->increment('qty', $order_product->quantity);
                $products_returned_quantity += $order_product->quantity;
            }

            $order->update([
                'status' =>  'refused',
                'return_quantity' => 1,
                'refused_reason' => 'This invoice has expired',
                // 'note' => ''
            ]);
        }
    }

    // --------------------------------------------
    // --------------------------------------------
}
