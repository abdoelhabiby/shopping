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



    @endsection




    @section('js')

        {{-- ttttttsssss --}}


        <script>
            $(function() {


                var urlftech = "{{ route('dashboard.notifications.fetchDatatable') }}";
                var token = "{{ csrf_token() }}";

                var check_coun_unread = "{{ isset($navbar['notify_count']) ? $navbar['notify_count'] : 0 }}"



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
                            text: '<span id="makeAllRead">make all read</span>',
                            enabled: check_coun_unread > 0 ? true : false,

                        }

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
                            name: 'read at'
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



                    },
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

                            var url = "{{ route('dashboard.notifications.index') }}/" + id;

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



                $(document).on('click', '#makeAllRead', function(e) {

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
                                });

                            } else {

                                swal({
                                    title: '404 not found',
                                    type: "error",
                                    timer: 2000,
                                });

                            }
                        },

                    })


                });
            })
        </script>



        {{-- ------------------------ --}}

    @stop
