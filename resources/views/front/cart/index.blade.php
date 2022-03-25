@extends('layouts.front')

@section('title')
    | cart
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
                        <a itemprop="item" href="">
                            <span itemprop="name">
                                @lang('front.cart')
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop

@section('content')

    <div class="container no-index">
        @include('front.includes.alerts.success')
        @include('front.includes.alerts.errors')
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <section id="main">
                    <h1 class="page-title">@lang('front.cart')</h1>
                    <div class="cart-grid row">

                        <!-- Left Block: cart product informations & shpping -->
                        <div class="cart-grid-body col-xs-12 col-lg-9">

                            <!-- cart products detailed -->
                            <div class="cart-container">


                                @isset($products)

                                    @if (count($products) > 0)

                                        @foreach ($products as $product)

                                            <!-- ---------------------------------- -->

                                            <!-- ---------------------------------- -->

                                            <div
                                                class="cart-overview product-{{ $product->id . '-' . $product->attribute->id }}">


                                                <div class="product-line-grid row spacing-10">
                                                    <!--  product left content: image-->
                                                    <div class="product-line-grid-left col-sm-2 col-xs-4">
                                                        <span class="product-image media-middle">
                                                            {{-- @if ($product->images->first())

                                                                @php
                                                                    $image = $product->images->first()->name;
                                                                @endphp
                                                                <img class="img-fluid"
                                                                    src="{{ fileExist($image) ? asset($image) : getLinkImageNoImage() }}"
                                                                    alt="{{ $product->name }}">

                                                            @else
                                                                <img class="img-fluid" src="{{ getLinkImageNoImage() }}"
                                                                    alt="{{ $product->name }}">

                                                            @endif --}}




                                                            <img class="img-fluid"
                                                                src="{{ $product->image ? asset($product->image->name) : pathNoImage() }}"
                                                                alt="{{ $product->name }}">

                                                        </span>
                                                    </div>

                                                    <!--  product left body: description -->
                                                    <div class="product-line-grid-body col-sm-10 col-xs-8">
                                                        <div class="row">

                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="product-line-info">
                                                                    <a class="label"
                                                                        href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}"
                                                                        data-id_customization="0">
                                                                        {{ $product->name }}
                                                                    </a>
                                                                </div>

                                                                <div class="product-line-info product-price">
                                                                    <div class="product-group-price">



                                                                        <div class="product-price-and-shipping">
                                                                            @if ($product->attribute->hasOffer)
                                                                                <span
                                                                                    class="vlaue">{{ $product->attribute->price_offer }}
                                                                                    @lang('front.egp')</span>

                                                                                <span
                                                                                    class="regular-price">{{ $product->attribute->price }}
                                                                                    @lang('front.egp')</span>
                                                                            @else
                                                                                <span
                                                                                    class="vlaue">{{ $product->attribute->price }}
                                                                                    @lang('front.egp')</span>
                                                                            @endif

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="product-line-info">
                                                                    {{-- <span
                                                                        class="label-atrr">الحجم:</span>
                                                                    <span class="value">ص</span> --}}
                                                                    <span
                                                                        class="value">{{ $product->attribute->name }}</span>
                                                                </div>
                                                                {{-- <div
                                                                    class="product-line-info">
                                                                    <span class="label-atrr">:</span>
                                                                    <span class="value">ابيض مطفي</span>
                                                                </div> --}}

                                                            </div>
                                                            <div class=" text-center product-line-actions col-sm-6 col-xs-12">
                                                                <div class="row">
                                                                    <div class="col-sm-9 col-xs-12">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-xs-6 qty">
                                                                                <div class="label">@lang('front.qty'):
                                                                                </div>

                                                                                <div class="qty ">

                                                                                    @php
                                                                                        $user_selected = $product->user_select_quantity ?? 1;
                                                                                        $check_quantity = $product->attribute->qty > 0 ? 1 : 0;
                                                                                        if ($user_selected <= $product->attribute->qty) {
                                                                                            $check_quantity = $user_selected;
                                                                                        }
                                                                                    @endphp

                                                                                    @if ($product->attribute->qty > 0)
                                                                                        <form
                                                                                            action="{{ route('cart.update', [$product->slug, $product->attribute->id]) }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            @method('put')
                                                                                            {{-- <input type="number"
                                                                                                    name="quantity"
                                                                                                    class="form-control"
                                                                                                    value="{{ $check_quantity }}"
                                                                                                    min="1"
                                                                                                    max="{{ $product->attribute->qty }}"
                                                                                                    style="min-width: 70px; border-radius: 23px;"
                                                                                                    onchange="this.closest('form').submit()"> --}}

                                                                                            <select id="" class="form-control"
                                                                                                name="quantity"
                                                                                                style="max-width:100px; border-radius: 23px;"
                                                                                                onchange="this.closest('form').submit()">

                                                                                                @for ($i = 1; $i <= $product->attribute->qty; $i++)
                                                                                                    <option
                                                                                                        value="{{ $i }}"
                                                                                                        title="{{ $i }}"
                                                                                                        {{ $i == $check_quantity ? 'selected' : '' }}>
                                                                                                        {{ $i }}
                                                                                                    </option>
                                                                                                @endfor


                                                                                            </select>
                                                                                        </form>


                                                                                        <span class="text-warning "
                                                                                            style=" display: flex; justify-content: flex-start;">
                                                                                            {{ $product->attribute->qty }}
                                                                                            @lang('front.count_in_stock') !
                                                                                        </span>

                                                                                    @else


                                                                                        <div class="label text-danger">
                                                                                            @lang('front.unavailable')</div>



                                                                                    @endif




                                                                                </div>

                                                                            </div>
                                                                            {{-- ----------------- --}}
                                                                            @php
                                                                                $real_price = 0;

                                                                                if ($product->attribute->hasOffer) {
                                                                                    $real_price = $product->attribute->price_offer;
                                                                                } else {
                                                                                    $real_price = $product->attribute->price;
                                                                                }

                                                                            @endphp
                                                                            {{-- -------------- --}}
                                                                            <div class="col-md-6 col-xs-6 price">
                                                                                <div class="label">
                                                                                    @lang('front.total'):</div>
                                                                                <div class="product-price total">
                                                                                    {{ $real_price * $check_quantity }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3 col-xs-12 text-xs-right ">
                                                                        <div class="cart-line-product-actions ">

                                                                            <form
                                                                                action="{{ route('cart.destroy', [$product->slug, $product->attribute->id]) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"
                                                                                    class="btn-outline-danger remove-from-cart"
                                                                                    style="border: 0px">
                                                                                    <i class="fa fa-trash-o"
                                                                                        aria-hidden="true"></i>
                                                                                </button>
                                                                            </form>




                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ---------------------------------- -->

                                        @endforeach

                                    @else
                                        <div class="d-flex justify-content-center m-4">

                                            @lang('front.no_products_in_cart')

                                        </div>
                                    @endif

                                @endisset











                            </div>


                            <a class="label btn btn-primary mt-45" href="{{ route('front.home') }}">
                                @lang('front.continue_in_shopping')
                            </a>




                            <!-- shipping informations -->



                        </div>

                        <!-- Right Block: cart subtotal & cart total -->
                        <div class="cart-grid-right col-xs-12 col-lg-3">


                            <div class="cart-summary">




                                <div class="cart-detailed-totals">
                                    <div class="cart-summary-products">
                                        <div class="summary-label">{{ $total_products_count }}
                                            @lang('front.count_products_in_your_cart')</div>
                                    </div>

                                    <div class="">
                                        <div class=" cart-summary-line"
                                        id="cart-subtotal-products">
                                        <span class="label js-subtotal">
                                            @lang('front.total_products_price') :
                                        </span>
                                        <span class="value">{{ $total_price }} @lang('front.egp')</span>
                                    </div>
                                    <div class="cart-summary-line" id="cart-subtotal-shipping">
                                        <span class="label">
                                            Total الشحن:
                                        </span>
                                        <span class="value">مجاناً</span>
                                        <div><small class="value"></small></div>
                                    </div>
                                </div>




                                <div class="">
                                        <div class=" cart-summary-line
                                    cart-total">
                                    <span class="label js-subtotal">
                                        @lang('front.total_price') :
                                    </span>
                                    <span class="value">{{ $total_price }} @lang('front.egp')</span>
                                    <span class="value">(شامل للضريبة)</span>
                                </div>

                            </div>

                        </div>











                        @if ($total_products_count > 0 && $total_price > 0)

                            <div class="checkout cart-detailed-actions">
                                <div class="text-xs-center">
                                    <a href="{{ route('front.checkout.index') }}" class="btn btn-primary">اتمام
                                        الطلب</a>

                                </div>
                            </div>

                        @endif






                    </div>



                    <div class="blockreassurance_product">
                        <div>
                            <span class="item-product">
                                <img class="svg"
                                    src="{{ asset('front') }}/modules/blockreassurance/img/ic_verified_user_black_36dp_1x.png">
                                &nbsp;
                            </span>
                            <p class="block-title" style="color:#000000;">Security policy (edit with Customer
                                reassurance module)</p>
                        </div>
                        <div>
                            <span class="item-product">
                                <img class="svg"
                                    src="{{ asset('front') }}/modules/blockreassurance/img/ic_local_shipping_black_36dp_1x.png">
                                &nbsp;
                            </span>
                            <p class="block-title" style="color:#000000;">Delivery policy (edit with Customer
                                reassurance module)</p>
                        </div>
                        <div>
                            <span class="item-product">
                                <img class="svg"
                                    src="{{ asset('front') }}/modules/blockreassurance/img/ic_swap_horiz_black_36dp_1x.png">
                                &nbsp;
                            </span>
                            <p class="block-title" style="color:#000000;">Return policy (edit with Customer
                                reassurance module)</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>



            </div>

        </div>
        </section>

    </div>
    </div>
    </div>

@stop
@section('scripts')

    <script>
        $(document).on('click', '.remove-from-cart', function(e) {

            e.preventDefault();

            var form = $(this).closest('form');

            swal({
                title: "{{ __('front.are_you_sure') }}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6B6F82',
                cancelButtonText: "{{ __('front.cancel') }}",
                confirmButtonText: "{{ __('front.yes_delete') }}"
            }).then(function(result) {

                if (result.value == true) {

                    form.submit();

                }

            });



        });
    </script>

@stop
