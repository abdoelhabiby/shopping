<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\DataTables\BrandDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Requests\Dashboard\BrandRequest;

class BrandController extends Controller
{
    use AjaxResponseTrait;

    protected $view_model = 'dashboard.brands';
    protected $model = 'brands';


    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BrandDataTable $datatable)
    {

        return $datatable->render($this->view_model . '.index');
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = Category::mainCategory()->select('id')->get();
        return view($this->view_model . '.create',compact('main_categories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //-------------uploade image if found-----------

            if ($request->hasFile('image') && $request->image != null) {
                $image = $request->file('image');
                $path = imageUpload($image, $this->model);
                $validated['image'] = $path;
            }

            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);
            unset($validated['name']);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to create

            Brand::create($data); //create new sub category

            DB::commit();

            return redirect()->route($this->model . '.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return $th->getMessage();
            return catchErro($this->model . '.index', $th);
        }


    }



    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
          $row = $brand;
          $main_categories = Category::mainCategory()->select('id')->get();

        return view($this->view_model . '.edit',compact('row','main_categories'));

    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {

        //return $request->validated();
        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


              //-------------uploade image if found-----------

              if ($request->hasFile('image') && $request->image != null) {
                $image = $request->file('image');
                $path = imageUpload($image, $this->model);
                $validated['image'] = $path;

                deleteFile($brand->image);

            }

            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);

            unset($validated['name']);



            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to update
            $brand->update($data);

            DB::commit();
            return redirect()->route($this->model . '.index')->with(['success' => "success update"]);

        } catch (\Throwable $th) {
            DB::rollback();
            return catchErro($this->model . '.index', $th);
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if (request()->ajax()) {

            $brand->delete();

            return $this->successMessage('ok');
        }

        return $this->notfound();



    }
}