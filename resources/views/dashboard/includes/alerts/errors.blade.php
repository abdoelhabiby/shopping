@if(Session::has('error'))

<div class="alert alert-danger alert-dismissible fade show mb-2 " role="alert">
  <strong class=""> {{Session::get('error')}} </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>



@endif
