@if (admin()->can('update_brand'))
    <a href="{{ route('brands.edit', $id) }}"><i class="la la-edit"></i></a>
@endif


@if (admin()->can('delete_brand'))
    <a class="delete_log text-danger" data-url="{{ route('brands.destroy', $id) }}" data-id="{{ $id }}"><i
            class="la la-trash"></i></a>
@endif



<script>
    $(function() {



        //-----------------delete record -------------------
        $(document).on('click', '.delete_log', function() {

            var record_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var url = $(this).data('url');


            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6B6F82',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {

                if (result.value == true) {

                    $.ajax({
                        url: url,
                        method: 'delete',
                        data: {
                            _token: token
                        },
                        beforeSend: function() {

                        },
                        success: function(response) {

                            $('#brand-table').DataTable().ajax.reload();

                            swal({
                                title: 'succes delete',
                                type: "success",
                                timer: 3000,
                            });


                        },
                        error: function(response) {

                            swal({
                                title: '404 not found',
                                type: "error",
                                timer: 3000,
                            });

                        }
                    })





                }
            });






        }); //end click

    })
</script>
