@extends('layouts.dashboard')





@section('title')
    | settings | home page slider
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

                                <li class="breadcrumb-item active"> settings
                                </li>
                                <li class="breadcrumb-item active"> home page slider
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
                                        home page slider
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
                                                <button type="submit" id="applay_changes" class="btn btn-primary btn-xs">
                                                    Apllay Changes
                                                </button>

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


                                        <div class="show-images">

                                            @include(
                                                'dashboard.settings.home_page_slider._fetch_images'
                                            )

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
        $(document).on('click', '#applay_changes', function(e) {
            e.preventDefault();
            Dropzone.forElement('#dpz-multiple-files').removeAllFiles(true);
            fetch();
        });


        var url = "{{ route('admin.homepage_slider.store') }}";

        var uploadedDocumentMap = {}
        Dropzone.options.dpzMultipleFiles = {
            url: url,
            maxFilesize: 2, // MB
            // maxFiles: 2, // MB
            addRemoveLinks: true,
            paramName: 'image',
            acceptedFiles: ".jpeg,.jpg,.png",
            //   dictRemoveFile: "Remove file",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {

                //this.removeAllFiles();  // if i want use real time
                fetch();

            },
            error: function(file, response, xhr) {

                if (xhr && xhr.status == 422) {
                    swal({
                        title: response.errors.image[0],
                        type: "error",
                        timer: 6000,
                    });
                }



                if ( typeof(response.errors) != "undefined" && response.errors !== null) {
                    swal({
                        title: response.errors.image[0],
                        type: "error",
                        timer: 6000,
                    });

                }




            },

            removedfile: function(file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.name !== 'undefined') {
                    name = file.name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }

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
            var url = "{{ route('admin.homepage_slider.fetch') }}";
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


                },
                error: function(response) {}
            })


        }
    </script>
@stop
