<?php

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

define('PAGINATE_COUNT',10);

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('test',function(){

        $test = Category::with('parent.translation_default')->subCategory()->first();

       return $test;

    });



    //-------------------------------------------

    Route::get('/', function () {
        return view('dashboard.home');
    })->name('dashboard.home');


    Route::resources([
        "admins" => "AdminController",
        "users" => "UserController",
        "main-categories" => "MainCategoryController",
        "sub-categories" => "SubCategoryController",
        "brands" => "BrandController",
    ],[
        'except' => 'show'
    ]);

    Route::get('logout', 'Auth\LoginController@logout')->name('dashboard.logout');
});


Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', 'Auth\LoginController@showFormLogin')->name('dashboard.form_login');
    Route::post('/login', 'Auth\LoginController@login')->name('dashboard.login');
});




// <!-- /resources/views/post/create.blade.php -->

// <h1>Create Post</h1>

// @if ($errors->any())
//     <div class="alert alert-danger">
//         <ul>
//             @foreach ($errors->all() as $error)
//                 <li>{{ $error }}</li>
//             @endforeach
//         </ul>
//     </div>
// @endif

// <!-- Create Post Form -->
