<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\AjaxResponseTrait;
use App\Contracts\Dashboard\ProductContract;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\Controllers\Dashboard\BaseController;
use App\Http\Resources\Dahboard\ProdctsCollection;


class ProductController extends BaseController
{
    use AjaxResponseTrait;
    protected $view_model = 'dashboard.products';
    protected $model = 'products';
    public $default_paginate = 10;

    public $product_repository;


    public function __construct(ProductContract $product_repository)
    {
        $this->middleware('permission:read_product')->only('index');
        $this->middleware('permission:create_product')->only(['create', 'store']);
        $this->middleware('permission:update_product')->only(['edit', 'update']);
        $this->middleware('permission:delete_product')->only('destroy');


        $this->product_repository = $product_repository;
    }




    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ------------------------------------------


        return view($this->view_model . '.index');
    }
    // -------------------------------------------


    public function fetchDataTable()
    {

        return $this->product_repository->fetchDatatable();
    }


    // -------------------------------------------
    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories =  Category::mainCategory()
            ->whereHas('subCategories')
            ->with(['subCategories' => function ($query) {
                $query->whereHas('categories')->with('categories:id,parent_id,slug')->select(['parent_id', 'slug', 'id']);
            }])
            ->select(['slug', 'id'])->get();



        $brands = Brand::select('id')->get();
        $tags = Tag::select('id')->get();

        return view($this->view_model . '.create', compact(['categories', 'brands', 'tags']));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $create_product = $this->product_repository->createProduct($validated);

            if ($create_product) {
                DB::commit();
                return redirect()->route($this->model . '.index')->with(['success' => "success create"]);
            }

            return $this->redirectBackError();
        } catch (\Throwable $th) {

            DB::rollback();

            return catchErro($this->model . '.index', $th);
        }
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {



        $categories =  Category::mainCategory()
        ->whereHas('subCategories')
        ->with(['subCategories' => function ($query) {
            $query->whereHas('categories')->with('categories:id,parent_id,slug')->select(['parent_id', 'slug', 'id']);
        }])
        ->select(['slug', 'id'])->get();

        $product->load('categories');


        $brands = Brand::select('id')->get();
        $tags = Tag::select('id')->get();
        return view($this->view_model . '.edit', compact(['product','categories', 'brands', 'tags']));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(ProductRequest $request, Product $product)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $update = $this->product_repository->updateProduct($validated, $product);

            if ($update) {
                DB::commit();
                return redirect()->route($this->model . '.index')->with(['success' => "success update"]);
            }

            return $this->redirectBackError();
        } catch (\Throwable $th) {
            DB::rollback();
            return catchErro($this->model . '.index', $th);
        }
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            if ($this->product_repository->deleteProduct($id)) {
                return $this->responseJson(false, 200, ['success delete product']);
            }

            return $this->responseJson(true, 404, ['not found']);

    }

    // -----------------------------------------
    public function redirectBackError()
    {

        $message = 'some errors happend pleas try again later';
        return redirect()->back()->with(['error' => $message]);
    }
    // -----------------------------------------

}
