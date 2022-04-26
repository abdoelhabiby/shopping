@extends('layouts.dashboard')


@php
$model_name = 'notifications';
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


                                        <table class="table table-striped table-bordered" id="tableNotifications">
                                            {{-- <table class="table table-striped table-bordered dataex-html5-export" id="tableProducts"> --}}
                                            <thead>
                                                <tr>
                                                    <th>title</th>
                                                    <th>body</th>
                                                    <th>created at</th>
                                                    <th>read at</th>
                                                    <th class="noExport">Action</th>

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
    </div>



@endsection




@section('js')

    {{-- ttttttsssss --}}


    <script>
        $(function() {






            var urlftech = "{{ route('dashboard.notifications.fetchDatatable') }}";
            var token = "{{ csrf_token() }}";

            var table = $('#tableNotifications').DataTable({
                'responsive': true,
                'processing': true,
                'serverSide': true,
                "bServerSide": true,
                searching: false,
                ordering: false,
                'serverMethod': 'get',
                'ajax': {
                    'url': urlftech
                },
                dom: 'Bfrtip',

                buttons: [

                    'pageLength',

                    {
                        text: "<span>Refresh</span>",
                        className: 'btn btn-info ml-1',
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        }
                    },
                    {
                        text: 'make all read',
                        className: 'makeAllRead ml-1 btn btn-primary',
                    },

                ],
                'columns': [{
                        data: 'title',
                        orderable: false,
                    },
                    {
                        data: 'message',
                        orderable: false,

                    },
                    {
                        data: 'created_at',
                        name: 'created at'
                    },
                    {
                        data: 'read_at',
                        name: 'read at',
                        render: function(data, type, row) {

                            if (row.read_at == null) {
                                return `<button type="button" data-rwo-id="${row.id}" class="btn btn-info btn-sm round btn-min-width mr-1 mb-1 makeAsRead">make read</button>`;
                            }

                            return row.read_at;

                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var id = row.id;
                            var show_url = row.url;
                            return actionButtons(id, show_url);
                        }
                    },



                ],
                "drawCallback": function(settings) {
                    // Here the response
                    var response = settings.json;
                    var unreadcount = response.unreadcount;

                    $("#show_notification_count").text(unreadcount);

                    if (!unreadcount > 0) {
                        table.buttons('.makeAllRead').disable()
                    }


                },
            });


            $(document).on('click', '#delete_row', function(e) {
                e.preventDefault();
                var row = $(this);
                var row_id = row.data('id');

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

                        var url_delete =
                            '{{ route('dashboard.notifications.delete', ':id') }}';
                        url_delete = url_delete.replace(':id', row_id);

                        $.ajax({
                            url: url_delete,
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
                                        position: 'top-end',
                                        toast: true,

                                    });



                                } else {

                                    var message = response.message[0];

                                    swal({
                                        title: message ? message : 'not found',
                                        type: "error",
                                        timer: 2000,
                                        position: 'top-end',
                                        toast: true,
                                    });
                                }
                            },

                        })
                    } // endif
                });


            });


            function actionButtons(id, show_url) {


                button_delete =
                    `<i class="la la-trash text-danger" id="delete_row" data-id="${id}" style="cursor: pointer;"></i>`;
                button_show = `<a href="${show_url}"> <i class="la la-eye "></i></a>`;

                return `${button_show} ${button_delete}`;

            }



            $(document).on('click', '.makeAsRead', function(e) {

                var row_id = $(this).data('rwo-id');
                var url_make_read = "{{ route('dashboard.notifications.makeAsRead', ':id') }}";
                url_make_read = url_make_read.replace(':id', row_id);

                $.ajax({
                    url: url_make_read,
                    method: 'post',
                    data: {
                        _token: token,
                    },

                    success: function(response) {

                        if (response.error == false) {

                            table.ajax.reload();




                            swal({

                                title: 'success',
                                text: response.message[0] ? response.message[0] :
                                    'success',
                                type: "success",

                                timer: 2000,
                                position: 'top-end',
                                toast: true,
                            });


                        } else {

                            var message = response.message[0];

                            swal({

                                title: 'error',
                                text: message ? message : 'not found',
                                type: "error",
                                timer: 2000,
                                position: 'top-end',
                                toast: true,


                            });

                        }
                    },

                })


            });

            $(document).on('click', '.makeAllRead', function(e) {

                var url_read = "{{ route('dashboard.notifications.makeAllRead') }}";


                $.ajax({
                    url: url_read,
                    method: 'post',
                    data: {
                        _token: token,
                    },

                    success: function(response) {

                        if (response.error == false) {

                            table.ajax.reload();

                            swal({
                                title: response.message[0],
                                type: "success",
                                timer: 2000,
                                position: 'top-end',
                                toast: true,

                            });

                        } else {

                            var message = response.message[0];

                            swal({
                                title: message ? message : 'not found',
                                type: "error",
                                timer: 2000,
                                position: 'top-end',
                                toast: true,
                            });

                        }
                    },

                })


            });


        })
    </script>



    {{-- ------------------------ --}}

@stop
