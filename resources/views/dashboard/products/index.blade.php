@extends('layouts.dashboard')


@php
$model_name = 'products';
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
                                <li class="breadcrumb-item active"> {{ $model_name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')

                {{-- -------------------test ----------------- --}}
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">{{ $model_name }} </h5>


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

                                        <table class="table table-striped table-bordered" id="tableProducts">
                                            {{-- <table class="table table-striped table-bordered dataex-html5-export" id="tableProducts"> --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>sku</th>
                                                    <th>Quantity</th>
                                                    <th>active</th>
                                                    <th>slug</th>
                                                    <th>created at</th>
                                                    <th class="noExport">attributes</th>
                                                    <th class="noExport">images</th>
                                                    <th class="noExport">action</th>

                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                {{-- ------------------------------------------- --}}

        </div>


    </div>



@endsection


{{-- @push('scripts')
    <script type="text/javascript" src="{{ asset('admin/js/printThis.js') }}"></script>
@endpush --}}

@section('js')

    {{-- ttttttsssss --}}


    <script>
        var urlftech = "{{ route('products.datatable.fetch') }}";
        var urlcreate = "{{ route('products.create') }}";
        var token = "{{ csrf_token() }}"
        var checkPermissionDelete = "{{ admin()->can('delete_product') }}";
        var checkPermissionUpdate = "{{ admin()->can('update_product') }}";
        var checkPermissionCreate = "{{ admin()->can('create_product') }}";


        var table = $('#tableProducts').DataTable({
            'responsive': true,
            'processing': true,
            'serverSide': true,
            "bServerSide": true,
            'serverMethod': 'get',
            'ajax': {
                'url': urlftech
            },
            dom: 'Bfrtip',
            buttons: [

                  {
                    extend: 'print',
                    exportOptions: { columns: "thead th:not(.noExport)" }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: { columns: "thead th:not(.noExport)" }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: { columns: "thead th:not(.noExport)" }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {  columns: "thead th:not(.noExport)"}
                },
                'pageLength',
                {
                    text: 'create <i class="la la-plus" style="font-size: 13px;"></i>',
                    enabled: checkPermissionCreate ?? false,
                    action: function(e, dt, node, config) {
                        window.location = urlcreate;
                    }

                }

            ],
            'columns': [
                { data: 'name',  },
                { data: 'sku'  },
                { data: 'quantity'  },
                { data: 'is_active',  name: 'active'},
                { data: 'slug'},
                { data: 'created_at',name:'created at'},
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var row_td = ` <a href="${row.link_attributes}" class="btn btn-outline-info btn-sm">  Attributes </a>`;
                        return row_td;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var row_td = ` <a href="${row.link_images}">  <i class="la la-image"></i> </a>`;
                        return row_td;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        var id = row.id;
                        return actionButtons(id);
                    }
                },



            ]
        });


        $(document).on('click', '#delete_row', function(e) {
            e.preventDefault();
            var row = $(this);
            var id = row.data('id');

            swal({
                title: "{{ __('front.are_you_sure') }}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6B6F82',
                cancelButtonText: "{{ __('front.cancel') }}",
                confirmButtonText: "{{ __('front.yes_delete') }}"
            }).then(function(result) {

                if (result.value == true) {

                    var url = "{{ route('products.index') }}/" + id;

                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            _token: token,
                        },

                        success: function(response) {

                            if (response.error == false) {

                                table.row(row.parents('tr')).remove().draw();

                                swal({
                                    title: response.message[0],
                                    type: "success",
                                    timer: 2000,
                                });

                            } else {

                                swal({
                                    title: '404 not found',
                                    type: "error",
                                    timer: 2000,
                                });

                            }



                        },
                        error: function(response) {



                        }
                    })


                }
            });


        });


        function actionButtons(id) {

            var ref = "{{ route('products.index') }}/" + id + '/edit';
            var button_delete = ``;
            var button_edit = ``;

            if (checkPermissionDelete) {
                button_delete =
                    `<i class="la la-trash text-danger" id="delete_row" data-id="${id}" style="cursor: pointer;"></i>`;
            }

            if (checkPermissionUpdate) {
                button_edit = `<a href="${ref}" >
                    <i class="la la-edit " id="row-${id}" data-id="${id}" ></i>
                     </a>`;
            }

            return `${button_edit}  ${button_delete}`;

        }
    </script>



    {{-- ------------------------ --}}




    <script>
        //-------------------------------------------------

        $("#select-serach-type").on('change', function() {
            $(this).attr('name', $(this).val());
        });


        //-------------------form submit search------------------

        $("#form-search").submit(function(e) {

            e.preventDefault();

            var type_search = $("#select-serach-type").val();
            var search = $(this).find('input[name="search"]').val();
            var url = $(this).attr('action') + "?" + type_search + "=" + search;

            window.location = url;

        })



        //-------------------------------------------------

        $(".printMe").click(function() {

            $('.tabel-print').printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: "{{ asset('css/print-this-style.css') }}",
                printDelay: 333, // variable print delay
                header: "<h4>Products</h4>", // prefix to html
                footer: null,
            });
        });
    </script>
@stop
