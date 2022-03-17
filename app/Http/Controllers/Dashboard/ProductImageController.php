<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Rules\CheckCountImageProduct;
use Intervention\Image\Facades\Image;
use App\Http\Traits\AjaxResponseTrait;

class ProductImageController extends Controller
{

    use AjaxResponseTrait;


    protected $max_images_upload = 7;



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
    public function store(Product $product, Request $request)
    {

        if (!$request->ajax()) {
            return $this->notfound();
        }


        $request->validate([
            'image' =>  'required|image|mimes:jpg,png,jpeg|max:2048'

        ]);

        try {


            DB::beginTransaction();


            $folder_path = public_path('images/products/' . $product->id);

            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0775, true);
            }


            $get_count_can_upload = $this->max_images_upload - $product->images()->count();

            if (!max($get_count_can_upload, 0) > 0) {
                $message = "sorry product can take just {$this->max_images_upload} images";
                $error = ['image' => [$message]];
                return response(['errors' => $error], 400);
            }


            //max 2mb


            $image = $request->file('image');
            $original_name = $image->getClientOriginalName();

            $path ='images/products/' . $product->id . '/' . $image->hashName();

            $resize = Image::make($image)
                ->fit(900, 800, function ($constraint) {
                    $constraint->upsize();
                })->encode('png', 100)->save(public_path($path));


            //insert to database
            $product->images()->create(['name' => $path]);

            DB::commit();

            return response()->json([
                'name'          => $path,
                'original_name' => $original_name,
            ]);

        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            $er_mes = 'some errors happend please try agian alatarererewer';
            return response(['error' => $er_mes],400);
        }
    } // end of method storre




    //-----------------------store images relation product in database-----------------

    public function storeDatabase(Request $request, Product $product)
    {


        $get_count_can_upload = $this->max_images_upload - $product->images()->count();


        $request->validate([
            'images' => 'required|array|min:1|max:' . $get_count_can_upload,
            'images.*' => 'required|string|max:150'
        ], [
            'images.required' => 'please upload images',
            'images.max' => 'the product just can have ' . $this->max_images_upload . ' images',
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

    public function dropZoneDeleteImage(Product $product, Request $request)
    {
        $image = $request->has('image_name') ? $request->image_name : false;

        $check_image = File::exists(public_path($image)) ? true : false;


        if (!isset($image) || !$check_image) {

            return response('not found 404 ', 404);
        }

        File::delete(public_path($image));

        return true;
    }

    public function destroy(Product $product, ProductImage $image)
    {
        $check_image = File::exists(public_path($image->name)) ? true : false;

        if (request()->ajax() && $product->id == $image->product_id && $check_image) {

            try {

                File::delete(public_path($image->name));
                $image->delete();

                return $this->successMessage('ok');
            } catch (\Throwable $th) {
                Log::alert($th);
                abort(404);
            }
        }

        return  abort(404);
    }
} //end of class
