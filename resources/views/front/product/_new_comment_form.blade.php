<div class="modal fade in" id="new_comment_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center"><i class="fa fa-edit"></i>
                    {{ ucfirst(__('front.write_review')) }}
                </h4>
                <button type="button" class="close close_modal_review" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons close">close</i>
                </button>
            </div>
            <div class="modal-body">


                <form id="id_new_comment_form" action="{{ route('product.review.store') }}">
                    @csrf

                    <input type="hidden" name="product_id" value="{{$product->id}}">

                    <div class="alert alert-danger alert-dismissible fade show display-errors d-none"
                    role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                    <div class="product row no-gutters">
                        <div class="product-image col-4">
                            <img class="img-fluid" src="{{ $product->images->first()->name }}" height="" width=""
                                alt="{{ $product->name }}">
                        </div>
                        <div class="product_desc col-8">
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


                            <select id="group_1" name="quality" class="form-control mr-2" style="max-width: 50px; border-radius: 30px;">

                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5" selected>5</option>

                            </select>

                            <div class="star star_on"></div>


                        </div>


                        <label for="comment_title">@lang('front.title')<sup class="required">*</sup></label>
                        <input id="comment_title" name="title" type="text" value="">

                        <label for="content">@lang('front.write_review')<sup class="required">*</sup></label>
                        <textarea id="content" name="review"></textarea>



                        <div id="new_comment_form_footer">
                            <div class="fl">
                                <sup class="required">*</sup>
                                @lang('front.required_fields')
                            </div>
                            <div class="fr">
                                {{-- <button id="submitNewMessage" data-dismiss="modal"
                                    aria-label="Close" class="btn btn-primary" name="submitMessage"
                                    type="submit">@lang('front.send')</button> --}}

                                <button id="submitNewMessage" class="btn btn-primary" name="submitMessage"
                                    type="submit">@lang('front.send')</button>
                            </div>
                        </div>
                    </div>
                </form><!-- /end new_comment_form_content -->
            </div>
        </div>
    </div>
</div>
