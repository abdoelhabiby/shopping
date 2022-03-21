<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Front\HomeRepository;
use App\Interfaces\Front\HomeRepositoryInterface;

class HomeController extends Controller
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

        //--------------------get new products added----------

        $new_poducts = $home_repository->getNewProducts(18);

        //--------------------get products best sellers ----------

        $best_sellers = $home_repository->getBestSellers(18);

        //--------------------get products trending ----------

        $trending = $home_repository->getProductsTrending(6);

        //----------------------get image sliders------------------

        $slider_images = Slider::select('image')->latest()->limit(10)->get();





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
