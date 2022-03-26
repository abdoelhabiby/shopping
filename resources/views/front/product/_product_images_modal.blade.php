@if ($product->images->count() > 0)
    <div class="modal fade js-product-images-modal" id="product-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <figure>
                        <img class="js-modal-product-cover product-cover-modal" width="600"
                            src="{{ asset($product->images->first()->name) }}" alt="" title="" itemprop="image">
                    </figure>
                    <aside id="thumbnails" class="thumbnails js-thumbnails text-xs-center">

                        <div class="js-modal-mask mask  nomargin ">
                            <ul class="product-images js-modal-product-images">

                                @foreach ($product->images as $image)
                                    @if (fileExist($image->name))
                                        <li class="thumb-container">
                                            <img data-image-large-src="{{ asset($image->name) }}"
                                                class="thumb js-modal-thumb" src="{{ asset($image->name) }}" alt=""
                                                title="{{ $product->name }}" width="125" itemprop="image">
                                        </li>
                                    @endif
                                @endforeach


                            </ul>
                        </div>

                    </aside>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endif
