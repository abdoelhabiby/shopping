@extends('layouts.dashboard')


@php
$model_name = 'tags';
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

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{ $model_name }}</h4>

                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            @if (admin()->can('create_tag'))
                                                <li><a href="{{ route($model_name . '.create') }}"
                                                        class="btn btn-outline-info btn-sm box-shadow-2"><i
                                                            class="la la-plus"></i></a></li>
                                            @endif
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>

                                        </ul>


                                    </div>

                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class="container" style="background: #FFF;padding-top: 20px;">

                                            {!! $dataTable->table() !!}
                                        </div>


                                        @push('scripts')
                                            {{-- <script
                                                src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"> </script> --}}
                                            <script src="/vendor/datatables/buttons.server-side.js"></script>
                                            {!! $dataTable->scripts() !!}
                                        @endpush


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
