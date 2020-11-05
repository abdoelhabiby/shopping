<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Requests\Dashboard\ProductRequest;

class ProductController extends Controller
{
    use AjaxResponseTrait;
    protected $view_model = 'dashboard.products';
    protected $model = 'products';
    public $default_paginate = 10;

    public $search_by = [
        '1' => 'products',
        '2' => 'categories',
        '3' => 'brand',
        '4' => 'tags'
    ];


    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $search_by = $this->search_by;
        $sh = $request->sh ?? false;
        $sby = $request->sby ?? false;

        //-------------------filter serch by category or tag or brand-------------------------
        if ($sby && $sh && array_key_exists($sby, $search_by) && $sby != 1) {

            $products = Product::whereHas($search_by[$sby], function ($query) use ($sh) {
                $query->whereTranslationLike('name', '%' . $sh . '%')
                    ->orWhere('slug', 'like', '%' . $sh . '%');
            })->with([
                'categories',
                'tags',
                'brand'
            ])->orderBy('id', 'desc')->paginate($this->default_paginate);

            return view($this->view_model . '.index', compact(['products', 'search_by']));
        }

        //-------------------filter serch by product name-------------------------

        if ($sby && $sh && array_key_exists($sby, $search_by) && $sby == 1) {

            $products = Product::with([
                'categories',
                'tags',
                'brand'
            ])
                ->whereTranslationLike('name', '%' . $sh . '%')
                ->orWhere('slug', 'like', '%' . $sh . '%')
                ->orderBy('id', 'desc')->paginate($this->default_paginate);

            return view($this->view_model . '.index', compact(['products', 'search_by']));
        }

        //----------------------index products-------------------------
        $products = Product::with([
            'categories',
            'tags',
            'brand'
        ])->orderBy('id', 'desc')->paginate($this->default_paginate);
        return view($this->view_model . '.index', compact(['products', 'search_by']));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = Category::subCategory()->select('id')->get();
        $brands = Brand::select('id')->get();
        $tags = Tag::select('id')->get();
        return view($this->view_model . '.create', compact(['sub_categories', 'brands', 'tags']));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $categories = [];
        $tags = [];

        try {

            DB::beginTransaction();

            $validated = $request->validated();

            $validated['vendor_id'] = admin()->id;

            $categories = $validated['categories'];
            unset($validated['categories']);
            if (isset($validated['tags']) && !empty($validated['tags'])) {
                $tags =  $validated['tags'];
                unset($validated['tags']);
            }


            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //----------customize the translation-------------------

            //-------------------name--------------

            $translation_name = nameTranslations($validated['name']);
            unset($validated['name']);

            //----------------description----------

            $trans_content = [];

            foreach ($validated['description'] as $key => $value) {
                if (in_array($key, supportedLanguages())) {
                    $trans_content[$key] = ['description' => $value];
                }
            }

            $translation_description = $trans_content;
            unset($validated['description']);

            $translations = array_merge_recursive($translation_name, $translation_description);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to create

            $product = Product::create($data); //create new  product



            $product->categories()->attach($categories);

            if (count($tags) > 0) {
                $product->tags()->attach($tags);
            }

            DB::commit();

            return redirect()->route($this->model . '.index')->with(['success' => "success create"]);
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


        $sub_categories = Category::subCategory()->select('id')->get();

        $brands = Brand::select('id')->get();
        $tags = Tag::select('id')->get();
        return view($this->view_model . '.edit', compact(['product', 'sub_categories', 'brands', 'tags']));
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

        $categories = [];
        $tags = [];

        try {

            DB::beginTransaction();

            $validated = $request->validated();

            $categories = $validated['categories'];
            unset($validated['categories']);

            if (isset($validated['tags']) && !empty($validated['tags'])) {
                $tags =  $validated['tags'];
                unset($validated['tags']);
            }

            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //----------customize the translation-------------------

            //-------------------name--------------

            $translation_name = nameTranslations($validated['name']);
            unset($validated['name']);

            //----------------description----------

            $trans_content = [];

            foreach ($validated['description'] as $key => $value) {
                if (in_array($key, supportedLanguages())) {
                    $trans_content[$key] = ['description' => $value];
                }
            }

            $translation_description = $trans_content;
            unset($validated['description']);

            $translations = array_merge_recursive($translation_name, $translation_description);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to create

            $product->update($data); //update  product

            if (count($tags) > 0) {
                $product->tags()->sync($tags);
            } else {
                $product->tags()->detach();
            }

            $product->categories()->sync($categories);

            DB::commit();

            return redirect()->route($this->model . '.index')->with(['success' => "success update"]);
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
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route($this->model . '.index')->with(['success' => "success delete"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return catchErro($this->model . '.index', $th);
        }
    }
}
