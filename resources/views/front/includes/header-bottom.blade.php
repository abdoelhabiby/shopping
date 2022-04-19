{{-- {{ dd($main_categories->first()->select('slug')) }} --}}

<div class="header-bottom hidden-sm-down">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="contentsticky_verticalmenu verticalmenu-main col-lg-3 col-md-1 d-flex"
                data-textshowmore="Show More" data-textless="Hide" data-desktop_item="4">
                <div class="toggle-nav d-flex align-items-center justify-content-start">
                    <span class="btnov-lines"></span>
                    <span>{{ __('front.shop_by_categories') }}</span>
                </div>
                <div class="verticalmenu-content has-showmore ">
                    <div id="_desktop_verticalmenu" class="nov-verticalmenu block" data-count_showmore="6">
                        <div class="box-content block_content">
                            <div id="verticalmenu" class="verticalmenu" role="navigation">
                                <ul class="menu level1">


                                    @isset($main_categories_home)

                                        @if ($main_categories_home->count() > 0)

                                            @foreach ($main_categories_home as $main_category)


                                                @if ($main_category->chields->count() > 0)


                                                    <!-- ---- main categories-----------  -->

                                                    <li class="item  parent group">
                                                        <a href="{{route('front.main_category.show',$main_category->slug)}}" class="p-0 m-0" title="{{ $main_category->name }}">

                                                            {{-- <i class="hasicon nov-icon"
                                                                style=""></i> --}}

                                                            {{ $main_category->name }}
                                                        </a>

                                                        <span class="show-sub fa-active-sub"></span>
                                                        <!-- - short description-- - -->
                                                        <span class="menu-sub text-highlight">
                                                            @foreach ($main_category->chields as $index => $subcategory)

                                                                @if ($subcategory->chields->count() > 0)


                                                                    @if ($index < 3)
                                                                        {{ $subcategory->name }} ,
                                                                    @endif
                                                                    @if ($loop->last)
                                                                        {{ __('front.etc') }}
                                                                    @endif

                                                                @endif

                                                            @endforeach

                                                        </span>

                                                        <!-- ---- sub categories-----------  -->



                                                        <div class="dropdown-menu  " style="width:922px">


                                                            <ul>
                                                                <li class="item group-list-category">
                                                                    <div class="menu-content">

                                                                        <div class="row">

                                                                            @foreach ($main_category->chields as $subcategory)

                                                                                @if ($subcategory->chields->count() > 0)

                                                                                    <div class="col-lg-3 col-12 ">
                                                                                        <a href="{{route('front.subcategory.show',$subcategory->slug)}}"
                                                                                            class="title-category d-flex justify-content-start">
                                                                                           {{ $subcategory->name }}
                                                                                        </a>
                                                                                        <ul class="">
                                                                                            @foreach ($subcategory->chields as $category)

                                                                                                    <li>
                                                                                                        <a class="d-flex justify-content-start"
                                                                                                            href="{{route('front.category.show',[$subcategory->slug,$category->slug])}}">{{ $category->name }} </a>
                                                                                                    </li>



                                                                                            @endforeach

                                                                                        </ul>
                                                                                    </div>

                                                                                @else

                                                                                @endif

                                                                            @endforeach


                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>


                                                        </div>






                                                    </li>


                                                @else





                                                @endif



                                            @endforeach

                                        @endif

                                    @endisset





                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-11 header-menu d-flex align-items-center justify-content-start">
                <div class="header-menu-search d-flex justify-content-between w-100 align-items-center">

                    <div id="_desktop_top_menu">

                    </div>

                    <div class="advencesearch_header " style="padding-top: 7px;  padding-bottom: 7px;">
                        <span class="toggle-search hidden-lg-up"><i class="zmdi zmdi-search"></i></span>
                        <div id="_desktop_search" class="contentsticky_search">
                            <!-- block seach mobile -->
                            <!-- Block search module TOP -->
                            <div id="desktop_search_content" >
                                <form method="get"
                                    action="{{ route('front.catalog.search') }}"
                                    id="searchbox" class="form-novadvancedsearch">



                                    <div class="input-group">
                                        <input type="text" id="search_catalog"
                                            class="search_query ui-autocomplete-input form-control" name="q"
                                            value="" placeholder="{{ __('front.search_product_and_category') }}">


                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit" >
                                                <i class="fa fa-search"></i></button>
                                        </span>
                                    </div>

                                </form>
                            </div>
                            <!-- /Block search module TOP -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
