@extends('layouts.front')

@section('title')
    | {{ __('front.orders') }}
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
                                @lang('front.profile')
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="{{ route('front.user.orders') }}">
                            <span itemprop="name">
                                @lang('front.orders')
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>

                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="">
                            <span itemprop="name">
                                {{ __('front.order') }}
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

    <div class="no-index">
        <div id="content-wrapper">

            <section id="main" itemscope="" itemtype="" class="container mb-5">

                @include('front.includes.alerts.success')
                @include('front.includes.alerts.errors')

                {{-- ---------- user data----------- --}}

                <div>
                    <h4>{{ __('front.order') }}</h4>
                </div>


                <div class="cart-container">

                    <table class="table " style="    text-align-last: start;">
                        <thead>
                            <tr>
                                {{-- <th>{{ __('front.first_name') }}</th>
                                <th>{{ __('front.last_name') }}</th>
                                <th>{{ __('front.email') }}</th> --}}
                                <th>{{ __('front.order_number') }}</th>
                                <th>{{ __('front.status') }}</th>
                                <th>{{ __('front.total_price') }}</th>
                                <th>{{ __('front.quantity') }}</th>
                                <th>{{ __('front.method_pay') }}</th>
                                <th>{{ __('front.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td> {{ $order->user->addressDetails->first_name}}
                                <td> {{ $order->user->addressDetails->last_name }}
                                </td>
                                <td> {{ $order->user->addressDetails->email }}</td> --}}
                                <td>
                                    {{ $order->charge_id }}
                                </td>
                                <td>
                                    @php
                                        $status = $order->status;
                                        switch ($status) {
                                            case 'paid':
                                                echo "<span class='badge badge-success'>" . __('front.success') . '</span>';
                                                break;
                                            case 'refused':
                                                echo "<span class='badge badge-danger'>" . __('front.refused') . '</span>';
                                                break;

                                            default:
                                                echo "<span class='badge badge-primary'>" . __('front.pending') . '</span>';
                                        }

                                    @endphp


                                </td>
                                <td> {{ $order->amount }}</td>
                                <td> {{ $order->orderProducts->sum('quantity') }}</td>

                                <td>
                                    {{ $order->payment_method }}
                                </td>

                                <td> {{ $order->created_at }}</td>


                            </tr>


                        </tbody>
                    </table>


                    @if ($order->status == 'refused')
                        <div class="refused mt-2 alert alert-danger">
                            <div class="bs-callout-dabger callout-border-left callout-transparent p-1">
                                <h4 class="danger">refused reason</h4>
                                <p>{{ $order->refused_reason }}</p>
                            </div>
                        </div>
                    @endif





                    <!--  products  -->

                    <!-- ---------------------------------- -->

                    @if ($order->orderProducts && $order->orderProducts->count() > 0)
                        <div class="cart-overview mt-5">

                            <h3 class="card-title" id="basic-layout-form">
                                {{ __('front.products') }}
                            </h3>


                            <table class="table " style="    text-align-last: start;">
                                <thead>
                                    <tr>
                                        <th>{{ __('front.name') }}</th>
                                        <th>{{ __('front.attribute') }}</th>
                                        <th>{{ __('front.price') }}</th>
                                        <th>{{ __('front.quantity') }}</th>
                                        <th>{{ __('front.image') }}</th>


                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($order->orderProducts as $order_product)
                                        <tr>

                                            <td>

                                                {{ $order_product->product->name }}
                                            </td>

                                            <td>

                                                {{ $order_product->attribute ? $order_product->attribute->name : '' }}
                                            </td>
                                            <td>
                                                {{ $order_product->price }}
                                            </td>
                                            <td>
                                                {{ $order_product->quantity }}
                                            </td>

                                            <td>
                                                @php
                                                    $image = $order_product->product->image ? $order_product->product->image->name : pathNoImage();
                                                @endphp

                                                <img class=""
                                                    src="{{ fileExist($image) ? asset($image) : getLinkImageNoImage() }}"
                                                    alt="{{ $order_product->product->name }}" width='100' height="100">
                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>





                        </div>
                    @endif

                    <!-- ---------------------------------- -->

                    {{-- order user address details --}}

                    @if ($order->user->addressDetails)


                        <div class="card mt-4 mb-4">


                            <div class="card-header cleafix" style="background: #2d9ae8;color:white">

                                <h4 class="float-right"> {{ __('front.about_address_details') }} </h4>

                            </div>
                            <div class="card-body p-3 " style="min-height: 225px; ">




                                <p class="card-title">
                                    {{ __('front.first_name') . ' : ' . user()->addressDetails->first_name }}</p>
                                <p class="card-title">
                                    {{ __('front.last_name') . ' : ' . user()->addressDetails->last_name }}</p>
                                <p class="card-text">
                                    {{ __('front.email') . ' : ' . user()->addressDetails->email }}
                                </p>

                                <p class="card-text">
                                    {{ __('front.phone') . ' : ' . user()->addressDetails->phone }}
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

                            </div>
                        </div>


                    @endif



                    <!-- ---------------------------------- -->




                </div>









            </section>
        </div>
    </div>


@endsection
