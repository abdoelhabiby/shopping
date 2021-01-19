@isset($three_main_categories)

    @if ($three_main_categories->count() > 0)



        <div class="nov-row  col-lg-12 col-xs-12">
            <div class="nov-row-wrap row">



                @foreach ($three_main_categories as $key => $main_category)


                    <div class="nov-productlist   productlist-liststyle    col-xl-4 col-lg-4 col-md-4 col-xs-12 col-md-12">

                        <div class="block block-product clearfix">
                            <h2 class="title_block">
                                {{ $main_category['name'] }}
                            </h2>

                            <div class="block_content">
                                <div id="productlist178913877" class="product_list grid owl-carousel owl-theme multi-row"
                                    data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                                    data-dots="false" data-nav="true" data-items="1" data-items_large="1"
                                    data-items_tablet="2" data-items_mobile="1">



                                    @foreach (array_chunk($main_category['products'], 3) as $index => $products)

                                        <div class="item  text-center ">

                                            @foreach ($products as $key => $product)

                                                <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                    data-id-product="1" data-id-product-attribute="40" itemscope=""
                                                    itemtype="http://schema.org/Product">

                                                    {{-- images
                                                    --}}
                                                    <div class="col-12 col-w27 no-padding">
                                                        <div class="thumbnail-container">


                                                            <a href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}"
                                                                class="thumbnail product-thumbnail {{ hasTwoImage($product->images->count()) }}">


                                                                {{-- ------------
                                                                --}}

                                                                @if ($product->images->count() > 0)
                                                                    @foreach ($product->images as $index => $image)

                                                                        @if ($index == 0 && fileExist($image->name))
                                                                            <img class="img-fluid image-cover"
                                                                                src="{{ asset($image->name) }}" alt=""
                                                                                width="600" height="600">
                                                                        @elseif($index == 1 && fileExist($image->name))

                                                                            <img class="img-fluid image-secondary"
                                                                                src="{{ asset($image->name) }}" alt=""
                                                                                alt="" width="600" height="600">
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

                                                    {{-- description
                                                    --}}
                                                    <div class="col-12 col-w73 no-padding">
                                                        <div class="product-description">

                                                            <div class="product-groups">
                                                                <div class="product-comments">

                                                                    {{-- --- helper function
                                                                    tooo append
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
                                                                        href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}">
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



                                                        </div>
                                                    </div>
                                                </div>



                                            @endforeach
                                            <!-- - end foreach products -- -->

                                        </div>
                                        <!-- - end foreach products paginate -->
                                    @endforeach




                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- - end foreach main categoies -->
                @endforeach

            </div>
        </div>

    @endif

@endisset
