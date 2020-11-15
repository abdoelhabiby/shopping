<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Rules\CheckCountImageProduct;
use App\Http\Traits\AjaxResponseTrait;

class ProductImageController extends Controller
{

    use AjaxResponseTrait;


    //----------------------index-------------------
    public function index(Product $product)
    {
        return view('dashboard.products.images.index', compact('product'));
    }

    //--------------get all product images----------------------------

    public function fetchImages(Product $product)
    {


        $html = view('dashboard.products.images._fetch_images', compact('product'))->render();

        return $this->returnRenderHtml('images', $html);
    }

    //--------------------------store image in folder product using dropzone-----------------
    public function store(Request $request, $id)
    {

        if ($request->ajax()) {

            $product = Product::find($id);

            if (!$product) {
                return response('not found 404 ', 404);
            }

            if ($request->hasFile('image') && $request->image != null) {

                $request->validate([
                    'image' => [
                        'image',
                        'mimes:png,jpg,jpeg',
                    ]
                ]);


                $image = $request->file('image');
                $path = imageUpload($image, 'products/' . $product->id);
                $original_name = $image->getClientOriginalName();
                $name = $path;

                return response()->json([
                    'name'          => $name,
                    'original_name' => $original_name,
                ]);
            }
        }

        return $this->response();
    }




    //-----------------------store images relation product in database-----------------

    public function storeDatabase(Request $request, Product $product)
    {


        $get_count_can_upload = MAX_IMAGES_UPLOAD - $product->images()->count();


        $request->validate([
            'images' => 'required|array|min:1|max:' . $get_count_can_upload,
            'images.*' => 'required|string|max:150'
        ], [
            'images.required' => 'please upload images',
            'images.max' => 'the product just can have ' . MAX_IMAGES_UPLOAD . ' images',
        ]);


        try {

            DB::beginTransaction();

            $images = $request->images;

            foreach ($images as $image) {

                if (File::exists(public_path($image))) {
                    $add_image = new ProductImage(['name' => $image]);
                    $product->images()->save($add_image);
                }
            }

          //-----------clean folder from images not appended in database---------
            $path = public_path('images/products/' . $product->id);

            $all_images = [];

            foreach (File::allFiles($path) as $file) {
                $all_images[] = str_replace(public_path(), '', $file);
            }

            $product_images_database = $product->images()->pluck('name')->toArray();

            if (count($all_images) > 0) {
                foreach ($all_images as $file) {
                    if (!in_array($file, $product_images_database)) {
                        deleteFile($file);
                    }
                }
            }


            DB::commit();

            return redirect()->back()->with(['success' => "success save"]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            return redirect()->back()->with(['error' => 'some errors happend please try agian alatarererewer']);
        }
    }


    //-------------delete image ----------------

    public function destroy(Product $product, ProductImage $image)
    {
        if (request()->ajax()) {

            $image->delete();

            return $this->successMessage('ok');
        }

       return  abort(404);
    }
} //end of class
