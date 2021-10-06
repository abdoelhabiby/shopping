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
                            @if ($calculate_reviews)
                                (<span class="total_ratings">{{ $calculate_reviews->total_rating }}</span>)

                            @endif
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

                            <p class="mb-3">
                                @auth()
                                    <a id="new_comment_tab_btn" class="open-comment-form btn btn-default"
                                        data-toggle="modal" data-target="#new_comment_form"
                                        href="#">{{ ucfirst(__('front.write_review')) }} !</a>


                                @else
                                    <a class=" btn btn-default" href="{{ route('login') }}"><i
                                            class="fa fa-edit"></i>{{ ucfirst(__('front.write_review')) }}</a>

                                @endauth

                            </p>



                            @if ($product->reviews->count() > 0)

                                @foreach ($product->reviews as $review)


                                    <div class="comment clearfix">
                                        <div class="comment_author">
                                            <span>Grade&nbsp;</span>

                                            {{ hundelProductReviewsStars($review->quality) }}



                                            <div class="comment_author_infos">
                                                <div class="user-comment"><i class="fa fa-user"></i>
                                                    {{ $review->user->name }}
                                                </div>
                                                <div class="date-comment">
                                                    {{ $review->created_at ? $review->created_at->format('Y/m/d') : '' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment_details">
                                            <h4>{{ $review->title }}</h4>
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                @endforeach


                                <div class="text-center">
                                    <a class=" btn btn-info" href="{{ route('product.reviews.index', $product->slug) }}"
                                        style="">
                                        <i class="fa fa-eye"></i> @lang('front.see_all_reviews')
                                    </a>
                                </div>



                            @endif



                        </div>


                    </div>






                </div>
            </div>




            {{-- --------------------------------------- --}}
            {{-- <div class="col-lg-3 col-md-5">

                <div
                    class="nov-productlist     productlist-liststyle-3  col-xl-12 col-lg-12 col-md-12 col-xs-12 no-padding">
                    <div class="block block-product clearfix">
                        <h2 class="title_block">
                            Bestseller
                        </h2>
                        <div class="block_content">
                            <div id="productlist1553156098"
                                class="product_list grid owl-carousel owl-theme multi-row owl-rtl owl-loaded owl-drag"
                                data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                                data-dots="false" data-nav="true" data-items="1" data-items_large="1"
                                data-items_tablet="1" data-items_mobile="1">


                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 540px;">
                                        <div class="owl-item lastActiveItem active" style="width: 270px;">
                                            <div class="item  text-center">
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                    data-id-product="1" data-id-product-attribute="40" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/1-40-hummingbird-printed-t-shirt.html#/1-الحجم-ص/6-اللون_-رمادي_داكن"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/24-home_default/hummingbird-printed-t-shirt.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/24-large_default/hummingbird-printed-t-shirt.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/25-home_default/hummingbird-printed-t-shirt.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/25-large_default/hummingbird-printed-t-shirt.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                    </div>
                                                                    <span>5
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/1_david-james/">
                                                                        <i class="fa fa-user"></i>
                                                                        David James
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/1-40-hummingbird-printed-t-shirt.html#/1-الحجم-ص/6-اللون_-رمادي_داكن">Nullam
                                                                        sed
                                                                        sollicitudin
                                                                        mauris</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">24.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature "
                                                    data-id-product="2" data-id-product-attribute="60" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-الحجم-ص/11-اللون_-اسود"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/29-home_default/brown-bear-printed-sweater.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/29-large_default/brown-bear-printed-sweater.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/30-home_default/brown-bear-printed-sweater.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/30-large_default/brown-bear-printed-sweater.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/1_david-james/">
                                                                        <i class="fa fa-user"></i>
                                                                        David James
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-الحجم-ص/11-اللون_-اسود">Lorem
                                                                        ipsum dolor
                                                                        sit amet
                                                                        ege</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">36.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  last_item"
                                                    data-id-product="3" data-id-product-attribute="95" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/3-95-the-best-is-yet-to-come-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/34-home_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/34-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/35-home_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/35-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                    </div>
                                                                    <span>5
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/3-95-the-best-is-yet-to-come-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي">Mauris
                                                                        molestie
                                                                        porttitor
                                                                        diam</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">30.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 270px;">
                                            <div class="item  text-center">
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                    data-id-product="4" data-id-product-attribute="112" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/4-112-the-adventure-begins-framed-poster.html#/1-الحجم-ص/9-اللون_-ابيض_مطفي"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/39-home_default/the-adventure-begins-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/39-large_default/the-adventure-begins-framed-poster.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/43-home_default/the-adventure-begins-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/43-large_default/the-adventure-begins-framed-poster.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/4-112-the-adventure-begins-framed-poster.html#/1-الحجم-ص/9-اللون_-ابيض_مطفي">Maecenas
                                                                        vulputate
                                                                        ligula
                                                                        vel</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">18.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature "
                                                    data-id-product="5" data-id-product-attribute="134" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/audio/5-134-today-is-a-good-day-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/44-home_default/today-is-a-good-day-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/44-large_default/today-is-a-good-day-framed-poster.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/45-home_default/today-is-a-good-day-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/45-large_default/today-is-a-good-day-framed-poster.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/audio/5-134-today-is-a-good-day-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي">Vehicula
                                                                        vel tempus
                                                                        sit amet
                                                                        ulte</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">34.80&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  last_item"
                                                    data-id-product="6" data-id-product-attribute="0" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/6-nullam-tempor-orci-eu-pretium.html"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/49-home_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/49-large_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/50-home_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/50-large_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/6-nullam-tempor-orci-eu-pretium.html">Nullam
                                                                        tempor orci
                                                                        eu
                                                                        pretium</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">14.28&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-nav">
                                    <div class="owl-prev disabled"><i class="fa fa-angle-left"></i></div>
                                    <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                                </div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="nov-productlist     productlist-liststyle-3  col-xl-12 col-lg-12 col-md-12 col-xs-12 no-padding">
                    <div class="block block-product clearfix">
                        <h2 class="title_block">
                            TRENDING NOW
                        </h2>
                        <div class="block_content">
                            <div id="productlist1182624796"
                                class="product_list grid owl-carousel owl-theme multi-row owl-rtl owl-loaded owl-drag"
                                data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                                data-dots="false" data-nav="true" data-items="1" data-items_large="1"
                                data-items_tablet="1" data-items_mobile="1">


                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 540px;">
                                        <div class="owl-item lastActiveItem active" style="width: 270px;">
                                            <div class="item  text-center">
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                    data-id-product="1" data-id-product-attribute="40" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/1-40-hummingbird-printed-t-shirt.html#/1-الحجم-ص/6-اللون_-رمادي_داكن"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/24-home_default/hummingbird-printed-t-shirt.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/24-large_default/hummingbird-printed-t-shirt.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/25-home_default/hummingbird-printed-t-shirt.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/25-large_default/hummingbird-printed-t-shirt.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                    </div>
                                                                    <span>5
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/1_david-james/">
                                                                        <i class="fa fa-user"></i>
                                                                        David James
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/1-40-hummingbird-printed-t-shirt.html#/1-الحجم-ص/6-اللون_-رمادي_داكن">Nullam
                                                                        sed
                                                                        sollicitudin
                                                                        mauris</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">24.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature "
                                                    data-id-product="2" data-id-product-attribute="60" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-الحجم-ص/11-اللون_-اسود"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/29-home_default/brown-bear-printed-sweater.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/29-large_default/brown-bear-printed-sweater.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/30-home_default/brown-bear-printed-sweater.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/30-large_default/brown-bear-printed-sweater.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/1_david-james/">
                                                                        <i class="fa fa-user"></i>
                                                                        David James
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-الحجم-ص/11-اللون_-اسود">Lorem
                                                                        ipsum dolor
                                                                        sit amet
                                                                        ege</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">36.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  last_item"
                                                    data-id-product="3" data-id-product-attribute="95" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/3-95-the-best-is-yet-to-come-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/34-home_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/34-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/35-home_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/35-large_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                        <div class="star star_on">
                                                                        </div>
                                                                    </div>
                                                                    <span>5
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/3-95-the-best-is-yet-to-come-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي">Mauris
                                                                        molestie
                                                                        porttitor
                                                                        diam</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">30.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-item" style="width: 270px;">
                                            <div class="item  text-center">
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                    data-id-product="4" data-id-product-attribute="112" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/4-112-the-adventure-begins-framed-poster.html#/1-الحجم-ص/9-اللون_-ابيض_مطفي"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/39-home_default/the-adventure-begins-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/39-large_default/the-adventure-begins-framed-poster.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/43-home_default/the-adventure-begins-framed-poster.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/43-large_default/the-adventure-begins-framed-poster.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/4-112-the-adventure-begins-framed-poster.html#/1-الحجم-ص/9-اللون_-ابيض_مطفي">Maecenas
                                                                        vulputate
                                                                        ligula
                                                                        vel</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">18.00&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature "
                                                    data-id-product="6" data-id-product-attribute="0" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/6-nullam-tempor-orci-eu-pretium.html"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/49-home_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/49-large_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/50-home_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/50-large_default/nullam-tempor-orci-eu-pretium.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/6-nullam-tempor-orci-eu-pretium.html">Nullam
                                                                        tempor orci
                                                                        eu
                                                                        pretium</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">14.28&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  last_item"
                                                    data-id-product="7" data-id-product-attribute="155" itemscope=""
                                                    itemtype="http://schema.org/Product">
                                                    <div class="col-12 col-w37 no-padding">
                                                        <div class="thumbnail-container">

                                                            <a href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/7-155-donec-non-lectus-ac-erat-sedei.html#/1-الحجم-ص/10-اللون_-احمر"
                                                                class="thumbnail product-thumbnail two-image">
                                                                <img class="img-fluid image-cover"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/54-home_default/donec-non-lectus-ac-erat-sedei.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/54-large_default/donec-non-lectus-ac-erat-sedei.jpg"
                                                                    width="600" height="600">
                                                                <img class="img-fluid image-secondary"
                                                                    src="http://demo.bestprestashoptheme.com/savemart/55-home_default/donec-non-lectus-ac-erat-sedei.jpg"
                                                                    alt=""
                                                                    data-full-size-image-url="http://demo.bestprestashoptheme.com/savemart/55-large_default/donec-non-lectus-ac-erat-sedei.jpg"
                                                                    width="600" height="600">
                                                            </a>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-w63 no-padding">
                                                        <div class="product-description">
                                                            <div class="product-groups">
                                                                <div class="product-comments">
                                                                    <div class="star_content">
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                        <div class="star">
                                                                        </div>
                                                                    </div>
                                                                    <span>0
                                                                        review</span>
                                                                </div>
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/jmarketplace/2_taylor-jonson/">
                                                                        <i class="fa fa-user"></i>
                                                                        Taylor
                                                                        Jonson
                                                                    </a>
                                                                </p>



                                                                <div class="product-title" itemprop="name">
                                                                    <a
                                                                        href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/7-155-donec-non-lectus-ac-erat-sedei.html#/1-الحجم-ص/10-اللون_-احمر">Donec
                                                                        non lectus
                                                                        ac erat
                                                                        sedei</a>
                                                                </div>

                                                                <div class="product-group-price">

                                                                    <div class="product-price-and-shipping">



                                                                        <span itemprop="price"
                                                                            class="price">14.28&nbsp;US$</span>





                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-nav">
                                    <div class="owl-prev disabled"><i class="fa fa-angle-left"></i></div>
                                    <div class="owl-next"><i class="fa fa-angle-right"></i></div>
                                </div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nov-html col-xl-12 col-lg-12 col-md-12 policy-product no-padding">
                    <div class="block">
                        <div class="block_content">
                            <div class="policy-row d-flex">
                                <div class="icon-policy"><i class="noviconpolicy noviconpolicy-1">1</i>
                                </div>
                                <div class="policy-content">
                                    <div class="policy-name">Free Delivery</div>
                                    <div class="policy-des">From $ 250</div>
                                </div>
                            </div>
                            <div class="policy-row d-flex">
                                <div class="icon-policy"><i class="noviconpolicy noviconpolicy-2">2</i>
                                </div>
                                <div class="policy-content">
                                    <div class="policy-name">Money Back</div>
                                    <div class="policy-des">Guarantee</div>
                                </div>
                            </div>
                            <div class="policy-row d-flex">
                                <div class="icon-policy"><i class="noviconpolicy noviconpolicy-3">3</i>
                                </div>
                                <div class="policy-content">
                                    <div class="policy-name">Authenticity</div>
                                    <div class="policy-des">100% guaranteed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

        </div>
    </div>
</div>
