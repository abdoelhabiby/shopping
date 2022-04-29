<div class="row match-height">
    <div class="col-xl-8 col-lg-12">
        <div class="card" style="height: 394px;">
            <div class="card-content ">
                {{-- <div id="cost-revenue" class="height-250 position-relative">

                </div> --}}
            </div>

            <div class="card-footer">
                <div class="row mt-1">

                    @if ($chart_cost_revenue->has('total_products'))
                        <div class="col-3 text-center">
                            <h6 class="text-muted">Total Products</h6>
                            <h4 class="block font-weight-normal">
                                @isset($chart_cost_revenue->get('total_products')['total'])
                                    {{ $chart_cost_revenue->get('total_products')['total'] }}
                                @endisset
                            </h4>
                            @isset($chart_cost_revenue->get('total_products')['percentage'])
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                        style="width: {{ $chart_cost_revenue->get('total_products')['percentage'] }}%"
                                        aria-valuenow="{{ $chart_cost_revenue->get('total_products')['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endisset

                        </div>
                    @endif





                    @if ($chart_cost_revenue->has('total_sales'))
                        <div class="col-3 text-center">
                            <h6 class="text-muted">Total Sales</h6>
                            <h4 class="block font-weight-normal">
                                @isset($chart_cost_revenue->get('total_sales')['total'])
                                    {{ $chart_cost_revenue->get('total_sales')['total'] }}
                                @endisset

                            </h4>
                            @isset($chart_cost_revenue->get('total_sales')['percentage'])
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-primary" role="progressbar"
                                        style="width: {{ $chart_cost_revenue->get('total_products')['percentage'] }}%"
                                        aria-valuenow="{{ $chart_cost_revenue->get('total_products')['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endif


                    @if ($chart_cost_revenue->has('total_cost'))
                        <div class="col-3 text-center">
                            <h6 class="text-muted">Total Cost</h6>
                            <h4 class="block font-weight-normal">
                                @isset($chart_cost_revenue->get('total_cost')['total'])
                                    {{ $chart_cost_revenue->get('total_cost')['total'] }}
                                @endisset

                            </h4>
                            @isset($chart_cost_revenue->get('total_cost')['percentage'])
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                        style="width: {{ $chart_cost_revenue->get('total_products')['percentage'] }}%"
                                        aria-valuenow="{{ $chart_cost_revenue->get('total_products')['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endif

                    @if ($chart_cost_revenue->has('total_revenue'))
                        <div class="col-3 text-center">
                            <h6 class="text-muted">Total Revenue</h6>
                            <h4 class="block font-weight-normal">
                                @isset($chart_cost_revenue->get('total_revenue')['total'])
                                    {{ $chart_cost_revenue->get('total_revenue')['total'] }}
                                @endisset

                            </h4>
                            @isset($chart_cost_revenue->get('total_revenue')['percentage'])
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                        style="width: {{ $chart_cost_revenue->get('total_products')['percentage'] }}%"
                                        aria-valuenow="{{ $chart_cost_revenue->get('total_products')['percentage'] }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="card" style="height: 394px;">
            <div class="card-content">
                <div class="card-body sales-growth-chart">
                    <div id="monthly-sales" class="height-250"
                        style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="chart-title mb-1 text-center">
                    <h6>Total monthly Sales.</h6>
                </div>
                <div class="chart-stats text-center">

                    <span class="text-muted test">for this year.</span>
                </div>
            </div>
        </div>
    </div>
</div>
