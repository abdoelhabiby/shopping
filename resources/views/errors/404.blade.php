<!doctype html>
<html lang="{{ currentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>


    <meta charset="utf-8">


    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <title>Osah Store @yield('title')</title>
    <meta name="description" content="Shop powered by PrestaShop">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=yes">


    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('front/img/favicon.ico') }}?1531456858">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/img/favicon.ico') }}?1531456858">


    <link href="{{ asset('front/css/css.css') }}?family=Roboto:300,400,500,600,700,900" rel="stylesheet">
    <link href="{{ asset('front/css/css-1.css') }}?family=Oswald:300,400,500,600,700,900" rel="stylesheet">


    @if (currentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('front/themes/vinova_savemart/assets/cache/theme-526bb624.css') }}"
            type="text/css" media="all"> <!-- ar ---- -->

    @else
        <link rel="stylesheet" href="{{ asset('front/themes/vinova_savemart/assets/cache/theme-78026624.css') }}"
            type="text/css" media="all">

    @endif


    <script type="text/javascript">
        var added_to_wishlist = "The product was successfully added to your wishlist.";
        var isLogged = false;
        var isLoggedWishlist = false;
        var loggin_required = "You must be logged in to manage your wishlist.";
        var prestashop = {
            "cart": {
                "products": [],
                "totals": {
                    "total": {"type": "total", "label": "Total", "amount": 0, "value": "\u00a30.00"},
                    "total_including_tax": {
                        "type": "total",
                        "label": "Total (tax incl.)",
                        "amount": 0,
                        "value": "\u00a30.00"
                    },
                    "total_excluding_tax": {
                        "type": "total",
                        "label": "Total (tax excl.)",
                        "amount": 0,
                        "value": "\u00a30.00"
                    }
                },
                "subtotals": {
                    "products": {"type": "products", "label": "Subtotal", "amount": 0, "value": "\u00a30.00"},
                    "discounts": null,
                    "shipping": {"type": "shipping", "label": "Shipping", "amount": 0, "value": "Free"},
                    "tax": null
                },
                "products_count": 0,
                "summary_string": "0 items",
                "vouchers": {"allowed": 0, "added": []},
                "discounts": [],
                "minimalPurchase": 0,
                "minimalPurchaseRequired": ""
            },
            "currency": {"name": "British Pound", "iso_code": "GBP", "iso_code_num": "826", "sign": "\u00a3"},
            "customer": {
                "lastname": null,
                "firstname": null,
                "email": null,
                "birthday": null,
                "newsletter": null,
                "newsletter_date_add": null,
                "optin": null,
                "website": null,
                "company": null,
                "siret": null,
                "ape": null,
                "is_logged": false,
                "gender": {"type": null, "name": null},
                "addresses": []
            },
            "language": {
                "name": "English (English)",
                "iso_code": "en",
                "locale": "en-US",
                "language_code": "en-us",
                "is_rtl": "0",
                "date_format_lite": "m\/d\/Y",
                "date_format_full": "m\/d\/Y H:i:s",
                "id": 1
            },
            "page": {
                "title": "",
                "canonical": null,
                "meta": {
                    "title": "Prestashop_Savemart",
                    "description": "Shop powered by PrestaShop",
                    "keywords": "",
                    "robots": "index"
                },
                "page_name": "index",
                "body_classes": {
                    "lang-en": true,
                    "lang-rtl": false,
                    "country-GB": true,
                    "currency-GBP": true,
                    "layout-full-width": true,
                    "page-index": true,
                    "tax-display-enabled": true
                },
                "admin_notifications": []
            },
            "shop": {
                "name": "Prestashop_Savemart",
                "logo": "\/savemart\/img\/prestashopsavemart-logo-1531456858.jpg",
                "stores_icon": "\/savemart\/img\/logo_stores.png",
                "favicon": "\/savemart\/img\/favicon.ico"
            },
            "urls": {
                "base_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/",
                "current_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/?home=home_3",
                "shop_domain_url": "http:\/\/demo.bestprestashoptheme.com",
                "img_ps_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/",
                "img_cat_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/c\/",
                "img_lang_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/l\/",
                "img_prod_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/p\/",
                "img_manu_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/m\/",
                "img_sup_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/su\/",
                "img_ship_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/s\/",
                "img_store_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/st\/",
                "img_col_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/img\/co\/",
                "img_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/themes\/vinova_savemart\/assets\/img\/",
                "css_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/themes\/vinova_savemart\/assets\/css\/",
                "js_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/themes\/vinova_savemart\/assets\/js\/",
                "pic_url": "http:\/\/demo.bestprestashoptheme.com\/savemart\/upload\/",
                "pages": {
                    // "address": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/address",
                    // "addresses": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/addresses",
                    // "authentication": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/login",
                    // "cart": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/cart",
                    // "category": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=category",
                    // "cms": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=cms",
                    // "contact": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/contact-us",
                    // "discount": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/discount",
                    // "guest_tracking": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/guest-tracking",
                    // "history": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/order-history",
                    // "identity": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/identity",
                    // "index": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/",
                    // "my_account": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/my-account",
                    // "order_confirmation": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/order-confirmation",
                    // "order_detail": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=order-detail",
                    // "order_follow": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/order-follow",
                    // "order": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/order",
                    // "order_return": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=order-return",
                    // "order_slip": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/credit-slip",
                    // "pagenotfound": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/page-not-found",
                    // "password": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/password-recovery",
                    // "pdf_invoice": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=pdf-invoice",
                    // "pdf_order_return": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=pdf-order-return",
                    // "pdf_order_slip": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=pdf-order-slip",
                    // "prices_drop": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/prices-drop",
                    // "product": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/index.php?controller=product",
                    // "search": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/search",
                    // "sitemap": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/sitemap",
                    // "stores": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/stores",
                    // "supplier": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/supplier",
                    // "register": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/login?create_account=1",
                    // "order_login": "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/order?login=1"
                },


            },

            "field_required": [],


        };
        var psr_icon_color = "#F19D76";
        var search_url = "http:\/\/demo.bestprestashoptheme.com\/savemart\/en\/search";
    </script>


    <script type="text/javascript">
        var baseDir = "/savemart/";
        var static_token = "28add935523ef131c8432825597b9928";

    </script>




