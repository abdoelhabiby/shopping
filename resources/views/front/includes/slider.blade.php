<div id="displayTop" class="displaytopthree ">
    <div class="container">
        <div class="row">
            <div class="nov-row  col-lg-12 col-xs-12">
                <div class="nov-row-wrap row">
                    <div class="nov-html col-xl-3 col-lg-3 col-md-3">
                        <div class="block">
                            <div class="block_content">

                            </div>
                        </div>
                    </div>
                    <div id="nov-slider" class="slider-wrapper theme-default col-xl-9 col-lg-9 col-md-9 col-md-12"
                        data-effect="random" data-slices="15" data-animspeed="500" data-pausetime="10000"
                        data-startslide="0" data-directionnav="false" data-controlnav="true"
                        data-controlnavthumbs="false" data-pauseonhover="true" data-manualadvance="false"
                        data-randomstart="false">
                        <div class="nov_preload">
                            <div class="process-loading active">
                                <div class="loader">

                                    @foreach ($slider_images as $image)
                                        <div class="dot"></div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="nivoSlider">

                            @foreach ($slider_images as $image)

                                    {{-- <img src="{{ asset($image->image) }}" alt="" style="max-height: 500px !important"> --}}
                                    <img class="" src="{{ asset($image->image) }}" style="display: inline; height: auto; width: 870px;">

                            @endforeach

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
