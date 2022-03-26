<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Traits\AjaxResponseTrait;
use App\Http\Requests\Front\ProductReviewRequest;
use App\Http\Controllers\Front\BaseController;

class ProductReviewController extends BaseController
{

    use AjaxResponseTrait;


    //----------------- show all productss reviews--------

    public function index($product_slug)

    {


        $product =  Product::active()->where('slug', $product_slug)->select([
            "id",
            "sku",
            "slug",
            "is_active",
            "meta_keywords",
        ])->with([
            'attribute' => function ($attr) {
                return $attr->where('is_active', true)
                    ->select([
                        "sku",
                        "qty",
                        "product_id",
                        "is_active",
                        "id",
                    ]);
            },
            'reviewsRating'
        ])
            ->firstOrFail();



        // $ttt = ProductReview::where('product_id', $product->id)

        // ->select('quality', DB::raw('count(*) as total'))
        // ->groupBy('quality')
        // ->orderBy('quality','desc')
        // ->get();


        $quality = [];

        for ($i = 5; $i > 0; $i--) {
            $quality[$i] = ProductReview::where('product_id', $product->id)->where('quality', $i)->count();
        }



        $reviews = $product->reviews()->paginate(10);

        $calculate_reviews = $product->reviewsRating->first();

        ///---------------this baaaaaad-----evaluations--------
        //--------It can be done in a better way----
        $evaluations = [
            'total_add_rate' => $calculate_reviews->total_rating ?? 0,
            'quality' => $quality
        ];


        return view('front.product.reviews.index', compact(['product', 'reviews', 'calculate_reviews', 'evaluations']));
    }

    //-------------store review---------------

    public function store(ProductReviewRequest $request)
    {

        if (!request()->ajax()) {
            return $this->notfound();
        }

        $product_id = $request->validated()['product_id'];

        $product = Product::where('id', $product_id)

            ->select(['id', 'slug'])
            ->active()->first();

        if (!$product) {
            return $this->notfound();
        }


        try {





              $get_image = $product->images()->first() ? asset($product->images()->first()->name) : pathNoImage();
              $product->image =$get_image;
              $product->description = stringLength($product->description, 200);


            $validated = $request->validated();
            $validated = array_merge(['user_id' => user()->id], $validated);

            $review = ProductReview::create($validated);

            $review->created_at_diff =  $review->created_at->diffForHumans();

            $review->user_name = user()->name;


            $calculate_reviews = $product->reviewsRating()->first();

            return response(['data' => ['review' => $review, 'calculate_reviews' => $calculate_reviews,'product' => $product]], 201);


        } catch (\Throwable $th) {

            return $th->getMessage();
            return $this->notfound();
        }
    }


    //-----------------------update review--------------------


    public function update(ProductReviewRequest $request)
    {

        if (!request()->ajax()) {
            return $this->notfound();
        }



        try {

            $product_id = $request->validated()['product_id'];

            $product = Product::where('id', $product_id)
                ->select(['id', 'slug'])
                ->active()->first();

            if (!$product) {
                return $this->notfound();
            }



            $review =  ProductReview::whereHas('product', function ($pro) use ($request) {
                return $pro->where('id', $request->product_id)->active();
            })->with('product')->where('product_id', $request->product_id)->where('user_id', user()->id)->first();


            if (!$review) {
                return $this->notfound();
            }

            $validated = $request->validated();
            unset($validated['product_id']);

            $review->update($validated);


            $calculate_reviews = $product->reviewsRating()->first();

            return response()->json(['calculate_reviews' => $calculate_reviews  ]);

        } catch (\Throwable $th) {
            return $this->notfound();
        }
    }


    //-----------------delete review--------------------------

    public function destroy(Request $request)
    {


        if (!request()->ajax() || !$request->product_id) {
            return $this->notfound();
        }

        try {

            $review =  ProductReview::whereHas('product', function ($pro) use ($request) {
                return $pro->where('id', $request->product_id)->active();
            })->with('product')->where('product_id', $request->product_id)->where('user_id', user()->id)->first();


            if (!$review) {
                return $this->notfound();
            }

            $product = $review->product;

            $review->delete();


            $calculate_reviews = $this->getCalculateReviews($review->product->id);

            return response()->json([
                'calculate_reviews' => $calculate_reviews
            ]);

            // return $this->returnRenderHtml('append_modal', $modal_html);
        } catch (\Throwable $th) {
            return $this->notfound();
        }
    }


    //-------------------------------------------------

    //method to calculate reviews starts with count user rating

    private function getCalculateReviews($product_id)
    {
        return ProductReview::select(
            \DB::raw("ROUND(SUM(CAST(quality as integer)) * 5 / (COUNT(id) * 5)) as stars"),
            \DB::raw("COUNT(id) as total_rating")
        )->where('product_id', $product_id)->first();
    }
    //-------------------------------------------------


}//-----end of class
