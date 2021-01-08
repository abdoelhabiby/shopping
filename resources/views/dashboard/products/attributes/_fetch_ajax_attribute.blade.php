<div class="tabel-print">

    <table class="table  table-responsive">
        <thead>
            <th>#</th>
            <th>Sku</th>
            <th>Name</th>
            <th>quantity</th>
            <th>purchase price</th>
            <th>price</th>
            <th>price offer</th>
            <th>start offer at</th>
            <th>end offer at</th>
            <th>is active</th>
            <th class="no-print-this">Action</th>



        </thead>

        <tbody>


            @isset($product->attributes)

                @if ($product->attributes->count() > 0)
                    @foreach ($product->attributes as $index => $attribute)




                        <tr>

                            <td>
                                {{ orderNumberOfRows() + $index + 1 }}
                            </td>
                            <td>{{ $attribute->sku }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->qty }}</td>
                            <td>{{ $attribute->purchase_price }}</td>
                            <td>{{ $attribute->price }}</td>
                            <td>{{ $attribute->price_offer }}</td>
                            <td>{{ $attribute->start_offer_at }}</td>
                            <td>{{ $attribute->end_offer_at }}</td>
                            <td>{{ $attribute->is_active }}</td>




                            <td class="no-print-this">
                                <div class="btn-group" role="group" aria-label="Basic example">



                                    <a href="javascript:void(0);" class="" data-toggle="modal" data-target="#attribute-modal-{{$attribute->id}}">
                                        <i class="la la-edit"></i>
                                    </a>


                                    <div class="modal fade bd-example-modal-lg" id="attribute-modal-{{$attribute->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">

                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Upadte attribute
                                                        {{ $attribute->name }}
                                                    </h4>
                                                    <button type="button" class="close close-edit-attribute" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <form class="form "
                                                    action="{{ route('product.attibutes.update', [$product->id, $attribute->id]) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')

                                                    <div class="modal-body">

                                                        <div class="alert alert-danger alert-dismissible fade show display-errors d-none"
                                                            role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>




                                                        <div class="form-body">

                                                            <div class="row">


                                                                @foreach (supportedLanguages() as $index => $language)

                                                                    <div class="col-md-3">

                                                                        <div class="form-group">
                                                                            <label>
                                                                                {{ 'name ' . $language }}
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="input size {{ 'name ' . $language }}   "
                                                                                name="name[{{ $language }}]"
                                                                                value="{{ $attribute->translate($language)->name ?? '' }} ">

                                                                        </div>
                                                                    </div>




                                                                @endforeach


                                                                <!-- ----------------------------- -->

                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'sku';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> {{ $input }} </label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $attribute->sku }}"
                                                                            name=" {{ $input }}"
                                                                            placeholder=" input {{ $input }}">

                                                                    </div>
                                                                </div>
                                                                <!-- ----------------------------- -->

                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'qty';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> quantity </label>
                                                                        <input type="number" min="0" class="form-control"
                                                                            name=" {{ $input }}"
                                                                            value="{{ $attribute->$input }}"
                                                                            placeholder=" input quantity ...">

                                                                    </div>
                                                                </div>
                                                                <!-- ----------------------------- -->

                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'purchase_price';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> purchase price
                                                                        </label>
                                                                        <input type="number" min="0" class="form-control"
                                                                            step=".01" name=" {{ $input }}"
                                                                            value="{{ $attribute->$input }}"
                                                                            placeholder=" input purchase price ...">

                                                                    </div>
                                                                </div>

                                                                <!-- ----------------------------- -->
                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'price';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> {{ $input }} </label>
                                                                        <input type="number" min="0" class="form-control"
                                                                            step=".01" name=" {{ $input }}"
                                                                            value="{{ $attribute->$input }}"
                                                                            placeholder=" input  {{ $input }} ...">

                                                                    </div>
                                                                </div>
                                                                <!-- ----------------------------- -->
                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'price_offer';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> price offer</label>
                                                                        <input type="number" min="0" class="form-control"
                                                                            step=".01" name=" {{ $input }}"
                                                                            value="{{ $attribute->$input }}"
                                                                            placeholder=" input  price offer ...">

                                                                    </div>
                                                                </div>

                                                                <!-- ----------------------------- -->
                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'start_offer_at';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> start offer
                                                                            at</label>
                                                                        <input type="date" min="0"
                                                                            value="{{ $attribute->$input }}"
                                                                            class="form-control" name=" {{ $input }}">


                                                                    </div>
                                                                </div>
                                                                <!-- ----------------------------- -->
                                                                <div class="col-md-3">
                                                                    @php
                                                                    $input = 'end_offer_at';
                                                                    @endphp
                                                                    <div class="form-group">
                                                                        <label> end offer at</label>
                                                                        <input type="date" min="0"
                                                                            value="{{ $attribute->$input }}"
                                                                            class="form-control" name=" {{ $input }}">

                                                                    </div>
                                                                </div>


                                                                <!-- ----------------------------- -->


                                                            </div> <!-- -----------end fo row------------ -->

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="fom-group">


                                                                        <label>
                                                                            <input type="checkbox" name="is_active"
                                                                                value="true"
                                                                                {{ $attribute->is_active == 'active' ? 'checked' : '' }}>
                                                                            active

                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn grey btn-outline-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" id="form-update"
                                                                class="btn btn-outline-primary ">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <a href="javascript:void(0);" id="delete-attribute"
                                        data-action="{{ route('product.attibutes.delete', [$product->id, $attribute->id]) }}"
                                        data-name="{{ $attribute->slug }}" class="text-danger">
                                        <i class="la la-trash"></i>
                                    </a>


                                </div>

                            </td>
                        </tr>


                    @endforeach

                @else
                    <tr class="text-center">
                        <td colspan="10">No matching records found </td>
                    </tr>

                @endif

            @else
                <tr class="text-center">
                    <td colspan="10">No matching records found </td>
                </tr>

            @endisset


        </tbody>
    </table>

</div>
