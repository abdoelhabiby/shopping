<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\UserRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_user')->only('index');
        $this->middleware('permission:create_user')->only(['create', 'store']);
        $this->middleware('permission:update_user')->only(['edit', 'update']);
        $this->middleware('permission:delete_user')->only('destroy');
    }







    //------------------------shoew all uesrs------------------
    public function index()
    {
        $rows = User::paginate(PAGINATE_COUNT);
        return view('dashboard.users.index', compact('rows'));
    }

    //------------------------show all uesrs------------------


    //------------------------create uesr------------------

    public function create()
    {
        return view('dashboard.users.create');
    }
    //------------------------create uesrs------------------

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {



        try {

            $validated = $request->validated();

            $validated['password'] = Hash::make($validated['password']);

            if ($request->hasFile('image') && $request->image != null) {

                $image = $request->file('image');

                $path = imageUpload($image, 'users');

                $validated['image'] = $path;
            }

            User::create($validated);

            return redirect()->route('users.index')->with(['success' => "success create"]);
        } catch (\Throwable $th) {
            return catchErro('users.index', $th);
        }
    }




    //-----------------edit user ------------------
    public function edit(User $user)
    {
        $row = $user;
        return view('dashboard.users.edit', compact('row'));
    }
    //-----------------edit user ------------------


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {



        try {

            $validated = $request->validated();

            if ($request->password && $request->password != '' && !empty(trim($request->password))) {

                $validated["password"] = bcrypt($request->password);
            } else {

                unset($validated['password']);
            }

            if ($request->hasFile('image') && $request->image != null) {

                $image = $request->file('image');

                $path = imageUpload($image, 'users');

                $validated['image'] = $path;

                if ($user->image != 'images/default.png') {
                    deleteFile($user->image);
                }
            }



            $user->update($validated);


            return redirect()->route('users.index')->with(['success' => "success update"]);
        } catch (\Throwable $th) {
            return catchErro('users.index', $th);
        }
    }



    //----------------delete user ------------------


    public function destroy(User $user)
    {

        try {

            if ($user->image != 'images/default.png') {
                deleteFile($user->image);
            }

            $user->delete();

            return redirect()->route('users.index')->with(['success' => "success delete"]);
        } catch (\Throwable $th) {
            return catchErro('users.index', $th);
        }
    }
}
