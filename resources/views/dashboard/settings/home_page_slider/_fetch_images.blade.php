<div class="row text-center">
    @if ($sliders->count() > 0)

        @foreach ($sliders as $slider)
            <div class="col-md-3 mb-1">
                <img src="{{ asset($slider->image) }}" width="155" height="155"
                    alt="">
                <div class="">
                    <button id="delete-image" data-id="{{ $slider->id }}"
                        data-action="{{ route('admin.homepage_slider.delete',  $slider->id) }}"
                        class="btn btn-danger  btn-sm "
                        style="margin-top: 3px;"><i
                            class="la la-trash"></i></button>

                </div>
                <hr>
            </div>

        @endforeach

    @else
        <div class="col-md-12 text-center">
            sliders dosent have image
        </div>
    @endif


</div>
