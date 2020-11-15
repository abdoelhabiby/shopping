 @section('create_attribute_js')

     <script>
         $('#form-create').submit(function(e) {

             e.preventDefault();

             var url = $(this).attr('action');
             var data = $(this).serialize();

             $.ajax({
                 url: url,
                 method: 'post',
                 data: data,
                 beforeSend: function() {

                     $(".display-errors").empty();
                     $(".display-errors").addClass('d-none');

                 },
                 success: function(success) {

                     fetchAttribute();

                     $("#form-create")[0].reset();

                     swal({
                         title: 'succes create new attribute',
                         type: "success",
                         timer: 2000,
                     });


                 },
                 error: function(getError) {
                     if (getError.status == 422) {
                         var arr = Object.values(getError.responseJSON.errors);
                         $(".display-errors").removeClass('d-none');
                         $(".display-errors").append('<p>' + arr[0] + '</p>');

                         //console.log(arr[0]);

                     }

                     console.log(getError);
                 }
             });


         });

     </script>
 @stop


 <section id="dom">
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title ">
                         Create {{ $model_name }}
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


                         <div class="alert alert-danger alert-dismissible fade show display-errors d-none" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>


                         <form class="form " id="form-create"
                             action="{{ route('product.attibutes.store', $product->id) }}" method="POST"
                             enctype="multipart/form-data">
                             @csrf

                             <div class="form-body">
                                 <h4 class="form-section"><i class="ft-list"></i>
                                     {{ Str::singular($model_name) }} data
                                 </h4>


                                 <div class="row">


                                     @foreach (supportedLanguages() as $index => $language)

                                         <div class="col-md-3">

                                             <div class="form-group">
                                                 <label for="name-{{ $language }}"> {{ 'name ' . $language }}
                                                 </label>
                                                 <input type="text"
                                                     id="name-{{ $language }}" class="form-control"
                                                     placeholder="input size {{ 'name ' . $language }}  "
                                                     name="name[{{ $language }}]">

                                             </div>
                                         </div>




                                     @endforeach


                                     <!-- ----------------------------- -->

                                     <div class="col-md-3">
                                         @php
                                         $input = 'sku';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> {{ $input }} </label>
                                             <input type="text" id="{{ $input }}" class="form-control" "
                                                                name=" {{ $input }}" placeholder=" input {{ $input }}">

                                         </div>
                                     </div>
                                     <!-- ----------------------------- -->

                                     <div class="col-md-3">
                                         @php
                                         $input = 'qty';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> quantity </label>
                                             <input type="number" id="{{ $input }}" min="0" class="form-control"
                                                 name=" {{ $input }}" placeholder=" input quantity ...">

                                         </div>
                                     </div>
                                     <!-- ----------------------------- -->

                                     <div class="col-md-3">
                                         @php
                                         $input = 'purchase_price';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> purchase price </label>
                                             <input type="number" id="{{ $input }}" min="0" class="form-control"
                                                 step=".01" name=" {{ $input }}"
                                                 placeholder=" input purchase price ...">

                                         </div>
                                     </div>

                                     <!-- ----------------------------- -->
                                     <div class="col-md-3">
                                         @php
                                         $input = 'price';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> {{ $input }} </label>
                                             <input type="number" id="{{ $input }}" min="0" class="form-control"
                                                 step=".01" name=" {{ $input }}" placeholder=" input  {{ $input }} ...">

                                         </div>
                                     </div>
                                     <!-- ----------------------------- -->
                                     <div class="col-md-3">
                                         @php
                                         $input = 'price_offer';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> price offer</label>
                                             <input type="number" id="{{ $input }}" min="0" class="form-control"
                                                 step=".01" name=" {{ $input }}" placeholder=" input  price offer ...">

                                         </div>
                                     </div>

                                     <!-- ----------------------------- -->
                                     <div class="col-md-3">
                                         @php
                                         $input = 'start_offer_at';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> start offer at</label>
                                             <input type="date" id="{{ $input }}" min="0" class="form-control"
                                                 name=" {{ $input }}">


                                         </div>
                                     </div>
                                     <!-- ----------------------------- -->
                                     <div class="col-md-3">
                                         @php
                                         $input = 'end_offer_at';
                                         @endphp
                                         <div class="form-group">
                                             <label for="{{ $input }}"> end offer at</label>
                                             <input type="date" id="{{ $input }}" min="0" class="form-control"
                                                 name=" {{ $input }}">

                                         </div>
                                     </div>


                                     <!-- ----------------------------- -->


                                     <!-- ----------------------------- -->
                                     <!-- ----------------------------- -->
                                     <!-- ----------------------------- -->
                                     <!-- ----------------------------- -->



                                 </div> <!-- -----------end fo row------------ -->

                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="fom-group">


                                             <label>
                                                 <input type="checkbox" name="is_active" value="true" checked=""> active
                                             </label>
                                         </div>
                                     </div>
                                 </div>


                                 <div class="form-actions">

                                     <button type="submit" id="" class=" btn btn-primary">
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
