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

                <section id="main" class="mb-5">
                    <div class="cart-grid row">

                        <!-- Left Block: cart product informations & shpping -->


                        <div class="cart-grid-left col-xs-12 col-lg-6">


                            <div class="card text-center">
                                <div class="card-header">
                                    @lang('front.checkout')
                                </div>
                                <div class="card-body" style="min-height: 175px">
                                    <h3 class="page-title mt-5">@lang('front.checkout') : {{ $data['total_price'] }}
                                        @lang('front.egp')</h3>

                                    {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                    <p class="card-text">


                            <div class="m-4 row" style="text-align: left;">
                                <div class="col-6">
                                    <h5>{{ __('front.test_card') }}</h5>
                                    <p> card holder name : test test </p>
                                    <p> card number :  5453010000095539</p>
                                    <p> MM/YY :  12/25	 </p>
                                    <p> CVC:  300</p>
                                </div>

                                <div class="col-6">
                                    <h5>{{ __('front.test_card') }}</h5>
                                    <p> card holder name : test test </p>
                                    <p> card number : 5123 4500 0000 0008 </p>
                                    <p> MM/YY : 05 / 21 	 </p>
                                    <p> CVC: 100 </p>
                                </div>



                            </div>

                                        {{ __('front.click_to_payemnt') }}

                                    </p>

                                </div>
                                <div class="card-footer text-muted">
                                    <form action="{{ route('front.checkout.myfatoorah.redirect') }}" method="post">
                                        @csrf
                                        <button class="btn btn-primary">
                                            {{ __('front.click_to_payemnt') }}
                                        </button>

                                    </form>

                                </div>
                            </div>










                        </div>


                        {{-- -----------user details----------- --}}

                        @if (user()->addressDetails)
                            <div class="cart-grid-body col-xs-12 col-lg-3" style="min-height:260px">

                                <div class="card ">


                                    <div class="card-header cleafix" style="background: #2d9ae8;color:white">
                                        <a href="{{ route('front.profile.address.edit') }}" class="float-left"><i
                                                style="color:white" class="fa fa-edit fa-lg"></i></a>
                                        <h4 class="float-right"> {{ __('front.about_address_details') }} </h4>

                                    </div>
                                    <div class="card-body p-3 " style="min-height: 225px; ">




                                        <p class="card-title">
                                            {{ __('front.first_name') . ' : ' . user()->addressDetails->first_name }}</p>
                                        <p class="card-title">
                                            {{ __('front.last_name') . ' : ' . user()->addressDetails->last_name }}</p>
                                        <p class="card-text">
                                            {{ __('front.email') . ' : ' . user()->addressDetails->email }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('front.phone') . ' : ' . user()->addressDetails->phone }}
                                        </p>
                                        @if (user()->addressDetails->second_phone)
                                            <p class="card-text">
                                                {{ __('front.second_phone') . ' : ' . user()->addressDetails->second_phone }}
                                            </p>
                                        @endif
                                        <p class="card-text">
                                            {{ __('front.address') . ' : ' . user()->addressDetails->address }}
                                        </p>

                                        @if (user()->addressDetails->second_address)
                                            <p class="card-text">
                                                {{ __('front.second_address') . ' : ' . user()->addressDetails->second_address }}
                                            </p>
                                        @endif

                                    </div>
                                </div>





                            </div>



                        @endif
                        <!-- Right Block: cart subtotal & cart total -->
                        <div class="cart-grid-right col-xs-12 col-lg-3">


                            <div class="cart-summary">




                                <div class="cart-detailed-totals">
                                    <div class="cart-summary-products">
                                        <div class="summary-label">{{ $data['total_products_count'] }}
                                            @lang('front.count_products_in_your_cart')</div>
                                    </div>

                                    <div class="">
                                        <div class="cart-summary-line" id="cart-subtotal-products">
                                            <span class="label js-subtotal">
                                                @lang('front.total_products_price') :
                                            </span>
                                            <span class="value">{{ $data['total_price'] }}
                                                @lang('front.egp')</span>
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
                                            <span class="value">{{ $data['total_price'] }}
                                                @lang('front.egp')</span>
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


                            {{-- <div class="blockreassurance_product">
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
                            </div> --}}


                        </div>


                    </div>
                </section>

            </div>
        </div>
    </div>

@stop
@section('scripts')




@stop
