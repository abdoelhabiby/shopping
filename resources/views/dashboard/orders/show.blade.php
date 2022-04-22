@extends('layouts.dashboard')


@php
$model_name = 'orders';
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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.' . $model_name . '.index') }}">
                                        {{ $model_name }} </a>
                                </li>
                                <li class="breadcrumb-item active"> details
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
                                    <h4 class="card-title" id="basic-layout-form"> {{ Str::singular($model_name) }}
                                        Details
                                    </h4>
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


                                        <div class="cart-grid row">

                                            <!-- Left Block: cart product informations & shpping -->
                                            <div class="cart-grid-body col-xs-12 col-lg-12 ">

                                                {{-- order details --}}

                                                <div class="cart-container">

                                                    <table class="table display nowrap table-striped table-bordered ">
                                                        <thead>
                                                            <tr>
                                                                <th>Username</th>
                                                                <th>Email</th>
                                                                <th>status</th>
                                                                <th>Total Amount</th>
                                                                <th>Total Quantity</th>
                                                                <th>gateway</th>
                                                                <th>method</th>
                                                                <th>Created at</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> {{ $order->user->name }}</td>
                                                                <td> {{ $order->user->email }}</td>
                                                                <td> {{ $order->status }}</td>
                                                                <td> {{ $order->amount }}</td>
                                                                <td> {{ $order->orderProducts->sum('quantity') }}</td>
                                                                <td>
                                                                    {{ $order->payment_gateway }}
                                                                </td>
                                                                <td>
                                                                    {{ $order->payment_method }}
                                                                </td>

                                                                <td> {{ $order->created_at }}</td>


                                                            </tr>


                                                        </tbody>
                                                    </table>


                                                    @if ($order->note)
                                                        <div class="note">
                                                            <div
                                                                class="bs-callout-primary callout-border-left callout-transparent p-1">
                                                                <h4 class="primary">Note</h4>
                                                                <p>{{ $order->note }}</p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ($order->status == 'refused')
                                                        <div class="refused mt-2">
                                                            <div
                                                                class="bs-callout-dabger callout-border-left callout-transparent p-1">
                                                                <h4 class="danger">refused reason</h4>
                                                                <p>{{ $order->refused_reason }}</p>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    {{-- order user address details --}}


                                                    <div class="card ">

                                                        <div class="card-body p-3 " style="min-height: 225px; ">

                                                            <p class="mb-2">Address detials : </p>

                                                            <p class="card-title">
                                                                first name :
                                                                {{ $order->user->addressDetails->first_name }}
                                                            </p>
                                                            <p class="card-title">
                                                                last name :
                                                                {{ $order->user->addressDetails->last_name }}
                                                            </p>
                                                            <p class="card-text">
                                                                email : {{ $order->user->addressDetails->email }}
                                                            </p>

                                                            <p class="card-text">
                                                                phone : {{ $order->user->addressDetails->phone }}
                                                            </p>
                                                            @if ($order->user->addressDetails->second_phone)
                                                                <p class="card-text">
                                                                    second phone :
                                                                    {{ $order->user->addressDetails->second_phone }}
                                                                </p>
                                                            @endif
                                                            <p class="card-text">
                                                                address : {{ $order->user->addressDetails->address }}
                                                            </p>

                                                            @if ($order->user->addressDetails->second_address)
                                                                <p class="card-text">
                                                                    second address :
                                                                    {{ $order->user->addressDetails->second_address }}
                                                                </p>
                                                            @endif

                                                        </div>
                                                    </div>




                                                    <!--  products  -->

                                                    <!-- ---------------------------------- -->

                                                    @if ($order->orderProducts && $order->orderProducts->count() > 0)
                                                        <div class="cart-overview mt-3">

                                                            <h3 class="card-title" id="basic-layout-form">
                                                                Products
                                                            </h3>


                                                            <table
                                                                class="table display nowrap table-striped table-bordered ">
                                                                <thead>
                                                                    <tr>
                                                                        <th>image</th>
                                                                        <th>name</th>
                                                                        <th>attribute</th>
                                                                        <th>price</th>
                                                                        <th>quantity</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>


                                                                    @foreach ($order->orderProducts as $order_product)

                                                                            <tr>
                                                                                <td>
                                                                                    @php
                                                                                        $image = $order_product->product->image ? $order_product->product->image->name : pathNoImage();
                                                                                    @endphp

                                                                                    <img class=""
                                                                                        src="{{ fileExist($image) ? asset($image) : getLinkImageNoImage() }}"
                                                                                        alt="{{ $order_product->product->name }}"
                                                                                        width='100' height="100">
                                                                                </td>
                                                                                <td>
                                                                                    {{ $order_product->product->name }}
                                                                                </td>

                                                                                <td>

                                                                                    {{ $order_product->attribute ? $order_product->attribute->name : ''}}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $order_product->price }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $order_product->quantity }}
                                                                                </td>


                                                                            </tr>

                                                                    @endforeach


                                                                </tbody>
                                                            </table>





                                                        </div>
                                                    @endif

                                                    <!-- ---------------------------------- -->




                                                </div>



                                            </div>


                                        </div>



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
