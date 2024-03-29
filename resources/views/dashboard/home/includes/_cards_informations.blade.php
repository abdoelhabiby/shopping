<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="info">
                    @isset($card_information->get('products_sold')['total'])
                    {{ $card_information->get('products_sold')['total']  }}
                    @endisset

                </h3>
                <h6>Products Sold</h6>
              </div>
              <div>
                <i class="icon-basket-loaded info font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                @php
                    $percentage = 0;
                    if(isset($card_information->get('products_sold')['percentage'])){

                        $percentage = $card_information->get('products_sold')['percentage'];

                    }

                @endphp
              <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
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
                <h3 class="warning">
                    @isset($card_information->get('profit')['total'])
                    {{ $card_information->get('profit')['total']  }}
                    @endisset
                    EGP</h3>
                <h6>Net Profit</h6>
              </div>
              <div>
                <i class="icon-pie-chart warning font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                @php
                $percentage = 0;
                if(isset($card_information->get('profit')['percentage'])){

                    $percentage = $card_information->get('profit')['percentage'];

                }

            @endphp
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
                <h3 class="success">{{ $card_information->get('new_customers')  }}</h3>
                <h6>New Customers</h6>
              </div>
              <div>
                <i class="icon-user-follow success font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 35%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
