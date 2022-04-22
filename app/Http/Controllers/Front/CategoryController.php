<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\BaseController;

class CategoryController extends BaseController
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
                return $chiled->active()->whereHas('products', function ($t) {
                    return $t->active();
                })->inRandomOrder()->take(10);
            }])
            ->firstOrFail();





        return view('front.categories.maincategory', compact('maincategory'));
    }

    //--------------show subcategories------------

    public function subCategory(Category $subcategory)
    {


        $sub_category_chields = Category::where('parent_id', $subcategory->id)
            ->whereHas('products', function ($products) {
                $products->active();
            })
            ->withTranslation()
            ->active()
            ->paginate(18);

        return view('front.categories.subcategory', compact(['subcategory', 'sub_category_chields']));
    }


    //----------------------------------------------

    public function category(Category $subcategory, $category)
    {



           $category =   Category::where('slug', $category)
            ->where('parent_id', $subcategory->id)
            ->whereHas('products',function($products){
                return $products->active()->withTranslation();
            })
            ->with('parent')
            ->active()
            ->firstOrFail();

        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('product_categories.category_id', $category->id);
        })
            ->with([
                'attribute' => function ($attr) {
                    return $attr->where('is_active', true)
                        ->select([
                            "sku",
                            "qty",
                            "product_id",
                            "is_active",
                            "price",
                            "price_offer",
                            "start_offer_at",
                            "end_offer_at",
                            "id",
                        ])->withTranslation();
                },
                'vendor:id,name,email',
                'reviewsRating',
                'images' => function ($images) {
                    $images->take(2);
                }
            ])
            // ->withTranslation()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('front.categories.category', compact(['category', 'products']));
    }
    //----------------------------------------------
    //----------------------------------------------

} //end of class--------------
