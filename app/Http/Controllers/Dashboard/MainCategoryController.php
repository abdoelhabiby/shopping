<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\DataTables\MainCategoryDataTable;
use App\Http\Requests\Dashboard\MainCategoryRequest;

class MainCategoryController extends Controller
{
    use AjaxResponseTrait;
    protected $view_model = 'dashboard.main_categories';


    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MainCategoryDataTable $datatable)
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
        return view($this->view_model . '.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //-------------uploade image if found-----------

            if ($request->hasFile('image') && $request->image != null) {
                $image = $request->file('image');
                $path = imageUpload($image, 'categories');
                $validated['image'] = $path;
            }

            //----------customize the translation-------------------

            $translations = $validated['name'];
            unset($validated['name']);
            $trans_content = [];

            foreach ($translations as $key => $value) {
                if (in_array($key, supportedLanguages())) {
                    $trans_content[$key] = ['name' => $value];
                }
            }
            //-----------------------------------
            $data = array_merge($trans_content, $validated); // handel data to create

            Category::create($data); //create new category

            DB::commit();

            return redirect()->route('main-categories.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return catchErro('main-categories.index', $th);
        }


    }



    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $main_category)
    {
         $row = $main_category;

        return view($this->view_model . '.edit',compact('row'));

    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request, Category $main_category)
    {
        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


              //-------------uploade image if found-----------

              if ($request->hasFile('image') && $request->image != null) {
                $image = $request->file('image');
                $path = imageUpload($image, 'categories');
                $validated['image'] = $path;

                deleteFile($main_category->image);

            }

            //----------customize the translation-------------------

            $translations = $validated['name'];
            unset($validated['name']);
            $trans_content = [];

            foreach ($translations as $key => $value) {
                if (in_array($key, supportedLanguages())) {
                    $trans_content[$key] = ['name' => $value];
                }
            }
            //-----------------------------------
            $data = array_merge($trans_content, $validated); // handel data to update

            $main_category->update($data);

            DB::commit();

            return redirect()->route('main-categories.index')->with(['success' => "success update"]);

        } catch (\Throwable $th) {
            DB::rollback();


            return catchErro('main-categories.index', $th);
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $main_category)
    {
        if (request()->ajax()) {
            $main_category->delete();

            return $this->successMessage('ok');
        }

        return $this->notfound();


    }
}
