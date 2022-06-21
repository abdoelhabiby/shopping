@extends('layouts.front')


@section('content')


    <div class="container no-index p-5">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                <div id="main">


                    <div class="page-header">
                        <h1 class="page-title hidden-xs-up">
                            Log in to your account
                        </h1>
                    </div>




                    <section id="content" class="page-content">


                        <section class="login-form">

                            <form method="POST" action="{{ route('register') }}">
                                @csrf




                                <section>

                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                            @lang('front.name') :
                                        </label>
                                        <div class="col-md-6">
                                            <input id="name" type="name"
                                                class="form-control @error('email') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>


                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                            @lang('front.email') :
                                        </label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>




                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                            @lang('front.password') :
                                        </label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>


                                    {{-- ---------------------------------- --}}


                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                             @lang('front.password_confirmation')  :
                                        </label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                                required autocomplete="new-password">

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>






                                    <div class="form-group row mb-1">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('front.save') }}
                                            </button>

                                            {{-- @if (Route::has('password.request'))
                                                <a class="" href="{{ route('password.request') }}">
                                                    {{ __('front.forget_password') }} ?
                                                </a>
                                            @endif --}}

                                                <a href="{{ route('register') }}" >
                                                    @lang('front.login') ?
                                                </a>

                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-md-8 offset-md-2">

                                        </div>
                                    </div>






                                </section>




                            </form>


                        </section>


                    </section>



                </div>


            </div>
        </div>
    </div>

@stop



