<?php

use App\Cart\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
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

{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}
|
*/




Route::group(
    [
        //  'prefix' => LaravelLocalization::setLocale(),
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

            //----------------------------product--------------------------
            Route::get('product/{product_slug}/{product_attribute_id}', 'ProductController@show')->name('front.prouct.show');


            //-----------------------see all product reviews-------------------------------

            Route::get('product-reviews/{product_slug}', 'ProductReviewController@index')->name('product.reviews.index');


            //-----------------------routes with auth----------------------------

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

                //----------------------checkout----------------------

                // Route::get('checkout/{amount}','CheckoutController@index')->name('front.checkout.index');

                Route::get('checkout', 'CheckoutController@index')->name('front.checkout.index');
                Route::post('charge', 'CheckoutController@charge')->name('front.checkout.charge');
            });
            //---------------------end routes with auth------------

            //-----------------------start routes categories---------

            //----route main category--------------
            Route::get('m/{category:slug}', "CategoryController@mainCategory")->name('front.main_category.show');
            //-------------------------------------------------------

            //-----route subcategory==-------------
            Route::get('s/{category:slug}', "CategoryController@subCategory")->name('front.subcategory.show');

            //-----route category-------------
             Route::get('category/{subcategory:slug}/{category:slug}', "CategoryController@category")->name('front.category.show');

            //-------------------------------------------------------
            //-------------------------------------------------------
            //-------------------------------------------------------
        });






        Route::get('test', function () {

            $best_sellers =  Product::active()

                ->with(
                    [
                        'vendor' => function ($vend) {
                            return $vend->select(['name', 'id']);
                        },
                        'attribute' => function ($attr) {
                            return $attr->select([
                                "id",
                                "sku",
                                "qty",
                                "product_id",
                                "is_active",
                                "price",
                                "price_offer",
                                "start_offer_at",
                                "end_offer_at",
                            ])->where('is_active', true);
                        },
                        'reviews' => function ($rev) {
                            return $rev->select(
                                'product_id',
                                \DB::raw("ROUND(SUM(quality) * 5 / (COUNT(id) * 5)) as stars"),
                                \DB::raw("COUNT(product_id) as total_rating"),
                            )->groupBy('product_id');
                        }

                    ]
                )->latest()->limit(18)->get();


            return view('front.test', compact('best_sellers'));

            // http://127.0.0.1:8000/ar/m/category-name
            // get the main category

            //return $category =  Category::mainCategory()->where('slug','clothes')->firstOrFail();

            // http://127.0.0.1:8000/ar/s/category-name
            // get subcategory

            // return $category =  Category::mainCategory()->where('slug','clothes')->firstOrFail();

            $maincategory =  Category::mainCategory()->where('slug', 'fashions')->firstOrFail();


            //--------from here------------------------

            $subcategories = $maincategory->chields()->with(['chields' => function ($ch) {
                return $ch->select(['parent_id', 'id']);
            }])->get();


            //------set ids subcategories and categories to get prodcts by relation ---
            $chields_id = [];
            $chields_id = array_merge($chields_id, $subcategories->pluck('id')->toArray());

            $categories_array = [];
            //--------get categories from subcategories-----
            $categories =  $subcategories->pluck('chields');

            //--------loop to merq all opjects
            foreach ($categories as $key => $value) {
                $categories_array = array_merge($categories_array, collect($value)->toArray());
            }
            $categories_ids = collect($categories_array)->pluck('id')->toArray();
            return $chields_id = array_merge($chields_id, $categories_ids);

            //-------------to here to get some products a7a--------------------

            //  return $category->chields;

            //----------------get relation by custom join------
            $products = DB::table('products')
                ->join('product_categories', function ($join) use ($chields_id) {
                    $join->on('products.id', '=', 'product_categories.product_id')
                        ->whereIn('product_categories.category_id', $chields_id);
                })
                ->select('products.*', 'product_categories.category_id')
                ->get();


            return $products;
        });



        //------------routes default auth-----------------
        Auth::routes();
    }
); // end group packege LaravelLocalization







Route::get('/home', 'HomeController@index')->name('home');
