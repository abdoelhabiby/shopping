<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\BaseController;

class OrderController extends BaseController
{



    public function index()
    {

        $orders = user()->orders()->wherehas('orderProducts')->orderBy('created_at','desc')->paginate(20);

        return view('front.profile.orders.index',compact('orders'));
    }


    public function show($id)
    {


    $order = Order::with([
        'orderProducts.product' => function ($query) {
           $query->withTrashed()->select([
               "id",
               "slug",
               "sku",
               "is_active",
           ])->with('image');
       },
       'orderProducts.attribute' => function ($query) {
           $query->withTrashed()->select([
               "id",
               "sku",
               "qty",
               "product_id",
               "is_active",
           ]);
       },
       ])
       ->where('user_id',user()->id)
       ->findOrFail($id);


        return view('front.profile.orders.show',compact('order'));

    }



}
