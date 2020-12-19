<div class="nov-row  col-lg-12 col-xs-12 teto">




    <div class="nov-row-wrap row">





        {{-- ----------------best sealere---------------------------------
        --}}

        @isset($best_sellers)

            <div class="nov-productlist   productlist-slider      col-xl-9 col-lg-9 col-md-9 col-xs-12 col-md-12 col-lg-12">
                <div class="block block-product clearfix">
                    <h2 class="title_block">
                        @lang('front.best_sellers')
                    </h2>
                    <div class="block_content">
                        <div id="productlist893645890" class="product_list grid owl-carousel owl-theme multi-row"
                            data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                            data-dots="false" data-nav="true" data-items="3" data-items_large="3" data-items_tablet="3"
                            data-items_mobile="2">

                            @foreach ($best_sellers->chunk(2) as $index => $products_best_sellers)

                                <div class="item  text-center ">

                                    @foreach ($products_best_sellers as $key => $product)


                                        <div class="product-miniature js-product-miniature item-one first_item"
                                            data-id-product="{{ $product->id }}"
                                            data-id-product-attribute="{{ $product->attribute->id }}" itemscope=""
                                            itemtype="http://schema.org/Product">



                                            <div class="thumbnail-container">



                                                <a href=""
                                                    class="thumbnail product-thumbnail {{ $product->images->count() > 1 ? 'two-image' : '' }}">



                                                    {{-- ------------
                                                    --}}

                                                    @if ($product->images->count() > 0)
                                                        @foreach ($product->images as $index => $image)

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
                                                    {{-- ------------
                                                    --}}



                                                </a>


                                                {{-- check if has offer
                                                --}}

                                                @if ($product->attribute->hasOffer)
                                                    <div class="product-flags discount">@Lang('front.offer')
                                                    </div>
                                                @endif


                                            </div>

                                            <div class="product-description">

                                                <div class="product-groups">



                                                    <div class="category-title">
                                                        <a href="smartphone-tablet/1-hummingbird-printed-t-shirt.html">product
                                                            name</a>
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

                                                                <span class="regular-price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>
                                                            @else

                                                                <span itemprop="price"
                                                                    class="price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>

                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="product-buttons d-flex justify-content-center" itemprop="offers"
                                                    itemscope="" itemtype="http://schema.org/Offer">
                                                    <form action="http://demo.bestprestashoptheme.com/savemart/en/cart"
                                                        method="post" class="formAddToCart">
                                                        <input type="hidden" name="token"
                                                            value="28add935523ef131c8432825597b9928">
                                                        <input type="hidden" name="id_product" value="1">
                                                        <a class="add-to-cart" href="#" data-button-action="add-to-cart"><i
                                                                class="novicon-cart"></i><span>Add to cart</span></a>
                                                    </form>

                                                    <a class="addToWishlist wishlistProd_1" href="#" data-rel="1"
                                                        onclick="WishlistCart('wishlist_block_list', 'add', '1', false, 1); return false;">
                                                        <i class="fa fa-heart"></i>
                                                        <span>Add to Wishlist</span>
                                                    </a>


                                                    <a href="#" class="quick-view hidden-sm-down"
                                                        data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-search"></i><span> Quick view</span>
                                                    </a>




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

        @endisset
        {{-- --------------------------------------------------------
        --}}




        {{-- --------------trending now-------------------------
        --}}

        @isset($trending)

            <div
                class="nov-productlist     productlist-liststyle-2  col-xl-3 col-lg-3 col-md-3 col-xs-12 col-md-12 col-lg-12">
                <div class="block block-product clearfix">
                    <h2 class="title_block">
                        @lang('front.trending_now')
                    </h2>
                    <div class="block_content">
                        <div id="productlist72625769" class="product_list grid owl-carousel owl-theme multi-row"
                            data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                            data-dots="false" data-nav="true" data-items="1" data-items_large="3" data-items_tablet="2"
                            data-items_mobile="1">



                            <div class="item  text-center ">


                                @foreach ($trending as $product)


                                    <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                        data-id-product="1" data-id-product-attribute="40" itemscope=""
                                        itemtype="http://schema.org/Product">

                                        <div class="col-12 col-w37 no-padding">
                                            <div class="thumbnail-container">

                                                <a href="smartphone-tablet/1-40-hummingbird-printed-t-shirt.html#/1-size-s/6-color-taupe"
                                                    class="thumbnail product-thumbnail {{ hasTwoImage($product->images->count()) }}">


                                                    {{-- ------------
                                                    --}}

                                                    @if ($product->images->count() > 0)
                                                        @foreach ($product->images as $index => $image)

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
                                                    {{-- ------------
                                                    --}}


                                                </a>



                                            </div>
                                        </div>
                                        <div class="col-12 col-w63 no-padding">
                                            <div class="product-description">



                                                <div class="product-groups">



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

                                                                <span class="regular-price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>
                                                            @else

                                                                <span itemprop="price"
                                                                    class="price">{{ $product->attribute->price }}
                                                                    @lang('front.egp')</span>

                                                            @endif
                                                        </div>

                                                    </div>

                                                </div>




                                            </div>
                                        </div>
                                    </div>

                                @endforeach


                            </div>




                        </div>
                    </div>
                </div>
            </div>

        @endisset


    </div>
</div>








