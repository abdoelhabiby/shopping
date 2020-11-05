<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Requests\Dashboard\ProductAttributeRequest;

class ProductAttributeController extends Controller
{
    use AjaxResponseTrait;



    public function index(Product $product)
    {
        return view('dashboard.products/attributes/index', compact('product'));
    }



    //---------------------store attribute-------------------


    public function store(ProductAttributeRequest $request, Product $product)
    {


        if ($request->ajax()) {



            try {

                DB::beginTransaction();

                $validated = $request->validated();
                $validated['is_active'] = $request->has('is_active') ? true : false; //get active




                //----------add product id-------------------

                $validated['product_id'] = $product->id;

                //----------customize the translation-------------------

                $translations = nameTranslations($validated['name']);
                unset($validated['name']);

                //-----------------------------------
                $data = array_merge($translations, $validated); // handel data to create

                ProductAttribute::create($data); //create new attribute

                DB::commit();

                return $this->successMessage('success create new attribute');
            } catch (\Throwable $th) {
                DB::rollback();

                Log::alert($th);

                return $this->notfound();
            }
        }

        return $this->notfound();
    }


    //---------------------------update attribute-----------------------


    public function update(ProductAttributeRequest $request, Product $product, ProductAttribute $attribute)
    {


        if ($request->ajax()) {

            if ($product->id !== $attribute->product_id) {
                return $this->notfound();
            }



            try {

                DB::beginTransaction();

                $validated = $request->validated();
                $validated['is_active'] = $request->has('is_active') ? true : false; //get active

                //----------customize the translation-------------------

                $translations = nameTranslations($validated['name']);
                unset($validated['name']);

                //-----------------------------------
                $data = array_merge($translations, $validated); // handel data to create

                $attribute->update($data); //create new attribute

                DB::commit();

                return $this->successMessage('success create new attribute');
            } catch (\Throwable $th) {
                DB::rollback();

                Log::alert($th);

                return $this->notfound();
            }
        }

        return abort(404);
    }


    //---------------------- return ajax fetch all attributes ------------


    public function fetchAttributes(Request $request, Product $product)
    {


        if ($request->ajax()) {
            $html = view('dashboard.products/attributes/_fetch_ajax_attribute', compact('product'))->render();

            return $this->returnRenderHtml('attributes', $html);
        }

        return  abort(404);
    }


    //-----------destroy attribute--------------------


    public function destroy(Product $product, ProductAttribute $attribute)
    {
        if (request()->ajax()) {

            if ($product->id !== $attribute->product_id) {
                return $this->notfound();
            }

            $attribute->delete();

            return $this->successMessage('ok');
        }


        return  abort(404);
    }
}
