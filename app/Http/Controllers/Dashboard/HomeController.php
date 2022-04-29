<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Dashboard\HomeIndexContract;
use App\Http\Controllers\Dashboard\BaseController;

class HomeController extends BaseController
{

    public $home_repository;
    public function __construct(HomeIndexContract $homeIndexRepository)
    {
        $this->home_repository = $homeIndexRepository;
    }


    public function index(Request $request)
    {
        $year =Carbon::now()->format('Y');


        $products_sold_quantity = $this->home_repository->getTotalProductsSoldQuantity();
        $products_in_stock_quantity = $this->home_repository->getTotalProductsInStockQuantity();
        $profit =  $this->home_repository->getTotalProfit();
        $new_customers = $this->home_repository->getNewCustomers();
        $new_products_order= $this->home_repository->getProductsNewOrders($limit = 6);
        $latest_transactions= $this->home_repository->getLatestTransactions();

        $total_products_sold_amount = $this->home_repository->getTotalProductsSoldAmount();
        $total_products_cost = $this->home_repository->getTotalProductsCost();


        $sales_months= $this->home_repository->getSalesByMonths($year);


        $card_information = collect([
            'profit' => $profit,
            'products_sold_quantity' => $products_sold_quantity,
            'new_customers' => $new_customers,

        ]);



        $chart_information = $this->getChrtInforamionByType($request->get("chart-type"));

        $total_products_percentage =ceil(($products_sold_quantity / ($products_sold_quantity + $products_in_stock_quantity)) * 100);
        $total_sales_percentage =ceil(($total_products_sold_amount / $total_products_cost) * 100);
        $total_profit_percentage =ceil(($profit / $total_products_cost) * 100);


        $chart_cost_revenue = collect([

            'total_products' => [
                "total" => $products_sold_quantity + $products_in_stock_quantity,
                'percentage' => $total_products_percentage
            ],
            'total_sales' => [
                'total' => (int) $total_products_sold_amount,
                'percentage' => $total_sales_percentage
            ],
              'total_cost' => [
                'total' => (int)  $total_products_cost,
                'percentage' => $total_sales_percentage
            ],
              'total_revenue' => [
                'total' =>  (int) $profit ,
                'percentage' => $total_sales_percentage
            ]



        ]);


        $compacts = [
            'card_information',
            'chart_information',
            'new_products_order',
            'latest_transactions',
            'chart_cost_revenue',
            'sales_months'
        ];



        return view('dashboard.home.index', compact($compacts));
    }




    private function getChrtInforamionByType($type="profits")
    {

        if($type && in_array($type,['profits','sales']) ){
            $type = $type;
        }else{
            $type="profits";
        }

        $year =Carbon::now()->format('Y');

        if($type == 'sales'){


        $sales_per_day= $this->home_repository->getSalesLatestDayes(7);
        $sales_per_week= $this->home_repository->getSalesLatestWeek(10,$year);
        $sales_per_months= $this->home_repository->getSalesByMonths($year);

        $chart_information = collect([
            "type" => "sales",
            'per_day' => $sales_per_day,
            'per_week' => $sales_per_week,
            'per_months' => $sales_per_months,
        ]);


        }else{

            $profit_per_day= $this->home_repository->getProfitLatestDayes(7);
            $profit_per_week= $this->home_repository->getProfitLatestWeek(10,$year);
            $profit_per_months= $this->home_repository->getProfitByMonths($year);
            $chart_information = collect([
                "type" => "profits",
                'per_day' => $profit_per_day,
                'per_week' => $profit_per_week,
                'per_months' => $profit_per_months,
            ]);



        }


        return $chart_information;



    }





}
