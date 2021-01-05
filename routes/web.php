<?php

use App\Cart\Cart;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Mywishlist;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['namespace' => 'Front'], function () {


            Route::get('/', 'HomeController@index')->name('front.home');

            //-------------------routes cart-----------------
            Route::post('cart/{product_slug}/{product_attribute_id}', 'CartController@store')->name('cart.add');

            //---------------get modal show product details by ajax--------------

            Route::post('product-details/{product_slug}/{product_attribute_id}', 'ProductDetailsAjax@index')->name('get-product-details-modal');

            //-------------------------------------------------------------
            //----------------------------product--------------------------
            Route::get('p/{product_slug}/{product_attribute_id}','ProductController@show')->name('front.prouct.show');
            //-------------------------------------------------------------

            //-----------------------routes auth----------------------------

            Route::group(['middleware' => 'auth'], function () {

                //-------------------start wishlis--------------------
                Route::group(['prefix' => 'mywishlist'], function () {

                    Route::get('/', 'MywishlistController@index')->name('mywishlist.index');
                    Route::post('{product_slug}', 'MywishlistController@store')->name('mywishlist.store');
                    Route::delete('{product_id}', 'MywishlistController@destroy')->name('mywishlist.destroy');
                });

                //-------------------end wishlis--------------------


            });
            //-------------------------------------------------------
            //-------------------------------------------------------
            //-------------------------------------------------------
        });




        Route::get('test', function () {

            // $atribute_id = 8;

            // $product = Product::where('slug','d-ress')->latest()->take(5)->get();

            // return $product;

           return view('front.product.index');

        });



        //------------routes default auth-----------------
        Auth::routes();
    }
); // end group packege LaravelLocalization








Route::get('/home', 'HomeController@index')->name('home');
