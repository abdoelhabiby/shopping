
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Gallery Media Grid - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template +
    Bitcoin Dashboard</title>
  <link rel="apple-touch-icon" href="{{ asset('admin') }}/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin') }}/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/default-skin/default-skin.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/app.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/pages/gallery.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/style.css">
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="2-columns">
  <!-- fixed-top-->

  <!-- ////////////////////////////////////////////////////////////////////////////-->

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">Gallery Media Grid</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Gallery</a>
                </li>
                <li class="breadcrumb-item active">Gallery Media Grid
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
            id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"><i class="ft-settings icon-left"></i> Settings</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Cards</a><a class="dropdown-item"
              href="component-buttons-extended.html">Buttons</a></div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Description -->

        <!--/ Description -->
        <!-- Image grid -->
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
                <p>Image gallery grid with photo-swipe integration. Display images gallery
                  in 4-2-1 columns and photo-swipe provides gallery features.</p>
              </div>
            </div>
            <div class="card-body  my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
              <div class="row">
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/1.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/1.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/2.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/2.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/3.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/3.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/4.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/4.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>

                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/5.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/5.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/6.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/6.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/7.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/7.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/8.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/8.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
              </div>
              <div class="row">
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/9.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/9.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/10.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/10.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/11.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/11.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/12.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/12.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
              </div>
              <div class="row">
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/13.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/13.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/14.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/14.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/15.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/15.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
                <figure class="col-lg-3 col-md-6 col-12" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                  <a href="{{ asset('admin') }}/images/gallery/16.jpg" itemprop="contentUrl" data-size="480x360">
                    <img class="img-thumbnail img-fluid" src="{{ asset('admin') }}/images/gallery/16.jpg"
                    itemprop="thumbnail" alt="Image description" />
                  </a>
                </figure>
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
                    <button class="pswp__button pswp__button--share" title="Share"></button>
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
        <!--/ Image grid -->
        <!-- Video grid -->

        <!-- Video grid -->
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">PIXINVENT </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="{{ asset('admin') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{ asset('admin') }}/vendors/js/gallery/masonry/masonry.pkgd.min.js"
  type="text/javascript"></script>
  <script src="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe.min.js"
  type="text/javascript"></script>
  <script src="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('admin') }}/js/core/app-menu.js" type="text/javascript"></script>
  <script src="{{ asset('admin') }}/js/core/app.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ asset('admin') }}/js/scripts/gallery/photo-swipe/photoswipe-script.js"
  type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>
