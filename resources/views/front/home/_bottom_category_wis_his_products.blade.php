@isset($maincategories_products)

    @if (count($maincategories_products) > 0)
        <div class="nov-row  col-lg-12 col-xs-12">
            <div class="nov-row-wrap row">



                @foreach ($maincategories_products as $category => $data)
                    @if (isset($maincategories_products[$category]['products']) && count($maincategories_products[$category]['products']) > 0)




                        <div
                            class="nov-productlist   productlist-liststyle    col-xl-4 col-lg-4 col-md-4 col-xs-12 col-md-12">

                            <div class="block block-product clearfix">
                                <h2 class="title_block">
                                    {{ $data['category_name'] }}
                                </h2>

                                <div class="block_content">
                                    <div id="productlist178913877" class="product_list grid owl-carousel owl-theme multi-row"
                                        data-autoplay="false" data-autoplaytimeout="6000" data-loop="false" data-margin="0"
                                        data-dots="false" data-nav="true" data-items="1" data-items_large="1"
                                        data-items_tablet="2" data-items_mobile="1">




                                        @foreach ($data['products']->chunk(3) as $index => $products)
                                            <div class="item  text-center ">

                                                @foreach ($products as $key => $product)
                                                    <div class="d-flex flex-wrap align-items-start product-miniature js-product-miniature  first_item"
                                                        data-id-product="1" data-id-product-attribute="40" itemscope=""
                                                        itemtype="http://schema.org/Product">

                                                        {{-- images --}}
                                                        <div class="col-12 col-w27 no-padding">
                                                            <div class="thumbnail-container">


                                                                <a href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}"
                                                                    class="thumbnail product-thumbnail {{ hasTwoImage($product->images->count()) }}">


                                                                    {{-- ------------ --}}

                                                                    @if ($product->images->count() > 0)
                                                                        @foreach ($product->images as $offset => $image)
                                                                            @if ($offset == 0 )
                                                                                <img class="img-fluid image-cover"
                                                                                    src="{{ fileExist($image->name) ? asset($image->name) :  getLinkImageNoImage() }}" alt=""
                                                                                    width="600" height="600">
                                                                            @elseif($offset == 1 )
                                                                                <img class="img-fluid image-secondary"
                                                                                    src="{{ fileExist($image->name) ? asset($image->name) :  getLinkImageNoImage() }}" alt=""
                                                                                    alt="" width="600" height="600">
                                                                            @else
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <img class="img-fluid image-cover"
                                                                        src="{{ asset('/images/noImage.jpg') }}"
                                                                        alt="" width="600" height="600">

                                                                @endif



                                                            </a>

                                                        </div>
                                                    </div>

                                                    {{-- description --}}
                                                    <div class="col-12 col-w73 no-padding">
                                                        <div class="product-description">

                                                            <div class="product-groups">
                                                                <div class="product-comments">

                                                                    {{-- --- helper function
                                                                tooo append
                                                                stars --}}
                                                                    @php
                                                                        $stars = $product->reviewsRating->first() ? $product->reviewsRating->first()->stars : 0;
                                                                        echo hundelProductReviewsStars($stars);
                                                                    @endphp


                                                                </div>
                                                                @if($product->vendor)
                                                                <p class="seller_name">
                                                                    <a title="View seller profile"
                                                                        href="{{ route('front.seller.products', $product->vendor->id) }}">
                                                                        <i class="fa fa-user"></i>
                                                                        {{ $product->vendor ? $product->vendor->name : '' }}
                                                                    </a>
                                                                </p>

                                                                @endif


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
                @endif
                <!-- - end foreach main categoies -->
            @endforeach

        </div>
    </div>
@endif

@endisset

{{-- --------------------------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------------------------- --}}
