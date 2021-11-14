@extends('layouts.dashboard')


@php
$model_name = 'users';
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
                                            <li><a href="{{ route( $model_name . '.create') }}"
                                                    class="btn btn-outline-info btn-sm box-shadow-2"><i
                                                        class="la la-plus"></i></a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>

                                        </ul>


                                    </div>

                                </div>


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table class="table display nowrap table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Image</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($rows->count() > 0)


                                                    @foreach ($rows as $index => $row)

                                                        <tr>
                                                            <td> {{ orderNumberOfRows($rows->perPage()) + $index + 1 }}</td>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ $row->email }}</td>
                                                        <td><img src="{{asset($row->image )}}" class="rounded-circle" width="50" height="50" alt=""></td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                    aria-label="Basic example">

                                                                    <a href="{{ route( $model_name . '.edit', $row->id) }}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        Edit
                                                                    </a>

                                                                    <button type="button" id="button_delete"
                                                                        data-action="{{ route( $model_name . '.destroy', $row->id) }}"
                                                                        data-name="{{ $row->name }}"
                                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">
                                                                        Delete
                                                                    </button>

                                                                </div>

                                                                <i class="la la-automobile"></i>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                @endif







                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">

            {{ $rows->appends(request()->query())->links() }}

        </div>
    </div>



    <!-- Modal delete -->

    @include('dashboard.includes.alerts.model_delete')






@endsection
