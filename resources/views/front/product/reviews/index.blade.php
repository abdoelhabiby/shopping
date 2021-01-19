@extends('layouts.front')

@section('title')
    | {{ $product->name }} | @lang('front.reviews')
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
                            href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}"
                            class="active ">
                            <span itemprop="name">{{ $product->name }}</span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                    <li itemprop="itemListElement" itemscope="">
                        <a itemprop="item" href="" class="active ">
                            <span itemprop="name">@lang('front.reviews')</span>
                        </a>
                        <meta itemprop="position" content="3">
                    </li>

                </ol>

            </div>
        </div>
    </nav>

@stop

@section('content')

    <section id="main" itemscope="" itemtype="" class="m-2">

        <div class="container ">

            <div class="card p-3">
                <div class="card-body">

                    <h3 class="card-title">
                        <a href="{{ route('front.prouct.show', [$product->slug, $product->attribute->id]) }}" title="back">
                            <i class="fa fa-arrow-{{ currentLocale() == 'ar' ? 'right' : 'left' }}"></i>
                        </a>
                        @lang('front.reviews')
                    </h3>
                    <hr>

                    <div class="card-text">
                        <h4 class="" style=" margin-bottom: 15px !important">
                            @lang('front.product_reviews')({{ $reviews->total() }})
                        </h4>
                        <div class="row">
                            <div class="col-md-3">


                                <div class="text-center " style="font-size: 21px">

                                    <div class="mt-4 p-2" style="background:#f7f3f3 ">

                                        <div style="color:#ffa500;background">
                                            {{ $calculate_reviews->stars ?? 0 }}/5
                                        </div>
                                        <div class="stars">
                                            @php
                                            $stars = $calculate_reviews->stars ?? 0;
                                            for ($i = 0; $i < $stars; $i++) {
                                                echo '<i class="fa fa-star" style="color:#ffa500;background"></i>' ; }
                                                $minus=5 - $stars; if ($minus> 0) {
                                                for ($i = 0; $i < $minus; $i++) {
                                                    echo '<i class="fa fa-star-o" style="color:#ffa500;background"></i>' ; }
                                                    } @endphp </div>

                                                    <div class="count-reviews">
                                                        <p>{{ $calculate_reviews->total_rating ?? 0 }}
                                                            @lang('front.evaluation')</p>
                                                    </div>



                                        </div>
                                    </div>



                                    @isset($evaluations)

                                        @php
                                        $max_total_rate = ((int) $evaluations['total_add_rate']) * 5;
                                        @endphp

                                        @foreach ($evaluations['quality'] as $key => $value)



                                            <div class="evaluations mt-25">
                                                <span class="d-inline">
                                                    {{ $key }} <i class="fa fa-star" style="color:#ffa500;background"></i> (
                                                    {{ $value }} )
                                                </span>
                                                <div class="progress ">
                                                    @php
                                                    $width = (($value * 5) / $max_total_rate) * 100;
                                                    @endphp
                                                    <div class="progress-bar bg-info" style="width:{{ $width }}%"
                                                        role="progressbar" aria-valuenow="{{ $width }}" aria-valuemin="0"
                                                        aria-valuemax="{{ $max_total_rate }}"></div>
                                                </div>
                                            </div>
                                        @endforeach


                                    @endisset




                                </div>
                                <div class="col-md-9">
                                    @isset($reviews)

                                        @if ($reviews->count() > 0)

                                            @foreach ($reviews as $review)


                                                <div class="comment row">


                                                    <div class="comment_details col-md-8">
                                                        <h4>{{ $review->title }}</h4>
                                                        <p>{{ $review->review }}</p>

                                                    </div>


                                                    <div class="comment_author col-md-4" style="text-align: end;">

                                                        <div class="stars">
                                                            {{-- <span>Grade&nbsp;</span>
                                                            --}}

                                                            @php
                                                            $stars = $review->quality ?? 0;
                                                            for ($i = 0; $i < $stars; $i++) {
                                                                echo '<i class="fa fa-star" style="color:#ffa500;background"></i>'
                                                                ; } $minus=5 - $stars; if ($minus> 0) {
                                                                for ($i = 0; $i < $minus; $i++) {
                                                                    echo '<i class="fa fa-star-o" style="color:#ffa500;background"></i>'
                                                                    ; } } @endphp </div>

                                                                    <div class="">
                                                                        <div class="user-">

                                                                            {{ $review->user->name }} <i
                                                                                class="fa fa-user-secret"></i>
                                                                        </div>
                                                                        <div class="date-comment">
                                                                            {{ $review->created_at->format('Y/m/d') }}
                                                                        </div>


                                                                    </div>



                                                        </div>

                                                        {{-- <div class="clearfix"></div>
                                                        --}}

                                                    </div>

                                                    <hr>


                                            @endforeach


                                        @endif

                                    @endisset

                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="d-flex justify-content-center m-4">

                    {{ $reviews->appends(request()->query())->links() }}

                </div>

            </div>
        </div>


    </section>
    @stop @section('scripts') @stop
