@extends('layouts.front')

@section('title')
    | {{$product->name}}
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
                        <a itemprop="item" href="" class="active ">
                            <span itemprop="name">{{$product->name}}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop

@section('content')

    <div class="no-index">
        <div id="content-wrapper">

            <section id="main" itemscope="" itemtype="">
                <meta itemprop="url"
                    content="">
                <div class="product-detail-top">
                    <div class="container">



                        <div class="row main-productdetail" data-product_layout_thumb="list_thumb"
                            style="position: relative;">
                            <div class="col-lg-5 col-md-4 col-xs-12 box-image">

                                <section class="page-content" id="content">


                                    {{-- ---------- images ------- --}}

                                    <div class="images-container list_thumb">

                                        <div class="product-cover">
                                            @if ($product->images->first())

                                                <img class="js-qv-product-cover img-fluid"
                                                    src="{{ $product->images->first()->name }}" alt=""
                                                    title="{{ $product->name }}" style="width:100%;" itemprop="image">

                                            @else

                                                <img class="img-fluid image-cover" src="{{ asset('/images/noImage.jpg') }}"
                                                    alt="" title="{{ $product->name }}" style="width:100%;"
                                                    itemprop="image">

                                            @endif


                                            <div class="layer hidden-sm-down" data-toggle="modal"
                                                data-target="#product-modal">
                                                <i class="fa fa-expand"></i>
                                            </div>
                                        </div>


                                        @if($product->images->count() > 0)

                                        <div class="js-qv-mask mask only-product">
                                            <div class="row">

                                                @foreach($product->images as $image)


                                                <div class="item thumb-container col-md-6 col-xs-12 pt-30">
                                                    <img class="img-fluid thumb js-thumb  @if($loop->first) 'selected' @endif "
                                                        src="{{$image->name}}"
                                                        alt="" title="{{$product->name}}" itemprop="image">
                                                </div>

                                                @endforeach



                                            </div>
                                        </div>

                                        @endif


                                    </div>



                                </section>

                            </div>

                            {{-- ---------------product information and buttons add cart,wishlist --}}

                            <div class="col-lg-7 col-md-8 col-xs-12 mt-sm-20">
                                <div class="product-information">
                                    <div class="product-actionss">

                                        <form action="{{ route('cart.add', [$product->slug, $product->attribute->id]) }}" method="post"
                                            id="form-add-to-cart" class="row">

                                            {{-- ---------------product reviews------------ --}}
                                            <div class="productdetail-right col-12 col-lg-6 col-md-6">
                                                <div class="product-reviews">
                                                    <div id="product_comments_block_extra">

                                                        <div class="comments_note">
                                                            <span>Review: </span>
                                                            <div class="star_content clearfix">
                                                                <div class="star star_on"></div>
                                                                <div class="star star_on"></div>
                                                                <div class="star star_on"></div>
                                                                <div class="star star_on"></div>
                                                                <div class="star star_on"></div>
                                                            </div>
                                                        </div>


                                                        <div class="comments_advices d-block">
                                                            <span  class="comments_advices_tab"><i
                                                                    class="fa fa-comments"></i>@lang('front.reviews') (2)
                                                            </span>

                                                                    @auth()


                                                                    <a class="open-comment-form" data-toggle="modal"
                                                                    data-target="#new_comment_form" href="#"><i
                                                                        class="fa fa-edit"></i>{{ucfirst(__('front.write_review'))}}
                                                                    </a>
                                                                    @else
                                                                    <a class=""
                                                                     href="{{route('login')}}"><i
                                                                        class="fa fa-edit"></i>{{ucfirst(__('front.write_review'))}}</a>

                                                                    @endauth

                                                        </div>
                                                    </div>


                                                    <!--  /Module NovProductComments -->

                                                </div>

                                                <h1 class="detail-product-name" itemprop="name">
                                                    {{$product->name}}
                                                </h1>



                                                <div class="group-price d-flex justify-content-start align-items-center">


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





                                                <div class="in_border end">

                                                    <div class="sku">
                                                        <label class="control-label">Sku:</label>
                                                        <span itemprop="sku" content="demo_6">{{$product->sku}}</span>
                                                    </div>

                                                    @if($product->categories->count() > 0)




                                                    <div class="pro-cate">
                                                        <label class="control-label ">@lang('front.categories'):</label>
                                                        <div>
                                                            @foreach($product->categories as $category)
                                                            <span>
                                                                {{-- add link to category here --}}
                                                                <a href="" title="{{$category->name}}">
                                                                    {{$category->name}}
                                                                </a>
                                                            </span>
                                                            @endforeach

                                                        </div>
                                                    </div>

                                                    @endif


                                                    @if($product->tags->count() > 0)


                                                    <div class="pro-tag">
                                                        <label class="control-label ">@lang('front.tags'):</label>
                                                        <div>

                                                           @foreach($product->tags as $tag)
                                                            <span>
                                                                {{-- add link to tag here --}}
                                                                <a href="" title="{{$tag->name}}">
                                                                    {{$tag->name}}
                                                                </a>
                                                            </span>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>


                                                <div id="_desktop_productcart_detail">
                                                    <div id="product-availability" class="info-stock ">
                                                        <label class="control-label">{{ ucfirst(__('front.availability')) }} : </label>

                                                        @if ($product->attribute->qty > 0)
                                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                        @else
                                                            <span class="text-danger">@lang('front.unavailable')</span>
                                                        @endif

                                                    </div>

                                                    <div class="product-add-to-cart in_border">
                                                        @if($product->attribute->qty > 0)


                                                        <div class="add">
                                                            <button class="btn btn-primary add-to-cart"
                                                                 type="submit">
                                                                <div class="icon-cart">
                                                                    <i class="shopping-cart"></i>
                                                                </div>
                                                                <span>@lang('front.add_to_cart')</span>
                                                            </button>
                                                        </div>

                                                        @endif


                                                        {{--  -add to wishlist ----------- --}}

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

                                                        <div class="clearfix"></div>



                                                        {{-- <p class="product-minimal-quantity mt-20">
                                                        </p> --}}

                                                    </div>
                                                </div>






                                            </div>

                                            <div class="productdetail-left col-12 col-lg-6 col-md-6">

                                                @if ($product->attribute->qty > 0)


                                                <div class="product-quantity">

                                                    <span class="control-label">@lang('front.qty') : </span>
                                                    <div class="qty">

                                                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{$product->attribute->qty}}"
                                                        style="min-width: 130px; border-radius: 23px;">

                                                    </div>
                                                </div>

                                                @endif




                                                @if($product->attributes->count() > 1)


                                                <div class="product-variants in_border">
                                                    <div class="product-variants-item">
                                                        <span class="control-label">@lang('front.other_options') : </span><br>
                                                        <select id="group_1" class="mt-4" onchange="location = this.value;">

                                                            @foreach($product->attributes as $product_attribute)
                                                              <option value="{{route('front.prouct.show',[$product->slug, $product_attribute->id])}}"
                                                                title="{{$product_attribute->name}}"
                                                                {{$product_attribute->id == $product->attribute->id ? 'selected' : ''}}
                                                                {{-- {{ !$product_attribute->qty > 0 ? 'disabled' : '' }} --}}
                                                                >

                                                                    {{$product_attribute->name}}
                                                            </option>


                                                            @endforeach



                                                        </select>
                                                    </div>

                                                </div>

                                                @endif





                                                <div id="_mobile_productcart_detail"></div>

                                                <div class="productbuttons">
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
                                                        <button class="btn btn-link" type="button" id="social-sharingButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span><i class="fa fa-share-alt" aria-hidden="true"></i>Share
                                                                With :</span>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="social-sharingButton">
                                                            <a class="dropdown-item"
                                                                href="http://www.facebook.com/sharer.php?u=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                                                title="Share" target="_blank"><i
                                                                    class="fa fa-facebook"></i>Facebook</a>
                                                            <a class="dropdown-item"
                                                                href="https://twitter.com/intent/tweet?text=Mauris molestie porttitor diam http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                                                title="Tweet" target="_blank"><i
                                                                    class="fa fa-twitter"></i>Tweet</a>
                                                            <a class="dropdown-item"
                                                                href="https://plus.google.com/share?url=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                                                title="Google+" target="_blank"><i
                                                                    class="fa fa-google-plus"></i>Google+</a>
                                                            <a class="dropdown-item"
                                                                href="http://www.pinterest.com/pin/create/button/?media=http://demo.bestprestashoptheme.com/savemart/34/the-best-is-yet-to-come-framed-poster.jpg&amp;url=http://demo.bestprestashoptheme.com/savemart/en/smartphone-tablet/3-the-best-is-yet-to-come-framed-poster.html"
                                                                title="Pinterest" target="_blank"><i
                                                                    class="fa fa-pinterest"></i>Pinterest</a>
                                                        </div>
                                                    </div>


                                                    <a class="btn btn-link" href="javascript:print();">
                                                        <span><i class="fa fa-print" aria-hidden="true"></i>Print</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- ------------------------ --}}



                @include('front.product.product-detail-middle',$product)
                @include('front.product.product-detail-bottom',$product)

                @include('front.product._product_images_modal',$product)


                @auth()
                @if($user_product_review)
                @include('front.product._update_comment_form',['product' => $product,'user_product_review' => $user_product_review])

                @else
                @include('front.product._new_comment_form',$product)

                @endif

                @endauth

                {{-- ------------------------ --}}





                <footer class="page-footer">

                    <!-- Footer content -->

                </footer>


            </section>


        </div>
    </div>





