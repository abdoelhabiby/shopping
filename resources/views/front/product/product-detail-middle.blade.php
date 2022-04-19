<div class="product-detail-middle">
    <div class="container">
        <div class="row">
            <div class="tabs col-lg-9 col-md-7 ">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">@lang('front.description')</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews">
                            @lang('front.reviews')

                            (<span
                                class="total_ratings">{{ $product->reviewsRating->first() ? $product->reviewsRating->first()->total_rating : 0 }}</span>)

                        </a>
                    </li>


                </ul>

                <div class="tab-content" id="tab-content">

                    <div class="tab-pane fade in active" id="description">

                        <div class="product-description">
                            <p>{!! nl2br(e($product->description)) !!}</p>

                        </div>

                    </div>




                    <div class="tab-pane fade in " id="reviews">
                        <div id="product_comments_block_tab" class="p-4">



                            <div class="poduct_reviews">



                                @if ($product->reviews->count() > 0)

                                    @foreach ($product->reviews as $review)
                                        <div class="comment clearfix" id="review_id_{{ $review->id }}">

                                            <div class="comment_author" style=" display: grid">

                                                <div class="d-flex">

                                                    {{ hundelProductReviewsStars($review->quality) }}
                                                    @auth
                                                        @if (user()->id == $review->user_id)
                                                            <a class="open-comment-form" data-toggle="modal"
                                                                data-target="#new_comment_form" href="#"><i
                                                                    class="fa fa-edit"></i>
                                                            </a>
                                                        @endif
                                                    @endauth


                                                </div>

                                                <div class="comment_author_infos">
                                                    <div class="user-comment"><i class="fa fa-user"></i>
                                                        {{ $review->user->name }}
                                                    </div>
                                                    <div class="date-comment">
                                                        {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="comment_details" style="">
                                                <h4>{{ $review->title }}</h4>
                                                <p> {!! nl2br(e($review->review)) !!}</p>
                                            </div>

                                        </div>
                                    @endforeach


                                    <div class="text-center">
                                        <a class=" btn btn-info"
                                            href="{{ route('product.reviews.index', $product->slug) }}" style="">
                                            <i class="fa fa-eye"></i> @lang('front.see_all_reviews')
                                        </a>
                                    </div>



                                @endif

                            </div>


                        </div>


                    </div>






                </div>
            </div>




        </div>
    </div>
</div>
