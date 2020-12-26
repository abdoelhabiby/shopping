<?php

use App\Cart\Cart;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Route;
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
            Route::post('cart/{product_sku}/{product_attribute_sku}', 'CartController@store')->name('cart.add');

            //---------------get modal show product details by ajax--------------

            Route::post('product-details/{product_sku}/{attribute_sku}', 'ProductDetailsAjax@index')->name('get-product-details-modal');

            //---------------------------------------------
        });



        Route::get('test', function () {








        });



        //------------routes default auth-----------------
        Auth::routes();
    }
); // end group packege LaravelLocalization








Route::get('/home', 'HomeController@index')->name('home');
