@extends('layouts.dashboard')


@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Multiple Files Upload</h4>
                      <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                      <div class="heading-elements">
                        <ul class="list-inline mb-0">
                          <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                          <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                          <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-content collapse show">
                      <div class="card-body">

                        <p class="card-text">Upload images</p>
                        <form action="#" class="dropzone dropzone-area dz-clickable" id="dpz-multiple-files">
                          <div class="dz-message">Drop Files Here To Upload</div>
                        </form>




                        <div class="attributes">
                            <form action="" id="form-attributes"></form>
                        </div>


                      </div>
                    </div>
                  </div>

            </div>


        </div>
    </div>

@endsection


@section('js')
<script>

  var asset = "{{asset('/')}}";
  var uploadedDocumentMap = {}
  Dropzone.options.dpzMultipleFiles = {
    url: '{{ route("product.images.store",1) }}',
    maxFilesize: 2, // MB
   // maxFiles: 2, // MB
    addRemoveLinks: true,
    paramName:'image',
    acceptedFiles:'image/*',
    useFontAwesome: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {

      $('#form-attributes').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },

    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.name !== 'undefined') {
        name = file.name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    }

  }





</script>
@stop
