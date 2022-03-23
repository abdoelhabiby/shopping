<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">
                    <div class="detail-email d-flex align-items-center justify-content-center">
                        <i class="icon-email"></i>
                        <p>Email : </p>
                        <span>
                            support@gmail.com
                        </span>
                    </div>
                    <div class="detail-call d-flex align-items-center justify-content-center">
                        <i class="icon-deal"></i>
                        <p>Today Deals </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">





                    @auth('web')



                        <div class="register-sign">
                            <a class="account" href="{{ route('front.profile') }}"
                                title="{{ __('front.profile') }}" rel="nofollow"><span>{{auth()->user()->name}}</span></a>

                            <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('front.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>



                    @else

                        <div class="register-out">

                            <i class="zmdi zmdi-account"></i>
                            <a class="register" href="{{ route('register') }}" data-link-action="display-register-form">
                                Register
                            </a>
                            <span class="or-text">or</span>
                            <a class="login" href="{{ route('login') }}" rel="nofollow"
                                title="Log in to your customer account">Login in</a>

                        </div>
                    @endauth






                    <div id="_desktop_language_selector"
                        class="language-selector groups-selector hidden-sm-down language-selector-dropdown">

                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            role="main">
                            <span class="expand-more">
                                <img class="img-fluid"
                                    src="{{ asset('front') }}/img/{{ LaravelLocalization::getCurrentLocale() }}.jpg"
                                    alt="{{ __('front.' . LaravelLocalization::getCurrentLocale()) }}" width="16"
                                    height="11">
                            </span>
                        </div>

                        <div class="language-list dropdown-menu">
                            <div class="language-list-content text-left">


                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                    <div class="language-item current flex-first">
                                        <div class="current">
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <img class="img-fluid"
                                                    src="{{ asset('front') }}/img/{{ $localeCode }}.jpg"
                                                    alt="{{ __('front.' . $localeCode) }}" width="16" height="11">

                                                <span>{{ $properties['native'] }}</span>
                                            </a>
                                        </div>
                                    </div>




                                @endforeach






                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
