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
                        'dashboard.home.includes._products_sales_chart',
                        ['type' => $chart_information->get('type')]
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
                @include(
                    'dashboard.home.includes._recent_orders_monthly_sales'
                )

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





    <script>
        $(document).ready(function() {

            $(window).on("load", function() {
                $('#recent-buyers, #new-orders').perfectScrollbar({
                    wheelPropagation: true
                });

                /********************************************
                 *               Monthly Sales               *
                 ********************************************/
                Morris.Bar.prototype.fillForSeries = function(i) {
                    var color;
                    return "0-#fff-#f00:20-#000";
                };

                Morris.Bar({
                    element: 'monthly-sales',
                    data: [
                        @isset($sales_months)
                            @foreach ($sales_months as $month)
                                {
                                month: "{{ $month->month }}",
                                sales: "{{ $month->amount }}"
                                },
                            @endforeach
                        @endisset

                    ],
                    xkey: 'month',
                    ykeys: ['sales'],
                    labels: ['Sales'],
                    barGap: 4,
                    barSizeRatio: 0.3,
                    gridTextColor: '#bfbfbf',
                    gridLineColor: '#E4E7ED',
                    numLines: 5,
                    gridtextSize: 14,
                    resize: true,
                    barColors: ['#FF394F'],
                    hideHover: 'auto',
                });






            });



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
                                        from: data.path.clone().scale(1, 0).translate(0,
                                            data
                                            .chartRect.height()).stringify(),
                                        to: data.path.clone().stringify(),
                                        easing: Chartist.Svg.Easing.easeOutQuint
                                    }
                                });
                            }
                        });
                    };




                    var DayLabelList = [
                        @foreach ($chart_information->get('per_day') as $dayes)
                            "{{ $dayes->day }}",
                        @endforeach
                    ];
                    var DaySeries1List = {
                        name: "series-1",
                        data: [
                            @foreach ($chart_information->get('per_day') as $profits)
                                "{{ $profits->amount }}",
                            @endforeach
                        ]
                    };
                    var WeekLabelList = [
                        @foreach ($chart_information->get('per_week') as $weeks)
                            "W{{ $weeks->week }}",
                        @endforeach
                    ];
                    var WeekSeries1List = {
                        name: "series-1",
                        data: [
                            @foreach ($chart_information->get('per_week') as $profits)
                                "{{ $profits->amount }}",
                            @endforeach
                        ]
                    };
                    var MonthLabelList = [
                        @foreach ($chart_information->get('per_months') as $months)
                            "{{ $months->month }}",
                        @endforeach
                    ];
                    var MonthSeries1List = {
                        name: "series-1",
                        data: [
                            @foreach ($chart_information->get('per_months') as $profits)
                                "{{ $profits->amount }}",
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



            })(window, document, jQuery);

        });
    </script>
@endsection
