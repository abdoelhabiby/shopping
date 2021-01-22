<?php

use App\Cart\Cart;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Mywishlist;
use App\Models\ProductAttribute;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
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

{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}
|
*/


Route::group(
    [
        // 'prefix' => LaravelLocalization::setLocale(),
        //------for unit testing stop redirect set language------
        'prefix' => !App::runningUnitTests() ? LaravelLocalization::setLocale(null) : config('app.locale'),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::group(['namespace' => 'Front'], function () {


            Route::get('/', 'HomeController@index')->name('front.home');

            //-------------------routes cart-----------------
            Route::get('cart', 'CartController@index')->name('cart.index');
            Route::post('cart/{product_slug}/{product_attribute_id}', 'CartController@store')->name('cart.add');
            Route::put('cart/{product_slug}/{product_attribute_id}', 'CartController@update')->name('cart.update');
            Route::delete('cart/{product_slug}/{product_attribute_id}', 'CartController@destroy')->name('cart.destroy');

            //---------------get modal show product details by ajax--------------

            Route::post('product-details/{product_slug}/{product_attribute_id}', 'ProductDetailsAjax@index')->name('get-product-details-modal');

            //-------------------------------------------------------------
            //----------------------------product--------------------------
            Route::get('product/{product_slug}/{product_attribute_id}', 'ProductController@show')->name('front.prouct.show');
            //-------------------------------------------------------------


            //-----------------------see all product reviews-------------------------------

            Route::get('product-reviews/{product_slug}', 'ProductReviewController@index')->name('product.reviews.index');


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

                //-------------------start product reviews--------------------

                Route::post('product/review', 'ProductReviewController@store')->name('product.review.store');
                Route::put('product/review', 'ProductReviewController@update')->name('product.review.update');
                Route::delete('product/review', 'ProductReviewController@destroy')->name('product.review.destroy');


                //-------------------end product reviews--------------------


            });
            //-------------------------------------------------------
            //-------------------------------------------------------
            //-------------------------------------------------------
        });




        Route::get('test', function () {


            return "test";


        });



        //------------routes default auth-----------------
        Auth::routes();
    }
); // end group packege LaravelLocalization







Route::get('/home', 'HomeController@index')->name('home');
