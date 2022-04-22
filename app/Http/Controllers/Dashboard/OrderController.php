<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;

class OrderController extends Controller
{


    use AjaxResponseTrait;
    protected $view_model = 'dashboard.orders';
    public $default_paginate = 10;


    public function __construct()
    {
        $this->middleware('permission:read_order')->only(['index','show']);
        $this->middleware('permission:create_order')->only(['create', 'store']);
        $this->middleware('permission:update_order')->only(['edit', 'update']);
        $this->middleware('permission:delete_order')->only('destroy');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDataTable $datatable)
    {
        return $datatable->render($this->view_model . '.index');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        ->findOrFail($id);


        return view($this->view_model . '.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
