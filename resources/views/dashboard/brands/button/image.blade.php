@if ($image && \File::exists(public_path($image)))

        <img src="{{ asset($image) }}"
            style="min-height: 50px; max-height:50px" alt="" >

@endif
