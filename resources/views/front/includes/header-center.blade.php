
<div class="header-center hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div id="_desktop_logo" class="contentsticky_logo d-flex align-items-center justify-content-start col-lg-3 col-md-3">
            <a href="{{route('front.home')}}">

                    <span class="text-uppercase" style="font-size: 30px;color:#0275d8">OSAHSTRORe</span>
                {{-- <img src="{{asset('front')}}//img/logo-footer.png" alt="logo" width="167" height="23"> --}}
                </a>
            </div>
            <div class="col-lg-9 col-md-9 header-menu d-flex align-items-center justify-content-end">
                <div class="data-contact d-flex align-items-center">
                    <div class="title-icon">support<i class="icon-support icon-address"></i></div>
                    <div class="content-data-contact">
                        <div class="support">Call customer services :</div>
                        <div class="phone-support">
                            01015357722
                        </div>
                    </div>
                </div>
                <div class="contentsticky_group d-flex justify-content-end">
                    <div class="header_link_myaccount">
                        <a class="login" href="login-1.html" rel="nofollow" title="Log in to your customer account"><i class="header-icon-account"></i></a>
                    </div>
                    <div class="header_link_wishlist">

                        @auth
                        <a href="{{route('mywishlist.index')}}" title="My Wishlists">
                            <i class="header-icon-wishlist"></i>
                        </a>
                        @else
                        <a href="{{route('login')}}" title="My Wishlists">
                            <i class="header-icon-wishlist"></i>
                        </a>

                        @endauth

                    </div>
                    <div id="_desktop_cart">
                        <div class="blockcart cart-preview active" >
                            <div class="header-cart">
                                <div class="cart-left">
                                    <div class="shopping-cart" onclick="window.location='{{route('cart.index')}}'">
                                        <a href="#" >
                                            <i class="zmdi zmdi-shopping-cart"></i>

                                        </a>
                                    </div>
                                    <div class="cart-products-count">{{get_cart_products_count()}}</div>
                                </div>
                                <div class="cart-right d-flex flex-column align-self-end ml-13">
                                    <span class="title-cart">Cart</span>
                                    <span class="cart-item"> items</span>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

