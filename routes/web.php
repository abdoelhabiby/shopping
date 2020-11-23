<?php

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


        Route::get('/', 'HomeController@index')->name('front.home');


        //--------------------------------

        Route::get('test', function () {



            return ProductAttribute::where('sku', 'TSH-lg')->get();
        });
    }
);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
