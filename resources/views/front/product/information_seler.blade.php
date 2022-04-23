<div class="productbuttons">
    <div class="tabs">
        <h4 class="buttons_bottom_block">
            {{ __('front.information_seller') }}
        </h4>
        <div class="seller_info">
            <span class="seller_name">
                {{ $product->vendor->name }}

            </span>
            <div class="average_rating">
                {{-- <a href="http://demo.bestprestashoptheme.com/savemart/en/jmarketplace/2_taylor-jonson/comments"
                    title="View comments about Taylor Jonson">  </a> --}}





                    <div class="star star_on"></div>
                    <div class="star star_on"></div>
                    <div class="star star_on"></div>
                    <div class="star star_on"></div>
                    <div class="star"></div>
                    <br>



            </div>
        </div>
        <div class="seller_links">

            {{-- <p class="link_seller_profile">
                <a title="View seller profile"
                    href="">
                    <i class="icon-user fa fa-user"></i>
                    View seller profile
                </a>
            </p> --}}

            {{-- <p class="link_contact_seller">
                <a title="Contact seller"
                    href="">
                    <i class="fa fa-comment"></i>
                    Contact seller
                </a>
            </p> --}}
            {{-- <p class="link_seller_favorite">
                <a title="Add to favorite seller"
                    href="">
                    <i class="icon-heart fa fa-heart"></i>
                    Add to favorite seller
                </a>
            </p> --}}
            <p class="link_seller_products">
                <a title=" {{ __('front.more_seller_products') }}"
                    href="{{ route('front.seller.products',$product->vendor->id) }}">
                    <i class="icon-list fa fa-list"></i>
                    {{ __('front.more_seller_products') }}

                </a>
            </p>
        </div>
    </div>
    <script type="text/javascript">
        var PS_REWRITING_SETTINGS = "1";
    </script>


    <div class="dropdown social-sharing">
        <button class="btn btn-link" type="button"
            id="social-sharingButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share
                With :</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="social-sharingButton">
            <a class="dropdown-item"
                href="http://www.facebook.com/sharer.php?u="
                title="Share" target="_blank"><i
                    class="fa fa-facebook"></i>Facebook</a>
            <a class="dropdown-item"
                href="https://twitter.com/intent/tweet?text=Mauris molestie porttitor diam "
                title="Tweet" target="_blank"><i
                    class="fa fa-twitter"></i>Tweet</a>
            <a class="dropdown-item"
                href="https://plus.google.com/share?url="
                title="Google+" target="_blank"><i
                    class="fa fa-google-plus"></i>Google+</a>

        </div>
    </div>


    <a class="btn btn-link" href="javascript:print();">
        <span><i class="fa fa-print" aria-hidden="true"></i>Print</span>
    </a>
</div>
