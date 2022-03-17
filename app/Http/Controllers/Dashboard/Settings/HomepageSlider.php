<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Traits\AjaxResponseTrait;

class HomepageSlider extends Controller
{

    use AjaxResponseTrait;
    protected $max_images_upload = 10;


    //----------------------index-------------------
    public function index()
    {


        $sliders = Slider::latest()->limit(10)->get();
        return view('dashboard.settings.home_page_slider.index', compact('sliders'));
    }

    //--------------get all product images----------------------------

    public function fetchImages()
    {

        $sliders = Slider::latest()->limit(10)->get();

        $html = view('dashboard.settings.home_page_slider._fetch_images', compact('sliders'))->render();

        return $this->returnRenderHtml('images', $html);
    }

    //--------------------------store image in folder product using dropzone-----------------
    public function store(Request $request)
    {

        // add validation files count before save

        if (!$request->ajax()) {
            return $this->notfound();
        }


        $request->validate([
            'image' =>  'required|image|mimes:jpg,png,jpeg|max:2048'

        ]);


        try {


            DB::beginTransaction();


            $folder_path = public_path('images/sliders');

            if (!File::exists($folder_path)) {
                File::makeDirectory($folder_path, 0775, true);
            }

            $get_count_can_upload = $this->max_images_upload - Slider::count();



            if (!max($get_count_can_upload, 0) > 0) {
                $message = "sorry sliders can add just {$this->max_images_upload} images";
                $error = ['image' => [$message]];
                return response(['errors' => $error], 400);
            }


            //max 2mb


            $image = $request->file('image');
            $original_name = $image->getClientOriginalName();

            $path = 'images/sliders/' . $image->hashName();

            $resize = Image::make($image)
                ->fit(600, 350, function ($constraint) {
                    $constraint->upsize();
                })->encode('png', 100)->save(public_path($path));


            //insert to database
            Slider::create(['image' => $path]);

            DB::commit();

            return response()->json([
                'name'          => $path,
                'original_name' => $original_name,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            $er_mes = 'some errors happend please try agian alatarererewer';
            return response(['error' => $er_mes], 400);
        }
    }





    //-----------------------store images relation product in database-----------------

    public function storeDatabase(Request $request)
    {


        $slider_count = Slider::count();

        $get_count_can_upload = $this->max_images_upload - $slider_count;


        $request->validate([
            'images' => 'required|array|min:1|max:' . $get_count_can_upload,
            'images.*' => 'required|string|max:150'
        ], [
            'images.required' => 'please upload images',
            'images.max' => 'the product just can have ' . $this->max_images_upload . ' images'
        ]);


        try {

            DB::beginTransaction();

            $images = $request->images;

            foreach ($images as $image) {

                if (File::exists(public_path($image))) {

                    Slider::create(['image' => $image]);
                }
            }

            //-----------clean folder from images not appended in database---------
            $path = public_path('images/sliders');

            $all_images = [];

            foreach (File::allFiles($path) as $file) {  //get all images in folder
                $all_images[] = str_replace(public_path(), '', $file);
            }

            $slider_images_in_database = Slider::pluck('image')->toArray();

            //delete image not saved in database
            if (count($all_images) > 0) {
                foreach ($all_images as $file) {
                    if (!in_array($file, $slider_images_in_database)) {
                        deleteFile($file);
                    }
                }
            }


            DB::commit();

            return redirect()->back()->with(['success' => "success save"]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            return redirect()->back()->with(['error' => 'some errors happend please try agian later']);
        }
    }


    //-------------delete image ----------------

    public function destroy(Slider $slider)
    {
        if (request()->ajax()) {



            try {

                deleteFile($slider->image);
                $slider->delete();
                return $this->successMessage('ok');
            } catch (\Throwable $th) {
                Log::alert($th);
                abort(404);
            }
        }

        abort(404);
    }
} //end of class
