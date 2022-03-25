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



                @if (admin()->hasAnyPermission(['read_slider', 'create_slider']))
                    {{-- ----------------show images with gallery --}}

                    @include(
                        'dashboard.settings.home_page_slider._fetch_images'
                    )
                @endif
                {{-- ------------------------------------------ --}}
                {{-- ------------------------------------------ --}}

                {{-- ------------section upload images----------- --}}

                @if (admin()->can('create_slider'))
                    <section id="dom">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title ">
                                            Upload images
                                        </h4>


                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
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
                @endif

            </div>
        </div>

    </div>



@endsection


@section('js')
    <script>
        var url = "{{ route('admin.homepage_slider.store') }}";

        var check_permission_delete = "{{ admin()->can('delete_slider') }}" ? true : false;


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

                var append_image_swiper = ` <figure class="col-lg-3 col-md-6 col-12 image-section-galary-${response.data.id}"   itemprop="associatedMedia" itemscope itemtype="">

                            <a href="${response.data.image_url}" itemprop="contentUrl" data-size="700x560">
                            <img class="img-thumbnail img-fluid" src="${response.data.image_url}"
                            itemprop="thumbnail" alt="Image description" style="height: 200px !important" />
                            </a>

                            </figure>`;

                var button_delete = '';
                if (check_permission_delete) {
                    button_delete = `  <div class="">
                        <button id="delete-image" data-id="${response.data.id}"
                        data-action="${response.data.image_delete_url}"
                        class="btn btn-danger  btn-sm "
                        style="margin-top: 3px;padding: 1px;"><i
                            class="la la-trash"></i></button>

                        </div>`;
                }

                var append_image = `<div class="col-md-3 mb-1 image-section-${response.data.id}">
                        <img src="${response.data.image_url}" width="90" height="100"
                        alt="">
                          ${button_delete}
                        <hr>
                        </div>`;

                $(".my-gallery-row").append(append_image_swiper);
                $(".show-images-row").append(append_image);


                file.previewElement.remove();

            },
            error: function(file, response, xhr) {

                if (typeof(xhr) !== 'undefined' && typeof(xhr.status) !== 'undefined' && xhr.status == 422) {

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

        //----------delete image-----------------------

        $(document).on('click', '#delete-image', function() {
            var url = $(this).data('action');
            var token = "{{ csrf_token() }}";
            var image_id = $(this).data('id');
            var that = $(this);


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

                            // fetch();
                            $(document).find(".image-section-" + image_id).remove();
                            $(document).find(".image-section-galary-" + image_id).remove();

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
    </script>
@stop
