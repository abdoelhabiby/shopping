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


            $categories = Category::mainCategory()
                ->active()
                ->whereHas('chields', function ($chi) {
                    return $chi->whereHas('products');
                })
                ->with(['chields'])
                ->inRandomOrder()
                ->get()
                ->map(function ($main) {
                    $main->setRelation('chields', $main->chields->take(2));
                    return $main;
                });




            //  return $categories;

            $groups = [];

            foreach ($categories as $main_categories) {
                // echo "(div) $main_categories->name"; // strat get main category name

                foreach ($main_categories->chields as $subcategory) {
                    if ($subcategory->products->count() > 0) { // if not fund name translation
                        foreach ($subcategory->products()->active()->whereHas('attribute')->take(2)->get() as $product) {
                            // echo "<br>---(div) $product->name ";
                            // echo "(/div)<br>";

                            $groups[$main_categories->name][] = $product;

                        }
                    }
                }

                // echo "(/div)<br><br>------------------------------- <br>"; // end get main category name

            }

            return $groups;
            return;







            //-----------get product by relation throught----------------




        });
    }
);




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
