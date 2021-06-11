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
                            data-dots="false" data-nav="true" data-items="4" data-items_large="4" data-items_tablet="3"
                            data-items_mobile="2">

                            @foreach ($best_sellers->chunk(2) as $index => $products_best_sellers)

                                <div class="item  text-center ">

                                    @foreach ($products_best_sellers as $key => $product)


                                        @include('front.includes.section_product',$product)

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

                                                <a href="{{route('front.prouct.show',[$product->slug, $product->attribute->id])}}"
                                                    class="thumbnail product-thumbnail {{ hasTwoImage($product->images->count()) }}">


                                                    {{-- ------------
                                                    --}}

                                                    @if ($product->images->count() > 0)
                                                        @foreach ($product->images as $index => $image)

                                                            @if ($index == 0 && fileExist($image->name))
                                                                <img class="img-fluid image-cover"
                                                                    src="{{ asset($image->name) }}" alt=""
                                                                    title="{{ $product->name }}" width="600" height="600">
                                                            @elseif($index == 1 && fileExist($image->name))

                                                                <img class="img-fluid image-secondary"
                                                                    src="{{ asset($image->name) }}" alt=""
                                                                    title="{{ $product->name }}" alt="" width="600"
                                                                    height="600">
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

                                                        {{-- --- helper function tooo append
                                                        stars --}}

                                                        @php
                                                        $stars = $product->reviews->first() ? $product->reviews->first()->stars : 0;
                                                        echo hundelProductReviewsStars($stars);
                                                    @endphp




                                                    </div>
                                                    <p class="seller_name">
                                                        <a title="View seller profile"
                                                            href="jmarketplace/1_david-james/index.htm">
                                                            <i class="fa fa-user"></i>
                                                            {{ $product->vendor->name }}
                                                        </a>
                                                    </p>


                                                    <div class="product-title" itemprop="name"><a
                                                            href="{{route('front.prouct.show',[$product->slug, $product->attribute->id])}}">
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
