<div class="col-xl-4 col-lg-12">
    <div class="card" style="height: 433px;">
        <div class="card-header">
            <h4 class="card-title">New Orders</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="new-orders" class="media-list position-relative ps-container ps-theme-default"
                data-ps-id="f1a70b81-4400-1ba4-7d34-3b0cccf89731">
                <div class="table-responsive">
                    <table id="new-orders-table" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">Product</th>
                                <th class="border-top-0">Total</th>
                                <th class="border-top-0">Quantity</th>

                                <th class="border-top-0">Customers</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($new_products_order as $product)
                                <tr>
                                    <td class="text-truncate">{{ $product->product->name }}</td>

                                    <td class="text-truncate">{{ $product->total }}EGP</td>
                                    <td class="text-truncate">{{ $product->quantity }}</td>

                                    <td class="text-truncate p-1">
                                        @if ($product->users->count() > 0)
                                            <ul class="list-unstyled users-list m-0">


                                                @foreach ($product->users as $index => $user)

                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="{{ $user->name }}"
                                                    class="avatar avatar-sm pull-up">


                                                    <img class="media-object rounded-circle"
                                                        src="{{ fileExist($user->image) ? asset($user->image) : getLinkImageNoImage() }}"
                                                        alt="Avatar">
                                                </li>


                                            @endforeach


                                        </ul>
                                    @endif


                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </div>
    </div>
</div>
</div>
