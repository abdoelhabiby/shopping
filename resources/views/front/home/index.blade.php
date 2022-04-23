@extends('layouts.front')

@section('slider')

    @isset($slider_images)

        @if ($slider_images->count() > 0)
            @include('front.includes.slider',$slider_images)

        @endif

    @endisset

@stop

@section('content')

    <div id="main">



        <section id="content" class="page-home pagehome-three">
            <div class="container">
                <div class="row">



                    {{-- ------ section first banner --}}
                    @include('front.home._first_banner')
                    {{-- ------------------------- --}}


                    {{-- ------ section new and flash deals --}}
                    @include('front.home._new_flash',[$products_offer,$new_poducts])
                    {{-- ------------------------- --}}



                    {{-- ------ section seconde banner --}}

                    @include('front.home._seconde_banner')


                    {{-- ------------------------- --}}


                    {{-- ------ section trending now and best saller
                    --}}

                    @include('front.home._trending_best_seller',[$trending,$best_sellers])

                    {{-- ------------------------- --}}


                    <div class="nov-row policy-home col-lg-12 col-xs-12">
                        <div class="nov-row-wrap row">
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-1"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Free Delivery From $ 250</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-2"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Money Back Guarantee</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                    natus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nov-html col-xl-4 col-lg-4 col-md-4">
                                <div class="block">
                                    <div class="block_content">
                                        <div class="policy-row"><i class="noviconpolicy noviconpolicy-3"></i>
                                            <div class="policy-content">
                                                <div class="policy-name">Authenticity 100% guaranteed</div>
                                                <div class="policy-des">Sed ut perspiciatis unde omnis iste
                                                    natus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- ------ section bottom sho 3categories with his products
                    --}}

                    @include('front.home._bottom_category_wis_his_products',[$maincategories_products])


                    {{-- ------------------------- --}}



                </div>
            </div>
        </section>


    </div>


@stop

