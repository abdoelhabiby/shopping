<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{





    public function mainCategory($category_slug)
    {
            $maincategory =  Category::mainCategory()->active()->where('slug', $category_slug)
            ->whereHas('chields', function ($chiled) {
                  return $chiled->active()->whereHas('chields');
                // return $chiled;
            })
            ->with(['chields.chields' => function($chiled){
                return $chiled->active()->whereHas('products');
            }])
            ->firstOrFail();



        return view('front.categories.maincategory',compact('maincategory'));


    }




    // return $category->chields()->with(['products' => function($q){
    //     return $q->select('products.id');
    // }])->get();


}
