@extends('layouts.front')

@section('slider')

    @isset($slider_images)

        @if ($slider_images->count() > 0)
            {{-- @include('front.includes.slider',$slider_images) --}}

        @endif

    @endisset

@stop

@section('content')

    <div id="main">

        <section id="content" class="page-home pagehome-three">
            <div class="container">
                <div class="row">



                    {{-- ------ section first banner --}}
                    {{-- @include('front.home._first_banner') --}}
                    {{-- ------------------------- --}}


                    {{-- ------ section new and flash deals --}}
                    {{-- @include('front.home._new_flash') --}}
                    {{-- ------------------------- --}}



                    {{-- ------ section seconde banner --}}

                    {{-- @include('front.home._seconde_banner') --}}


                    {{-- ------------------------- --}}


                    {{-- ------ section trending now and best saller
                    --}}

                    {{-- @include('front.home._trending_best_seller') --}}

                    {{-- ------------------------- --}}


                    <div class="nov-row policy-home col-lg-12 col-xs-12">
                        <div class="nov-row-wrap row">
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-1"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Free Delivery From $ 250</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-2"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Money Back Guarantee</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                    natus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-3"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Authenticity 100% guaranteed</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                    natus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- ------ section bottom sho 3categories with his products
                    --}}

                    @include('front.home._bottom_category_wis_his_products')


                    {{-- ------------------------- --}}



                </div>
            </div>
        </section>


    </div>


@stop



@section('scripts')
    <script>

// mywishlist.store

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //---------------------------------------------------------------



        //------------------ add product to cart--------------------

        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            var url = $(this).data('add-cart');

            $.ajax({
                method: 'post',
                url,
                success: function(response) {

                    if(response.cart_products_count && parseInt(response.cart_products_count) > 0){
                       $(".cart-products-count").text(response.cart_products_count);

                    }


                    swal({
                        title: '{{ __("front.success_add_product") }}',
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


        //-----------------get modal ajax to show product details-----------

        $(document).on('click', '.quick-view', function(e) {

            e.preventDefault();

            // var product_miniature = $(this).closest('.product-miniature');
            // var product_id = product_miniature.data('id-product');
            // var product_attribute_id = product_miniature.data('id-product-attribute');

            var url = $(this).data('url');

            $.ajax({
                method: 'post',
                url,
                success: function(response) {
                    $('body').append(response.quickview_modal);
                },
                error: function(error) {
                    // console.log(error);
                }
            });


        });

        //----------------------select attribute -------------------

        $(document).on('change', '.select_attibute', function() {
            var product_slug = $(this).data('product-slug');
            var product_attribute_id = this.value;


            var url = '/{{ localeLanguage() }}/product-details/' + product_slug + '/' + product_attribute_id;



            $.ajax({
                method: 'post',
                url,
                success: function(response) {
                    $('.quickview').remove();
                    $('body').append(response.quickview_modal);
                },
                error: function(error) {
                    //console.log(error);
                }
            });

        })

        //-----------------close modal--------------

        $(document).on('click', '.close', function() {
            $(this).closest('.quickview').remove();
        });

    </script>

@stop
