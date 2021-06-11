@extends('layouts.front')


@section('title')
    | {{ $subcategory->name }}
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
                        <a itemprop="item" href="{{ route('front.main_category.show',$subcategory->parent->slug) }}">
                            <span itemprop="name">
                                {{$subcategory->parent->name}}
                            </span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="">
                            <span itemprop="name">
                                {{ $subcategory->name }}
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


                {{-- check if main category has chileds --}}
                @if ($categories_with_paginate->count() > 0)

                    {{-- start forecah chileds of maincategory --}}





                    <div class="row">

                        <div class="nov-row spacing-30 mt-15 mb-15 col-lg-12 col-xs-12">


                            <div class="nov-row-wrap row">


                                @foreach ($categories_with_paginate as $category)
                                    <div class="nov-image col-lg-2 col-md-2">
                                        <div class="block">
                                            <div class="block_content">
                                                <div class="effect">
                                                    <a href="{{route('front.category.show',[$subcategory->slug,$category->slug])}}">
                                                        @if ($category->image && fileExist($category->image))
                                                            <div style="height: 185px;width:185px">
                                                                <img class="img-fluid" src="{{ asset($category->image) }}"
                                                                    alt="{{ $category->name }}"
                                                                    title="{{ $category->name }}"
                                                                    style="height: 100%;width:100%">
                                                            </div>


                                                        @else

                                                            <div style="height: 185px;width:185px">
                                                                <img class="img-fluid"
                                                                    src="{{ asset('/images/noImage.jpg') }}"
                                                                    alt="{{ $category->name }}"
                                                                    title="{{ $category->name }}"
                                                                    style="height: 100%;width:100%">
                                                            </div>


                                                        @endif

                                                    </a>

                                                </div>
                                            </div>
                                            <div class="text-center mt-2 ">{{ $category->name }}</div>


                                        </div>



                                    </div>



                                @endforeach
                                {{-- end forecah chileds of maincategory --}}

                            </div>
                        </div>





                    </div>




                    <div class="d-flex justify-content-center mb-14 ">

                        {{ $categories_with_paginate->links() }}

                    </div>


                @endif
                {{-- end check if main category has chileds --}}





            </div>
        </section>







    </div>


@stop



@section('scripts')



@stop
