<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>



    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content=" ">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Shopping @yield('title') </title>
    <link rel="apple-touch-icon" href="{{ asset('admin') }}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin') }}/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">



        <link rel="stylesheet" href="{{ asset('admin/line-awesome-1.3.0/1.3.0/css/line-awesome.min.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/plugins/animate/animate.css"> --}}
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/vendors.css">


    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/forms/icheck/custom.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/chartist-plugin-tooltip.css">



    {{-- --------------------rtl ---------------------------
    --}}

    {{-- @if ('rtl' == 'test rtl')
        --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/core/menu/menu-types/vertical-menu.css">

              <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/default-skin/default-skin.css">
  <!-- END VENDOR CSS-->

        <!-- END VENDOR CSS-->
        <!-- BEGIN MODERN CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/app.css">
        {{--
        <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css-rtl/custom-rtl.css">
        --}}
        <!-- END MODERN CSS-->
        <!-- BEGIN Page Level CSS-->

        {{--
    @endif --}}



    {{-- ----------------------------end rtl
    ------------------------------------------------- --}}


    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/dropzone.css">




    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/style.css">
    <!-- END Custom CSS-->

    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .unread {
            background: #EEE
        }

    </style>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">



    <script src="https://unpkg.com/sweetalert2@7.12.10/dist/sweetalert2.all.js"></script>

    <script src="  https://printjs-4de6.kxcdn.com/print.min.js"></script>


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" /> --}}

    @yield('css')
    @stack('css')
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-col="2-columns">
    <!-- fixed-top-->

    <!-- Begin Header -->
    @include('dashboard.includes.nav')
    <!--End  Header -->

    <!-- Begin SideBar-->

    @include('dashboard.includes.sidebar')

    <!--End Sidebare-->


    {{-- -------- start content --}}

    @yield('content')


    {{-- -------- end content --}}


    {{-- -------- start footer --}}

    @include('dashboard.includes.footer')

    {{-- -------- end footer --}}




    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('admin') }}/vendors/js/vendors.min.js" type="text/javascript"></script>

      <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{ asset('admin') }}/vendors/js/gallery/masonry/masonry.pkgd.min.js"
  type="text/javascript"></script>
  <script src="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe.min.js"
  type="text/javascript"></script>
  <script src="{{ asset('admin') }}/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('admin') }}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript">
    </script>

    <script src="{{ asset('admin') }}/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript">
    </script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('admin') }}/vendors/js/charts/chart.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script>


    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('admin') }}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/js/core/app.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/js/scripts/customizer.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{ asset('admin') }}/js/scripts/pages/dashboard-crypto.js"
        type="text/javascript"></script> --}}

  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{ asset('admin') }}/js/scripts/gallery/photo-swipe/photoswipe-script.js"
  type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
    <script src="{{ asset('admin') }}/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->





    <script src="{{ asset('admin/js/dropzone.min.js') }}"></script>

    <script src="{{ asset('admin') }}/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>

    <script src="{{ asset('admin') }}/js/scripts/forms/form-repeater.js" type="text/javascript"></script>

    <script src="{{ asset('admin/js/custom.js') }}"></script>







    @yield('admin_notification_in_include_nav')



    @stack('scripts')

    @yield('js')




</body>

</html>
