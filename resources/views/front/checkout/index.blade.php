@extends('layouts.front')

@section('title')
    | @lang('front.checkout')
@stop


@section('style')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>
@endsection

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
                                @lang('front.checkout')
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
                    <h1 class="page-title">@lang('front.checkout') : {{$total_price}} @lang('front.egp')</h1>
                    <div class="cart-grid row">

                        <!-- Left Block: cart product informations & shpping -->
                        <div class="cart-grid-body col-xs-12 col-lg-9">




                            <div class="" style="max-width:500px">

                                <form action="{{route('front.checkout.charge')}}" method="post" id="payment-form">
                                    @csrf

                                    <input type="hidden" name="amount" value="{{$total_price}}">
                                    <div class="form-row">
                                        <label for="card-element">
                                            Credit or debit card
                                        </label>
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display Element errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>

                                    <button class="btn btn-lg btn-success " style="  margin-top: 15px !important;">@lang('front.checkout')</button>
                                </form>

                            </div>




{{--
                            <a class="label btn btn-primary mt-45" href="{{ route('front.home') }}">
                                @lang('front.continue_in_shopping')
                            </a> --}}




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
                                        <div class="cart-summary-line" id="cart-subtotal-products">
                                            <span class="label js-subtotal">
                                                @lang('front.total_products_price') :
                                            </span>
                                            <span class="value">{{ $total_price }} @lang('front.egp')</span>
                                        </div>
                                        <div class="cart-summary-line" id="cart-subtotal-shipping">
                                            <span class="label">
                                                {{ __('front.totla_shipping') }}:
                                            </span>

                                            <span class="value">{{ __('front.free') }}</span>
                                            <div><small class="value"></small></div>
                                        </div>
                                    </div>




                                    <div class="">
                                        <div class="cart-summary-line cart-total">
                                            <span class="label js-subtotal">
                                                @lang('front.total_price') :
                                            </span>
                                            <span class="value">{{ $total_price }} @lang('front.egp')</span>
                                            <span class="value"> ({{ __('front.tax_incl') }})</span>
                                        </div>

                                    </div>

                                </div>











                                <div class="checkout cart-detailed-actions">
                                    <div class="text-xs-center">
                                        <a href="{{ route('cart.index') }}" class="btn btn-primary">
                                            @lang('front.details')</a>

                                    </div>
                                </div>







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
