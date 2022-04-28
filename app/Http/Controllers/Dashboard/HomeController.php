<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Contracts\Dashboard\HomeIndexContract;
use App\Http\Services\AdminNotificationService;
use App\Http\Controllers\Dashboard\BaseController;
use App\Events\Dashboard\NotificationNewOrderEvenet;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;

class HomeController extends Controller
{

    public $home_repository;
    public function __construct(HomeIndexContract $homeIndexRepository)
    {
        $this->home_repository = $homeIndexRepository;
    }


    public function index()
    {
        $year =Carbon::now()->format('Y');


        $products_sold = $this->home_repository->getTotalProductsSold();
        $profit =  $this->home_repository->getTotalProfit();
        $new_customers = $this->home_repository->getNewCustomers();
        $profit_per_day= $this->home_repository->getProfitLatestDayes(7);
        $profit_per_week= $this->home_repository->getProfitLatestWeek(10,$year);
        $profit_per_months= $this->home_repository->getProfitByMonths($year);
        $new_products_order= $this->home_repository->getProductsNewOrders($limit = 6);
        $latest_transactions= $this->home_repository->getLatestTransactions();



        $card_information = collect([
            'profit' => $profit,
            'products_sold' => $products_sold,
            'new_customers' => $new_customers,

        ]);

        $chart_information = collect([
            'profit_per_day' => $profit_per_day,
            'profit_per_week' => $profit_per_week,
            'profit_per_months' => $profit_per_months,
        ]);


        $compacts = [
            'card_information',
            'chart_information',
            'new_products_order',
            'latest_transactions'
        ];



        return view('dashboard.home.index', compact($compacts));
    }
}
