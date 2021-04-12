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

        .steps_filling_data_or_filled {
                    background: #2d9ae8 !important;
                    color: white !important;
                }

                .steps_filling_data_or_filled_title {
                    color: #2d9ae8  !important;
                }

        section.checkout-step .step-title {
            color: #afafaf;
            font-family: "Oswald", sans-serif;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 2rem;
            line-height: 1.5em;
            cursor: pointer;
            margin-bottom: 30px;
            display: inline-block;
            background: #fff;
            padding-right: 15px;
        }

        section.checkout-step .step-number {
            width: 30px;
            height: 30px;
            font-size: 1.6rem;
            color: #fff;
            background: #afafaf;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
            margin-right: 15px;
            text-align: center;
            padding: 6px;

            /* float: left; */
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

                    <div class="cart-grid row">

                        <div class="col-md-9">



                            <section id="checkout-personal-information-step"
                                class="checkout-step -current -reachable js-current-step -clickable">
                                <h1 class="step-title h3 steps_filling_data_or_filled_title">
                                    <span class="step-number steps_filling_data_or_filled">1</span>
                                    المعلومات الشخصية
                                    {{-- <span class="step-edit"><i class="material-icons edit">mode_edit</i> edit</span> --}}
                                </h1>

                                <div class="content">




                                    <div class="tab-content">
                                        <div class="tab-pane active" id="checkout-guest-form" role="tabpanel">




                                            <form
                                                action="http://demo.bestprestashoptheme.com/savemart/ar/%D8%B7%D9%84%D8%A8%20%D8%B4%D8%B1%D8%A7%D8%A1"
                                                id="customer-form" class="js-customer-form" method="post">
                                                <section>




                                                    <input type="hidden" name="id_customer" value="">






                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5">
                                                            المسميات :
                                                        </label>
                                                        <div class="col-md-6 form-control-valign">

                                                            <label class="radio-inline">
                                                                <span class="custom-radio">
                                                                    <input name="id_gender" type="radio" value="1">
                                                                    <span></span>
                                                                </span>
                                                                السيد.
                                                            </label>
                                                            <label class="radio-inline">
                                                                <span class="custom-radio">
                                                                    <input name="id_gender" type="radio" value="2">
                                                                    <span></span>
                                                                </span>
                                                                السيدة.
                                                            </label>



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>






                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                                            الاسم الأول :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <input class="form-control" name="firstname" type="text"
                                                                value="" required="">



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>






                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                                            الاسم الأخير :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <input class="form-control" name="lastname" type="text" value=""
                                                                required="">



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>






                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                                            البريد الإلكتروني :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <input class="form-control" name="email" type="email" value=""
                                                                required="">



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>





                                                    <div class="desc-password">
                                                        <span class="font-weight-bold">أنشئ حساب</span>
                                                        <span>(إختياري)</span>
                                                        <br>
                                                        <span class="text-muted">ووفر الوقت عند الطلب القادم!</span>
                                                    </div>

                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5">
                                                            كلمة المرور :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <div class="input-group js-parent-focus">
                                                                <input
                                                                    class="form-control js-child-focus js-visible-password"
                                                                    name="password" type="password" value=""
                                                                    pattern=".{5,}">
                                                                <span class="input-group-btn">
                                                                    <button class="btn" type="button"
                                                                        data-action="show-password" data-text-show="إظهار"
                                                                        data-text-hide="إخفاء">
                                                                        إظهار
                                                                    </button>
                                                                </span>
                                                            </div>


                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                            (اختياري)
                                                        </div>
                                                    </div>





                                                    <div class="hidden-comment">

                                                        <div class="form-group row no-gutters">
                                                            <label class="col-md-2 form-control-label mb-xs-5">
                                                                تاريخ الميلاد :
                                                            </label>
                                                            <div class="col-md-6">

                                                                <input class="form-control" name="birthday" type="text"
                                                                    value="" placeholder="YYYY-MM-DD">
                                                                <span class="form-control-comment mt-xs-5">
                                                                    (مثال: 1970-05-31)
                                                                </span>



                                                            </div>

                                                            <div class="col-md-4 form-control-comment right">
                                                                (اختياري)
                                                            </div>
                                                        </div>



                                                    </div>



                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5">
                                                        </label>
                                                        <div class="col-md-6">
                                                            <span class="custom-checkbox ">
                                                                <input name="optin" type="checkbox" value="1">
                                                                <span><i
                                                                        class="material-icons checkbox-checked">check</i></span>
                                                                <label>الحصول على العروض من شركائنا</label>
                                                            </span>



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>






                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5">
                                                        </label>
                                                        <div class="col-md-6">
                                                            <span class="custom-checkbox ">
                                                                <input name="newsletter" type="checkbox" value="1">
                                                                <span><i
                                                                        class="material-icons checkbox-checked">check</i></span>
                                                                <label>إشترك في نشرتنا البريدية <br><em>يمكنك إلغاء الاشتراك
                                                                        في أي لحظة. لهذا الغرض، يرجى الاطلاع على معلومات
                                                                        الاتصال لدينا في الإشعار القانوني.</em></label>
                                                            </span>



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>






                                                </section>


                                                <footer class="form-footer clearfix">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-10 offset-md-2">
                                                            <input type="hidden" name="submitCreate" value="1">

                                                            <button class="continue btn btn-primary pull-xs-right"
                                                                name="continue" data-link-action="register-new-customer"
                                                                type="submit" value="1">
                                                                استمرار
                                                            </button>

                                                        </div>
                                                    </div>
                                                </footer>


                                            </form>


                                        </div>
                                        <div class="tab-pane " id="checkout-login-form" role="tabpanel">





                                            <form id="login-form"
                                                action="http://demo.bestprestashoptheme.com/savemart/ar/%D8%B7%D9%84%D8%A8%20%D8%B4%D8%B1%D8%A7%D8%A1"
                                                method="post">

                                                <section>



                                                    <input type="hidden" name="back" value="">




                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                                            البريد الإلكتروني :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <input class="form-control" name="email" type="email" value=""
                                                                required="">



                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>




                                                    <div class="form-group row no-gutters">
                                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                                            كلمة المرور :
                                                        </label>
                                                        <div class="col-md-6">

                                                            <div class="input-group js-parent-focus">
                                                                <input
                                                                    class="form-control js-child-focus js-visible-password"
                                                                    name="password" type="password" value="" pattern=".{5,}"
                                                                    required="">
                                                                <span class="input-group-btn">
                                                                    <button class="btn" type="button"
                                                                        data-action="show-password" data-text-show="إظهار"
                                                                        data-text-hide="إخفاء">
                                                                        إظهار
                                                                    </button>
                                                                </span>
                                                            </div>


                                                        </div>

                                                        <div class="col-md-4 form-control-comment right">
                                                        </div>
                                                    </div>




                                                    <div class="row no-gutters">
                                                        <div class="col-md-10 offset-md-2">
                                                            <div class="forgot-password">
                                                                <a href="http://demo.bestprestashoptheme.com/savemart/ar/استعادة كلمة المرور"
                                                                    rel="nofollow">
                                                                    هل نسيت كلمة المرور؟
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>


                                                <footer class="form-footer clearfix">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-10 offset-md-2">
                                                            <input type="hidden" name="submitLogin" value="1">

                                                            <button class="continue btn btn-primary pull-xs-right"
                                                                name="continue" data-link-action="sign-in" type="submit"
                                                                value="1">
                                                                استمرار
                                                            </button>

                                                        </div>
                                                    </div>
                                                </footer>


                                            </form>


                                        </div>
                                    </div>



                                </div>
                            </section>


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
                                                Total الشحن:
                                            </span>
                                            <span class="value">مجاناً</span>
                                            <div><small class="value"></small></div>
                                        </div>
                                    </div>




                                    <div class="">
                                        <div class="cart-summary-line cart-total">
                                            <span class="label js-subtotal">
                                                @lang('front.total_price') :
                                            </span>
                                            <span class="value">{{ $total_price }} @lang('front.egp')</span>
                                            <span class="value">(شامل للضريبة)</span>
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
@section('scripts')



@stop
