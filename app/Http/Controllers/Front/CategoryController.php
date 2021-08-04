<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{



    //--------------show maincategory------------


    public function mainCategory($category_slug)
    {
        $maincategory =  Category::mainCategory()->active()->where('slug', $category_slug)
            ->whereHas('chields', function ($chiled) {
                return $chiled->active()->whereHas('chields');
                // return $chiled;
            })
            ->with(['chields.chields' => function ($chiled) {
                return $chiled->active()->whereHas('products',function($t){
                    return $t->active();
                })->inRandomOrder()->take(10);
            }])
            ->firstOrFail();





        return view('front.categories.maincategory', compact('maincategory'));
    }

    //--------------show subcategories------------

    public function subCategory($category_slug)
    {


        $subcategory =  Category::subCategory()->active()->where('slug', $category_slug)
            ->whereHas('chields', function ($chiled) {
                return $chiled->where('is_active', true);
            })
            ->with(['chields' => function ($chiled) {
                return $chiled->active()->whereHas('products');
            }])
            //
            ->firstOrFail();

        if (!$subcategory->chields->count() > 0) {
            abort('404');
        }

        $categories_with_paginate =  $subcategory->chields()->active()->whereHas('products',function($t){
            return $t->active();
        })->paginate(18);

        return view('front.categories.subcategory', compact(['subcategory', 'categories_with_paginate']));
    }


    //----------------------------------------------

    public function category($subcategory, $category)
    {
        $subcategory =  Category::subCategory()->active()->where('slug', $subcategory)
            ->whereHas('chield', function ($chiled) use ($category) {
                return $chiled->where('is_active', true)->where('slug', $category);
            })
            ->with(['chield' => function ($chiled) use ($category) {
                // return $chiled->active()->where('slug', $category)->whereHas('products')->with(['products' => function($p){
                //     return $p->active()->paginate(1);
                // }]);
                return $chiled->active()->where('slug', $category)->whereHas('products');
            }])
            //
            ->firstOrFail();

        $category = $subcategory->chield;
         $category_products = $category->products()->active()->paginate(2);

        // if (!$category_products->count() > 0) {
        //     abort('404');
        // }


        return view('front.categories.category', compact(['category', 'category_products']));
    }
    //----------------------------------------------
    //----------------------------------------------

} //end of class--------------