@stop


@section('scripts')


    @if (session()->has('success'))

        <script>
            swal({
                title: "{{ session('success') }}",
                type: "success",
                timer: 2000,
            });

        </script>

    @endif
    @if (session()->has('exception_error'))

        <script>
            swal({
                title: "{{ session('exception_error') }}",
                type: "error",
                timer: 3000,
            });

        </script>

    @endif

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


// -------------------modal review-------------------
//------------close modal form add review------------
        $(".close_modal_review").click(function(){

            $('#id_new_comment_form')[0].reset();
            $('#id_new_comment_form').find(".display-errors").empty().addClass('d-none');

        });


   //------delete review---------------

   $(document).on('click','#delete-review',function(e){

       e.preventDefault();


            var url = $(this).data('action');
            var token = "{{ csrf_token() }}";
            var product_id = "{{$product->id}}";


            swal({
                title: "{{__('front.are_you_sure')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6B6F82',
                cancelButtonText: "{{__('front.cancel')}}",
                confirmButtonText: "{{__('front.yes_delete')}}"
            }).then(function(result) {

                if (result.value == true) {

                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            _token: token,product_id : product_id
                        },
                        beforeSend: function() {

                        },
                        success: function(response) {

                            $('#new_comment_form').modal('hide');

                        //set timeout because the modal to fix background  e..e.
                            setTimeout(function(){
                                $('#new_comment_form').remove();

                                $('body').append(response.append_modal);

                                }, 1000);

                            swal({
                                title: 'succes delete',
                                type: "success",
                                timer: 1000,
                            });


                        },
                        error: function(response) {

                            swal({
                                title: '404 not found',
                                type: "error",
                                timer: 3000,
                            });

                        }
                    })


                }
            });



   });



   //------modal form update review---------------
   $(document).on('submit','#id_update_comment_form',function(e){

e.preventDefault();
var myform = $(this);
var url = $(this).attr('action');
var data = $(this).serialize();





$.ajax({
    url: url,
    method: 'put',
    data: data,
    beforeSend: function() {

        myform.find(".display-errors").empty();
        myform.find(".display-errors").addClass('d-none');

    },
    success: function(success) {

        $('#new_comment_form').modal('hide');

       //set timeout because the modal to fix background  e..e.
        setTimeout(function(){
             $('#new_comment_form').remove();
             $('body').append(success.append_modal);
            }, 1000);


        swal({
            title: "{{__('front.success_update_review')}}",
            type: "success",
            timer: 2000,
        });


    },
    error: function(getError) {
        if (getError.status == 422) {

            var arr = Object.values(getError.responseJSON.errors);
            myform.find(".display-errors").append('<p>' + arr[0] + '</p>');
            myform.find(".display-errors").removeClass('d-none');

        }

    }
});

});

   //------modal form add review------------------

        $(document).on('submit','#id_new_comment_form',function(e){


            e.preventDefault();
            var myform = $(this);
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                url: url,
                method: 'post',
                data: data,
                beforeSend: function() {

                    myform.find(".display-errors").empty();
                    myform.find(".display-errors").addClass('d-none');

                },
                success: function(success) {

                    $('#new_comment_form').modal('hide');

                   //set timeout because the modal to fix background  e..e.
                    setTimeout(function(){
                         $('#new_comment_form').remove();
                         $('body').append(success.append_modal);
                        }, 1000);


                    swal({
                        title: "{{__('front.success_add_review')}}",
                        type: "success",
                        timer: 2000,
                    });


                },
                error: function(getError) {
                    if (getError.status == 422) {

                        var arr = Object.values(getError.responseJSON.errors);
                        myform.find(".display-errors").append('<p>' + arr[0] + '</p>');
                        myform.find(".display-errors").removeClass('d-none');

                    }

                }
            });

        });
        // ---------------------------------------------------------
        //------------------ add product to cart--------------------

        $(document).on('submit', '#form-add-to-cart', function(e) {
            e.preventDefault();
             var url = $(this).attr('action');
             var quantity = $(this).find('input[name="quantity"]').val();





            $.ajax({
                method: 'post',
                url,
                data:{'quantity' : quantity},
                success: function(response) {

                    if (response.cart_products_count && parseInt(response.cart_products_count) > 0) {
                        $(".cart-products-count").text(response.cart_products_count);

                    }


                    swal({
                        title: "{{ __('front.success_add_product') }}",
                        type: "success",
                        timer: 2000,
                    });
                    //---- fetch get count products to change icon cart add total products count
                },
                error: function(error) {
                    // console.log(error);
                }
            });

        });

    </script>



@stop
