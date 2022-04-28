<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Transactions</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">

                </div>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Invoice#</th>
                                <th class="border-top-0">Customer Name</th>
                                <th class="border-top-0">Products</th>
                                <th class="border-top-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($latest_transactions->count() > 0)


                                @foreach ($latest_transactions as $order)
                                    <tr>
                                        <td class="text-truncate">
                                            @switch($order->status)
                                                @case('paid')
                                                    <i class="la la-dot-circle-o success font-medium-1 mr-1"></i>
                                                    Paid
                                                @break

                                                @case('pending')
                                                    <i class="la la-dot-circle-o warning font-medium-1 mr-1"></i>
                                                    Pending
                                                @break

                                                @case('refused')
                                                    <i class="la la-dot-circle-o danger font-medium-1 mr-1"></i>
                                                    Refused
                                                @break
                                            @endswitch

                                        </td>
                                        <td class="text-truncate"><a
                                                href="{{ route('dashboard.orders.show', $order->id) }}">INVOICE-{{ $order->id }}</a>
                                        </td>
                                        <td class="text-truncate">
                                            @if ($order->user)
                                                <span class="avatar avatar-xs">

                                                    <img class="media-object rounded-circle"
                                                        src="{{ fileExist($order->user->image) ? asset($order->user->image) : getLinkImageNoImage() }}"
                                                        alt="Avatar">

                                                </span>
                                                <span>{{ $order->user->name }}</span>
                                            @endif
                                        </td>


                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">


                                                @foreach ($order->products->take(3) as $product)
                                                    <li data-toggle="tooltip " data-popup="tooltip-custom"
                                                        data-original-title="{{ $product->name }}"
                                                        class="avatar avatar-sm pull-up">
                                                        <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius"
                                                            src="{{ asset('admin') }}/app-assets/images/portfolio/portfolio-1.jpg"
                                                            title="{{ $product->name }}">
                                                    </li>
                                                @endforeach

                                                @if ($order->products->count() > 3)
                                                    <li class="avatar avatar-sm">
                                                        <span
                                                            class="badge badge-info">+{{ $order->products->count() - 3 }}
                                                            more</span>
                                                    </li>
                                                @endif



                                            </ul>
                                        </td>


                                        <td class="text-truncate">{{ $order->amount }} EGP</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="8">no found new orders</td>
                                </tr>

                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
