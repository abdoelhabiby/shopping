<div class="row text-center">
    @if ($product->images->count() > 0)

        @foreach ($product->images as $image)
            <div class="col-md-3 mb-1">
                <img src="{{ asset($image->name) }}" width="155" height="155"
                    alt="">
                <div class="">
                    <button id="delete-image" data-id="{{ $image->id }}"
                        data-action="{{ route('product.images.delete', [$product->id, $image->id]) }}"
                        class="btn btn-danger  btn-sm "
                        style="margin-top: 3px;"><i
                            class="la la-trash"></i></button>

                </div>
                <hr>
            </div>

        @endforeach

    @else
        <div class="col-md-12 text-center">
            product dosent have images
        </div>
    @endif


</div>
