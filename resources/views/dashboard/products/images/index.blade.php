@extends('layouts.dashboard')


@php
$model_name = 'product-images';
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
                                <li class="breadcrumb-item active"> images
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">
                                        {{ $model_name }}
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

                                        <!-- /resources/views/post/create.blade.php -->

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <!-- Create Post Form -->



                                        <div class="mb-2">
                                            <p class="card-text float-left">Upload images</p>

                                            <div class="float-right">
                                                <form id="form-images"
                                                    action="{{ route('product.images.store_database', $product->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-xs">Save
                                                        Images</button>
                                                </form>


                                            </div>

                                            <div class="clearfix"></div>


                                        </div>



                                        <form action="#" class="dropzone dropzone-area dz-clickable"
                                            id="dpz-multiple-files">
                                            <div class="dz-message">Drop Files Here To Upload</div>
                                        </form>








                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">
                                        images
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

                                        <p class="card-text "> images</p>

                                        <div class="show-images">

                                            @include('dashboard.products.images._fetch_images')

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



@endsection


@section('js')
    <script>
        // fetch();


        var url = "{{ route('product.images.store', $product->id) }}";

        var uploadedDocumentMap = {}
        Dropzone.options.dpzMultipleFiles = {
            url: url,
            maxFilesize: 2, // MB
            // maxFiles: 2, // MB
            addRemoveLinks: true,
            paramName: 'image',
            acceptedFiles: ".jpeg,.jpg,.png",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {

                //this.removeAllFiles();

                $('#form-images').append('<input type="hidden" data-name="' + response.original_name +
                    '" name="images[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            error: function(file, response) {


                swal({
                    title: response.errors.image[0],
                    type: "error",
                    timer: 6000,
                });

            },

            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.name !== 'undefined') {
                    name = file.name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('#form-images').find('input[name="images[]"][data-name="' + name + '"]').remove()
            },

            init: function() {

            }



        }


        //----------delete image-----------------------

        $(document).on('click', '#delete-image', function() {
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

                            fetch();

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

        function fetch() {
            var url = "{{route('product.images.fetch',$product->id)}}";
            var div_images = $('.show-images'); // to append images to parrent element
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
                            $('.show-images').html(response.images);
                            console.log(response);

                        },
                        error: function(response) {
                        }
                    })


        }

    </script>
@stop
