<?php

use App\Cart\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


/*

 ** comment at 9/10/2021.
 ** we have some mistakes...
 ** routes name dosent have same name start like (dashbord).
 ** fixxxxxxxxxxxxxxxx it....

*/

if (!defined('PAGINATE_COUNT')) define('PAGINATE_COUNT', '10');


Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('test',  "TestControler@test");

    Route::post('test', function (Request $request) {

        return $request;
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

    ], [
        'except' => 'show'
    ]);


    //----------------- start routes product attributes and images---------------

    //---------------------------product images--------------------------
    Route::group(['prefix' => 'product-images'], function () {

        Route::get('{product:slug}', "ProductImageController@index")->name('product.images.index');
        Route::post('{product}/store', "ProductImageController@store")->name('product.images.store');
        // Route::post('{product}', "ProductImageController@storeDatabase")->name('product.images.store_database');
        Route::get('{product}/fetch', "ProductImageController@fetchImages")->name('product.images.fetch');
        Route::delete('{product}/{image}', "ProductImageController@destroy")->name('product.images.delete');
        // Route::post('dropzone/{product}', "ProductImageController@dropZoneDeleteImage")->name('product.images.dropzone.delete');
    });

    //-------------------------product attributes-----------------------------
    Route::group(['prefix' => 'product-attributes'], function () {

        Route::get('{product:slug}', "ProductAttributeController@index")->name('product.attibutes.index');
        Route::get('{product:slug}/fetch', "ProductAttributeController@fetchAttributes")->name('product.attibutes.fetch_attribute');
        Route::post('{product}', "ProductAttributeController@store")->name('product.attibutes.store');
        Route::put('{product}/{attribute}', "ProductAttributeController@update")->name('product.attibutes.update');
        Route::delete('{product}/{attribute}', "ProductAttributeController@destroy")->name('product.attibutes.delete');
    });

    //----------------- end routes product attributes-----------------


    //----------------------strat settings-----------------------

    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {

        //-------------------------home page sliders---------------------------
        Route::group(['prefix' => 'homepage-sliders'], function () {

            Route::get('/', 'HomepageSlider@index')->name('admin.homepage_slider.index');
            Route::post('store', "HomepageSlider@store")->name('admin.homepage_slider.store');
            // Route::post('/', "HomepageSlider@storeDatabase")->name('admin.homepage_slider.store_database'); //store into databse
            Route::get('fetch', "HomepageSlider@fetchImages")->name('admin.homepage_slider.fetch');
            Route::delete('{slider}', "HomepageSlider@destroy")->name('admin.homepage_slider.delete');
        });
    });

    //----------------------end settings-----------------------


    //----------------------start orders---------------------

    Route::resource(
        'orders',
        OrderController::class,
        ['as' => 'dashboard', 'except' => ['create', 'store']]
    );

    //----------------------end orders-----------------------

    // ------------------------------------------------------------


    Route::get('logout', 'Auth\LoginController@logout')->name('dashboard.logout');
});


Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', 'Auth\LoginController@showFormLogin')->name('dashboard.form_login');
    Route::post('/login', 'Auth\LoginController@login')->name('dashboard.login');
});
