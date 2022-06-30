<section id="image-gallery" class="card">
    <div class="card-header">
        <h4 class="card-title">Image gallery</h4>
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
    <div class="card-content">
        <div class="card-body">
            <div class="card-text">

            </div>
        </div>
        <div class="card-body  my-gallery" itemscope itemtype="">
            <div class="row my-gallery-row">
                @foreach ($sliders as $image)
                    <figure class="col-lg-3 col-md-6 col-12 image-section-galary-{{ $image->id }}"
                        itemprop="associatedMedia" itemscope itemtype="">

                        <a href="{{ asset($image->image) }}" itemprop="contentUrl" data-size="700x560">
                            <img class="img-thumbnail img-fluid" src="{{ asset($image->image) }}" itemprop="thumbnail"
                                alt="Image description" style="height: 200px !important" />
                        </a>

                    </figure>
                @endforeach

            </div>

        </div>
        <!--/ Image grid -->
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <!-- Background of PhotoSwipe.
                   It's a separate element as animating opacity is faster than rgba(). -->
            <div class="pswp__bg"></div>
            <!-- Slides wrapper with overflow:hidden. -->
            <div class="pswp__scroll-wrap">
                <!-- Container that holds slides.
                      PhotoSwipe keeps only 3 of them in the DOM to save memory.
                      Don't modify these 3 pswp__item elements, data is added later on. -->
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <!--  Controls are self-explanatory. Order can be changed. -->
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        {{-- <button class="pswp__button pswp__button--share" title="Share"></button> --}}
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                        <!-- element will get class pswp__preloader-active when preloader is running -->
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ PhotoSwipe -->
</section>
{{-- --------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------- --}}
{{-- --------------------------------------------------------------- --}}

@if (admin()->can('delete_slider'))

<section id="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">
                        delete images

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


                <div class="card-content collapse ">
                    <div class="card-body card-dashboard">

                        <p class="card-text "> images</p>

                        <div class="show-images">

                            <div class="row text-center show-images-row">
                                @if ($sliders->count() > 0)

                                    @foreach ($sliders as $image)
                                        <div class="col-2 mb-1 image-section-{{ $image->id }}">
                                            <img src="{{ asset($image->image) }}" width="90" height="100" alt="">
                                            <div class="">


                                                @if (admin()->can('delete_slider'))
                                                    <button id="delete-image" data-id="{{ $image->id }}"
                                                        data-action="{{ route('admin.homepage_slider.delete', $image->id) }}"
                                                        class="btn btn-danger  btn-sm " style="margin-top: 3px;padding: 1px; "><i
                                                            class="la la-trash"></i></button>
                                                @endif


                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach

                                @endif


                            </div>


                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endif
