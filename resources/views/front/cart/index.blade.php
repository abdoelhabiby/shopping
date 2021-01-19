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
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <section id="main">
                    <h1 class="page-title">سلة الشراء</h1>
                    <div class="cart-grid row">

                        <!-- Left Block: cart product informations & shpping -->
                        <div class="cart-grid-body col-xs-12 col-lg-9">

                            <!-- cart products detailed -->
                            <div class="cart-container">





                                <div class="cart-overview js-cart"
                                    data-refresh-url="//demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?ajax=1&amp;action=refresh">
                                    <ul class="cart-items">
                                        <li class="cart-item">

                                            <div class="product-line-grid row spacing-10">
                                                <!--  product left content: image-->
                                                <div class="product-line-grid-left col-sm-2 col-xs-4">
                                                    <span class="product-image media-middle">
                                                        <img class="img-fluid"
                                                            src="http://demo.bestprestashoptheme.com/savemart/39-cart_default/the-adventure-begins-framed-poster.jpg"
                                                            alt="Maecenas vulputate ligula vel">
                                                    </span>
                                                </div>

                                                <!--  product left body: description -->
                                                <div class="product-line-grid-body col-sm-10 col-xs-8">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="product-line-info">
                                                                <a class="label"
                                                                    href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/4-112-the-adventure-begins-framed-poster.html#/1-الحجم-ص/9-اللون_-ابيض_مطفي"
                                                                    data-id_customization="0">Maecenas vulputate ligula
                                                                    vel</a>
                                                            </div>

                                                            <div class="product-line-info product-price">
                                                                <span class="value">18.00&nbsp;UK£</span>
                                                            </div>

                                                            <div class="product-line-info">
                                                                <span class="label-atrr">الحجم:</span>
                                                                <span class="value">ص</span>
                                                            </div>
                                                            <div class="product-line-info">
                                                                <span class="label-atrr">:</span>
                                                                <span class="value">ابيض مطفي</span>
                                                            </div>

                                                        </div>
                                                        <div class="text-center product-line-actions col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-6 qty">
                                                                            <div class="label">Qty:</div>
                                                                            <div class="input-group bootstrap-touchspin">
                                                                                <span
                                                                                    class="input-group-addon bootstrap-touchspin-prefix"
                                                                                    style="display: none;"></span><input
                                                                                    id="quantity_wanted"
                                                                                    class="js-cart-line-product-quantity form-control"
                                                                                    data-down-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=4&amp;id_product_attribute=112&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=down"
                                                                                    data-up-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=4&amp;id_product_attribute=112&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=up"
                                                                                    data-update-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=4&amp;id_product_attribute=112&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                                    data-product-id="4" type="text"
                                                                                    value="5" name="product-quantity-spin"
                                                                                    min="1" style="display: block;"><span
                                                                                    class="input-group-addon bootstrap-touchspin-postfix"
                                                                                    style="display: none;"></span><span
                                                                                    class="input-group-btn-vertical"><button
                                                                                        class="btn btn-touchspin js-touchspin js-increase-product-quantity bootstrap-touchspin-up"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-up"></i></button><button
                                                                                        class="btn btn-touchspin js-touchspin js-decrease-product-quantity bootstrap-touchspin-down"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-down"></i></button></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 price">
                                                                            <div class="label">Total:</div>
                                                                            <div class="product-price total">
                                                                                90.00&nbsp;UK£
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-3 col-xs-12 text-xs-right align-self-end">
                                                                    <div class="cart-line-product-actions ">
                                                                        <a class="remove-from-cart" rel="nofollow"
                                                                            href="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?delete=1&amp;id_product=4&amp;id_product_attribute=112&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                            data-link-action="delete-from-cart"
                                                                            data-id-product="4"
                                                                            data-id-product-attribute="112"
                                                                            data-id-customization="">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="cart-item">

                                            <div class="product-line-grid row spacing-10">
                                                <!--  product left content: image-->
                                                <div class="product-line-grid-left col-sm-2 col-xs-4">
                                                    <span class="product-image media-middle">
                                                        <img class="img-fluid"
                                                            src="http://demo.bestprestashoptheme.com/savemart/29-cart_default/brown-bear-printed-sweater.jpg"
                                                            alt="Lorem ipsum dolor sit amet ege">
                                                    </span>
                                                </div>

                                                <!--  product left body: description -->
                                                <div class="product-line-grid-body col-sm-10 col-xs-8">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="product-line-info">
                                                                <a class="label"
                                                                    href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/2-60-brown-bear-printed-sweater.html#/1-الحجم-ص/11-اللون_-اسود"
                                                                    data-id_customization="0">Lorem ipsum dolor sit amet
                                                                    ege</a>
                                                            </div>

                                                            <div class="product-line-info product-price">
                                                                <span class="value">36.00&nbsp;UK£</span>
                                                            </div>

                                                            <div class="product-line-info">
                                                                <span class="label-atrr">الحجم:</span>
                                                                <span class="value">ص</span>
                                                            </div>
                                                            <div class="product-line-info">
                                                                <span class="label-atrr">:</span>
                                                                <span class="value">اسود</span>
                                                            </div>

                                                        </div>
                                                        <div class="text-center product-line-actions col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-6 qty">
                                                                            <div class="label">Qty:</div>
                                                                            <div class="input-group bootstrap-touchspin">
                                                                                <span
                                                                                    class="input-group-addon bootstrap-touchspin-prefix"
                                                                                    style="display: none;"></span><input
                                                                                    id="quantity_wanted"
                                                                                    class="js-cart-line-product-quantity form-control"
                                                                                    data-down-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=2&amp;id_product_attribute=60&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=down"
                                                                                    data-up-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=2&amp;id_product_attribute=60&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=up"
                                                                                    data-update-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=2&amp;id_product_attribute=60&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                                    data-product-id="2" type="text"
                                                                                    value="1" name="product-quantity-spin"
                                                                                    min="1" style="display: block;"><span
                                                                                    class="input-group-addon bootstrap-touchspin-postfix"
                                                                                    style="display: none;"></span><span
                                                                                    class="input-group-btn-vertical"><button
                                                                                        class="btn btn-touchspin js-touchspin js-increase-product-quantity bootstrap-touchspin-up"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-up"></i></button><button
                                                                                        class="btn btn-touchspin js-touchspin js-decrease-product-quantity bootstrap-touchspin-down"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-down"></i></button></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 price">
                                                                            <div class="label">Total:</div>
                                                                            <div class="product-price total">
                                                                                36.00&nbsp;UK£
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-3 col-xs-12 text-xs-right align-self-end">
                                                                    <div class="cart-line-product-actions ">
                                                                        <a class="remove-from-cart" rel="nofollow"
                                                                            href="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?delete=1&amp;id_product=2&amp;id_product_attribute=60&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                            data-link-action="delete-from-cart"
                                                                            data-id-product="2"
                                                                            data-id-product-attribute="60"
                                                                            data-id-customization="">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="cart-item">

                                            <div class="product-line-grid row spacing-10">
                                                <!--  product left content: image-->
                                                <div class="product-line-grid-left col-sm-2 col-xs-4">
                                                    <span class="product-image media-middle">
                                                        <img class="img-fluid"
                                                            src="http://demo.bestprestashoptheme.com/savemart/34-cart_default/the-best-is-yet-to-come-framed-poster.jpg"
                                                            alt="Mauris molestie porttitor diam">
                                                    </span>
                                                </div>

                                                <!--  product left body: description -->
                                                <div class="product-line-grid-body col-sm-10 col-xs-8">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="product-line-info">
                                                                <a class="label"
                                                                    href="http://demo.bestprestashoptheme.com/savemart/ar/smartphone-tablet/3-95-the-best-is-yet-to-come-framed-poster.html#/1-الحجم-ص/13-اللون_-برتقالي"
                                                                    data-id_customization="0">Mauris molestie porttitor
                                                                    diam</a>
                                                            </div>

                                                            <div class="product-line-info product-price">
                                                                <span class="value">30.00&nbsp;UK£</span>
                                                            </div>

                                                            <div class="product-line-info">
                                                                <span class="label-atrr">الحجم:</span>
                                                                <span class="value">ص</span>
                                                            </div>
                                                            <div class="product-line-info">
                                                                <span class="label-atrr">:</span>
                                                                <span class="value">برتقالي</span>
                                                            </div>

                                                        </div>
                                                        <div class="text-center product-line-actions col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-6 qty">
                                                                            <div class="label">Qty:</div>
                                                                            <div class="input-group bootstrap-touchspin">
                                                                                <span
                                                                                    class="input-group-addon bootstrap-touchspin-prefix"
                                                                                    style="display: none;"></span><input
                                                                                    id="quantity_wanted"
                                                                                    class="js-cart-line-product-quantity form-control"
                                                                                    data-down-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=3&amp;id_product_attribute=95&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=down"
                                                                                    data-up-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=3&amp;id_product_attribute=95&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=up"
                                                                                    data-update-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=3&amp;id_product_attribute=95&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                                    data-product-id="3" type="text"
                                                                                    value="2" name="product-quantity-spin"
                                                                                    min="1" style="display: block;"><span
                                                                                    class="input-group-addon bootstrap-touchspin-postfix"
                                                                                    style="display: none;"></span><span
                                                                                    class="input-group-btn-vertical"><button
                                                                                        class="btn btn-touchspin js-touchspin js-increase-product-quantity bootstrap-touchspin-up"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-up"></i></button><button
                                                                                        class="btn btn-touchspin js-touchspin js-decrease-product-quantity bootstrap-touchspin-down"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-down"></i></button></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 price">
                                                                            <div class="label">Total:</div>
                                                                            <div class="product-price total">
                                                                                60.00&nbsp;UK£
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-3 col-xs-12 text-xs-right align-self-end">
                                                                    <div class="cart-line-product-actions ">
                                                                        <a class="remove-from-cart" rel="nofollow"
                                                                            href="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?delete=1&amp;id_product=3&amp;id_product_attribute=95&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                            data-link-action="delete-from-cart"
                                                                            data-id-product="3"
                                                                            data-id-product-attribute="95"
                                                                            data-id-customization="">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="cart-item">

                                            <div class="product-line-grid row spacing-10">
                                                <!--  product left content: image-->
                                                <div class="product-line-grid-left col-sm-2 col-xs-4">
                                                    <span class="product-image media-middle">
                                                        <img class="img-fluid"
                                                            src="http://demo.bestprestashoptheme.com/savemart/49-cart_default/nullam-tempor-orci-eu-pretium.jpg"
                                                            alt="Nullam tempor orci eu pretium">
                                                    </span>
                                                </div>

                                                <!--  product left body: description -->
                                                <div class="product-line-grid-body col-sm-10 col-xs-8">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-xs-12">
                                                            <div class="product-line-info">
                                                                <a class="label"
                                                                    href="http://demo.bestprestashoptheme.com/savemart/ar/home-appliance/6-nullam-tempor-orci-eu-pretium.html"
                                                                    data-id_customization="0">Nullam tempor orci eu
                                                                    pretium</a>
                                                            </div>

                                                            <div class="product-line-info product-price">
                                                                <span class="value">14.28&nbsp;UK£</span>
                                                            </div>


                                                        </div>
                                                        <div class="text-center product-line-actions col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-xs-6 qty">
                                                                            <div class="label">Qty:</div>
                                                                            <div class="input-group bootstrap-touchspin">
                                                                                <span
                                                                                    class="input-group-addon bootstrap-touchspin-prefix"
                                                                                    style="display: none;"></span><input
                                                                                    id="quantity_wanted"
                                                                                    class="js-cart-line-product-quantity form-control"
                                                                                    data-down-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=6&amp;id_product_attribute=0&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=down"
                                                                                    data-up-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=6&amp;id_product_attribute=0&amp;token=bd7f6629522b4660914af3ac025e179e&amp;op=up"
                                                                                    data-update-url="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?update=1&amp;id_product=6&amp;id_product_attribute=0&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                                    data-product-id="6" type="text"
                                                                                    value="1" name="product-quantity-spin"
                                                                                    min="1" style="display: block;"><span
                                                                                    class="input-group-addon bootstrap-touchspin-postfix"
                                                                                    style="display: none;"></span><span
                                                                                    class="input-group-btn-vertical"><button
                                                                                        class="btn btn-touchspin js-touchspin js-increase-product-quantity bootstrap-touchspin-up"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-up"></i></button><button
                                                                                        class="btn btn-touchspin js-touchspin js-decrease-product-quantity bootstrap-touchspin-down"
                                                                                        type="button"><i
                                                                                            class="material-icons touchspin-down"></i></button></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-xs-6 price">
                                                                            <div class="label">Total:</div>
                                                                            <div class="product-price total">
                                                                                14.28&nbsp;UK£
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-3 col-xs-12 text-xs-right align-self-end">
                                                                    <div class="cart-line-product-actions ">
                                                                        <a class="remove-from-cart" rel="nofollow"
                                                                            href="http://demo.bestprestashoptheme.com/savemart/ar/عربة التسوق?delete=1&amp;id_product=6&amp;id_product_attribute=0&amp;token=bd7f6629522b4660914af3ac025e179e"
                                                                            data-link-action="delete-from-cart"
                                                                            data-id-product="6"
                                                                            data-id-product-attribute="0"
                                                                            data-id-customization="">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>



                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>






                            </div>


                            <a class="label btn btn-primary" href="http://demo.bestprestashoptheme.com/savemart/ar/">
                                الاستمرار في التسوق
                            </a>




                            <!-- shipping informations -->



                        </div>

                        <!-- Right Block: cart subtotal & cart total -->
                        <div class="cart-grid-right col-xs-12 col-lg-3">


                            <div class="cart-summary">









                                <div class="cart-detailed-totals">
                                    <div class="cart-summary-products">
                                        <div class="summary-label">There are 9 منتجات in your cart</div>
                                    </div>

                                    <div class="">
                                        <div class="cart-summary-line" id="cart-subtotal-products">
                                            <span class="label js-subtotal">
                                                إجمالي المنتجات:
                                            </span>
                                            <span class="value">200.28&nbsp;UK£</span>
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
                                            <span class="label">الإجمالي:</span>
                                            <span class="value">200.28&nbsp;UK£ (شامل للضريبة)</span>
                                        </div>

                                    </div>

                                </div>











                                <div class="checkout cart-detailed-actions">
                                    <div class="text-xs-center">
                                        <a href="http://demo.bestprestashoptheme.com/savemart/ar/طلب شراء"
                                            class="btn btn-primary">اتمام الطلب</a>

                                    </div>
                                </div>







                            </div>



                            <div class="blockreassurance_product">
                                <div>
                                    <span class="item-product">
                                        <img class="svg"
                                            src="{{asset('front')}}/modules/blockreassurance/img/ic_verified_user_black_36dp_1x.png">
                                        &nbsp;
                                    </span>
                                    <p class="block-title" style="color:#000000;">Security policy (edit with Customer
                                        reassurance module)</p>
                                </div>
                                <div>
                                    <span class="item-product">
                                        <img class="svg"
                                            src="{{asset('front')}}/modules/blockreassurance/img/ic_local_shipping_black_36dp_1x.png">
                                        &nbsp;
                                    </span>
                                    <p class="block-title" style="color:#000000;">Delivery policy (edit with Customer
                                        reassurance module)</p>
                                </div>
                                <div>
                                    <span class="item-product">
                                        <img class="svg"
                                            src="{{asset('front')}}/modules/blockreassurance/img/ic_swap_horiz_black_36dp_1x.png">
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
