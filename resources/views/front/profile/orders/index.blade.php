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
                        <a itemprop="item" href="">
                            <span itemprop="name">
                                {{ __('front.orders') }}
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
                    <h4>{{ __('front.all_orders') }}</h4>
                </div>
                @if ($orders->count() > 0)

                    <table class="table display nowrap table-striped table-bordered ">
                        <thead>
                            <tr >

                                <th class="text-center">{{ __('front.status') }}</th>
                                <th class="text-center">{{ __('front.total_price') }}</th>
                                <th class="text-center">{{ __('front.quantity') }}</th>
                                <th class="text-center">{{ __('front.method_pay') }}</th>
                                <th class="text-center">{{ __('front.created_at') }}</th>
                                <th class="text-center">{{ __('front.show') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>

                                    <td>
                                        @php
                                          $status = $order->status;
                                          switch ($status) {
                                              case 'paid':
                                                echo "<span class='badge badge-success'>" . __('front.success') ."</span>";
                                           break;
                                                case 'refused':
                                                echo "<span class='badge badge-danger'>" . __('front.refused') ."</span>";
                                                break;


                                              default:
                                              echo "<span class='badge badge-primary'>" . __('front.pending') ."</span>";

                                          }

                                        @endphp


                                    </td>
                                    <td> {{ $order->amount }}</td>
                                    <td> {{ $order->orderProducts->sum('quantity') }}</td>

                                    <td>
                                        {{ $order->payment_method }}
                                    </td>

                                    <td> {{ $order->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('front.user.orders.show', $order->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>


                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @else
                    <div class="text-center">
                        <p>
                            {{ __('front.no_found_order') }}
                        </p>
                    </div>
                @endif

                <div class="d-flex justify-content-center mb-14 ">

                    {{ $orders->links() }}

                </div>



            </section>
        </div>
    </div>


@endsection
