@extends('layouts.front')


@section('title')
    | {{ __('front.edit_profile') }}
@stop


@section('breadcrumb')



    <nav data-depth="3" class="breadcrumb-bg">
        <div class="container no-index">
            <div class="breadcrumb" style="background-color: #eee; border-radius: 25px;">

                <ol itemscope="" itemtype="">
                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="{{ route('front.home') }}">
                            <span itemprop="name">
                                @lang('front.home')
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>




                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="{{ route('front.profile') }}">
                            <span itemprop="name">
                                {{ __('front.profile') }}
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>


                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="{{ route('front.profile.edit') }}">
                            <span itemprop="name">
                                {{ __('front.edit_profile') }}
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop


@section('content')



    <div class="container no-index p-5">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                @if (Session::has('exception_error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3 " role="alert">
                        <strong class=""> {{ Session::get('exception_error') }} </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                <div id="main">


                    <div class="page-header">
                        <h1 class="page-title hidden-xs-up">
                            Log in to your account
                        </h1>
                    </div>




                    <section id="content" class="page-content">


                        <section class="login-form">

                            <form id="update-profile" action="{{ route('front.profile.update') }}" method="post">
                                @csrf
                                @method('put')
                                <section>





                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                            @lang('front.name') :
                                        </label>
                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name', user()->name) }}" required autofocus>
                                            @error('name')
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
                                            @lang('front.email') :
                                        </label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', user()->email) }}" required autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-control-comment right">
                                        </div>
                                    </div>



                                    {{-- ---------------------------------- --}}



                                    <div class="form-group row mb-1">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('front.update') }}
                                            </button>

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
