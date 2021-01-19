@extends('layouts.front')

@section('title')
    | @lang('front.mywishlist')
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
                            <span itemprop="name">@lang('front.mywishlist')</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop

@section('content')

    <div id="main">

        <section id="content" class="page-home pagehome-three">
            <div class="container">
                @isset($wishlist_products)

                    <div class="row">


                        <div class="nov-row  col-lg-12 col-xs-12 ">

                            <div class="nov-row-wrap row">


                                {{-- ----------------best sealere---------------------------------
                                --}}


                                @if ($wishlist_products->count() > 0)

                                    <div
                                        class="nov-productlist   productlist-slider      col-xl-12 col-lg-12 col-md-12 col-xs-12 col-md-12 col-lg-12">
                                        <div class="block block-product clearfix">
                                            <h2 class="title_block">
                                                @lang('front.wishlist_products')
                                            </h2>
                                            <div class="block_content">
                                                <div id="productlist893645890"
                                                    class="product_list grid owl-carousel owl-theme multi-row"
                                                    data-autoplay="false" data-autoplaytimeout="6000" data-loop="false"
                                                    data-margin="0" data-dots="false" data-nav="true" data-items="4"
                                                    data-items_large="4" data-items_tablet="3" data-items_mobile="2">

                                                    @foreach ($wishlist_products->chunk(2) as $index => $wishlist_product)

                                                        <div class="item  text-center ">

                                                            @foreach ($wishlist_product as $key => $product)




                                                                <div class="product-miniature js-product-miniature item-one first_item"
                                                                    data-id-product="{{ $product->id }}"
                                                                    data-id-product-attribute="{{ $product->attribute->id }}"
                                                                    itemscope="" itemtype="">



                                                                    <div class="thumbnail-container">



                                                                        <a href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}"
                                                                            class="thumbnail product-thumbnail {{ $product->images->count() > 1 ? 'two-image' : '' }}">



                                                                            {{-- ------------
                                                                            --}}

                                                                            @if ($product->images->count() > 0)
                                                                                @foreach ($product->images as $index => $image)

                                                                                    @if ($index == 0 && fileExist($image->name))
                                                                                        <img class="img-fluid image-cover"
                                                                                            src="{{ asset($image->name) }}"
                                                                                            alt="" title="{{ $product->name }}"
                                                                                            width="600" height="600">
                                                                                    @elseif($index == 1 &&
                                                                                        fileExist($image->name))

                                                                                        <img class="img-fluid image-secondary"
                                                                                            src="{{ asset($image->name) }}"
                                                                                            alt="" title="{{ $product->name }}"
                                                                                            width="600" height="600">
                                                                                    @else
                                                                                        @break
                                                                                    @endif
                                                                                @endforeach

                                                                            @else

                                                                                <img class="img-fluid image-cover"
                                                                                    src="{{ asset('/images/noImage.jpg') }}"
                                                                                    alt="" width="600" height="600">

                                                                            @endif
                                                                            {{-- ------------
                                                                            --}}



                                                                        </a>


                                                                        {{-- check if has offer
                                                                        --}}

                                                                        @if ($product->attribute->hasOffer)
                                                                            <div class="product-flags discount">
                                                                                @Lang('front.offer')
                                                                            </div>
                                                                        @endif


                                                                    </div>

                                                                    <div class="product-description">

                                                                        <div class="product-groups">



                                                                            <div class="category-title">
                                                                                <a
                                                                                    href="smartphone-tablet/1-hummingbird-printed-t-shirt.html">product
                                                                                    name</a>
                                                                            </div>

                                                                            <div class="product-comments">

                                                                                {{-- --- helper
                                                                                function tooo append stars
                                                                                --}}
                                                                                @php
                                                                                $stars = $product->reviews->first() ?
                                                                                $product->reviews->first()->stars : 0;
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
                                                                        <div
                                                                            class="product-buttons d-flex justify-content-center">

                                                                            @if ($product->attribute->qty > 0)
                                                                                <form action="" method="post"
                                                                                    class="formAddToCart">
                                                                                    @csrf
                                                                                    <a class="add-to-cart" href="#"
                                                                                        data-add-cart="{{ route('cart.add', [$product->slug, $product->attribute->id]) }}">
                                                                                        <i class="novicon-cart"></i>
                                                                                        <span>Add to cart</span>
                                                                                    </a>
                                                                                </form>

                                                                            @endif





                                                                            {{-- --------remove
                                                                            from
                                                                            wish
                                                                            list --}}


                                                                            <form
                                                                                action="{{ route('mywishlist.destroy', $product->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"
                                                                                    class="addToWishlist hidden-sm-down"
                                                                                    style=" border: 2px;">
                                                                                    <i class="fa fa-trash"></i><span>
                                                                                        Delete</span>
                                                                                </button>
                                                                            </form>







                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            @endforeach

                                                        </div>
                                                    @endforeach



                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mt-5">

                                                {{ $wishlist_products->appends(request()->query())->links() }}

                                            </div>
                                        </div>
                                    </div>




                                @endif







                                {{-- --------------------------------------------------------
                                --}}






                            </div>
                        </div>




                    </div>

                @endisset

                @if (!$wishlist_products->count() > 0)
                    <div class="text-center" style="margin-bottom: 50px">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100"
                                height="100">
                                <defs>
                                    <path id="a"
                                        d="M99.962 49.908c0 27.564-22.378 49.908-49.981 49.908C22.377 99.816 0 77.472 0 49.908S22.377 0 49.98 0c27.604 0 49.982 22.344 49.982 49.908" />
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <mask id="b" fill="#fff">
                                        <use xlink:href="#a" />
                                    </mask>
                                    <use fill="#F5F5F5" xlink:href="#a" />
                                    <g fill-rule="nonzero" mask="url(#b)">
                                        <path fill="#F68B1E"
                                            d="M61.496 29A12.01 12.01 0 0051 35.127v35.83c3.38-2.511 22.5-17.287 22.5-30.082C73.5 34.317 68.125 29 61.496 29z" />
                                        <path fill="#FFB048"
                                            d="M40.004 29C33.374 29 28 34.317 28 40.875c0 12.794 19.12 27.57 22.5 30.082v-35.83A12.011 12.011 0 0040.004 29z" />
                                    </g>
                                </g>
                            </svg>
                        </div>

                        <div class="display-4">
                            @lang('front.havent_saved_aproduct')

                        </div>

                    </div>

                @endif


            </div>
        </section>


    </div>


@stop


@section('scripts')


    @if (session()->has('success'))

        <script>
            swal({
                title: "{{ session('success') }}",
                type: "success",
                timer: 2000,
            });

        </script>

    @endif
    @if (session()->has('exception_error'))

        <script>
            swal({
                title: "{{ session('exception_error') }}",
                type: "error",
                timer: 3000,
            });

        </script>

    @endif

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //------------------ add product to cart--------------------

        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var url = $(this).data('add-cart');

            $.ajax({
                method: 'post',
                url,
                success: function(response) {

                    if (response.cart_products_count && parseInt(response.cart_products_count) > 0) {
                        $(".cart-products-count").text(response.cart_products_count);

                    }


                    swal({
                        title: "{{ __('front.success_add_product') }}",
                        type: "success",
                        timer: 2000,
                    });
                    //---- fetch get count products to change icon cart add total products count
                },
                error: function(error) {
                    // console.log(error);
                }
            });

        });

    </script>

@stop
