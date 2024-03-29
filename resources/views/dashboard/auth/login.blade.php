<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection=">

<head>
    <meta http-equiv=" Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description"
    content="Modern {{ asset('admin') }} is super flexible, powerful, clean &amp; modern responsive bootstrap 4 {{ asset('admin') }} template with unlimited possibilities with bitcoin dashboard.">
<meta name="keywords"
    content="{{ asset('admin') }} template, modern {{ asset('admin') }} template, dashboard template, flat {{ asset('admin') }} template, responsive {{ asset('admin') }} template, web app, crypto dashboard, bitcoin dashboard">
<meta name="author" content="PIXINVENT">
<title>Admin Login </title>
<link rel="apple-touch-icon" href="{{ asset('admin') }}/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin') }}/images/ico/favicon.ico">
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/vendors.css">
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/forms/icheck/custom.css">
<!-- END VENDOR CSS-->
<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/app.css">
<!-- END MODERN CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/pages/login-register.css">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/style.css">
<!-- END Custom CSS-->
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Cairo', sans-serif;
    }

</style>
</head>

<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click"
    data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">



                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1">
                                            <img src="{{ asset('admin/images/logo/logo.png') }}" alt="LOGO" />

                                        </div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span> Login To Dashboard </span>
                                    </h6>
                                </div>



                                <!-- begin alet section-->
                                @if (session()->has('login_error'))
                                    <div class="row mr-2 ml-2">
                                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                            id="type-error"> {{ session()->get('login_error') }}
                                        </button>
                                    </div>
                                @endif




                                <!-- end alet section-->

                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple"
                                            action="{{ route('dashboard.login') }}" method="post">
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" name="email"
                                                    class="form-control form-control-lg input-lg" value="" id="email"
                                                    placeholder="email " required>
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror






                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" required
                                                    class="form-control form-control-lg input-lg" id="user-password"
                                                    placeholder="Password">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror

                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-md-left">
                                                    <fieldset>
                                                        <input type="checkbox" name="remember_me" id="remember-me"
                                                            class="chk-remember">
                                                        <label for="remember-me"> remember me</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i>
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('admin') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('admin') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('admin') }}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ asset('admin') }}/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('admin') }}/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <script>

    </script>
</body>

</html>
