<div id="quickview-modal-{{ $product->id }}-{{ $product->attribute->id }}" class="modal fade quickview in" tabindex="-1"
    role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="material-icons close">close</i></button>
            </div>
            <div class="modal-body">

                <div class="row no-gutters">
                    <div class="col-md-5 col-sm-5 divide-right">

                        <div class="images-container bottom_thumb">

                            <div class="product-cover">

                                    <img class="js-qv-product-cover img-fluid" src="{{$product->image ? asset($product->image->name) : pathNoImage() }}"
                                        alt="" title="{{ $product->name }}" style="width:100%;" itemprop="image">


                                <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                    <i class="fa fa-expand"></i>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-7 col-sm-7">
                        <h1 class="product-name">{{ $product->name }}</h1>

                        <div class="product-prices">


                            <div class="product-price " itemprop="offers">


                                <div class="current-price">

                                    @if ($product->attribute->hasOffer)

                                        <span itemprop="price" class="price">{{ $product->attribute->price_offer }}
                                            @lang('front.egp')</span>

                                        <span class="regular-price">{{ $product->attribute->price }}
                                            @lang('front.egp')</span>
                                    @else

                                        <span itemprop="price" class="price">{{ $product->attribute->price }}
                                            @lang('front.egp')</span>

                                    @endif

                                </div>



                            </div>



                            <div class="tax-shipping-delivery-label">
                                Tax included
                            </div>
                        </div>


                        <div id="product-description-short" itemprop="description">
                            <p>{{ stringLength($product->description, 200) }}</p>
                        </div>


                        <div class="product-actions">


                            <div class="product-variants in_border">

                                @if ($product->attributes->count() > 1)

                                    <div class="product-variants-item">
                                        <span class="control-label">@lang('front.other_options') : </span>
                                        <select id="" class="select_attibute" data-product-slug="{{ $product->slug }}"
                                            name="select_attibute">
                                            @foreach ($product->attributes as $product_attribute)
                                                <option value="{{ $product_attribute->id }}"
                                                    title="{{ $product_attribute->name }}"
                                                    {{ $product_attribute->id == $product->attribute->id ? 'selected' : '' }}
                                                    {{ !$product_attribute->qty > 0 ? 'disabled' : '' }}>
                                                    {{ $product_attribute->name }}
                                                </option>

                                            @endforeach

                                        </select>
                                    </div>

                                @endif


                                <div id="product-availability" class="info-stock ">
                                    <label class="control-label">{{ ucfirst(__('front.availability')) }} : </label>

                                    @if ($product->attribute->qty > 0)
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                    @else
                                        <span class="text-danger">@lang('front.unavailable')</span>
                                    @endif

                                </div>

                            </div>







                            <div class="product-add-to-cart in_border">

                                @if ($product->attribute->qty > 0)
                                    <div class="add">
                                        <button class="btn btn-primary add-to-cart add-product-to-cart"
                                            data-add-cart="{{ route('cart.add', [$product->slug, $product->attribute->id]) }}">
                                            <div class="icon-cart">
                                                <i class="shopping-cart"></i>
                                            </div>
                                            <span>{{ __('front.add_to_cart') }}</span>
                                        </button>
                                    </div>

                                @endif

                                @auth()
                                    <a class="addToWishlist add_to_wislist"
                                        href="{{ route('mywishlist.store', [$product->slug]) }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ __('front.add_to_wishlist') }}</span>
                                    </a>
                                @else

                                    <a class="addToWishlist " href="{{ route('login') }}">
                                        <i class="fa fa-heart"></i>
                                        <span>{{ __('front.add_to_wishlist') }}</span>
                                    </a>


                                @endauth

                                <div class="clearfix"></div>




                                <p class="product-minimal-quantity mt-20">
                                </p>

                            </div>



                        </div>

                        <div class="tabs">
                            <h4 class="buttons_bottom_block">
                                Information of seller
                            </h4>
                            <div class="seller_info">
                                <span class="seller_name">
                                    Taylor Jonson
                                </span>
                                <div class="average_rating">
                                    <a href="http://demo.bestprestashoptheme.com/savemart/en/jmarketplace/2_taylor-jonson/comments"
                                        title="View comments about Taylor Jonson">
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        (0)
                                    </a>
                                </div>
                            </div>
                            <div class="seller_links">
                                <p class="link_seller_profile">
                                    <a title="View seller profile"
                                        href="http://demo.bestprestashoptheme.com/savemart/en/jmarketplace/2_taylor-jonson/">
                                        <i class="icon-user fa fa-user"></i>
                                        View seller profile
                                    </a>
                                </p>
                                <p class="link_contact_seller">
                                    <a title="Contact seller"
                                        href="http://demo.bestprestashoptheme.com/savemart/en/module/jmarketplace/contactseller?id_seller=2&amp;id_product=3">
                                        <i class="fa fa-comment"></i>
                                        Contact seller
                                    </a>
                                </p>
                                <p class="link_seller_favorite">
                                    <a title="Add to favorite seller"
                                        href="http://demo.bestprestashoptheme.com/savemart/en/module/jmarketplace/favoriteseller?id_seller=2&amp;id_product=3">
                                        <i class="icon-heart fa fa-heart"></i>
                                        Add to favorite seller
                                    </a>
                                </p>
                                <p class="link_seller_products">
                                    <a title="View more products of this seller"
                                        href="http://demo.bestprestashoptheme.com/savemart/en/jmarketplace/2_taylor-jonson/products">
                                        <i class="icon-list fa fa-list"></i>
                                        View more products of this seller
                                    </a>
                                </p>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var PS_REWRITING_SETTINGS = "1";

                        </script>


                        <div class="dropdown social-sharing">
                            <button class="btn btn-link" type="button" id="social-sharingButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share With :</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="social-sharingButton">
                                <a class="dropdown-item"
                                    href="http://www.facebook.com/sharer.php?u=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                    title="Share" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>
                                <a class="dropdown-item"
                                    href="https://twitter.com/intent/tweet?text=Mauris molestie porttitor diam http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                    title="Tweet" target="_blank"><i class="fa fa-twitter"></i>Tweet</a>
                                <a class="dropdown-item"
                                    href="https://plus.google.com/share?url=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                    title="Google+" target="_blank"><i class="fa fa-google-plus"></i>Google+</a>
                                <a class="dropdown-item"
                                    href="http://www.pinterest.com/pin/create/button/?media=http://demo.bestprestashoptheme.com/savemart/34/the-best-is-yet-to-come-framed-poster.jpg&amp;url=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                    title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i>Pinterest</a>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
