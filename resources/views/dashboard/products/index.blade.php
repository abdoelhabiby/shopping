@extends('layouts.dashboard')


@php
$model_name = 'products';
@endphp


@section('title')
    | dashboard | {{ $model_name }}
@endsection

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">home</a>
                                </li>
                                <li class="breadcrumb-item active"> {{ $model_name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{ $model_name }}</h4>

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


                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">

                                        <div class=" table-header ">
                                            <div class="buttons float-left  mb-1">
                                                @if ($products->count() > 0)
                                                    <button class="btn btn-primary  printMe">Print <i
                                                            class="la la-print"></i></button>
                                                @endif

                                                @if (admin()->can('create_product'))
                                                    <button class="btn btn-primary ">
                                                        <a href="{{ route($model_name . '.create') }}"
                                                            class="text-white">
                                                            Create <i class="la la-plus"></i>
                                                        </a>
                                                    </button>
                                                @endif


                                                <button class="btn btn-primary ">
                                                    <a href="" class="text-white">
                                                        products deleted !!
                                                    </a>
                                                </button>



                                            </div>

                                            <div class="float-right  mb-1">

                                                <form action="{{ route('products.index') }}" method="GET">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="search" placeholder="search"
                                                        aria-describedby="button-addon2"  value="{{ request()->search }}">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-primary" type="submit">
                                                            <i class="la la-search"></i>
                                                          </button>
                                                        </div>
                                                      </div>
                                                </form>

                                                {{-- <form action="{{ route('products.index') }}" method="get"
                                                    id="form-search">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-primary" type="submit"><i
                                                                    class="la la-search"></i></button>
                                                        </div>

                                                        @php
                                                            $value = '';
                                                            foreach ($search_by as $by) {
                                                                if (request()->query($by)) {
                                                                    $value = request()->$by;
                                                                }
                                                            }
                                                        @endphp

                                                        <input type="text" class="form-control" placeholder="search"
                                                            aria-label="search" name="search" value="{{ $value }}">

                                                        <div class="input-group-append">


                                                            <select name="product" class="text-white bg-primary"
                                                                id="select-serach-type">
                                                                @foreach ($search_by as $by)
                                                                    <option value="{{ $by }}"
                                                                        {{ request()->query($by) ? 'selected' : '' }}>
                                                                        {{ $by }}
                                                                    </option>
                                                                @endforeach

                                                            </select>


                                                        </div>
                                                    </div>

                                                </form> --}}

                                            </div>

                                            <div class="clearfix"></div>
                                        </div>




                                        <table class="table tabel-print " style="width: 100%">
                                            <thead>
                                                <th>ID</th>
                                                <th>Slug</th>
                                                <th>Name</th>
                                                <th class="no-print-this">Images</th>
                                                <th>quantity</th>
                                                {{-- <th>brand</th> --}}
                                                <th>is active</th>
                                                {{-- <th>categories</th> --}}
                                                {{-- <th>tags</th> --}}
                                                <th class="no-print-this">Attributes</th>
                                                <th class="no-print-this">Action</th>
                                            </thead>

                                            <tbody>
                                                @isset($products)

                                                    @if ($products->count() > 0)
                                                        @foreach ($products as $key => $product)
                                                            <tr>
                                                                <td>{{ $product->id }}</td>
                                                                <td>{{ $product->slug }}</td>
                                                                <td>{{ $product->name }}</td>
                                                                <td class="no-print-this">
                                                                    <a
                                                                        href="{{ route('product.images.index', $product->slug) }}">
                                                                        <i class="la la-image"></i>
                                                                    </a>
                                                                </td>
                                                                <td>{{ $product->attributes->sum('qty') }}</td>

                                                                {{-- <td>
                                                                    {{ $product->brand->name }}</td> --}}
                                                                <td>{{ $product->is_active }}</td>
                                                                {{-- <td>
                                                                    @if ($product->categories->count() > 0)
                                                                        @foreach ($product->categories as $category)
                                                                            {{ $category->name }}
                                                                            @if (!$loop->last)
                                                                                |
                                                                            @endif

                                                                        @endforeach
                                                                    @endif
                                                                </td> --}}
                                                                {{-- <td>
                                                                    @if ($product->tags->count() > 0)
                                                                        @foreach ($product->tags as $tag)
                                                                            {{ $tag->name }}
                                                                            @if (!$loop->last)
                                                                                |
                                                                            @endif

                                                                        @endforeach
                                                                    @endif
                                                                </td> --}}

                                                                <td class="no-print-this">

                                                                    <a href="{{ route('product.attibutes.index', $product->slug) }}"
                                                                        class="btn btn-outline-info btn-sm">
                                                                        Attributes
                                                                    </a>
                                                                </td>

                                                                <td class="no-print-this">
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">

                                                                        @if (admin()->can('update_product'))
                                                                            <a href="{{ route($model_name . '.edit', $product->id) }}"
                                                                                class="">
                                                                                <i class="la la-edit"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if (admin()->can('delete_product'))
                                                                            <a type="button" id="button_delete"
                                                                                data-action="{{ route($model_name . '.destroy', $product->id) }}"
                                                                                data-name="{{ $product->name }}"
                                                                                class="text-danger">
                                                                                <i class="la la-trash"></i>
                                                                            </a>
                                                                        @endif

                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="text-center">
                                                            <td colspan="10">No matching records found </td>
                                                        </tr>
                                                    @endif



                                                @endisset


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


        <div class="d-flex justify-content-center mt-5">

            {{ $products->appends(request()->query())->links() }}

        </div>

    </div>

    <!-- Modal delete -->

    @include('dashboard.includes.alerts.model_delete')


@endsection


@push('scripts')
    <script type="text/javascript" src="{{ asset('admin/js/printThis.js') }}"></script>
@endpush

@section('js')

    <script>
        //-------------------------------------------------

        $("#select-serach-type").on('change', function() {
            $(this).attr('name', $(this).val());
        });


        //-------------------form submit search------------------

        $("#form-search").submit(function(e) {

            e.preventDefault();

            var type_search = $("#select-serach-type").val();
            var search = $(this).find('input[name="search"]').val();
            var url = $(this).attr('action') + "?" + type_search + "=" + search;

            window.location = url;

        })



        //-------------------------------------------------

        $(".printMe").click(function() {

            $('.tabel-print').printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: "{{ asset('css/print-this-style.css') }}",
                printDelay: 333, // variable print delay
                header: "<h4>Products</h4>", // prefix to html
                footer: null,
            });
        });
    </script>
@stop
