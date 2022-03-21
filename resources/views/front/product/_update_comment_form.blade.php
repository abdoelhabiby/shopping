<div class="modal fade in" id="new_comment_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">

                    <i class="fa fa-edit"></i>
                    {{ ucfirst(__('front.update_review')) }}


                </h4>

                <button type="button" class="close close_modal_review" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons close">close</i>
                </button>
            </div>
            <div class="modal-body">


                <form id="id_update_comment_form" action="{{ route('product.review.update') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="alert alert-danger alert-dismissible fade show display-errors d-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="product row no-gutters">
                        <div class="product-image col-4">
                            @if($product->images->first())
                            <img class="img-fluid" src="{{ asset($product->images->first()->name) }}" height="" width=""
                            alt="{{ $product->name }}">
                            @else

                            <img class="img-fluid" src="{{ pathNoImage() }}" height="" width=""
                            alt="{{ $product->name }}">
                            @endif

                        </div>
                        <div class="product_desc col-8 p-2">
                            <p class="product_name">
                                {{ $product->name }}
                            </p>
                            <p>
                                {{ stringLength($product->description, 200) }}
                            </p>
                        </div>
                    </div>
                    <div class="new_comment_form_content">
                        <div id="new_comment_form_error" class="error alert alert-danger">
                            <ul></ul>
                        </div>

                        <label>@lang('front.quality')</label>

                        <div class="d-flex">


                            <select id="group_1" name="quality" class="form-control mr-2"
                                style="max-width: 50px; border-radius: 30px;">

                                @for ($i = 1; $i < 6; $i++)
                                    <option value="{{ $i }}"
                                        {{ $user_product_review->quality == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor


                            </select>

                            <div class="star star_on"></div>


                        </div>


                        <label for="comment_title">@lang('front.title')<sup class="required">*</sup></label>
                        <input id="comment_title" name="title" type="text" value="{{ $user_product_review->title }}">

                        <label for="content">@lang('front.write_review')<sup class="required">*</sup></label>
                        <textarea id="content" name="review">{{ $user_product_review->review }}</textarea>



                        <div id="new_comment_form_footer">
                            <div class="fl">
                                <sup class="required">*</sup>
                                @lang('front.required_fields')
                            </div>
                            <div class="fr">

                                <a id="delete-review" data-review-id="{{$user_product_review->id}}" class="btn btn-danger" style="font-size: 1.2rem;
                                font-weight: 400;
                                color:aliceblue;
                                padding: 9px 32px;
                                border-radius: 21px;" data-action="{{ route('product.review.destroy') }}">
                                    @lang('front.delete')
                                </a>


                                <button id="submitUpdateReview" data-review-id="{{$user_product_review->id}}"  class="btn btn-primary" name="submitMessage"
                                    type="submit">@lang('front.update')
                                </button>

                            </div>
                        </div>
                    </div>
                </form><!-- /end new_comment_form_content -->


            </div>
        </div>
    </div>
</div>
