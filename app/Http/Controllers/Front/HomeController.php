<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Repositories\Front\HomeRepository;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HomeRepository $homeRepository)
    {



        //----------get some offers to show in section offers----
        $products_offer = $homeRepository->getProductsOffer(9);

        //--------------------get new products added----------

        $new_poducts = $homeRepository->getNewProducts(18);

        //--------------------get products best sellers ----------

        $best_sellers = $homeRepository->getBestSellers(18);

        //--------------------get products trending ----------

        $trending = $homeRepository->getProductsTrending(6);

        //----------------------get image sliders------------------

        $slider_images = Slider::select('image')->latest()->limit(10)->get();

        //-----------get 3 main categories with his chileds products-------

        /*
         **
         ** alert danger
         ** we must decide count of chields get
         ** and limit of product in this chiled to
         ** performance and thow count show in page
         ** the cield get = 3 * 4 products = 12 to every category
         **

        */


        $three_main_categories = $homeRepository->getThreeMainCategoriesWithChieldsProducts(3, 4);

        // ---------------------------------------------------
        $compacts = [
            'products_offer',
            'new_poducts',
            'trending',
            'best_sellers',
            'three_main_categories',
            'slider_images'
        ];
        return view('front.home.index', compact($compacts));
    }
}
