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
            'orderProducts' => function($q){
                return $q->with([
                    'product',
                    'attribute' => function ($q){
                    return $q->select([
                        "id",
                        "sku",
                        "qty",
                        "product_id",
                        "is_active",
                    ]);
                },'productImage']);

            },


            'user' => function($q){
                return $q->select(['id','name','email','image']);
            }
            ])->findOrFail($id);



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
