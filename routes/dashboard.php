<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

define('PAGINATE_COUNT',10);
define('MAX_IMAGES_UPLOAD',7);

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('test',function(){

        $path = public_path('images/products/1');

            $all_images = [];

             foreach(File::allFiles($path) as $file ){

                $all_images[] = str_replace(public_path() . '/','',$file);

             }

             return $all_images;




      //  return view('dashboard.test',compact(['product']));

//$test = Category::with('parent.translation_default')->subCategory()->first();
//
     //  return $test;

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
        "tags" => "TagController",
        "products" => "ProductController",


    ],[
        'except' => 'show'
    ]);


    //----------------- start routes product attributes and images---------------

    //---images-----
    Route::get('product-images/{product:slug}',"ProductImageController@index")->name('product.images.index');
    Route::post('product-images/{product}/store',"ProductImageController@store")->name('product.images.store');
    Route::post('product-images/{product}',"ProductImageController@storeDatabase")->name('product.images.store_database');
    Route::get('product-images/{product}/fetch',"ProductImageController@fetchImages")->name('product.images.fetch');
    Route::delete('product-images/{product}/{image}',"ProductImageController@destroy")->name('product.images.delete');

     //---attributes-----

    Route::post('product-attributes/{product}',"ProductAttributeController@store")->name('product.attibutes.store');


    //----------------- end routes product attributes-----------------


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
