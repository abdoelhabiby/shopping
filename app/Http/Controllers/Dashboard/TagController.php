<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\DataTables\TagDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Requests\Dashboard\TagRequest;

class TagController extends Controller
{
    use AjaxResponseTrait;

    protected $view_model = 'dashboard.tags';
    protected $model = 'tags';

    public function __construct()
    {
        $this->middleware('permission:read_tag')->only('index');
        $this->middleware('permission:create_tag')->only(['create', 'store']);
        $this->middleware('permission:update_tag')->only(['edit', 'update']);
        $this->middleware('permission:delete_tag')->only('destroy');
    }




    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagDataTable $datatable)
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
    public function store(TagRequest $request)
    {


        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active




            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);
            unset($validated['name']);

            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to create

            Tag::create($data); //create new tag

            DB::commit();

            return redirect()->route($this->model . '.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return catchErro($this->model . '.index', $th);
        }


    }



    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
          $row = $tag;
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
    public function update(TagRequest $request, Tag $tag)
    {

        try {

            DB::beginTransaction();

            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? true : false; //get active



            //----------customize the translation-------------------

            $translations = nameTranslations($validated['name']);

            unset($validated['name']);



            //-----------------------------------
            $data = array_merge($translations, $validated); // handel data to update
            $tag->update($data);

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
    public function destroy(Tag $tag)
    {
        if (request()->ajax()) {

            $tag->delete();

            return $this->successMessage('ok');
        }

        return $this->notfound();



    }
}
