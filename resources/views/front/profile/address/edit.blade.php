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
                        <a itemprop="item" href="{{ route('front.profile.address.edit') }}">
                            <span itemprop="name">
                                {{ __('front.edit_address_details') }}
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

                            <form id="update-profile" action="{{ route('front.profile.address.update') }}" method="post">
                                @csrf
                                @method('put')
                                <section>


                                    <x-inputs.input_address_form label="{{ __('front.first_name') }} " name="first_name"
                                        value="{{ user()->addressDetails->first_name ?? '' }}"
                                        placeholder="{{ __('front.first_name') }}" required />

                                    <x-inputs.input_address_form label="{{ __('front.last_name') }} " name="last_name"
                                        value="{{ user()->addressDetails->last_name ?? '' }}"
                                        placeholder="{{ __('front.last_name') }}" required />

                                    <x-inputs.input_address_form label="{{ __('front.email') }} " name="email"
                                        value="{{ user()->addressDetails->email ?? user()->email }}"
                                        placeholder="{{ __('front.email') }}" required />

                                    <x-inputs.input_address_form label="{{ __('front.phone') }} " name="phone"
                                        value="{{ user()->addressDetails->phone ?? '' }}"
                                        placeholder="{{ __('front.phone') }}" required />

                                    <x-inputs.input_address_form label="{{ __('front.second_phone') }} "
                                        name="second_phone" value="{{ user()->addressDetails->second_phone ?? '' }}"
                                        placeholder="{{ __('front.second_phone') }}" />

                                    <x-inputs.input_address_form label="{{ __('front.address') }} "
                                        placeup="{{ __('front.placeholder_address_details') }}" name="address"
                                        value="{{ user()->addressDetails->address ?? '' }}"
                                        placeholder="{{ __('front.address') }}" required />

                                    <x-inputs.input_address_form label="{{ __('front.second_address') }} "
                                        name="second_address" value="{{ user()->addressDetails->second_address ?? '' }}"
                                        placeholder="{{ __('front.second_address') }}" />



                                    {{-- ---------------------------------- --}}



                                    <div class="form-group row mb-1">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('front.save') }}
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
