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

                            <form id="login-form" action="{{ route('login') }}" method="post">
                                @csrf
                                <section>


                                    <!--
                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

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
                                            </div>


                                            <div class="form-group row">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

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
                                            </div>



                                            <div class="form-group row">
                                                {{-- <label for="password"
                                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                --}}

                                                <div class="col-md-6 ">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Login') }}
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Your Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                        -->






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



                                    <div class="form-group row no-gutters">
                                        <div class="col-md-2"></div>

                                        <div class="">
                                            <div class="form-check">
                                                <input type="checkbox" class="" name="remember" id="remember">
                                                <label class="form-check-label"
                                                    for="remember">@lang('front.remember_me')</label>
                                            </div>
                                        </div>


                                    </div>




                                    <div class="form-group row mb-1">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('front.login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="" href="{{ route('password.request') }}">
                                                    {{ __('front.forget_password') }} ?
                                                </a>
                                            @endif

                                            <div class="no-account">
                                                <a href="{{route('register')}}"
                                                    data-link-action="display-register-form">
                                                    @lang('front.create_new_account')
                                                </a>
                                            </div>

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
