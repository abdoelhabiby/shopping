<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class FrontSearchController extends BaseController
{


    public function search(Request $request)
    {
        $search = $request->q;



    $products = Product::when($search, function ($query) use ($search) {

        $query->whereTranslationLike('name', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')
            ->orWhere('sku', 'like', '%' . $search . '%')
            ->orWhereHas('categories', function ($query) use ($search) {
                $query->whereTranslationLike('name', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
    })
        ->with([
            'attribute',
            'reviewsRating',
            'images'
        ])
        ->active()
        ->orderBy('id', 'desc')
        ->paginate(12);


     return view('front.catalog.search', compact( 'products'));



    }
}
