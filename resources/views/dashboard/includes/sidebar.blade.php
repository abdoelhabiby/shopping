<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li
                class="nav-item {{ request()->segment(1) == 'dashboard' && request()->segment(2) == null ? 'active' : '' }}">
                <a href="{{ route('dashboard.home') }}"><i class="la la-home"></i><span class="menu-title"
                        data-i18n="nav.add_on_drag_drop.main">Home
                    </span></a>
            </li>

            {{-- ------------------------start nav item admins------------------------ --}}

            @if (admin()->hasRole('super_admin'))
                <li class="nav-item @if (request()->routeIs(['admins.index', 'admins.create'])) open active @endif }}">

                    @php
                        $module_name = 'admins';
                    @endphp

                    <a href=""><i class="las la-users-cog"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>

                        @php
                            //get count fo admins without superadmins
                            $ids_super_admin = App\Models\Admin::role('super_admin')
                                ->get()
                                ->pluck('id');

                            $count_admins = App\Models\Admin::whereNotIn('id', $ids_super_admin)->count();
                        @endphp
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ $count_admins }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_admin'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_admin'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            {{-- ------------------------end nav item admins------------------------ --}}


            {{-- -----start nav users -------- --}}

            @if (admin()->hasAnyPermission(['read_user', 'create_user']))

                <li class="nav-item @if (request()->routeIs(['users.index', 'users.create'])) open active @endif }}">

                    @php
                        $module_name = 'users';
                    @endphp

                    <a href=""><i class="la la-users"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\User::count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_user'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_user'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

            @endif


            {{-- ------end nav users --------- --}}





            {{-- -----start nav item
            main-categories-------- --}}
            @if (admin()->hasAnyPermission(['read_category', 'create_category']))

                <li class="nav-item @if (request()->routeIs(['main-categories.index', 'main-categories.create'])) open active @endif }}">

                    @php
                        $module_name = 'main-categories';
                    @endphp

                    <a href=""><i class="la la-list"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Category::mainCategory()->count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_category'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_category'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif


                    </ul>
                </li>

            @endif
            {{-- ------end nav item categories--------- --}}

            {{-- -----start nav item
            sub-categories-------- --}}
            @if (admin()->hasAnyPermission(['read_category', 'create_category']))

                <li class="nav-item @if (request()->routeIs(['sub-categories.index', 'sub-categories.create'])) open active @endif }}">

                    @php
                        $module_name = 'sub-categories';
                    @endphp

                    <a href=""><i class="la la-list"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Category::subCategory()->count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_category'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_category'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


                {{-- ------end nav item categories--------- --}}

            @endif



            {{-- -----start nav item barnds-------- --}}

            @if (admin()->hasAnyPermission(['read_brand', 'create_brand']))



                @php
                    $module_name = 'brands';
                @endphp

                <li class="nav-item @if (request()->routeIs(['brands.index','brands.create'])) open active @endif }}">

                    <a href=""><i class="la la-yahoo"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Brand::count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_brand'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_brand'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

            @endif
            {{-- ------end nav item barnds--------- --}}

            {{-- -----start nav item tags-------- --}}

            @if (admin()->hasAnyPermission(['read_tag', 'create_tag']))

                @php
                    $module_name = 'tags';
                @endphp

                <li class="nav-item @if (request()->routeIs(['tags.index','tags.create'])) open active @endif }}">

                    <a href=""><i class="la la-tags"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Tag::count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_tag'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_tag'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

            @endif
            {{-- ------end nav item tags--------- --}}

            {{-- -----start nav item products-------- --}}

            @if (admin()->hasAnyPermission(['read_product', 'create_product']))

                @php
                    $module_name = 'products';
                @endphp


                <li class="nav-item @if (request()->routeIs(['products.index', 'products.create'])) open active @endif }}">

                    <a href=""><i class="las la-tshirt"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Product::count() }}</span>
                    </a>
                    <ul class="menu-content">
                        @if (admin()->can('read_product'))
                            <li class="{{ request()->routeIs($module_name . '.index') ? 'active' : '' }}"><a
                                    class="menu-item" href="{{ route($module_name . '.index') }}"
                                    data-i18n="nav.dash.ecommerce">show all </a>
                            </li>
                        @endif
                        @if (admin()->can('create_product'))
                            <li class="{{ request()->routeIs($module_name . '.create') ? 'active' : '' }}">
                                <a class="menu-item" href="{{ route($module_name . '.create') }}"
                                    data-i18n="nav.dash.crypto">
                                    add
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

            @endif
            {{-- ------end nav item products--------- --}}



            {{-- -----start nav orders -------- --}}
            @if (admin()->can('read_order'))
                @php
                    $module_name = 'orders';
                @endphp

                <li class="nav-item @if (request()->routeIs('dashboard.orders.index')) open active @endif }}">

                    <a href="">
                        {{-- <i class="la la-cart"></i> --}}
                        <i class="las la-shopping-bag"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Order::count() }}</span>
                    </a>
                    <ul class="menu-content">


                        <li class="{{ request()->routeIs('dashboard.orders.index') ? 'active' : '' }}"><a
                                class="menu-item" href="{{ route('dashboard.' . $module_name . '.index') }}"
                                data-i18n="nav.dash.ecommerce">show all </a>
                        </li>

                    </ul>
                </li>
            @endif

            {{-- ------end nav orders --------- --}}


            {{-- -----start nav item -------- --}}
            {{-- ------end nav item --------- --}}
            {{-- -----start nav item -------- --}}
            {{-- ------end nav item --------- --}}
            {{-- -----start nav item -------- --}}
            {{-- ------end nav item --------- --}}






            {{-- -----start nav item settings-------- --}}

            @if (admin() && admin()->can('read_slider'))
                <li class="nav-item @if (request()->routeIs('admin.homepage_slider.index')) active open @endif">

                    @php
                        $module_name = 'settings';
                    @endphp

                    <a href=""><i class="la la-cog"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if (request()->routeIs('admin.homepage_slider.index')) active @endif">
                            <a class="menu-item" href="{{ route('admin.homepage_slider.index') }}"
                                data-i18n="nav.dash.ecommerce">Home Page slider </a>
                        </li>
                        <li class="">
                            <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">sett 2 </a>
                        </li>



                    </ul>
                </li>
            @endif

            {{-- ------end nav item settings--------- --}}




        </ul>
    </div>
</div>
