<div class="nov-row  col-lg-12 col-xs-12">
    <div class="nov-row-wrap row">

        {{-- -----------------start flash deals-------- --}}

        @isset($products_offer)

            @if ($products_offer->count() > 0)


                <div class="nov-productlist nov-countdown-productlist col-xl-4 col-lg-4 col-md-4  col-xs-12 col-md-12">
                    <div class="block block-product clearfix">
                        <h2 class="title_block">
                            {{ __('front.offers') }}
                        </h2>
                        <div class="block_content">
                            <div id="productlist1326409273"
                                class="product_list countdown-productlist countdown-column-1 owl-carousel owl-theme"
                                data-autoplay="false" data-autoplaytimeout="7000" data-loop="false" data-margin="30"
                                data-dots="false" data-nav="true" data-items="1" data-items_large="1" data-items_tablet="2"
                                data-items_mobile="1">

                                <!-- -- -- start items -- ---- -->

                                @foreach ($products_offer as $product_offer)

                                    <div class="item item-list">
                                        <div class="product-miniature js-product-miniature first_item"
                                            data-id-product="{{ $product_offer->id }}" data-id-product-attribute="232"
                                            itemscope="" itemtype="">
                                            <div class="thumbnail-container">

                                                <a href="home-appliance/12-232-nam-volutpat-justo-a-vehicula.html#/1-size-s/11-color-black"
                                                    class="thumbnail product-thumbnail  {{ $product_offer->images->count() > 1 ? 'two-image' : '' }} ">

                                                    @if ($product_offer->images->count() > 0)
                                                        @foreach ($product_offer->images as $index => $image)

                                                            @if ($index == 0 && fileExist($image->name))
                                                                <img class="img-fluid image-cover"
                                                                    src="{{ asset($image->name) }}" alt="" width="600"
                                                                    height="600">
                                                            @elseif($index == 1 && fileExist($image->name))

                                                                <img class="img-fluid image-secondary"
                                                                    src="{{ asset($image->name) }}" alt="" alt=""
                                                                    width="600" height="600">
                                                            @else
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @else

                                                        <img class="img-fluid image-cover"
                                                            src="{{ asset('/images/noImage.jpg') }}" alt="" width="600"
                                                            height="600">

                                                    @endif


                                                </a>


                                                {{-- -- circle show offer - -
                                                --}}
                                                <div class="product-flags discount">{{ __('front.offer') }}</div>


                                            </div>
                                            <div class="product-description">
                                                <div class="product-groups">

                                                    <div class="product-title" itemprop="name"><a
                                                            href="home-appliance/12-232-nam-volutpat-justo-a-vehicula.html#/1-size-s/11-color-black">
                                                            {{ $product_offer->name }}
                                                        </a>
                                                    </div>

                                                    <div class="product-comments">
                                                        <div class="star_content">
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                            <div class="star"></div>
                                                        </div>
                                                        <span>0 review</span>
                                                    </div>
                                                    <p class="seller_name">
                                                        <a title="View seller profile"
                                                            href="jmarketplace/3_harry-makle/index.htm">
                                                            <i class="fa fa-user"></i>
                                                            {{ $product_offer->vendor->name }}
                                                        </a>
                                                    </p>

                                                    <div class="product-group-price">

                                                        <div class="product-price-and-shipping">
                                                            <span itemprop="price"
                                                                class="price">{{ $product_offer->offer->price_offer }}
                                                                {{ __('front.egp') }}</span>
                                                            <span class="regular-price">{{ $product_offer->offer->price }}
                                                                {{ __('front.egp') }}</span>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="product-buttons d-flex justify-content-center" itemprop="offers"
                                                    itemscope="" itemtype="http://schema.org/Offer">
                                                    <form action="http://demo.bestprestashoptheme.com/savemart/en/cart"
                                                        method="post" class="formAddToCart">
                                                        <input type="hidden" name="token"
                                                            value="28add935523ef131c8432825597b9928">
                                                        <input type="hidden" name="id_product" value="12">
                                                        <a class="add-to-cart" href="#" data-button-action="add-to-cart"><i
                                                                class="novicon-cart"></i><span>Add to cart</span></a>
                                                    </form>

                                                    <a class="addToWishlist wishlistProd_12" href="#" data-rel="12"
                                                        onclick="WishlistCart('wishlist_block_list', 'add', '12', false, 1); return false;">
                                                        <i class="fa fa-heart"></i>
                                                        <span>Add to Wishlist</span>
                                                    </a>
                                                    <a href="#" class="quick-view hidden-sm-down"
                                                        data-link-action="quickview">
                                                        <i class="fa fa-search"></i><span> Quick view</span>
                                                    </a>
                                                </div>

                                            </div>
                                            <div class="countdownfree d-flex"
                                                data-date="{{ $product_offer->offer->end_offer_at }}"></div>

                                        </div>
                                    </div>

                                @endforeach


                                <!-- -- -- end items -- ---- -->


                            </div>
                        </div>
                    </div>
                </div>

            @endif

        @endisset

        {{-- -----------------end flash deals-------- --}}





        {{-- -----------------start new -------- --}}


        @isset($new_poducts)

            @if ($new_poducts->count() > 0)


                <div class="nov-productlist  productlist-rows     col-xl-8 col-lg-8 col-md-8 col-xs-12 col-md-12">
                    <div class="block block-product clearfix">
                        <h2 class="title_block">
                            @lang('front.new_products')
                        </h2>
                        <div class="block_content">
                            <div id="productlist303857090" class="product_list grid owl-carousel owl-theme multi-row"
                                data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="30"
                                data-dots="false" data-nav="true" data-items="2" data-items_large="2" data-items_tablet="3"
                                data-items_mobile="1">



                                @foreach ($new_poducts->chunk(3) as $index => $new_product)
                                    <div class="item  text-center ">

                                        @foreach ($new_product as $key => $product)

                                            <div class="d-flex flex-wrap  align-items-center product-miniature js-product-miniature item-row"
                                                data-id-product="2" data-id-product-attribute="60" itemscope=""
                                                >
                                                <div class="col-12 col-w40 pl-0">
                                                    <div class="thumbnail-container">

                                                        {{-- image
                                                        --}}
                                                        <a href="smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-size-s/11-color-black"
                                                            class="thumbnail product-thumbnail {{ $product->images->count() > 1 ? 'two-image' : '' }}">

                                                            @if ($product->images->count() > 0)
                                                                @foreach ($product->images as $index => $image)

                                                                    @if ($index == 0 && fileExist($image->name))
                                                                        <img class="img-fluid image-cover"
                                                                            src="{{ asset($image->name) }}" alt=""
                                                                            width="600" height="600">
                                                                    @elseif($index == 1 && fileExist($image->name))

                                                                        <img class="img-fluid image-secondary"
                                                                            src="{{ asset($image->name) }}" alt="" alt=""
                                                                            width="600" height="600">
                                                                    @else
                                                                        @break
                                                                    @endif
                                                                @endforeach

                                                            @else

                                                                <img class="img-fluid image-cover"
                                                                    src="{{ asset('/images/noImage.jpg') }}" alt=""
                                                                    width="600" height="600">

                                                            @endif
                                                        </a>

                                                    </div>
                                                </div>
                                                {{-- escription
                                                --}}
                                                <div class="col-12 col-w60 no-padding">
                                                    <div class="product-description">
                                                        <div class="product-groups">
                                                            @if ($product->attribute->hasOffer)
                                                                <div class="product-flags discount">@Lang('front.offer')
                                                                </div>
                                                            @endif
                                                            <div class="product-comments">
                                                                <div class="star_content">
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                    <div class="star"></div>
                                                                </div>
                                                                <span>0 review</span>
                                                            </div>
                                                            <p class="seller_name">
                                                                <a title="View seller profile"
                                                                    href="jmarketplace/1_david-james/index.htm">
                                                                    <i class="fa fa-user"></i>
                                                                    {{ $product->vendor->name }}
                                                                </a>
                                                            </p>


                                                            <div class="product-title" itemprop="name"><a
                                                                    href="smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-size-s/11-color-black">
                                                                    {{ $product->name }}
                                                                </a></div>

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

                                                        {{-- buttons add cart favorite and
                                                        search --}}
                                                        <div class="product-buttons d-flex justify-content-center"
                                                            itemprop="offers" itemscope=""
                                                            itemtype="http://schema.org/Offer">
                                                            {{-- add to card
                                                            --}}
                                                            <form
                                                                action="http://demo.bestprestashoptheme.com/savemart/en/cart"
                                                                method="post" class="formAddToCart">
                                                                <input type="hidden" name="token"
                                                                    value="28add935523ef131c8432825597b9928">
                                                                <input type="hidden" name="id_product" value="2">
                                                                <a class="add-to-cart" href="#"
                                                                    data-button-action="add-to-cart"><i
                                                                        class="novicon-cart"></i><span>Add to
                                                                        cart</span></a>
                                                            </form>

                                                            {{-- add to favorite
                                                            --}}
                                                            <a class="addToWishlist wishlistProd_2" href="#" data-rel="2"
                                                                onclick="WishlistCart('wishlist_block_list', 'add', '2', false, 1); return false;">
                                                                <i class="fa fa-heart"></i>
                                                                <span>Add to Wishlist</span>
                                                            </a>
                                                            <a href="#" class="quick-view hidden-sm-down"
                                                                data-link-action="quickview">
                                                                <i class="fa fa-search"></i><span> Quick view</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            @endif

        @endisset

        {{-- -----------------end new -------- --}}

    </div>
</div>
