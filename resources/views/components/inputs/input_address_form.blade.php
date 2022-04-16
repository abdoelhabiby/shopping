 @props([
    'required' => false,
    'name',
    'value',
    'placeholder',
    'label',
    'placeup' => null
])


 <div class="form-group row no-gutters">
     <label class="col-md-2 form-control-label mb-xs-5 {{ $required ? 'required' : '' }} ">
        {{ $label ?? $name }} :
     </label>
     <div class="col-md-6">

        @if($placeup)
            <span style="color: #a0a0b5">{{ $placeup }}</span>
        @endif

         <input autocomplete="off" type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}"
             class="form-control" placeholder="{{ $placeholder ?? '' }}" value="{{ old($name, $value ?? '') }}"
             {{ $required ?? false ? 'required' : '' }}>


         @error($name)
             <span class="text-danger">{{ $message }}</span>
         @enderror

     </div>

     <div class="col-md-4 form-control-comment right">
     </div>
 </div>


 {{-- -------------------------------------------------- --}}

