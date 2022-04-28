<?php

namespace App\Repositories\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dashboard\HomeIndexContract;

class HomeIndexRepository implements HomeIndexContract
{

    /**
     * @return float
     */
    public function getTotalProfit()
    {

        $profit =  Order::where('status', 'paid')
            ->withTrashed()
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->join('product_attributes', 'order_products.product_attribute_id', 'product_attributes.id')
            ->select([
                DB::raw("SUM((order_products.price * order_products.quantity) - (product_attributes.purchase_price * order_products.quantity)) as profit")
            ])

            ->first();

        $profit = (float) $profit->profit ?? 0;
        return $profit;
    }


    /**
     * @return int
     */
    public function getTotalProductsSold()
    {
        $totla_sold =  Order::where('status', 'paid')
            ->withTrashed()
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->select([
                DB::raw("SUM(order_products.quantity) as total_porudtcs_sold")
            ])
            ->first();

        return $totla_sold->total_porudtcs_sold ?? 0;
    }


    /**
     * @return int
     */
    public function getNewCustomers()
    {

        return  User::count();
    }


    /**
     * @param int $dayes
     * @return mixed
     */

    public function getProfitLatestDayes(int $dayes)
    {


        $start_date = Carbon::now()->subDays($dayes)->format('Y-m-d');
        $end_date = Carbon::now()->format('Y-m-d');
        $latest_seven_dayes = Order::where('orders.status', 'paid')
            ->withTrashed()
            ->whereBetween('orders.created_at', [$start_date . " 00:00:00", $end_date . " 23:59:59"])
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->join('product_attributes', 'order_products.product_attribute_id', 'product_attributes.id')
            ->select([
                DB::raw("SUM((order_products.price * order_products.quantity) - (product_attributes.purchase_price * order_products.quantity)) as profit"),
                DB::raw("DATE_FORMAT(orders.created_at, '%m/%e') day")
            ])
            ->groupBy(['day'])
            // ->latest('orders.created_at')
            ->get();

        return $latest_seven_dayes;
    }

    /**
     * @param int $weeks
     * @param  $year
     * @return mixed
     */

    public function getProfitLatestWeek(int $weeks, $year)
    {



        $weeks = Order::where('orders.status', 'paid')
            ->withTrashed()
            ->whereYear('orders.created_at',  $year)
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->join('product_attributes', 'order_products.product_attribute_id', 'product_attributes.id')
            ->select([
                DB::raw("SUM((order_products.price * order_products.quantity) - (product_attributes.purchase_price * order_products.quantity)) as profit"),
                DB::raw("week(orders.created_at) AS week")
            ])
            ->groupBy('week')
            ->latest('orders.created_at')
            ->limit($weeks)
            ->get();

        return $weeks;
    }

    /**
     * @param  $year
     * @return mixed
     */
    public function getProfitByMonths($year)
    {


        $months = Order::where('orders.status', 'paid')
            ->withTrashed()
            ->whereYear('orders.created_at',  $year)
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->join('product_attributes', 'order_products.product_attribute_id', 'product_attributes.id')
            ->select([
                DB::raw("SUM((order_products.price * order_products.quantity) - (product_attributes.purchase_price * order_products.quantity)) as profit"),
                DB::raw("substr(DATE_FORMAT(orders.created_at, '%M'),1,3) month")
            ])
            ->groupBy('month')
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return $months;
    }

 /**
     * @param int $limit
     *
     * @return mixed
     *
     * fix n+1
     *
     */

    public function getProductsNewOrders($limit = 6)
    {

        $products = OrderProduct::with(['product:id,slug'])

            ->select([
                'order_id',
                'product_id',
                DB::raw("SUM(quantity * price) as total"),
                DB::raw("SUM(quantity ) as quantity"),
                'created_at',

            ])

            ->groupBy(['product_id'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();


        $product_users = [];

        foreach ($products as $product) {

            $users = User::whereHas('orders', function ($q) use ($product) {
                $q->whereHas('orderProducts', function ($q) use ($product) {
                    $q->where('product_id', $product->product_id);
                });
            })
                ->limit(3)
                ->get(['name', 'image']);
            $product->users = $users;
            $product_users[] = $product;
        }

        return collect($product_users);

    }

     /**
     * @param int $limit
     * @param int $products_limit
     * @param int $categories_limit
     * @return mixed
     *
     */


    public function getLatestTransactions($limit=6,$products_limit=5,$categories_limit=2)
    {
        $latest_transactions = Order::with([
            'user:id,name,image',
              'products:id',
              'products.image',

        ])

            // ->latest()
            ->limit(6)
            ->select([
                'orders.id',
                'user_id',
                'charge_id',
                'amount',
                'status',
            ])
            ->get();

        return $latest_transactions;
    }



}//-------------end of class----------
