@extends('layouts.front')


@section('title')
    | {{ $maincategory->name }}
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
                        <a itemprop="item" href="">
                            <span itemprop="name">
                                {{ $maincategory->name }}
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
                @if ($maincategory->chields->count() > 0)

                    {{-- start forecah chileds of maincategory --}}
                    @foreach ($maincategory->chields as $subcategory)

                        {{-- check if subcategory has chileds --}}
                        @if ($subcategory->chields->count() > 0)


                            <div class="row">
                                <div class="nov-row spacing-30 mt-15 col-lg-12 col-xs-12">
                                    <div class="alert alert-success w-100 text-center">{{ $subcategory->name }}</div>
                                    <div class="nov-row-wrap row">


                                        {{-- start forecah chileds of subcategory --}}
                                        @foreach ($subcategory->chields as $category)

                                            <div class="nov-image col-lg-3 col-md-3">
                                                <div class="block">
                                                    <div class="block_content">
                                                        <div class="effect">
                                                            <a href="#">
                                                                @if ($category->image && fileExist($category->image))
                                                                    <div style="height: 155px;width:270px">
                                                                        <img class="img-fluid"
                                                                            src="{{ asset($category->image) }}"
                                                                            alt="{{ $category->name }}"
                                                                            title="{{ $category->name }}"
                                                                            style="height: 100%;width:100%">
                                                                    </div>


                                                                @else

                                                                    <div style="height: 155px;width:270px">
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
                                                    <div class="text-center mt-2">{{ $category->name }}</div>
                                                </div>
                                            </div>

                                        @endforeach
                                        {{-- end forecah chileds of subcategory --}}


                                    </div>
                                </div>





                            </div>

                        @endif
                        {{-- end check if subcategory has chileds --}}

                    @endforeach
                    {{-- end forecah chileds of maincategory --}}


                @endif
                {{-- end check if main category has chileds --}}




            </div>
        </section>


    </div>


@stop



@section('scripts')



@stop
