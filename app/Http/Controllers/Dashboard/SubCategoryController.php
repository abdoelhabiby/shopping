<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Services\FileService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Traits\AjaxResponseTrait;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\Dashboard\SubCategoryRequest;

class SubCategoryController extends Controller
{
    use AjaxResponseTrait;
    protected $view_model = 'dashboard.sub_categories';

    public function __construct()
    {
        $this->middleware('permission:read_category')->only('index');
        $this->middleware('permission:create_category')->only(['create', 'store']);
        $this->middleware('permission:update_category')->only(['edit', 'update']);
        $this->middleware('permission:delete_category')->only('destroy');
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubCategoryDataTable $datatable)
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

        $maincategories =  Category::mainCategory()
        ->with('subCategories:id,parent_id,slug')
        ->get();

        return view($this->view_model . '.create', compact('maincategories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //-------------uploade image if found-----------

            if ($request->hasFile('image') && $request->image != null) {


                $folder_path = public_path('images/categories');

                FileService::checkDirectoryExistsOrCreate($folder_path);



                $image = $request->file('image');
                $path = 'images/categories/' . $image->hashName();

                FileService::reszeImageAndSave($image, public_path(), $path);

                $validated['image'] = $path;
            }

            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);
            unset($validated['name']);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to create

            Category::create($data); //create new sub category

            DB::commit();

            return redirect()->route('sub-categories.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            DB::rollback();

            return catchErro('sub-categories.index', $th);
        }
    }



    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $sub_category)
    {
        $row = $sub_category;

       $maincategories =  Category::mainCategory()
        ->with(['subCategories' => function($q) use($row) {
            $q->where('id','!=',$row->id)->select(['id','parent_id','slug']);
        }])
        ->where('id','!=',$row->id)
        ->get();


        return view($this->view_model . '.edit', compact('row', 'maincategories'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, Category $sub_category)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active


            //-------------uploade image if found-----------

            if ($request->hasFile('image') && $request->image != null) {

                $folder_path = public_path('images/categories');

                FileService::checkDirectoryExistsOrCreate($folder_path);

                $image = $request->file('image');
                $path = 'images/categories/' . $image->hashName();

                FileService::reszeImageAndSave($image, public_path(), $path);

                $validated['image'] = $path;

                FileService::deleteFile(public_path($sub_category->image));
            }

            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);
            unset($validated['name']);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to update

            $sub_category->update($data);

            DB::commit();

            return redirect()->route('sub-categories.index')->with(['success' => "success update"]);
        } catch (\Throwable $th) {
            DB::rollback();

            return catchErro('sub-categories.index', $th);
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $sub_category)
    {
        if (request()->ajax()) {
            FileService::deleteFile(public_path($sub_category->image));

            $sub_category->delete();

            return $this->successMessage('ok');
        }

        return $this->notfound();
    }
}
