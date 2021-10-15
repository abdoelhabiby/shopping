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
                                                                <th>Amount</th>
                                                                <th>Created at</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> {{ $order->user->name }}</td>
                                                                <td> {{ $order->user->email }}</td>
                                                                <td> {{ $order->amount }}</td>
                                                                <td> {{ $order->created_at }}</td>


                                                            </tr>


                                                        </tbody>
                                                    </table>




                                                    <!--  products  -->





                                                    <!-- ---------------------------------- -->

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
                                                                                    $image = $order_product->productImage ? $order_product->productImage->name : pathNoImage();
                                                                                @endphp

                                                                                <img class=""
                                                                                    src="{{ fileExist($image) ? asset($image) : getLinkImageNoImage() }}"
                                                                                    alt="{{ $order_product->product->name }}"
                                                                                    width='100' height="100">
                                                                            </td>
                                                                            <td>
                                                                                <a href="">
                                                                                    {{$order_product->product->name}}

                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                {{$order_product->attribute->name}}
                                                                            </td>
                                                                            <td>
                                                                                {{$order_product->price}}
                                                                            </td>
                                                                            <td>
                                                                                {{$order_product->quantity}}
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
