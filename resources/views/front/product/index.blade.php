@extends('layouts.front')

@section('title')
    | {{ $product->name }}
@stop


@section('breadcrumb')



    <nav data-depth="3" class="breadcrumb-bg">
        <div class="container no-index">
            <div class="breadcrumb" style="background-color: #eee; border-radius: 25px;">

                <ol itemscope="" itemtype="">
                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="{{ route('front.home') }}">
                            <span itemprop="name">
                                @lang('front.home')
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="" class="active ">
                            <span itemprop="name">{{ $product->name }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop

@section('content')

    <div class="no-index">
        <div id="content-wrapper">

            <section id="main" itemscope="" itemtype="">
                <meta itemprop="url" content="">
                <div class="product-detail-top">
                    <div class="container">



                        <div class="row main-productdetail" data-product_layout_thumb="list_thumb"
                            style="position: relative;">
                            <div class="col-lg-5 col-md-4 col-xs-12 box-image">

                                <section class="page-content" id="content">


                                    {{-- ---------- images ------- --}}

                                    <div class="images-container list_thumb">

                                        <div class="product-cover">
                                            @if ($product->images->first())
                                                <img class="js-qv-product-cover img-fluid"
                                                    src="{{ fileExist($product->images->first()->name) ? asset($product->images->first()->name) : pathNoImage() }}"
                                                    alt="" title="{{ $product->name }}" style="width:100%;"
                                                    itemprop="image">
                                            @else
                                                <img class="img-fluid image-cover" src="{{ pathNoImage() }}" alt=""
                                                    title="{{ $product->name }}" style="width:100%;" itemprop="image">
                                            @endif


                                            <div class="layer hidden-sm-down" data-toggle="modal"
                                                data-target="#product-modal">
                                                <i class="fa fa-expand"></i>
                                            </div>
                                        </div>


                                        @if ($product->images->count() > 0)

                                            <div class="js-qv-mask mask only-product">
                                                <div class="row">

                                                    @foreach ($product->images as $image)
                                                        <div class="item thumb-container col-md-6 col-xs-12 pt-30">
                                                            <img class="img-fluid thumb js-thumb  @if ($loop->first) 'selected' @endif "
                                                                src="{{ asset($image->name) }}" alt=""
                                                                title="{{ $product->name }}" itemprop="image">
                                                        </div>
                                                    @endforeach



                                                </div>
                                            </div>

                                        @endif


                                    </div>



                                </section>

                            </div>

                            {{-- ---------------product information and buttons add cart,wishlist --}}

                            <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">
                                <div class="product-information">
                                    <div class="product-actionss">

                                        <form action="{{ route('cart.add', [$product->slug, $product->attribute->id]) }}"
                                            method="post" id="form-add-to-cart" class="row">

                                            {{-- ---------------product reviews------------ --}}
                                            <div class="productdetail-right col-12 col-lg-6 col-md-6">
                                                <div class="product-reviews">
                                                    <div id="product_comments_block_extra">

                                                        <div class="comments_note">

                                                            <span>Review: </span>
                                                            <div class="star_content clearfix">

                                                                @php
                                                                    $stars = $product->reviewsRating->first() ? $product->reviewsRating->first()->stars : 0;
                                                                    echo hundelProductReviewsStars($stars);
                                                                @endphp

                                                            </div>
                                                        </div>


                                                        <div class="comments_advices d-block">
                                                            <span class="comments_advices_tab"><i
                                                                    class="fa fa-comments"></i>@lang('front.reviews')
                                                                (<span
                                                                    class="total_ratings">{{ $product->reviewsRating->first() ? $product->reviewsRating->first()->total_rating : 0 }}</span>)
                                                            </span>

                                                            @auth()
                                                                <a class="open-comment-form" data-toggle="modal"
                                                                    data-target="#new_comment_form" href="#"><i
                                                                        class="fa fa-edit"></i>{{ ucfirst(__('front.write_review')) }}
                                                                </a>
                                                            @else
                                                                <a class="" href="{{ route('login') }}"><i
                                                                        class="fa fa-edit"></i>{{ ucfirst(__('front.write_review')) }}</a>
                                                            @endauth

                                                        </div>
                                                    </div>


                                                    <!--  /Module NovProductComments -->

                                                </div>

                                                <h1 class="detail-product-name" itemprop="name">
                                                    {{ $product->name }}
                                                </h1>



                                                <div class="group-price d-flex justify-content-start align-items-center">


                                                    <div class="product-group-price">

                                                        <div class="product-price-and-shipping">

                                                            @if ($product->attribute->hasOffer)
                                                                <span itemprop="price"
                                                                    class="price">{{ $product->attribute->price_offer }}
                                                                    @lang('front.egp')</span>

                                                                <span
                                                                    class="regular-price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>
                                                            @else
                                                                <span itemprop="price"
                                                                    class="price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>
                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>





                                                <div class="in_border end">

                                                    <div class="sku">
                                                        <label class="control-label">Sku:</label>
                                                        <span itemprop="sku" content="demo_6">{{ $product->sku }}</span>
                                                    </div>

                                                    @if ($product->categories->count() > 0)

                                                        <div class="pro-cate">
                                                            <label class="control-label ">@lang('front.categories'):</label>
                                                            <div>
                                                                @foreach ($product->categories as $category)
                                                                    <span>
                                                                        {{-- add link to category here --}}
                                                                        @if ($category->parent->slug)
                                                                            <a href="{{ route('front.category.show', [$category->parent->slug, $category->slug]) }}"
                                                                                title="{{ $category->name }}">
                                                                                {{ $category->name }}
                                                                            </a>
                                                                        @endif

                                                                    </span>
                                                                @endforeach

                                                            </div>
                                                        </div>

                                                    @endif


                                                    @if ($product->tags->count() > 0)


                                                        <div class="pro-tag">
                                                            <label class="control-label ">@lang('front.tags'):</label>
                                                            <div>

                                                                @foreach ($product->tags as $tag)
                                                                    <span>
                                                                        {{-- add link to tag here --}}
                                                                        <a href="" title="{{ $tag->name }}">
                                                                            {{ $tag->name }}
                                                                        </a>
                                                                    </span>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>


                                                <div id="_desktop_productcart_detail">
                                                    <div id="product-availability" class="info-stock ">
                                                        <label
                                                            class="control-label">{{ ucfirst(__('front.availability')) }}
                                                            : </label>

                                                        @if ($product->attribute->qty > 0)
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                        @else
                                                            <span class="text-danger">@lang('front.unavailable')</span>
                                                        @endif

                                                    </div>

                                                    <div class="product-add-to-cart in_border">
                                                        @if ($product->attribute->qty > 0)
                                                            <div class="add">
                                                                <button class="btn btn-primary add-to-cart" type="submit">
                                                                    <div class="icon-cart">
                                                                        <i class="shopping-cart"></i>
                                                                    </div>
                                                                    <span>@lang('front.add_to_cart')</span>
                                                                </button>
                                                            </div>
                                                        @endif


                                                        {{-- -add to wishlist ----------- --}}

                                                        @auth()
                                                            <a class="addToWishlist add_to_wislist"
                                                                href="{{ route('mywishlist.store', [$product->slug]) }}">
                                                                <i class="fa fa-heart"></i>
                                                                <span>Add to Wishlist</span>
                                                            </a>
                                                        @else
                                                            <a class="addToWishlist " href="{{ route('login') }}">
                                                                <i class="fa fa-heart"></i>
                                                                <span>Add to Wishlist</span>
                                                            </a>
                                                        @endauth

                                                        <div class="clearfix"></div>



                                                        {{-- <p class="product-minimal-quantity mt-20">
                                                        </p> --}}

                                                    </div>
                                                </div>






                                            </div>

                                            <div class="productdetail-left col-12 col-lg-6 col-md-6">

                                                @if ($product->attribute->qty > 0)
                                                    <div class="product-quantity">

                                                        <span class="control-label">@lang('front.qty') : </span>
                                                        <div class="qty">

                                                            <input type="number" name="quantity" class="form-control"
                                                                value="1" min="1" max="{{ $product->attribute->qty }}"
                                                                style="min-width: 130px; border-radius: 23px;">

                                                            <span class="text-warning "
                                                                style=" display: flex; justify-content: flex-start;">
                                                                {{ $product->attribute->qty }}
                                                                @lang('front.count_in_stock') !
                                                            </span>

                                                        </div>
                                                    </div>
                                                @endif




                                                @if ($product->attributes->count() > 1)


                                                    <div class="product-variants in_border">
                                                        <div class="product-variants-item">
                                                            <span class="control-label">@lang('front.other_options') :
                                                            </span><br>
                                                            <select id="group_1" class="mt-4"
                                                                onchange="location = this.value;">

                                                                @foreach ($product->attributes as $product_attribute)
                                                                    <option
                                                                        value="{{ route('front.prouct.show', [$product->slug, $product_attribute->id]) }}"
                                                                        title="{{ $product_attribute->name }}"
                                                                        {{ $product_attribute->id == $product->attribute->id ? 'selected' : '' }}
                                                                        {{-- {{ !$product_attribute->qty > 0 ? 'disabled' : '' }} --}}>

                                                                        {{ $product_attribute->name }}
                                                                    </option>
                                                                @endforeach



                                                            </select>
                                                        </div>

                                                    </div>

                                                @endif





                                                <div id="_mobile_productcart_detail"></div>

                                                {{-- ------------section information seller --}}

                                                @if ($product->vendor)
                                                    @include(
                                                        'front.product.information_seler'
                                                    )
                                                @endif

                                                {{-- ------------------------------- --}}

                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- ------------------------ --}}



                {{-- tabs show details and show reviews --}}


                @include('front.product.product-detail-middle', $product)

                {{-- @include('front.product.product-detail-bottom',$product) --}}

                @include('front.product._product_images_modal', $product)


                {{-- * check if the user give this product review ?
                      * if did get modal update to show and update if he need
                      * else get modal create new review --}}

                @auth()
                    @if ($product->authReview)
                        @include('front.product._update_comment_form', [
                            'product' => $product,
                            'user_product_review' => $product->authReview,
                        ])
                    @else
                        @include('front.product._new_comment_form', $product)
                    @endif
                @endauth

                {{-- ------------------------ --}}





                <footer class="page-footer">

                    <!-- Footer content -->

                </footer>


            </section>


        </div>
    </div>





@stop


@section('scripts')

    @include('front.product._scripts', $product)



@stop