</head>



<body id="index"
    class=" {{ currentLocale() == 'ar' ? 'lang-ar lang-rtl' : 'lang-en' }}  country-gb currency-gbp layout-full-width page-index tax-display-enabled">



   <main id="main-site" class="displayhomenovone">







        <aside id="notifications">
            <div class="container">



            </div>
        </aside>

        <div id="wrapper-site">





            <div class="container no-index">
                <div class="row">
                    <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                        <div id="main">


                            <div class="page-header">
                                <h1 class="page-title hidden-xs-up">
                                    <div class="hidden-xs-up">
                                        The page you are looking for was not found.
                                    </div>
                                </h1>
                            </div>




                            <section id="content" class="page-content page-not-found row align-items-center">
                                <div class="content-404 col-lg-6 col-sm-6 text-center">
                                    <div class="image">
                                        <img class="img-fluid"
                                            src="{{asset('front')}}/img/image-02-404.png" alt="Image 404">
                                    </div>
                                    <p class="h4">We're sorry — something has gone wrong on our end.</p>
                                    <div class="info">
                                        <p>If difficulties persist, please contact the System Administrator of this site and
                                            report the error below.</p>
                                    </div>
                                    <a class="btn btn-default" href="{{route('front.home')}}"><i
                                            class="fa"></i><span>@lang('front.home')</span></a>


                                </div>
                                <div class="content-right-404 col-lg-6 col-sm-6">
                                    <a href="{{route('front.home')}}"><img class="img-fluid"
                                            src="{{asset('front')}}/img/image-404.jpg"
                                            alt="image 404 right"></a>
                                </div>
                            </section>



                            <footer class="page-footer">

                                <!-- Footer content -->

                            </footer>


                        </div>


                    </div>
                </div>
            </div>



        </div>

    </main>


<script type="text/javascript" src="{{ asset('front/themes/vinova_savemart/assets/cache/bottom-3c96ed23.js') }}">
</script>

</body>

</html>

