@extends('layouts.front')

@section('title')
    | {{ __('front.profile') }}
@stop


@section('content')

    <div class="no-index">
        <div id="content-wrapper">

            <section id="main" itemscope="" itemtype="" class="container mb-5">

                @include('front.includes.alerts.success')
                @include('front.includes.alerts.errors')

                <div class="card " style="padding:20px;">
                    <div class="card-header cleafix">
                        <a href="{{ route('front.profile.edit') }}" class="float-left"><i style="color:#0a090a" class="fa fa-edit fa-lg"></i></a>
                        <h4 class="float-right"> {{ __('front.about_profile') }} </h4>

                    </div>
                    <div class="card-body p-3">
                        <h4 class="card-title">{{ user()->name }}</h4>
                        <p class="card-text">{{ user()->email }}</p>
                        <a href="{{ route('front.profile.change_password') }}" class="">{{ __('front.change_password') }}</a>
                    </div>
                </div>

            </section>
        </div>
    </div>


@endsection
