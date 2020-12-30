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

            //-------------------------------------------------------

            //-----------------------routes auth----------------------------

            Route::group(['middleware' => 'auth'], function () {

                //-------------------start wishlis--------------------
                Route::group(['prefix' => 'mywishlist'], function () {

                    Route::get('/', 'MywishlistController@index')->name('mywishlist.index');
                    Route::post('product-details/{product_slug}', 'MywishlistController@store')->name('mywishlist.store');
                });

                //-------------------end wishlis--------------------


            });
            //-------------------------------------------------------
            //-------------------------------------------------------
            //-------------------------------------------------------
        });


        // class Foo{
        //     public function __invoke()
        //     {
        //         return "test";
        //     }
        // }

        Route::get('test', function () {

            // return new Foo;

            $product =  Product::first();

          return   $mywishlist = Mywishlist::firstOrCreate([
                 'product_id' => $product->id,
                 'user_id' => user()->id
             ]);


            return user()->mywishlists;
        });



        //------------routes default auth-----------------
        Auth::routes();
    }
); // end group packege LaravelLocalization








Route::get('/home', 'HomeController@index')->name('home');
