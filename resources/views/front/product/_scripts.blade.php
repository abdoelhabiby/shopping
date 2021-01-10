@if (session()->has('success'))

    <script>
        swal({
            title: "{{ session('success') }}",
            type: "success",
            timer: 2000,
        });

    </script>

@endif
@if (session()->has('exception_error'))

    <script>
        swal({
            title: "{{ session('exception_error') }}",
            type: "error",
            timer: 3000,
        });

    </script>

@endif

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //---------------heper function to handel nnew action in product review------

    function appendFetchReviews(stars, total_rating) {

        var rating_stars = '';
        var stars = parseInt(stars);
        for (i = 0; i < stars; i++) {
            rating_stars += '<div class="star star_on"></div>';
        }

        var minus = 5 - stars;

        if (minus > 0) {
            for (i = 0; i < minus; i++) {
                rating_stars += ' <div class="star "></div>';
            }

        }

        $('.comments_note .star_content').html(rating_stars);
        $(".total_ratings").text(total_rating);

    }

    //------------------------------------------

    // -------------------modal review-------------------
    //------------close modal form add review------------
    $(".close_modal_review").click(function() {

        $('#id_new_comment_form')[0].reset();
        $('#id_new_comment_form').find(".display-errors").empty().addClass('d-none');

    });


    //---------------------delete review---------------

    $(document).on('click', '#delete-review', function(e) {

        e.preventDefault();


        var url = $(this).data('action');
        var token = "{{ csrf_token() }}";
        var product_id = "{{ $product->id }}";


        swal({
            title: "{{ __('front.are_you_sure') }}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6B6F82',
            cancelButtonText: "{{ __('front.cancel') }}",
            confirmButtonText: "{{ __('front.yes_delete') }}"
        }).then(function(result) {

            if (result.value == true) {

                $.ajax({
                    url: url,
                    method: 'delete',
                    data: {
                        _token: token,
                        product_id: product_id
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {

                        //return object stars and total ratings

                        var calculate_reviews = response.calculate_reviews;

                        if (calculate_reviews.stars && calculate_reviews.total_rating) {
                            appendFetchReviews(calculate_reviews.stars, calculate_reviews
                                .total_rating);
                        }

                        //----------------------------add new review---------------
                        $('#new_comment_form').modal('hide');


                        //set timeout because the modal to fix background  e..e.
                        setTimeout(function() {
                            $('#new_comment_form').remove();

                            $('body').append(response.append_modal);

                        }, 1000);

                        swal({
                            title: 'succes delete',
                            type: "success",
                            timer: 1000,
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



    });


    //------modal form update review---------------
    $(document).on('submit', '#id_update_comment_form', function(e) {

        e.preventDefault();
        var myform = $(this);
        var url = $(this).attr('action');
        var data = $(this).serialize();





        $.ajax({
            url: url,
            method: 'put',
            data: data,
            beforeSend: function() {

                myform.find(".display-errors").empty();
                myform.find(".display-errors").addClass('d-none');

            },
            success: function(response) {

                //return object stars and total ratings

                var calculate_reviews = response.calculate_reviews;

                if (calculate_reviews.stars && calculate_reviews.total_rating) {
                    appendFetchReviews(calculate_reviews.stars, calculate_reviews.total_rating);
                }

                $('#new_comment_form').modal('hide');

                //set timeout because the modal to fix background  e..e.
                setTimeout(function() {
                    $('#new_comment_form').remove();
                    $('body').append(response.append_modal);
                }, 1000);


                swal({
                    title: "{{ __('front.success_update_review') }}",
                    type: "success",
                    timer: 2000,
                });


            },
            error: function(getError) {
                if (getError.status == 422) {

                    var arr = Object.values(getError.responseJSON.errors);
                    myform.find(".display-errors").append('<p>' + arr[0] + '</p>');
                    myform.find(".display-errors").removeClass('d-none');

                }

            }
        });

    });

    //------modal form add review------------------

    $(document).on('submit', '#id_new_comment_form', function(e) {


        e.preventDefault();
        var myform = $(this);
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            beforeSend: function() {

                myform.find(".display-errors").empty();
                myform.find(".display-errors").addClass('d-none');

            },
            success: function(response) {

                //return object stars and total ratings

                var calculate_reviews = response.calculate_reviews;

                if (calculate_reviews.stars && calculate_reviews.total_rating) {
                    appendFetchReviews(calculate_reviews.stars, calculate_reviews.total_rating);
                }

                //----------------------------------
                $('#new_comment_form').modal('hide');

                //set timeout because the modal to fix background  e..e.
                setTimeout(function() {
                    $('#new_comment_form').remove();
                    $('body').append(response.append_modal);

                }, 1000);


                swal({
                    title: "{{ __('front.success_add_review') }}",
                    type: "success",
                    timer: 2000,
                });


            },
            error: function(getError) {
                if (getError.status == 422) {

                    var arr = Object.values(getError.responseJSON.errors);
                    myform.find(".display-errors").append('<p>' + arr[0] + '</p>');
                    myform.find(".display-errors").removeClass('d-none');

                }

            }
        });

    });
    // ---------------------------------------------------------
    //------------------ add product to cart--------------------

    $(document).on('submit', '#form-add-to-cart', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var quantity = $(this).find('input[name="quantity"]').val();





        $.ajax({
            method: 'post',
            url,
            data: {
                'quantity': quantity
            },
            success: function(response) {


                if (response.cart_products_count && parseInt(response.cart_products_count) > 0) {
                    $(".cart-products-count").text(response.cart_products_count);

                }


                swal({
                    title: "{{ __('front.success_add_product') }}",
                    type: "success",
                    timer: 2000,
                });
                //---- fetch get count products to change icon cart add total products count
            },
            error: function(error) {
                // console.log(error);
            }
        });

    });

</script>
