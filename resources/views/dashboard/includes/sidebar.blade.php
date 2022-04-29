{{-- <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"> --}}

<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">





            {{-- ---------------------use componenet ----------------- --}}
            {{-- -------------------home----------------------- --}}
            <x-dashboard.sidbar-item name="home" :one-list="true" route-name-open="dashboard.home">
                <x-slot name="icon"> <i class="la la-home"></i> </x-slot>
            </x-dashboard.sidbar-item>


            {{-- ------------------------------------------ --}}

            {{-- ------------------------start nav item admins------------------------ --}}

            @if (admin()->hasAnyPermission(['read_admin', 'create_admin']))

                @php  $module_name = 'admins';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*"
                    count="{{ App\Models\Admin::notRole('super_admin')->count() }}">
                    <x-slot name="icon"> <i class="las la-users-cog"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_admin'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_admin'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>

            @endif


            {{-- ------------------------end nav item admins------------------------ --}}




            {{-- ----------------------------------------- --}}







            {{-- -----start nav users -------- --}}

            @if (admin()->hasAnyPermission(['read_user', 'create_user']))


                @php  $module_name = 'users';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*" count="{{ App\Models\User::count() }}">
                    <x-slot name="icon"> <i class="las la-users"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_user'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_user'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>



            @endif


            {{-- ------end nav users --------- --}}





            {{-- -----start nav item
            main-categories-------- --}}
            @if (admin()->hasAnyPermission(['read_category', 'create_category']))

                @php  $module_name = 'main-categories';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*"
                    count="{{ App\Models\Category::mainCategory()->count() }}">
                    <x-slot name="icon"> <i class="las la-list"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_category'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_category'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>



            @endif
            {{-- ------end nav item categories--------- --}}

            {{-- -----start nav item
            sub-categories-------- --}}
            @if (admin()->hasAnyPermission(['read_category', 'create_category']))


                @php  $module_name = 'sub-categories';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*"
                    count="{{ App\Models\Category::subCategory()->count() }}">
                    <x-slot name="icon"> <i class="las la-list"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_category'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_category'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>



                {{-- ------end nav item categories--------- --}}

            @endif



            {{-- -----start nav item barnds-------- --}}

            @if (admin()->hasAnyPermission(['read_brand', 'create_brand']))


                @php  $module_name = 'brands';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*" count="{{ App\Models\Brand::count() }}">
                    <x-slot name="icon"> <i class="las la-dove"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_brand'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_brand'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>


            @endif
            {{-- ------end nav item barnds--------- --}}

            {{-- -----start nav item tags-------- --}}

            @if (admin()->hasAnyPermission(['read_tag', 'create_tag']))

                @php  $module_name = 'tags';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="{{ $module_name }}.*" count="{{ App\Models\Tag::count() }}">
                    <x-slot name="icon"> <i class="las la-tags"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_tag'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_tag'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>


            @endif
            {{-- ------end nav item tags--------- --}}

            {{-- -----start nav item products-------- --}}

            @if (admin()->hasAnyPermission(['read_product', 'create_product']))


                @php  $module_name = 'products';  @endphp

                @php
                    $routes = ['product.images.*', $module_name . '.*'];
                @endphp
                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false" :route-name-open="$routes"
                    count="{{ App\Models\Product::count() }}">
                    <x-slot name="icon"> <i class="las la-tshirt"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_product'))
                            <x-dashboard.sidbar-item-list name="show all" route-name="{{ $module_name }}.index" />
                        @endif
                        @if (admin()->can('create_product'))
                            <x-dashboard.sidbar-item-list name="add" route-name="{{ $module_name }}.create" />
                        @endif
                    </ul>

                </x-dashboard.sidbar-item>



            @endif
            {{-- ------end nav item products--------- --}}



            {{-- -----start nav orders -------- --}}
            @if (admin()->can('read_order'))


                @php  $module_name = 'orders';  @endphp

                <x-dashboard.sidbar-item name="{{ $module_name }}" :one-list="false"
                    route-name-open="dashboard.{{ $module_name }}.*" count="{{ App\Models\Order::count() }}">
                    <x-slot name="icon"> <i class="las la-tshirt"></i> </x-slot>
                    <ul class="menu-content">
                        @if (admin()->can('read_order'))
                            <x-dashboard.sidbar-item-list name="show all"
                                route-name="dashboard.{{ $module_name }}.index" />
                        @endif

                    </ul>

                </x-dashboard.sidbar-item>


            @endif

            {{-- ------end nav orders --------- --}}

            {{-- -----start nav item notifications-------- --}}

            @php
                $module_name = 'notifications';
                $count = 0;
                if (isset($navbar['notify_count'])) {
                    $count = $navbar['notify_count'];
                }

            @endphp

            <x-dashboard.sidbar-item name="notifications" :one-list="true" route-name-open="dashboard.notifications.index">
                <x-slot name="icon"> <i class="ficon ft-bell"></i> </x-slot>
            </x-dashboard.sidbar-item>







            {{-- ------end nav item notifications--------- --}}



            {{-- -----start nav item Logs-------- --}}

            @if(admin()->hasRole('super_admin'))



            <x-dashboard.sidbar-item name="Logs" :one-list="true" route-name-open="dashboard.logs">
                <x-slot name="icon"> <i class="las la-exclamation-triangle"></i></x-slot>
            </x-dashboard.sidbar-item>
            @endif





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




                    </ul>
                </li>
            @endif

            {{-- ------end nav item settings--------- --}}




        </ul>
    </div>
</div>
