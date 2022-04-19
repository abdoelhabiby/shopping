<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Services\FileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Rules\CheckCountImageProduct;
use Intervention\Image\Facades\Image;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Resources\ProductImagesCollection;

class ProductImageController extends Controller
{

    use AjaxResponseTrait;


    protected $max_images_upload = 7;



    public function __construct()
    {

        $this->middleware('permission:create_product')->only('store');
        $this->middleware('permission:delete_product')->only('destroy');
    }



    //----------------------index-------------------
    public function index(Product $product)
    {
        if (admin()->hasAnyPermission(['read_product', 'create_product'])) {

            return view('dashboard.products.images.index', compact('product'));
        }

        abort(403);
    }

    //--------------get all product images----------------------------

    // public function fetchImages(Product $product)
    // {

    //     if(!request()->ajax()){
    //         return $this->notfound();
    //     }

    //     return  ProductImagesCollection::collection($product->images);

    //     // $html = view('dashboard.products.images._fetch_images', compact('product'))->render();

    //     // return $this->returnRenderHtml('images', $html);
    // }

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

            FileService::checkDirectoryExistsOrCreate($folder_path);

            $get_count_can_upload = $this->max_images_upload - $product->images()->count();

            if (!max($get_count_can_upload, 0) > 0) {
                $message = "sorry product can take just {$this->max_images_upload} images";
                $error = ['image' => [$message]];
                return response(['errors' => $error], 422);
            }


            //max 2mb


            $image = $request->file('image');
            $path ='images/products/' . $product->id . '/' . $image->hashName();
            //save images in folder
            FileService::reszeImageAndSave($image, public_path(), $path);

            //insert to database
            $image = $product->images()->create(['name' => $path]);


            DB::commit();


            return new ProductImagesCollection($image);


        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            $er_mes = 'some errors happend please try agian alatarererewer';
            return response(['error' => $er_mes],400);
        }
    } // end of method storre




    //-----------------------destroy image-----------------





    public function destroy(Product $product, ProductImage $image)
    {


        if (request()->ajax() && $product->id == $image->product_id) {

            try {

                FileService::deleteFile(public_path($image->name));

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
