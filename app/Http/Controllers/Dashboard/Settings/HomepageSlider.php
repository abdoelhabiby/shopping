<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Services\FileService;
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

    public function __construct()
    {
        $this->middleware('permission:read_slider')->only('index');
        $this->middleware('permission:create_slider')->only('store');
        $this->middleware('permission:delete_slider')->only('destroy');
    }


    //----------------------index-------------------
    public function index()
    {


        $sliders = Slider::latest()->limit(10)->get();
        return view('dashboard.settings.home_page_slider.index', compact('sliders'));
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
                return response(['errors' => $error], 422);
            }


            //max 2mb


            $image = $request->file('image');
            $original_name = $image->getClientOriginalName();

            $path = 'images/sliders/' . $image->hashName();

            FileService::reszeImageAndSave($image, public_path(), $path, 600, 350);


            //insert to database
            $slider =  Slider::create(['image' => $path]);

            DB::commit();

            return response()->json([
                'data' => [
                    'id'          => $slider->id,
                    'image_url' => asset($slider->image),
                    'image_url_delete' => route('admin.homepage_slider.delete', $slider->id)
                ]
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::alert($th);
            $er_mes = 'some errors happend please try agian alatarererewer';
            return response(['error' => $er_mes], 400);
        }
    }


    //-------------delete image ----------------

    public function destroy(Slider $slider)
    {
        if (request()->ajax()) {



            try {

                FileService::deleteFile(public_path($slider->image));

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
