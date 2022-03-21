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


    var lang_update = " {{ __('front.update') }}";
    var lang_required = " {{ __('front.required_fields') }}";
    var lang_write_revie = "{{ ucfirst(__('front.write_review')) }}";

    //---------------heper function to handel nnew action in product review------

    function appendFetchReviews(stars, total_rating) {

        var rating_stars = '';
        var stars = stars ?? 0;
        // var stars = parseInt(stars);
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
        var review_id = $(this).data('review-id');



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

                        appendFetchReviews(calculate_reviews.stars, calculate_reviews
                            .total_rating);


                        $(document).find(".poduct_reviews #review_id_" + review_id) .remove();

                        $('#id_new_comment_form')[0].reset();

                        //----------------------------add new review---------------
                        $('#new_comment_form').modal('hide');


                        //set timeout because the modal to fix background  e..e.


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

    function unserialize(data) {
        data = data.split('&');
        var response = {};
        for (var k in data) {
            var newData = data[k].split('=');
            response[newData[0]] = newData[1].replaceAll('+', ' ');

        }
        return response;
    }
    //------modal form update review---------------
    // $(document).on('submit', '#id_update_comment_form', function(e) {
    $(document).on('click', '#submitUpdateReview', function(e) {

        e.preventDefault();
        var myform = $(this).closest('form');
        var url = myform.attr('action');
        var data = myform.serialize();
        var review_id = $(this).data('review-id');


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


                // -------------append changes----------
                var data_un = unserialize(data);

                var append_changes = `
                       <h4> ${data_un.title}</h4>
                        <p> ${data_un.review}</p>
                `;


                var stars = data_un.quality;
                var rating_stars = '';
                for (i = 0; i < stars; i++) {
                    rating_stars += '<div class="star star_on"></div>';
                }
                var minus = 5 - stars;

                if (minus > 0) {
                    for (i = 0; i < minus; i++) {
                        rating_stars += ' <div class="star "></div>';
                    }
                }



                $(document).find('#review_id_' + review_id + ' .comment_details').empty().append(
                    append_changes);

                $(document).find('#review_id_' + review_id + ' .star_content').empty().append(
                    rating_stars);


                // -------------------------------------

                $('#new_comment_form').modal('hide');




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

    // $(document).on('submit', '#id_new_comment_form', function(e) {
    $(document).on('click', '#submitNewReview', function(e) {


        e.preventDefault();

        var myform = $(this).closest('form');
        var url = myform.attr('action');
        var data = myform.serialize();


        $.ajax({
            url: url,
            method: 'post',
            data: data,
            beforeSend: function() {

                myform.find(".display-errors").empty();
                myform.find(".display-errors").addClass('d-none');

            },
            success: function(response) {

                //except return objects[review,calculate_reviews,product]

                if (typeof(response.data) !== 'undefined' && typeof(response.data.review) !==
                    'undefined' && typeof(response.data.calculate_reviews) !== 'undefined') {
                    var data = response.data;
                    var review = data.review;
                    var calculate_reviews = data.calculate_reviews;
                    var url_delete_review = "{{ route('product.review.destroy') }}";
                    var url_update_review = "{{ route('product.review.update') }}";


                    var model_foter = ` <div id="new_comment_form_footer">
                                                <div class="fl">
                                                    <sup class="required">*</sup>
                                                    ${lang_required}
                                                </div>
                                                <div class="fr">
                                                    <a id="delete-review" data-review-id="${review.id}" class="btn btn-danger" style="font-size: 1.2rem;
                                                    font-weight: 400;
                                                    color:aliceblue;
                                                    padding: 9px 32px;
                                                    border-radius: 21px;" data-action="${url_delete_review}">
                                                        @lang('front.delete')
                                                    </a>
                                                    <button id="submitUpdateReview" data-review-id="${review.id}" class="btn btn-primary" name="submitMessage"
                                                        type="submit">${lang_update}
                                                    </button>

                                                </div>
                                         </div>`;


                    $('#new_comment_form').modal('hide');
                    $(document).find('#id_new_comment_form').attr('action', url_update_review)
                    myform.find('#new_comment_form_footer').remove();
                    myform.find('.new_comment_form_content').append(model_foter);
                    // --------------------------------------
                    if (calculate_reviews.stars && calculate_reviews.total_rating) {
                        appendFetchReviews(calculate_reviews.stars, calculate_reviews
                            .total_rating);
                    }
                    // ------------------------------------------------
                    //-------append to product reviews----------------

                    appendNewReviewToProductReviews(review);



                }


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

    function appendNewReviewToProductReviews(review) {

        var stars = review.quality ?? 0;
        var modal = `<a class="open-comment-form" data-toggle="modal" data-target="#new_comment_form" href="#"><i class="fa fa-edit"></i>

             </a>`;
        var rating_stars = '<div class="star_content">';
        for (i = 0; i < stars; i++) {
            rating_stars += '<div class="star star_on"></div>';
        }
        var minus = 5 - stars;

        if (minus > 0) {
            for (i = 0; i < minus; i++) {
                rating_stars += ' <div class="star "></div>';
            }
        }

        rating_stars += '</div>';



        // --------------------------------




        var section_html = `<div class="comment clearfix" id="review_id_${review.id}">
                    <div class="comment_author" style=" display: grid">
                        <div class="d-flex">
                            ${rating_stars}
                            ${modal}

                        </div>

                        <div class="comment_author_infos">
                            <div class="user-comment"><i class="fa fa-user"></i>
                                ${review.user_name}
                            </div>
                            <div class="date-comment">
                                ${review.created_at_diff}
                            </div>
                        </div>
                    </div>

                    <div class="comment_details" style="">
                        <h4> ${review.title}</h4>
                        <p> ${review.review}</p>
                    </div>

                    </div>`;


        $(document).find("#product_comments_block_tab .poduct_reviews").prepend(section_html);


    }

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


                if (response.cart_products_count && parseInt(response.cart_products_count) >
                    0) {
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
