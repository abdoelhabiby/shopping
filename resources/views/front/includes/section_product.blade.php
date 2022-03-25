@if($product)

<div class="product-miniature js-product-miniature item-one first_item "
data-id-product="{{ $product->id }}"
data-id-product-attribute="{{ $product->attribute->id }}" itemscope=""
itemtype="">



<div class="thumbnail-container d-flex ">



    <a href="{{route('front.prouct.show',[$product->slug, $product->attribute->id])}}"
        class="thumbnail product-thumbnail {{ $product->images->count() > 1 ? 'two-image' : '' }}">



        {{-- ------------
        --}}

        @if ($product->images->count() > 0)
            @foreach ($product->images as $index => $image)

                @if ($index == 0 && fileExist($image->name))
                    <img class="img-fluid image-cover w-100"
                        src="{{ asset($image->name) }}" alt="" style="height: 250px"
                        title="{{ $product->name }}" >
                @elseif($index == 1 && fileExist($image->name))

                    <img class="img-fluid image-secondary w-100"
                        src="{{ asset($image->name) }}" alt=""  style="height: 250px"
                        title="{{ $product->name }}" >
                @else
                    @break
                @endif
            @endforeach

        @else

            <img class="img-fluid image-cover w-100"
                src="{{ getLinkImageNoImage() }}" alt=""  style="height: 250px">

        @endif
        {{-- ------------
        --}}



    </a>


    {{-- check if has offer
    --}}

    @if ($product->attribute->hasOffer)
        <div class="product-flags discount">@Lang('front.offer')
        </div>
    @endif


</div>

<div class="product-description">

    <div class="product-groups">




        <div class="category-title">
            <a href="{{route('front.prouct.show',[$product->slug, $product->attribute->id])}}">product
                name
            </a>
        </div>

        <div class="product-comments">

            {{-- --- helper function tooo append stars --}}
            @php
            $stars =  $product->reviewsRating->first() ? $product->reviewsRating->first()->stars :  0;
            echo hundelProductReviewsStars($stars);
        @endphp



        </div>

        @if($product->vendor)
        <p class="seller_name">
            <a title="View seller profile"
                href="{{ route('front.seller.products', $product->vendor->id) }}">
                <i class="fa fa-user"></i>
                {{ $product->vendor ? $product->vendor->name : '' }}
            </a>
        </p>

        @endif



        <div class="product-title" itemprop="name"><a href="{{route('front.prouct.show',[$product->slug, $product->attribute->id])}}">
                {{ $product->name }}
            </a></div>

        <div class="product-group-price">

            <div class="product-price-and-shipping">

                @if ($product->attribute->hasOffer)

                    <span itemprop="price"
                        class="price">{{ $product->attribute->price_offer }}
                        @lang('front.egp')</span>

                    <span class="regular-price">{{ $product->attribute->price }}
                        @lang('front.egp')</span>
                @else

                    <span itemprop="price"
                        class="price">{{ $product->attribute->price }}
                        @lang('front.egp')</span>

                @endif
            </div>

        </div>

    </div>
    <div class="product-buttons d-flex justify-content-center">

        @if ($product->attribute->qty > 0)
            <form action="" method="post" class="formAddToCart">
                @csrf
                <a class="add-to-cart" href="#"
                    data-add-cart="{{ route('cart.add', [$product->slug, $product->attribute->id]) }}">
                    <i class="novicon-cart"></i>
                    <span>Add to cart</span>
                </a>
            </form>

        @endif


        {{-- --------add to wish list --}}

        @auth()
        <a class="addToWishlist add_to_wislist" href="{{route('mywishlist.store',[$product->slug])}}">
            <i class="fa fa-heart"></i>
            <span>Add to Wishlist</span>
        </a>
        @else

        <a class="addToWishlist " href="{{route('login')}}">
            <i class="fa fa-heart"></i>
            <span>Add to Wishlist</span>
        </a>


        @endauth



        {{-- show details
        --}}

        <a href="#" class="quick-view hidden-sm-down"
            data-product-id="{{ $product->id }}"
            data-url="{{ route('get-product-details-modal', [$product->slug, $product->attribute->id]) }}">
            <i class="fa fa-search"></i><span> Quick view</span>
        </a>




    </div>

</div>
</div>

@endif
