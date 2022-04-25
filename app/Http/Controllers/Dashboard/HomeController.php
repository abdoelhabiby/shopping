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


        $column_can_order = ['read_at', 'created_at'];

       return $notifications = admin()->notifications()->whereNull('read_at')
            ->get();



            $notifications = admin()->notifications()

        ->orderBy('created_at', 'desc')->get();

  //     $notifications = admin()->notifications()->latest()->limit(6)->get();

    //    return AdminNotificationsCollection::collection($notifications);


    // $order = Order::latest()->first();


    //     // return route('dashboard.orders.show',$order->id);

    //  broadcast(new NotificationNewOrderEvenet($order));

        return view('dashboard.home');
    }


}
