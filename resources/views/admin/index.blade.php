@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12 col-xl-6 mb-20">
        <div class="row">
            <div class="col-12 col-sm-6 ">
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-bag-shopping text-primary fa-xl"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Total Orders</div>
                            <h4 class="text-black">{{ $dashboardDatas['Total'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-dollar-sign fa-xl text-primary"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Total Amount</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalAmount'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-bag-shopping text-primary fa-xl"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Pending Orders</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalOrdered'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-dollar-sign fa-xl text-primary"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Pending Orders Amount</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalOrderedAmount'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-bag-shopping text-primary fa-xl"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Delivered Orders</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalDelivered'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-dollar-sign fa-xl text-primary"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Delivered Orders Amount</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalDeliveredAmount'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-bag-shopping text-primary fa-xl"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Canceled Orders</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalCancelled'] }}</h4>
                        </div>
                    </div>
                </div>
                <div class="wg-chart-default mb-20">
                    <div class="d-flex align-items-center gap-4">
                        <div class="image-icon">
                            <i class="fa-solid fa-dollar-sign fa-xl text-primary"></i>
                        </div>
                        <div class="body-text">
                            <div class="f-14 text-black mb-2">Canceled Orders Amount</div>
                            <h4 class="text-black">{{ $dashboardDatas['TotalCancelledAmount'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 mb-20">
        <div class="wg-box">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fs-5 fw-bolder">Earning revenue</h5>
                <div class="dropdown-open position-relative">
                    <i class="fa-solid fa-ellipsis fa-xl"></i>
                    <div class="menu-dropdown d-none revenue-drop-width p-2">
                        <ul class="dropdown-item-list ">
                            <li class="drop-item">
                                <a href="">
                                    This week
                                </a>
                            </li>
                            <li class="drop-item">
                                <a href="">
                                    Last week
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex align-items-center gap-4">
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <div class="dot dot-1"></div>
                        <div class="f-12 text-black-50">Revenue</div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <h4 class="f-22 fw-bolder m-0">{{  $dashboardDatas['TotalDeliveredAmount'] }}</h4>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fa-solid fa-chart-line text-success"></i>
                            <div class="f-14 fw-bolder">0.56%</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <div class="dot dot-2"></div>
                        <div class="f-12 text-black-50">Order</div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <h4 class="f-22 fw-bolder m-0">{{  $dashboardDatas['TotalOrderedAmount'] }}</h4>
                        <div class="d-flex align-items-center gap-1">
                            <i class="fa-solid fa-chart-line text-success"></i>
                            <div class="f-14 fw-bolder">0.56%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="line-chart-8"></div>
        </div>
    </div>
</div>

<div class="tf-section mb-30">
<div class="wg-box">
    <div class="d-flex justify-content-between align-items-content mb-3">
        <h5 class="fs-5 fw-bolder">Recent Orders</h5>
        <a href="{{ route('admin.orders') }}" class="text-black-50 f-12">View all</a>
    </div>
    <div class="wg-table">
        <div class="table-responsive">
                <table class="table table-striped table-bordered details-table">
                    <thead>
                        <tr>
                            <th class="text-start">OrderNo</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Subtotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th>Delivered On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>${{ $order->subtotal }}</td>
                                <td>${{ $order->tax }}</td>
                                <td>${{ $order->total }}</td>
                                <td>
                                    @if ($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @else
                                        <span class="badge bg-success">Ordered</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->orderItems->count() }}</td>
                                <td>{{ $order->delivered_date }}</td>
                                <td>
                                    <a href="{{ route('admin.order.details', ['id' => $order->id]) }}">
                                        <i class="fa-regular fa-eye text-black"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>
@endsection
@push('script')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/apexcharts.js') }}"></script>
<script>
    (function ($) {

        var tfLineChart = (function () {

            var chartBar = function () {

                var options = {
                    series: [{
                        name: 'Total',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }, {
                        name: 'Pending',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00, 0.00, 0.00, 0.00]
                    },
                    {
                        name: 'Delivered',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }, {
                        name: 'Canceled',
                        data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00]
                    }],
                    chart: {
                        type: 'bar',
                        height: 325,
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '10px',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false,
                    },
                    colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                    stroke: {
                        show: false,
                    },
                    xaxis: {
                        labels: {
                            style: {
                                colors: '#212529',
                            },
                        },
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$ " + val + ""
                            }
                        }
                    }
                };

                chart = new ApexCharts(
                    document.querySelector("#line-chart-8"),
                    options
                );
                if ($("#line-chart-8").length > 0) {
                    chart.render();
                }
            };

            /* Function ============ */
            return {
                init: function () { },

                load: function () {
                    chartBar();
                },
                resize: function () { },
            };
        })();

        jQuery(document).ready(function () { });

        jQuery(window).on("load", function () {
            tfLineChart.load();
        });

        jQuery(window).on("resize", function () { });
    })(jQuery);
</script>
@endpush