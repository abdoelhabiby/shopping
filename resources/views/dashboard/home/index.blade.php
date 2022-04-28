@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/vendors/css/charts/chartist-plugin-tooltip.css">
@endsection


@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">



                <!-- eCommerce statistic -->

                @include(
                    'dashboard.home.includes._cards_informations',
                    $card_information
                )



                <!--/ eCommerce statistic -->
                <!-- Products sell and New Orders -->
                <div class="row match-height">


                    @include(
                        'dashboard.home.includes._products_sales_chart'
                    )

                    @if (admin()->can('read_order'))
                        @includeWhen(
                            isset($new_products_order) && $new_products_order->count() > 0,
                            'dashboard.home.includes._new_products_orders',
                            $new_products_order
                        )
                    @endif



                </div>
                <!--/ Products sell and New Orders -->



                <!-- Recent Transactions -->

                @includeWhen(isset($latest_transactions), 'dashboard.home.includes._latest_transactions')


                <!--/ Recent Transactions -->



                <!--Recent Orders & Monthly Sales -->
                <div class="row match-height">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card" style="height: 394px;">
                            <div class="card-content ">
                                <div id="cost-revenue" class="height-250 position-relative">
                                    <div class="chartist-tooltip" style="top: 78.4531px; left: 634.203px;"></div><svg
                                        xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                        class="ct-chart-line" style="width: 100%; height: 100%;">
                                        <g class="ct-grids"></g>
                                        <g>
                                            <g class="ct-series ct-series-a">
                                                <path
                                                    d="M0,250L0,187.5C25.047,195.833,50.094,212.5,75.141,212.5C100.188,212.5,125.234,175,150.281,175C175.328,175,200.375,212.5,225.422,212.5C250.469,212.5,275.516,150,300.563,150C325.609,150,350.656,187.5,375.703,187.5C400.75,187.5,425.797,164.286,450.844,150C475.891,135.714,500.938,100,525.984,100C551.031,100,576.078,162.5,601.125,162.5C626.172,162.5,651.219,104.167,676.266,75L676.266,250Z"
                                                    class="ct-area" style="fill: #28D094; fill-opacity: 0.2"></path>
                                                <path
                                                    d="M0,187.5C25.047,195.833,50.094,212.5,75.141,212.5C100.188,212.5,125.234,175,150.281,175C175.328,175,200.375,212.5,225.422,212.5C250.469,212.5,275.516,150,300.563,150C325.609,150,350.656,187.5,375.703,187.5C400.75,187.5,425.797,164.286,450.844,150C475.891,135.714,500.938,100,525.984,100C551.031,100,576.078,162.5,601.125,162.5C626.172,162.5,651.219,104.167,676.266,75"
                                                    class="ct-line"
                                                    style="fill: transparent; stroke: #28D094; stroke-width: 4px;"></path>
                                                <circle cx="0" cy="187.5" r="7" class="ct-area-circle"></circle>
                                                <circle cx="75.140625" cy="212.5" r="7" class="ct-area-circle"></circle>
                                                <circle cx="150.28125" cy="175" r="7" class="ct-area-circle"></circle>
                                                <circle cx="225.421875" cy="212.5" r="7" class="ct-area-circle"></circle>
                                                <circle cx="300.5625" cy="150" r="7" class="ct-area-circle"></circle>
                                                <circle cx="375.703125" cy="187.5" r="7" class="ct-area-circle"></circle>
                                                <circle cx="450.84375" cy="150" r="7" class="ct-area-circle"></circle>
                                                <circle cx="525.984375" cy="100" r="7" class="ct-area-circle"></circle>
                                                <circle cx="601.125" cy="162.5" r="7" class="ct-area-circle"></circle>
                                                <circle cx="676.265625" cy="75" r="7" class="ct-area-circle"></circle>
                                            </g>
                                        </g>
                                        <g class="ct-labels"></g>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row mt-1">
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Products</h6>
                                        <h2 class="block font-weight-normal">18.6 k</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                                style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Sales</h6>
                                        <h2 class="block font-weight-normal">64.54 M</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                                style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Cost</h6>
                                        <h2 class="block font-weight-normal">24.38 B</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar"
                                                style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Total Revenue</h6>
                                        <h2 class="block font-weight-normal">36.72 M</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                                style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card" style="height: 394px;">
                            <div class="card-content">
                                <div class="card-body sales-growth-chart">
                                    <div id="monthly-sales" class="height-250"
                                        style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg
                                            height="250" version="1.1" width="281.125" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            style="overflow: hidden; position: relative; left: -0.0625px; top: -0.546875px;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with
                                                Raphaël 2.1.2</desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text
                                                x="44.859375" y="211" text-anchor="end" font-family="sans-serif"
                                                font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#e4e7ed" d="M57.359375,211H256.125" stroke-width="0.5"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                                x="44.859375" y="164.5" text-anchor="end" font-family="sans-serif"
                                                font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">750
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#e4e7ed" d="M57.359375,164.5H256.125"
                                                stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path><text x="44.859375" y="118" text-anchor="end" font-family="sans-serif"
                                                font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,500
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#e4e7ed" d="M57.359375,118H256.125" stroke-width="0.5"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                                x="44.859375" y="71.5" text-anchor="end" font-family="sans-serif"
                                                font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,250
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#e4e7ed" d="M57.359375,71.5H256.125"
                                                stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                            </path><text x="44.859375" y="25" text-anchor="end" font-family="sans-serif"
                                                font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3,000
                                                </tspan>
                                            </text>
                                            <path fill="none" stroke="#e4e7ed" d="M57.359375,25H256.125" stroke-width="0.5"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text
                                                x="247.84309895833334" y="223.5" text-anchor="middle"
                                                font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Dec
                                                </tspan>
                                            </text><text x="165.02408854166669" y="223.5" text-anchor="middle"
                                                font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Jul
                                                </tspan>
                                            </text><text x="82.205078125" y="223.5" text-anchor="middle"
                                                font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                                font-weight="normal" transform="matrix(1,0,0,1,0,7)">
                                                <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Feb
                                                </tspan>
                                            </text>
                                            <rect x="63.15670572916667" y="97.23" width="4.969140625" height="113.77" rx="0"
                                                ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="79.72050781249999" y="64.928" width="4.969140625" height="146.072"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="96.28430989583332" y="120.542" width="4.969140625" height="90.458"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="112.84811197916666" y="131.082" width="4.969140625" height="79.918"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="129.4119140625" y="108.886" width="4.969140625" height="102.114" rx="0"
                                                ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="145.97571614583333" y="77.328" width="4.969140625" height="133.672"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="162.53951822916667" y="97.23" width="4.969140625" height="113.77"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="179.1033203125" y="64.928" width="4.969140625" height="146.072" rx="0"
                                                ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="195.66712239583333" y="120.542" width="4.969140625" height="90.458"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="212.23092447916667" y="131.082" width="4.969140625" height="79.918"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="228.7947265625" y="108.886" width="4.969140625" height="102.114" rx="0"
                                                ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                            <rect x="245.35852864583333" y="77.328" width="4.969140625" height="133.672"
                                                rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1"
                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                                            </rect>
                                        </svg>
                                        <div class="morris-hover morris-default-style"
                                            style="left: 52.4095px; top: 93px; display: none;">
                                            <div class="morris-hover-row-label">Mar</div>
                                            <div class="morris-hover-point" style="color: #FF394F">
                                                Sales:
                                                1,459
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="chart-title mb-1 text-center">
                                    <h6>Total monthly Sales.</h6>
                                </div>
                                <div class="chart-stats text-center">
                                    <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1">Statistics <i
                                            class="ft-bar-chart"></i></a>
                                    <span class="text-muted">for the last year.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Recent Orders & Monthly Sales -->

            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('admin') }}/vendors/js/charts/chartist.min.js"></script>
    <script src="{{ asset('admin') }}/vendors/js/charts/chartist-plugin-tooltip.min.js"></script>
    <script src="{{ asset('admin') }}/vendors/js/charts/raphael-min.js"></script>
    <script src="{{ asset('admin') }}/vendors/js/charts/morris.min.js"></script>


    {{-- <script src="{{ asset('admin') }}/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script> --}}



    <script>
        (function(window, document, $) {
            'use strict';
            /*************************************************
             *               Score Chart                      *
             *************************************************/
            (function() {
                var scoreChart = function scoreChart(id, labelList, series1List) {
                    var scoreChart = new Chartist.Line('#' + id, {
                        labels: labelList,
                        series: [series1List]
                    }, {
                        lineSmooth: Chartist.Interpolation.simple({
                            divisor: 2
                        }),
                        fullWidth: true,
                        chartPadding: {
                            right: 25
                        },
                        series: {
                            "series-1": {
                                showArea: false
                            }
                        },
                        axisX: {
                            showGrid: false
                        },
                        axisY: {
                            labelInterpolationFnc: function labelInterpolationFnc(value) {
                                return value / 1000 + 'K';
                            },
                            scaleMinSpace: 40
                        },
                        plugins: [Chartist.plugins.tooltip()],
                        low: 0,
                        showPoint: false,
                        height: 300
                    });

                    scoreChart.on('created', function(data) {
                        var defs = data.svg.querySelector('defs') || data.svg.elem('defs');
                        var width = data.svg.width();
                        var height = data.svg.height();

                        var filter = defs.elem('filter', {
                            x: 0,
                            y: "-10%",
                            id: 'shadow' + id
                        }, '', true);

                        filter.elem('feGaussianBlur', {
                            in: "SourceAlpha",
                            stdDeviation: "24",
                            result: 'offsetBlur'
                        });
                        filter.elem('feOffset', {
                            dx: "0",
                            dy: "32"
                        });

                        filter.elem('feBlend', {
                            in: "SourceGraphic",
                            mode: "multiply"
                        });

                        defs.elem('linearGradient', {
                            id: id + '-gradient',
                            x1: 0,
                            y1: 0,
                            x2: 1,
                            y2: 0
                        }).elem('stop', {
                            offset: 0,
                            'stop-color': 'rgba(22, 141, 238, 1)'
                        }).parent().elem('stop', {
                            offset: 1,
                            'stop-color': 'rgba(98, 188, 246, 1)'
                        });

                        return defs;
                    }).on('draw', function(data) {
                        if (data.type === 'line') {
                            data.element.attr({
                                filter: 'url(#shadow' + id + ')'
                            });
                        } else if (data.type === 'point') {

                            var parent = new Chartist.Svg(data.element._node.parentNode);
                            parent.elem('line', {
                                x1: data.x,
                                y1: data.y,
                                x2: data.x + 0.01,
                                y2: data.y,
                                "class": 'ct-point-content'
                            });
                        }
                        if (data.type === 'line' || data.type == 'area') {
                            data.element.animate({
                                d: {
                                    begin: 1000 * data.index,
                                    dur: 1000,
                                    from: data.path.clone().scale(1, 0).translate(0, data
                                        .chartRect.height()).stringify(),
                                    to: data.path.clone().stringify(),
                                    easing: Chartist.Svg.Easing.easeOutQuint
                                }
                            });
                        }
                    });
                };



                var DayLabelList = [
                    @foreach ($chart_information->get('profit_per_day') as $dayes)
                        "{{ $dayes->day }}",
                    @endforeach
                ];

                var DaySeries1List = {
                    name: "series-1",
                    data: [
                        @foreach ($chart_information->get('profit_per_day') as $profits)
                            "{{ $profits->profit }}",
                        @endforeach
                    ]

                };



                var WeekLabelList = [
                    @foreach ($chart_information->get('profit_per_week') as $weeks)
                        "W{{ $weeks->week }}",
                    @endforeach
                ];
                var WeekSeries1List = {
                    name: "series-1",
                    data: [
                        @foreach ($chart_information->get('profit_per_week') as $profits)
                            "{{ $profits->profit }}",
                        @endforeach
                    ]
                };



                var MonthLabelList = [
                    @foreach ($chart_information->get('profit_per_months') as $months)
                        "{{ $months->month }}",
                    @endforeach
                ];
                var MonthSeries1List = {
                    name: "series-1",
                    data: [
                        @foreach ($chart_information->get('profit_per_months') as $profits)
                            "{{ $profits->profit }}",
                        @endforeach
                    ]
                };



                var createChart = function createChart(button) {
                    var btn = button || $("#ecommerceChartView .chart-action").find(".active");

                    var chartId = btn.attr("href");
                    switch (chartId) {
                        case "#scoreLineToDay":
                            scoreChart("scoreLineToDay", DayLabelList, DaySeries1List);
                            break;
                        case "#scoreLineToWeek":
                            scoreChart("scoreLineToWeek", WeekLabelList, WeekSeries1List);
                            break;
                        case "#scoreLineToMonth":
                            scoreChart("scoreLineToMonth", MonthLabelList, MonthSeries1List);
                            break;
                    }
                };

                createChart();
                $(".chart-action li a").on("click", function() {
                    createChart($(this));
                });
            })();


            /*************************************************
             *               Cost Revenue Stats               *
             *************************************************/
            // new Chartist.Line('#cost-revenue', {
            //     labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            //     series: [
            //         [
            //             { meta: 'Revenue', value: 5 },
            //             { meta: 'Revenue', value: 3 },
            //             { meta: 'Revenue', value: 6 },
            //             { meta: 'Revenue', value: 3 },
            //             { meta: 'Revenue', value: 8 },
            //             { meta: 'Revenue', value: 5 },
            //             { meta: 'Revenue', value: 8 },
            //             { meta: 'Revenue', value: 12 },
            //             { meta: 'Revenue', value: 7 },
            //             { meta: 'Revenue', value: 14 },

            //         ]
            //     ]
            // }, {
            //     low: 0,
            //     high: 18,
            //     fullWidth: true,
            //     showArea: true,
            //     showPoint: true,
            //     showLabel: false,
            //     axisX: {
            //         showGrid: false,
            //         showLabel: false,
            //         offset: 0
            //     },
            //     axisY: {
            //         showGrid: false,
            //         showLabel: false,
            //         offset: 0
            //     },
            //     chartPadding: 0,
            //     plugins: [
            //         Chartist.plugins.tooltip()
            //     ]
            // }).on('draw', function(data) {
            //     if (data.type === 'area') {
            //         data.element.attr({
            //             'style': 'fill: #28D094; fill-opacity: 0.2'
            //         });
            //     }
            //     if (data.type === 'line') {
            //         data.element.attr({
            //             'style': 'fill: transparent; stroke: #28D094; stroke-width: 4px;'
            //         });
            //     }
            //     if (data.type === 'point') {
            //         var circle = new Chartist.Svg('circle', {
            //             cx: [data.x],
            //             cy: [data.y],
            //             r: [7],
            //         }, 'ct-area-circle');
            //         data.element.replace(circle);
            //     }
            // });
        })(window, document, jQuery);
    </script>
@endsection
