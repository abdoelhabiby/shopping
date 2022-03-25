@extends('layouts.front')


@section('title')
    | {{ __('front.search') }}
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



                    {{-- <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item"
                            href="">
                            <span itemprop="name">
                               {{ request()->has('q') ? request()->get('q') : }}
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li> --}}

                </ol>

            </div>
        </div>
    </nav>

@stop


@section('content')





    <div id="main">







        <section id="content" class="page-home pagehome-three">
            <div class="container">


                {{-- check if  category has products --}}
                @if ($products->count() > 0)

                    {{-- start forecah products --}}


                    <div id="jmarketplace-sellernews">
                        <div class="product_list grid row jmarketplace-products">




                            @foreach ($products as $key => $product)
                                <div class="item col-12 col-sm-6 col-md-4 col-lg-3">


                                    @include('front.includes.section_product',$product)
                                </div>

                            @endforeach



                        </div>
                    </div>





                    <div class="d-flex justify-content-center mb-14 ">

                        {{ $products->appends(request()->query())->links() }}

                    </div>

                 @else

                 <div class="card w-50 p-4 mb-5 m-auto text-center">

                    <div class="card-body">
                      <h5 class="card-title">{{ __('front.no_search_for')  .' ' . request()->q}}</h5>
                      <p class="card-text">
                        {{ __('front.message_for_better_search') }}
                        </p>
                      <a href="{{ route('home') }}" class="btn btn-primary">{{ __('front.home') }}</a>
                    </div>
                  </div>

                @endif
                {{-- end check if  category has products --}}




            </div>
        </section>







    </div>


@stop




@section('scripts')

    @if (session()->has('success'))

        <script>
            swal({
                title: "{{ session('success') }}",
                type: "success",
                timer: 3000,
            });
        </script>

    @endif
    @if (session()->has('error'))

        <script>
            swal({
                title: "{{ session('error') }}",
                type: "error",
                timer: 3000,
            });
        </script>

    @endif


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

                    if (response.cart_products_count && parseInt(response.cart_products_count) > 0) {
                        $(".cart-products-count").text(response.cart_products_count);

                    }


                    swal({
                        title: '{{ __('front.success_add_product') }}',
                        type: "success",
                        timer: 2000,
                    });

                },
                error: function(error) {
                    // console.log(error);
                }
            });

        });


        //-----------------get modal ajax to show product details-----------

        $(document).on('click', '.quick-view', function(e) {

            e.preventDefault();


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