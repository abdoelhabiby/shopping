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

        //-----------get 3 main categories with his chileds products-------

        /*
         **
         **
         ** we must decide count of chields get
         ** and limit of product in this chiled to
         ** performance and how count show in page
         ** the chield get = 3 * 4 products = 12 to every category
         **

        */


         $three_main_categories = $home_repository->getThreeMainCategoriesWithChieldsProducts(3, 4);



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
