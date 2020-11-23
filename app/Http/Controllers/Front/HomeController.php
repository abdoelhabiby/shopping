<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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



        $test = Product::where('slug','samsung-galaxy-7')->active()->with('attribute')->first();


        //----------get some offers to show in section offers----
         $products_offer = $homeRepository->getProductsOffer(9);

         //--------------------get new products added----------

          $new_poducts = $homeRepository->getNewProducts(18);



        $compacts = ['products_offer','new_poducts'];
        return view('front.home.index', compact($compacts));
    }
}
