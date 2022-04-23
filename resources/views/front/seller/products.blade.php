@extends('layouts.front')


@section('title')
    | {{ __('front.seller') . '|' .  $seller->name }}
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
                        <a itemprop="item"
                            href="{{ route('front.seller.products',$seller->id) }}">
                            <span itemprop="name">
                                {{ $seller->name }}
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





    <div id="main">







        <section id="content" class="page-home pagehome-three">
            <div class="container">


                {{-- check if  category has products --}}
                @if ($products->count() > 0)

                    {{-- start forecah products --}}


                    <div id="jmarketplace-sellernews">
                        <div class="product_list grid row jmarketplace-products">




                            @foreach ($products as $key => $product)
                                <div class="item col-12 col-sm-6 col-md-4 col-lg-3">


                                    @include('front.includes.section_product',$product)
                                </div>

                            @endforeach



                        </div>
                    </div>





                    <div class="d-flex justify-content-center mb-14 ">

                        {{ $products->links() }}

                    </div>


                @endif
                {{-- end check if  category has products --}}




            </div>
        </section>







    </div>


@stop


