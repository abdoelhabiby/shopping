@extends('layouts.dashboard')


@php
$model_name = 'products';
@endphp

@section('title')
    | dashboard | {{ $model_name }} | create
@endsection





@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">home </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route($model_name . '.index') }}">
                                        {{ $model_name }} </a>
                                </li>
                                <li class="breadcrumb-item active"> add
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> add {{ Str::singular($model_name) }}
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

                                <div class="card-content collapse show">
                                    <div class="card-body">




                                        <form class="form" action="{{ route($model_name . '.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="la la-connectdevelop"></i>
                                                    {{ Str::singular($model_name) }} data
                                                </h4>

                                                <div class="row">

                                                    @foreach (supportedLanguages() as $index => $language)

                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label for="name-{{ $language }}"> {{ 'name ' . $language }}
                                                                </label>
                                                                <input type="text" value="{{ old('name.' . $language) }}"
                                                                    id="name-{{ $language }}" class="form-control"
                                                                    placeholder="input {{ 'name ' . $language }}   "
                                                                    name="name[{{ $language }}]">
                                                                @error("name." . $language )
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    @endforeach


                                                </div>

                                                <div class="row">

                                                    {{-- -----slug -----
                                                    --}}
                                                    <div class="col-md-6">
                                                        @php
                                                        $input = 'slug';
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> {{ $input }} </label>
                                                            <input type="text" value="{{ old($input) }}" id="{{ $input }}"
                                                                class="form-control" placeholder="input {{ $input }}  "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- -----sku -----
                                                    --}}
                                                    <div class="col-md-6">
                                                        @php
                                                        $input = 'sku';
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> {{ $input }} </label>
                                                            <input type="text" value="{{ old($input) }}" id="{{ $input }}"
                                                                class="form-control" placeholder="input {{ $input }}  "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>



                                                {{-- description----------
                                                --}}

                                                <div class="row">

                                                    @foreach (supportedLanguages() as $index => $language)

                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label for="description-{{ $language }}">
                                                                    {{ 'description ' . $language }}
                                                                </label>

                                                                <textarea type="text" id="description-{{ $language }}"
                                                                    class="form-control" rows="5"
                                                                    placeholder="input {{ 'description ' . $language }}"
                                                                    name="description[{{ $language }}]">{{ old('description.' . $language) }}</textarea>

                                                                @error("description." . $language )
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    @endforeach


                                                </div>



                                                {{-- -----------------------
                                                --}}


                                                <div class="row">

                                                    {{-- ------------sub category------
                                                    --}}


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="categories"> Categories</label>

                                                            <select name="categories[]" class="select2 form-control "
                                                                multiple="" tabindex="-1" aria-hidden="true">

                                                                @isset($sub_categories)
                                                                    @if ($sub_categories->count() > 0)

                                                                        @foreach ($sub_categories as $category)
                                                                            <option value="{{ $category->id }}"
                                                                                @if(old('categories') && is_array(old('categories')))

                                                                                {{ in_array($category->id,old('categories')) ? 'selected' : '' }}

                                                                                @endif

                                                                                >
                                                                                {{ $category->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option disabled> add category</option>
                                                                    @endif
                                                                @endisset
                                                            </select>


                                                            @error('categories')
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    {{-- ------brand------- --}}

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="brand">brand</label>

                                                            <select name="brand_id"
                                                                class="select2  form-control "
                                                                id="single-placeholder" tabindex="-1" aria-hidden="true">

                                                                <option disabled selected>Select brand</option>

                                                                @isset($brands)

                                                                    @if ($brands->count() > 0)

                                                                        @foreach ($brands as $brand)
                                                                            <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id') ? 'selected' : '' }}>
                                                                                {{ $brand->name }}
                                                                            </option>

                                                                        @endforeach

                                                                    @else
                                                                        <option disabled> add brand</option>
                                                                    @endif

                                                                @endisset


                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror

                                                        </div>
                                                    </div>


                                                    {{-- ------------tags------
                                                    --}}


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tags">Tags</label>

                                                            <select name="tags[]" class="select2 form-control " multiple=""
                                                                tabindex="-1" aria-hidden="true">
                                                                @isset($tags)
                                                                    @if ($tags->count() > 0)

                                                                        @foreach ($tags as $tag)
                                                                            <option value="{{ $tag->id }}">
                                                                                {{ $tag->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @else
                                                                        <option disabled> no found any records tags</option>
                                                                    @endif
                                                                @endisset
                                                            </select>


                                                            @error('tags')
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>



                                                <div class="row">




                                                    <div class="col-md-12">
                                                        @php
                                                        $input = 'meta_keywords';
                                                        @endphp
                                                        <div class="form-group">
                                                            <label for="{{ $input }}"> meta keywords </label>
                                                            <input type="text" value="{{ old($input) }}" id="{{ $input }}"
                                                                class="form-control" placeholder="input meta keywords   "
                                                                name="{{ $input }}">
                                                            @error($input)
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>




                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="fom-group">


                                                            <label>
                                                                <input type="checkbox" checked name="is_active" value="true"
                                                                    > active
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>






                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                        <i class="ft-x"></i> back
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> save
                                                    </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection

@section('js')

<script>

</script>

@endsection
