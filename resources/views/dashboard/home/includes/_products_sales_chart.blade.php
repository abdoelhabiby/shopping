<div class="col-xl-8 col-12" id="ecommerceChartView">
    <div class="card card-shadow" style="height: 433px;">
        <div class="card-header card-header-transparent py-20">
            <div class="btn-group dropdown">
                <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS {{Str::upper( $type) }}</a>
                <div class="dropdown-menu animate" role="menu">
                    <a class="dropdown-item" href="{{ route('dashboard.home',['chart-type=profits']) }}" role="menuitem">Profits</a>
                    <a class="dropdown-item" href="{{ route('dashboard.home',['chart-type=sales']) }}" role="menuitem"> Sales</a>
                </div>
            </div>
            <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab"
                        href="#scoreLineToMonth">Month</a></li>
            </ul>
        </div>

        <div class="widget-content tab-content bg-white p-20">
            <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
            <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
            <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
        </div>
    </div>
</div>
