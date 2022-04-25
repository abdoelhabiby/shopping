<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\BaseController;
use App\Events\Dashboard\NotificationNewOrderEvenet;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;

class HomeController extends Controller


{


    public function index()
    {


    // $order = Order::latest()->first();


    //     // return route('dashboard.orders.show',$order->id);

    //  broadcast(new NotificationNewOrderEvenet($order));

        return view('dashboard.home');
    }


}
