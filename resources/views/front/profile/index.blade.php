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

                {{-- ---------- user data----------- --}}

                <div class="row">



                    <div class="card   col-6" style="padding:20px;">
                        <div class="card-header cleafix">
                            <a href="{{ route('front.profile.edit') }}" class="float-left"><i style="color:#0a090a"
                                    class="fa fa-edit fa-lg"></i></a>
                            <h4 class="float-right"> {{ __('front.about_profile') }} </h4>

                        </div>
                        <div class="card-body p-3">
                            <p class="card-title">{{ __('front.name') . ' : ' . user()->name }}</p>
                            <p class="card-text">{{ __('front.email') . ' : ' . user()->email }}</p>
                            <a href="{{ route('front.profile.change_password') }}" class="">
                                <strong>
                                    {{ __('front.change_password') }}
                                </strong>
                            </a>
                        </div>
                    </div>



                    {{-- ---------------user address --------- --}}


                    <div class="card col-6" style="padding:20px;">


                        <div class="card-header cleafix">
                            <a href="{{ route('front.profile.address.edit') }}" class="float-left"><i
                                    style="color:#0a090a" class="fa fa-edit fa-lg"></i></a>
                            <h4 class="float-right"> {{ __('front.about_address_details') }} </h4>

                        </div>
                        <div class="card-body p-3">


                            @if (user()->addressDetails)


                                <p class="card-title">
                                    {{ __('front.first_name') . ' : ' . user()->addressDetails->first_name }}</p>
                                <p class="card-title">
                                    {{ __('front.last_name') . ' : ' . user()->addressDetails->last_name }}</p>
                                <p class="card-text">{{ __('front.email') . ' : ' . user()->addressDetails->email }}
                                </p>

                                <p class="card-text">{{ __('front.phone') . ' : ' . user()->addressDetails->phone }}
                                </p>
                                @if (user()->addressDetails->second_phone)
                                    <p class="card-text">
                                        {{ __('front.second_phone') . ' : ' . user()->addressDetails->second_phone }}
                                    </p>
                                @endif
                                <p class="card-text">
                                    {{ __('front.address') . ' : ' . user()->addressDetails->address }}
                                </p>

                                @if (user()->addressDetails->second_address)
                                    <p class="card-text">
                                        {{ __('front.second_address') . ' : ' . user()->addressDetails->second_address }}
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>




                </div>


            </section>
        </div>
    </div>


@endsection
