<?php

namespace App\Http\Controllers\Front;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Front\BaseController;
use App\Interfaces\Front\HomeRepositoryInterface;

class HomeController extends BaseController
{




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeRepositoryInterface $home_repository_interface)
    {



        $home_repository = $home_repository_interface;



        //----------get some offers to show in section offers----

        $products_offer = $home_repository->getProductsOffer(9);


        $new_poducts = $home_repository->getNewProducts(18);


        $best_sellers = $home_repository->getBestSellers(18);


        $trending = $home_repository->getProductsTrending(6);


        $ttl = 60 * 60 * 24;
        $slider_images = Cache::remember('home_slider_images', $ttl, function () {
            return Slider::select('image')->latest()->limit(10)->get();
        });





         /**
          * get Main Categories With Nested subcategories Products
          */

         $maincategories_products = $home_repository->getMainCategoriesWithNestedSubcategoriesProducts();


        // ---------------------------------------------------
        $compacts = [
            'products_offer',
            'new_poducts',
            'trending',
            'best_sellers',
            'slider_images',
            'maincategories_products'
        ];
        return view('front.home.index', compact($compacts));
    }
}
