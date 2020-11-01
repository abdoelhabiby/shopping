<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li
                class="nav-item {{ request()->segment(1) == 'dashboard' && request()->segment(2) == null ? 'active' : '' }}">
                <a href="{{ route('dashboard.home') }}"><i class="la la-home"></i><span class="menu-title"
                        data-i18n="nav.add_on_drag_drop.main">Home
                    </span></a>
            </li>

            {{-- ------------------------start nav item admins------------------------
            --}}

            @if (admin()->hasRole('super_admin'))



                <li class="nav-item {{ isActive('admins') }}">

                    @php
                    $module_name = 'admins';
                    @endphp

                    <a href=""><i class="la la-users"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                        <span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Admin::role('admin')->count() }}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('admins.index') }}"
                                data-i18n="nav.dash.ecommerce">show all </a>
                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('admins.create') }}" data-i18n="nav.dash.crypto">
                                add
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            {{-- ------------------------end nav item admins------------------------
            --}}


            {{-- -----start nav users ----------}}
            <li class="nav-item {{ isActive('users') }}">

                @php
                $module_name = 'users';
                @endphp

                <a href=""><i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\User::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>
            {{-- ------end nav users -----------}}





            {{-- -----start nav item
            main-categories----------}}

            <li class="nav-item {{ isActive('main-categories') }}">

                @php
                $module_name = 'main-categories';
                @endphp

                <a href=""><i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Category::mainCategory()->count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>


            {{-- ------end nav item categories-----------}}

            {{-- -----start nav item
            sub-categories----------}}

            <li class="nav-item {{ isActive('sub-categories') }}">

                @php
                $module_name = 'sub-categories';
                @endphp

                <a href=""><i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Category::subCategory()->count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>


            {{-- ------end nav item categories-----------}}





            {{-- -----start nav item barnds----------}}

            @php
            $module_name = 'brands';
            @endphp

            <li class="nav-item {{ isActive($module_name) }}">

                <a href=""><i class="la la-yahoo"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Brand::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>
            {{-- ------end nav item barnds-----------}}

            {{-- -----start nav item tags----------}}

            @php
            $module_name = 'tags';
            @endphp

            <li class="nav-item {{ isActive($module_name) }}">

                <a href=""><i class="la la-tags"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Tag::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>
            {{-- ------end nav item tags-----------}}

            {{-- -----start nav item products----------}}

            @php
            $module_name = 'products';
            @endphp

            <li class="nav-item {{ isActive($module_name) }}">

                <a href=""><i class="la la-connectdevelop"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ App\Models\Product::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{ route($module_name . '.index') }}"
                            data-i18n="nav.dash.ecommerce">show all </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route($module_name . '.create') }}" data-i18n="nav.dash.crypto">
                            add
                        </a>
                    </li>
                </ul>
            </li>
            {{-- ------end nav item products-----------}}



            {{-- -----start nav item ----------}}
            {{-- ------end nav item -----------}}
            {{-- -----start nav item ----------}}
            {{-- ------end nav item -----------}}
            {{-- -----start nav item ----------}}
            {{-- ------end nav item -----------}}
            {{-- -----start nav item ----------}}
            {{-- ------end nav item -----------}}






            {{-- -----start nav item settings----------}}
            <li class="nav-item {{ isActive('users') }}">

                @php
                $module_name = 'settings';
                @endphp

                <a href=""><i class="la la-cog"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{ ucfirst($module_name) }}</span>
                </a>
                <ul class="menu-content">
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">sett 1 </a>
                    </li>
                    <li class="">
                        <a class="menu-item" href="" data-i18n="nav.dash.ecommerce">sett 2 </a>
                    </li>



                </ul>
            </li>
            {{-- ------end nav item settings-----------}}




        </ul>
    </div>
</div>
