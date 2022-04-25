<?php

use App\Cart\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserCollection;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Resources\ProductImagesCollection;
use App\Http\Resources\Dahboard\ProdctsCollection;
use App\Events\Dashboard\NotificationNewOrderEvenet;
use App\Http\Resources\Dashboard\AdminNotificationsCollection;

/*

 ** comment at 9/10/2021.
 ** we have some mistakes...
 ** routes name dosent have same name start like (dashbord).
 ** fixxxxxxxxxxxxxxxx it....

*/

if (!defined('PAGINATE_COUNT')) define('PAGINATE_COUNT', '10');


Route::group(['middleware' => ['auth:admin', 'shar_view_dash']], function () {



    // ----------------------test-------------------


    Route::get('test', function () {


    });


    //-------------------------------------------

    Route::get('/', 'HomeController@index')->name('dashboard.home');


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



    // ----------------------admin notifications-------------

    Route::get('notifications', 'AdminNotificationsController@index')->name('dashboard.notifications.index');
    Route::get('notifications/fetch', 'AdminNotificationsController@fetch')->name('dashboard.notifications.fetch');
    Route::get('notifications/fetch-datatable', 'AdminNotificationsController@fetchDatatable')->name('dashboard.notifications.fetchDatatable');
    Route::post('notifications', 'AdminNotificationsController@makeAllRead')->name('dashboard.notifications.makeAllRead');
    Route::delete('notifications/{id}', 'AdminNotificationsController@destroy')->name('dashboard.notifications.delete');

    // ---------------------------------------------------


    // -----------------------fetch datatable ajax----------------


    Route::get('products/fetch', 'ProductController@fetchDataTable')->name('products.datatable.fetch');

    //----------------- start routes product attributes and images---------------

    //---------------------------product images--------------------------
    Route::group(['prefix' => 'product-images'], function () {

        Route::get('{product:slug}', "ProductImageController@index")->name('product.images.index');
        Route::post('{product}/store', "ProductImageController@store")->name('product.images.store');
        Route::delete('{product}/{image}', "ProductImageController@destroy")->name('product.images.delete');
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
            Route::delete('{slider}', "HomepageSlider@destroy")->name('admin.homepage_slider.delete');
        });
    });

    //----------------------end settings-----------------------


    //----------------------start orders---------------------

    Route::resource(
        'orders',
        OrderController::class,
        ['as' => 'dashboard', 'except' => ['create', 'store']]
    )->middleware('MakeNotifyAsRead:admin');

    //----------------------end orders-----------------------

    // ------------------------------------------------------------


    Route::get('logout', 'Auth\LoginController@logout')->name('dashboard.logout');
});


Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('/login', 'Auth\LoginController@showFormLogin')->name('dashboard.form_login');
    Route::post('/login', 'Auth\LoginController@login')->name('dashboard.login');
});
