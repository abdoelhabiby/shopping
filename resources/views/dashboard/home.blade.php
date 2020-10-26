@extends('layouts.dashboard')


@section( 'content')

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- eCommerce statistic -->
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="info">850</h3>
                      <h6>Products Sold</h6>
                    </div>
                    <div>
                      <i class="icon-basket-loaded info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="warning">$748</h3>
                      <h6>Net Profit</h6>
                    </div>
                    <div>
                      <i class="icon-pie-chart warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="success">146</h3>
                      <h6>New Customers</h6>
                    </div>
                    <div>
                      <i class="icon-user-follow success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="danger">99.89 %</h3>
                      <h6>Customer Satisfaction</h6>
                    </div>
                    <div>
                      <i class="icon-heart danger font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ eCommerce statistic -->
        <!-- Products sell and New Orders -->
        <div class="row match-height">
          <div class="col-xl-8 col-12" id="ecommerceChartView">
            <div class="card card-shadow" style="height: 433px;">
              <div class="card-header card-header-transparent py-20">
                <div class="btn-group dropdown">
                  <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
                  <div class="dropdown-menu animate" role="menu">
                    <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                    <a class="dropdown-item" href="#" role="menuitem">profit</a>
                  </div>
                </div>
                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                  <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                </ul>
              </div>
              <div class="widget-content tab-content bg-white p-20">
                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"><div class="chartist-tooltip" style="top: 36.9531px; left: 136.203px;"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="300" class="ct-chart-line" style="width: 100%; height: 300px;"><g class="ct-grids"><line y1="265" y2="265" x1="50" x2="651.265625" class="ct-grid ct-vertical"></line><line y1="193.57142857142856" y2="193.57142857142856" x1="50" x2="651.265625" class="ct-grid ct-vertical"></line><line y1="122.14285714285714" y2="122.14285714285714" x1="50" x2="651.265625" class="ct-grid ct-vertical"></line><line y1="50.71428571428572" y2="50.71428571428572" x1="50" x2="651.265625" class="ct-grid ct-vertical"></line></g><g><g ct:series-name="series-1" class="ct-series ct-series-a"><path d="M50,265C92.948,265,92.948,104.286,135.895,104.286C178.843,104.286,178.843,172.143,221.79,172.143C264.738,172.143,264.738,47.143,307.685,47.143C350.633,47.143,350.633,172.143,393.58,172.143C436.528,172.143,436.528,32.857,479.475,32.857C522.423,32.857,522.423,150.714,565.371,150.714C608.318,150.714,608.318,22.143,651.266,22.143" class="ct-line" filter="url(#shadowscoreLineToDay)"></path></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="270" width="85.89508928571429" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">1st</span></foreignObject><foreignObject style="overflow: visible;" x="135.89508928571428" y="270" width="85.89508928571429" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">2nd</span></foreignObject><foreignObject style="overflow: visible;" x="221.79017857142858" y="270" width="85.8950892857143" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">3rd</span></foreignObject><foreignObject style="overflow: visible;" x="307.6852678571429" y="270" width="85.89508928571428" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">4th</span></foreignObject><foreignObject style="overflow: visible;" x="393.58035714285717" y="270" width="85.89508928571428" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">5th</span></foreignObject><foreignObject style="overflow: visible;" x="479.47544642857144" y="270" width="85.89508928571433" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">6th</span></foreignObject><foreignObject style="overflow: visible;" x="565.3705357142858" y="270" width="85.89508928571422" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 86px; height: 20px;">7th</span></foreignObject><foreignObject style="overflow: visible;" x="651.265625" y="270" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">8th</span></foreignObject><foreignObject style="overflow: visible;" y="193.57142857142856" x="10" height="71.42857142857143" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 71px; width: 30px;">0K</span></foreignObject><foreignObject style="overflow: visible;" y="122.14285714285712" x="10" height="71.42857142857143" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 71px; width: 30px;">2K</span></foreignObject><foreignObject style="overflow: visible;" y="50.71428571428572" x="10" height="71.42857142857142" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 71px; width: 30px;">4K</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="35.71428571428572" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 36px; width: 30px;">6K</span></foreignObject></g><defs><filter x="0" y="-10%" id="shadowscoreLineToDay"><feGaussianBlur in="SourceAlpha" stdDeviation="24" result="offsetBlur"></feGaussianBlur><feOffset dx="0" dy="32"></feOffset><feBlend in="SourceGraphic" mode="multiply"></feBlend></filter><linearGradient id="scoreLineToDay-gradient" x1="0" y1="0" x2="1" y2="0"><stop offset="0" stop-color="rgba(22, 141, 238, 1)"></stop><stop offset="1" stop-color="rgba(98, 188, 246, 1)"></stop></linearGradient></defs></svg></div>
                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
              </div>
            </div>
          </div>
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
                <div id="new-orders" class="media-list position-relative ps-container ps-theme-default" data-ps-id="f1a70b81-4400-1ba4-7d34-3b0cccf89731">
                  <div class="table-responsive">
                    <table id="new-orders-table" class="table table-hover table-xl mb-0">
                      <thead>
                        <tr>
                          <th class="border-top-0">Product</th>
                          <th class="border-top-0">Customers</th>
                          <th class="border-top-0">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-truncate">iPhone X</td>
                          <td class="text-truncate p-1">
                            <ul class="list-unstyled users-list m-0">
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-19.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Katherine Nichols" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-18.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joseph Weaver" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-17.png" alt="Avatar">
                              </li>
                              <li class="avatar avatar-sm">
                                <span class="badge badge-info">+4 more</span>
                              </li>
                            </ul>
                          </td>
                          <td class="text-truncate">$8999</td>
                        </tr>
                        <tr>
                          <td class="text-truncate">Pixel 2</td>
                          <td class="text-truncate p-1">
                            <ul class="list-unstyled users-list m-0">
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Scott" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-16.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Charles Miller" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-15.png" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="text-truncate">$5550</td>
                        </tr>
                        <tr>
                          <td class="text-truncate">OnePlus</td>
                          <td class="text-truncate p-1">
                            <ul class="list-unstyled users-list m-0">
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Christine Ramos" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-11.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Thomas Brewer" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-10.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Alice Chapman" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-9.png" alt="Avatar">
                              </li>
                              <li class="avatar avatar-sm">
                                <span class="badge badge-info">+3 more</span>
                              </li>
                            </ul>
                          </td>
                          <td class="text-truncate">$9000</td>
                        </tr>
                        <tr>
                          <td class="text-truncate">Galaxy</td>
                          <td class="text-truncate p-1">
                            <ul class="list-unstyled users-list m-0">
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Ryan Schneider" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-14.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Tiffany Oliver" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-13.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joan Reid" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-12.png" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="text-truncate">$7500</td>
                        </tr>
                        <tr>
                          <td class="text-truncate">Moto Z2</td>
                          <td class="text-truncate p-1">
                            <ul class="list-unstyled users-list m-0">
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar">
                              </li>
                              <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                <img class="media-object rounded-circle" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                              </li>
                              <li class="avatar avatar-sm">
                                <span class="badge badge-info">+1 more</span>
                              </li>
                            </ul>
                          </td>
                          <td class="text-truncate">$8500</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Products sell and New Orders -->
        <!-- Recent Transactions -->
        <div class="row">
          <div id="recent-transactions" class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Recent Transactions</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="invoice-summary.html" target="_blank">Invoice Summary</a></li>
                  </ul>
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
                        <th class="border-top-0">Categories</th>
                        <th class="border-top-0">Shipping</th>
                        <th class="border-top-0">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>                          Paid</td>
                        <td class="text-truncate"><a href="#">INV-001001</a></td>
                        <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-4.png" alt="avatar">
                          </span>
                          <span>Elizabeth W.</span>
                        </td>
                        <td class="text-truncate p-1">
                          <ul class="list-unstyled users-list m-0">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-4.jpg" alt="Avatar">
                            </li>
                            <li class="avatar avatar-sm">
                              <span class="badge badge-info">+1 more</span>
                            </li>
                          </ul>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-danger round">Food</button>
                        </td>
                        <td>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="text-truncate">$ 1200.00</td>
                      </tr>
                      <tr>
                        <td class="text-truncate"><i class="la la-dot-circle-o danger font-medium-1 mr-1"></i>                          Declined</td>
                        <td class="text-truncate"><a href="#">INV-001002</a></td>
                        <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-5.png" alt="avatar">
                          </span>
                          <span>Doris R.</span>
                        </td>
                        <td class="text-truncate p-1">
                          <ul class="list-unstyled users-list m-0">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                            </li>
                            <li class="avatar avatar-sm">
                              <span class="badge badge-info">+2 more</span>
                            </li>
                          </ul>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-warning round">Electronics</button>
                        </td>
                        <td>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="text-truncate">$ 1850.00</td>
                      </tr>
                      <tr>
                        <td class="text-truncate"><i class="la la-dot-circle-o warning font-medium-1 mr-1"></i>                          Pending</td>
                        <td class="text-truncate"><a href="#">INV-001003</a></td>
                        <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-6.png" alt="avatar">
                          </span>
                          <span>Megan S.</span>
                        </td>
                        <td class="text-truncate p-1">
                          <ul class="list-unstyled users-list m-0">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-2.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                            </li>
                          </ul>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-success round">Groceries</button>
                        </td>
                        <td>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="text-truncate">$ 3200.00</td>
                      </tr>
                      <tr>
                        <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>                          Paid</td>
                        <td class="text-truncate"><a href="#">INV-001004</a></td>
                        <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-7.png" alt="avatar">
                          </span>
                          <span>Andrew D.</span>
                        </td>
                        <td class="text-truncate p-1">
                          <ul class="list-unstyled users-list m-0">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-6.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-1.jpg" alt="Avatar">
                            </li>
                            <li class="avatar avatar-sm">
                              <span class="badge badge-info">+1 more</span>
                            </li>
                          </ul>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-info round">Apparels</button>
                        </td>
                        <td>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="text-truncate">$ 4500.00</td>
                      </tr>
                      <tr>
                        <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>                          Paid</td>
                        <td class="text-truncate"><a href="#">INV-001005</a></td>
                        <td class="text-truncate">
                          <span class="avatar avatar-xs">
                            <img class="box-shadow-2" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-9.png" alt="avatar">
                          </span>
                          <span>Walter R.</span>
                        </td>
                        <td class="text-truncate p-1">
                          <ul class="list-unstyled users-list m-0">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-5.jpg" alt="Avatar">
                            </li>
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                              <img class="media-object rounded-circle no-border-top-radius no-border-bottom-radius" src="{{asset('admin')}}/app-assets/images/portfolio/portfolio-3.jpg" alt="Avatar">
                            </li>
                          </ul>
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-danger round">Food</button>
                        </td>
                        <td>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td class="text-truncate">$ 1500.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Recent Transactions -->
        <!--Recent Orders & Monthly Sales -->
        <div class="row match-height">
          <div class="col-xl-8 col-lg-12">
            <div class="card" style="height: 394px;">
              <div class="card-content ">
                <div id="cost-revenue" class="height-250 position-relative"><div class="chartist-tooltip" style="top: 78.4531px; left: 634.203px;"></div><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"></g><g><g class="ct-series ct-series-a"><path d="M0,250L0,187.5C25.047,195.833,50.094,212.5,75.141,212.5C100.188,212.5,125.234,175,150.281,175C175.328,175,200.375,212.5,225.422,212.5C250.469,212.5,275.516,150,300.563,150C325.609,150,350.656,187.5,375.703,187.5C400.75,187.5,425.797,164.286,450.844,150C475.891,135.714,500.938,100,525.984,100C551.031,100,576.078,162.5,601.125,162.5C626.172,162.5,651.219,104.167,676.266,75L676.266,250Z" class="ct-area" style="fill: #28D094; fill-opacity: 0.2"></path><path d="M0,187.5C25.047,195.833,50.094,212.5,75.141,212.5C100.188,212.5,125.234,175,150.281,175C175.328,175,200.375,212.5,225.422,212.5C250.469,212.5,275.516,150,300.563,150C325.609,150,350.656,187.5,375.703,187.5C400.75,187.5,425.797,164.286,450.844,150C475.891,135.714,500.938,100,525.984,100C551.031,100,576.078,162.5,601.125,162.5C626.172,162.5,651.219,104.167,676.266,75" class="ct-line" style="fill: transparent; stroke: #28D094; stroke-width: 4px;"></path><circle cx="0" cy="187.5" r="7" class="ct-area-circle"></circle><circle cx="75.140625" cy="212.5" r="7" class="ct-area-circle"></circle><circle cx="150.28125" cy="175" r="7" class="ct-area-circle"></circle><circle cx="225.421875" cy="212.5" r="7" class="ct-area-circle"></circle><circle cx="300.5625" cy="150" r="7" class="ct-area-circle"></circle><circle cx="375.703125" cy="187.5" r="7" class="ct-area-circle"></circle><circle cx="450.84375" cy="150" r="7" class="ct-area-circle"></circle><circle cx="525.984375" cy="100" r="7" class="ct-area-circle"></circle><circle cx="601.125" cy="162.5" r="7" class="ct-area-circle"></circle><circle cx="676.265625" cy="75" r="7" class="ct-area-circle"></circle></g></g><g class="ct-labels"></g></svg></div>
              </div>
              <div class="card-footer">
                <div class="row mt-1">
                  <div class="col-3 text-center">
                    <h6 class="text-muted">Total Products</h6>
                    <h2 class="block font-weight-normal">18.6 k</h2>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 text-center">
                    <h6 class="text-muted">Total Sales</h6>
                    <h2 class="block font-weight-normal">64.54 M</h2>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 text-center">
                    <h6 class="text-muted">Total Cost</h6>
                    <h2 class="block font-weight-normal">24.38 B</h2>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-3 text-center">
                    <h6 class="text-muted">Total Revenue</h6>
                    <h2 class="block font-weight-normal">36.72 M</h2>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
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
                  <div id="monthly-sales" class="height-250" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="250" version="1.1" width="281.125" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.0625px; top: -0.546875px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="44.859375" y="211" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#e4e7ed" d="M57.359375,211H256.125" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="44.859375" y="164.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">750</tspan></text><path fill="none" stroke="#e4e7ed" d="M57.359375,164.5H256.125" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="44.859375" y="118" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,500</tspan></text><path fill="none" stroke="#e4e7ed" d="M57.359375,118H256.125" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="44.859375" y="71.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,250</tspan></text><path fill="none" stroke="#e4e7ed" d="M57.359375,71.5H256.125" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="44.859375" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3,000</tspan></text><path fill="none" stroke="#e4e7ed" d="M57.359375,25H256.125" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="247.84309895833334" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Dec</tspan></text><text x="165.02408854166669" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Jul</tspan></text><text x="82.205078125" y="223.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#bfbfbf" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Feb</tspan></text><rect x="63.15670572916667" y="97.23" width="4.969140625" height="113.77" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="79.72050781249999" y="64.928" width="4.969140625" height="146.072" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="96.28430989583332" y="120.542" width="4.969140625" height="90.458" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="112.84811197916666" y="131.082" width="4.969140625" height="79.918" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="129.4119140625" y="108.886" width="4.969140625" height="102.114" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="145.97571614583333" y="77.328" width="4.969140625" height="133.672" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="162.53951822916667" y="97.23" width="4.969140625" height="113.77" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="179.1033203125" y="64.928" width="4.969140625" height="146.072" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="195.66712239583333" y="120.542" width="4.969140625" height="90.458" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="212.23092447916667" y="131.082" width="4.969140625" height="79.918" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="228.7947265625" y="108.886" width="4.969140625" height="102.114" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="245.35852864583333" y="77.328" width="4.969140625" height="133.672" rx="0" ry="0" fill="#ff394f" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="left: 52.4095px; top: 93px; display: none;"><div class="morris-hover-row-label">Mar</div><div class="morris-hover-point" style="color: #FF394F">
  Sales:
  1,459
</div></div></div>
                </div>
              </div>
              <div class="card-footer">
                <div class="chart-title mb-1 text-center">
                  <h6>Total monthly Sales.</h6>
                </div>
                <div class="chart-stats text-center">
                  <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1">Statistics <i class="ft-bar-chart"></i></a>
                  <span class="text-muted">for the last year.</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/Recent Orders & Monthly Sales -->
        <!-- Basic Horizontal Timeline -->
        <div class="row match-height">
          <div class="col-xl-4 col-lg-12">
            <div class="card" style="height: 503px;">
              <div class="card-header">
                <h4 class="card-title">Basic Card</h4>
              </div>
              <div class="card-content">
                <img class="img-fluid" src="{{asset('admin')}}/app-assets/images/carousel/05.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Some quick example text to build on the card title and make up
                    the bulk of the card's content.</p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>
              <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                <span class="float-left">3 hours ago</span>
                <span class="float-right">
                  <a href="#" class="card-link">Read More <i class="fa fa-angle-right"></i></a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-lg-12">
            <div class="card" style="height: 503px;">
              <div class="card-header">
                <h4 class="card-title">Horizontal Timeline</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="card-text">
                    <section class="cd-horizontal-timeline loaded">
                      <div class="timeline">
                        <div class="events-wrapper">
                          <div class="events" style="width: 1140px;">
                            <ol>
                              <li><a href="#0" data-date="16/01/2015" class="selected" style="left: 120px;">16 Jan</a></li>
                              <li><a href="#0" data-date="28/02/2015" style="left: 300px;">28 Feb</a></li>
                              <li><a href="#0" data-date="20/04/2015" style="left: 480px;">20 Mar</a></li>
                              <li><a href="#0" data-date="20/05/2015" style="left: 600px;">20 May</a></li>
                              <li><a href="#0" data-date="09/07/2015" style="left: 780px;">09 Jul</a></li>
                              <li><a href="#0" data-date="30/08/2015" style="left: 960px;">30 Aug</a></li>
                              <li><a href="#0" data-date="15/09/2015" style="left: 1020px;">15 Sep</a></li>
                            </ol>
                            <span class="filling-line" aria-hidden="true" style="transform: scaleX(0.129215);"></span>
                          </div>
                          <!-- .events -->
                        </div>
                        <!-- .events-wrapper -->
                        <ul class="cd-timeline-navigation">
                          <li><a href="#0" class="prev inactive">Prev</a></li>
                          <li><a href="#0" class="next">Next</a></li>
                        </ul>
                        <!-- .cd-timeline-navigation -->
                      </div>
                      <!-- .timeline -->
                      <div class="events-content">
                        <ol>
                          <li class="selected" data-date="16/01/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-5.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="28/02/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-6.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="20/04/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="20/05/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-8.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="09/07/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-9.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="30/08/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-6.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                          <li data-date="15/09/2015">
                            <blockquote class="blockquote border-0">
                              <div class="media">
                                <div class="media-left">
                                  <img class="media-object img-xl mr-1" src="{{asset('admin')}}/app-assets/images/portrait/small/avatar-s-7.png" alt="Generic placeholder image">
                                </div>
                                <div class="media-body">
                                  Sometimes life is going to hit you in the head with a brick. Don't lose faith.
                                </div>
                              </div>
                              <footer class="blockquote-footer text-right">Steve Jobs
                                <cite title="Source Title">Entrepreneur</cite>
                              </footer>
                            </blockquote>
                            <p class="lead mt-2">
                              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia,
                              fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur
                              aspernatur at.
                            </p>
                          </li>
                        </ol>
                      </div>
                      <!-- .events-content -->
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Basic Horizontal Timeline -->
      </div>
    </div>
  </div>

@endsection
