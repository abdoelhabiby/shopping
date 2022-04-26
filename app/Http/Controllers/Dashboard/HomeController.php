<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Services\AdminNotificationService;
use App\Http\Controllers\Dashboard\BaseController;
use App\Events\Dashboard\NotificationNewOrderEvenet;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;
use App\Models\User;

class HomeController extends Controller


{


    public function index()
    {

        $products_sold = OrderProduct::sum('quantity');

        // -------------profit--------------

           $profit = OrderProduct::join('product_attributes','order_products.product_attribute_id','product_attributes.id')
        ->select([

            DB::raw("SUM((order_products.price * order_products.quantity) - (product_attributes.purchase_price * order_products.quantity)) as profit")
            ])
        ->first();
        $profit = (float) $profit->profit;

        $new_customers = User::count();

        $card_information = collect([
            'profit' => $profit,
            'products_sold' => $products_sold,
            'new_customers' => $new_customers
        ]);


        $compacts = [
           'card_information',
        ];



        return view('dashboard.home.index',compact($compacts));
    }
}
