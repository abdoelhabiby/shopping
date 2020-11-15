@extends('layouts.dashboard')


@php
$model_name = 'product attributes';
@endphp


@section('title')
    | dashboard | {{ $model_name }}
@endsection

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">products</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{ $product->slug }}</a>
                                </li>
                                <li class="breadcrumb-item active"> attributes
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">



                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')


                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">
                                        {{ $product->slug }}
                                    </h4>


                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>

                                        </ul>


                                    </div>

                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="card-text row">
                                            <div class="col-md-6">
                                                <h5>Sku :
                                                    <small><i>{{ $product->sku }}</i></small>
                                                </h5>
                                                <h5>Name :
                                                    <small><i>{{ $product->name }}</i></small>
                                                </h5>
                                            </div>

                                            <div class="col-md-6">
                                                @if ($product->firstImage())
                                                    <img src="{{ asset($product->firstImage()->name) }}" width="270"
                                                        height="300" alt="">

                                                @endif
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




                <!-- -------- include form create------------ -->
                @include('dashboard.products.attributes._create')

                <!-- -------- include fetch attribute------------ -->


                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">
                                        attributes
                                    </h4>


                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">

                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>

                                        </ul>


                                    </div>

                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <p class="card-text "> All Attributes</p>

                                        <button class="btn btn-primary  printMe mb-2">Print <i
                                                class="la la-print"></i></button>
                                        <button class="btn btn-info  refresh mb-2">Refresh <i
                                                class="la la-spinner "></i></button>

                                        <div class="show-attributes col-12">


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>






            </div>
        </div>

    </div>

    </div>



@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('admin/js/printThis.js') }}"></script>

@endpush

@section('js')
    <script>
        fetchAttribute(); // mounted fetch get attribute


        //---------------------print attributes----------------
        $(".printMe").click(function() {

            $('.tabel-print').printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: "{{ asset('css/print-this-style.css') }}",
                printDelay: 333, // variable print delay
                header: "<h4>Product {{ $product->slug }} attribute</h4>", // prefix to html
                footer: null,
            });
        });

        //-----------------update attribute----------------

        // $('#form-update').submit(function(e) {
        $(document).on('click', '#form-update', function(e) {

            e.preventDefault();

            var myform = $(this).closest('form');
            var url = myform.attr('action');
            var data = myform.serialize();

            $.ajax({
                url: url,
                method: 'post',
                data: data,
                beforeSend: function() {

                    myform.find(".display-errors").empty();
                    myform.find(".display-errors").addClass('d-none');

                },
                success: function(success) {

                    $('.modal').modal('hide');

                    setTimeout(function() {
                        fetchAttribute();
                    }, 1000);


                    swal({
                        title: 'succes create update',
                        type: "success",
                        timer: 2000,
                    });


                },
                error: function(getError) {
                    if (getError.status == 422) {
                        var arr = Object.values(getError.responseJSON.errors);
                        myform.find(".display-errors").removeClass('d-none');
                        myform.find(".display-errors").append('<p>' + arr[0] + '</p>');

                        //console.log(arr[0]);

                    }

                    console.log(getError);
                }
            });


        });


        //-------------refresh table-------------

        $(document).on('click', '.refresh', function() {

            $(this).find('.la-spinner').addClass('spinner');
            fetchAttribute();
            $(this).find('.la-spinner').removeClass('spinner');
        })



        //----------delete attribute-----------------------

        $(document).on('click', '#delete-attribute', function() {
            var url = $(this).data('action');
            var token = "{{ csrf_token() }}";


            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6B6F82',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {

                if (result.value == true) {

                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            _token: token
                        },
                        beforeSend: function() {

                        },
                        success: function(response) {

                            fetchAttribute();

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

        //------------ fetch images----------------------

        function fetchAttribute() {

            var url = "{{ route('product.attibutes.fetch_attribute', $product->slug) }}";
            var div_attributes = $('.show-attributes'); // to append images to parrent element
            var token = "{{ csrf_token() }}";


            $.ajax({
                url: url,
                method: 'get',
                data: {
                    _token: token
                },
                beforeSend: function() {

                },
                success: function(response) {

                    div_attributes.html(response.attributes);


                },
                error: function(response) {}
            })


        }

    </script>

    @yield('create_attribute_js')
@stop
