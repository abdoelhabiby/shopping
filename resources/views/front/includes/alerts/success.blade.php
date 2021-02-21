 @if(Session::has('success'))

<div class="alert alert-success alert-dismissible fade show mb-2 " role="alert">
  <strong class=""> {{Session::get('success')}} </strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>




@endif
