<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\AdminRequest;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:super_admin');
    }

    //-------------------index-----------------
    public function index()
    {
        $rows = Admin::role('admin')->paginate(10);

        return view('dashboard.admins.index', compact('rows'));
    }

    //-----------------show create form------------------

    public function create()
    {

        $permissions = Role::whereNotIn('name',['super_admin','admin'])
                             ->where('guard_name' , 'admin')
                             ->with(['permissions' => function($q){
                                 return $q->select('name');
                             }])
                             ->select(['id','name'])
                             ->get();

        $collect =  collect($permissions[0]->permissions);

        return $collect->pluck('name');

        return view('dashboard.admins.create');
    }

    //-----------------show create form------------------
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {



        try {

            $validated = $request->validated();

            $validated['password'] = Hash::make($validated['password']);

            $admin =  Admin::create($validated);

            $admin->assignRole('admin');

            return redirect()->route('admins.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            return catchErro('admins.index',$th);

        }


    }



    //------------------------show form edit ---------------

    public function edit(Admin $admin)
    {
        $row =  $admin;

        return view('dashboard.admins.edit', compact('row'));
    }
    //------------------------show form edit ---------------



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $Admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $Admin)
    {


        try {

            $validated = $request->validated();

            if ($request->password && $request->password != '' && !empty(trim($request->password))) {

                $validated["password"] = Hash::make($request->password);
            } else {

                unset($validated['password']);
            }



            $Admin->update($validated);


            return redirect()->route('admins.index')->with(['success' => "success update"]);
        } catch (\Throwable $th) {

            return catchErro('admins.index',$th);

        }
    }


    //-----------------------------delete admin------------------------------

    public function destroy(Admin $admin)
    {
        try {

            $admin->delete();
            return redirect()->route('admins.index')->with(['success' => "success delete"]);

        } catch (\Throwable $th) {

            return catchErro('admins.index',$th);
        }
    }

    //-----------------------------delete admin------------------------------
}
