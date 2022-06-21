@extends('layouts.dashboard')


@php
$model_name = 'admins';
@endphp

@section('title')
    | dashboard | {{ $model_name }} | create
@endsection





@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">home </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route($model_name . '.index') }}">
                                        {{ $model_name }} </a>
                                </li>
                                <li class="breadcrumb-item active"> add
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> add admin </h4>
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
                                    <div class="card-body">
                                        <form class="form" action="{{ route($model_name . '.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-user"></i> Admin data </h4>


                                                <div class="row">



                                                    <div class="col-md-6">

                                                        @php
                                                            $input = 'name';
                                                        @endphp

                                                        <div class="form-group">
                                                            <label for="name"> {{ $input }} </label>
                                                            <input type="text" value="{{ old($input) }}"
                                                                id="{{ $input }}" class="form-control"
                                                                placeholder="input {{ $input }}   "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        @php
                                                            $input = 'email';
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> {{ $input }} </label>
                                                            <input type="email" value="{{ old($input) }}"
                                                                id="{{ $input }}" class="form-control"
                                                                placeholder="input {{ $input }}   "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                                <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">


                                                    <div class="col-md-6">

                                                        @php
                                                            $input = 'password';
                                                        @endphp

                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> {{ $input }} </label>
                                                            <input type="password" id="{{ $input }}"
                                                                class="form-control"
                                                                placeholder="input {{ $input }}   "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                                <span class="text-danger">{{ $message }} </span>
                                                            @enderror

                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        @php
                                                            $input = 'password_confirmation';
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> password confermation
                                                            </label>
                                                            <input type="password" id="password_confirmation"
                                                                class="form-control"
                                                                placeholder="input password confermation   "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                                <span class="text-danger">{{ $message }} </span>
                                                            @enderror

                                                        </div>
                                                    </div>

                                                </div>

                                                {{-- ----------permissions ------------ --}}








                                                @if (isset($roles_permissions) && $roles_permissions->count() > 0)

                                                    <div class="row">
                                                        <div class="card" style="height: 305px;">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Admin Permisions</h4>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body">

                                                                    @error('permissions.*')
                                                                        <div class="alert alert-danger">
                                                                            {{ $message }}
                                                                        </div>

                                                                    @enderror


                                                                    <ul class="nav nav-tabs">

                                                                        @foreach ($roles_permissions as $role)


                                                                            <li class="nav-item">
                                                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}"
                                                                                    id="base-tab{{ $role->id }}"
                                                                                    data-toggle="tab"
                                                                                    aria-controls="tab{{ $role->id }}"
                                                                                    href="#tab{{ $role->id }}"
                                                                                    aria-expanded="true">{{ $role->name }}</a>
                                                                            </li>



                                                                        @endforeach

                                                                    </ul>

                                                                    <div class="tab-content px-1 pt-1">

                                                                        @foreach ($roles_permissions as $role)


                                                                            <div role="tabpanel"
                                                                                class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                                                id="tab{{ $role->id }}"
                                                                                aria-expanded="true"
                                                                                aria-labelledby="base-tab{{ $role->id }}">
                                                                                <div class="permissions-checkbox">
                                                                                    <div
                                                                                        class="checkbox_all  custom-control custom-checkbox mr-1">

                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input select_all_permissions"
                                                                                            name="select_all_permissions"
                                                                                            id="checkbox_{{ $role->name }}">

                                                                                        <label class="custom-control-label"
                                                                                            for="checkbox_{{ $role->name }}">Select
                                                                                            All </label>

                                                                                    </div>

                                                                                    @foreach (collect($role->permissions)->pluck('name')->toArray() as $permission)

                                                                                        <div
                                                                                            class="d-inline-block custom-control custom-checkbox mr-1">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input checkbox_permission"
                                                                                                name="permissions[]"
                                                                                                value="{{ $permission }}"
                                                                                                id="checkbox_{{ $permission }}"
                                                                                                @if (old('permissions'))
                                                                                            @if (in_array($permission, old('permissions')))
                                                                                                {{ 'checked' }}
                                                                                            @endif

                                                                                    @endif
                                                                                    >
                                                                                    <label class="custom-control-label"
                                                                                        for="checkbox_{{ $permission }}">
                                                                                        {{ str_replace("_"," ", $permission) }} </label>
                                                                                </div>

                                                                        @endforeach




                                                                    </div>
                                                                </div>






                                                @endforeach


                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endif






                        {{-- -------------- buttons submit and back --}}
                        <div class="form-actions">
                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                <i class="ft-x"></i> back
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> save
                            </button>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    <!-- // Basic form layout section end -->
    </div>
    </div>
    </div>

@endsection

@section('js')

    <script>

        $(document).on('change', '.select_all_permissions', function() {
            let get_inputs_permissions = $(this).parent('div').parent('.permissions-checkbox').find(
                '.checkbox_permission');
            $(get_inputs_permissions).prop('checked', this.checked);

        });

    </script>




@endsection
