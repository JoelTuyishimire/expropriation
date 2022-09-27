@extends("layouts.master")
@section("title","Dashboard")
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@stop
@section("content")
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Stats Widget 26-->
                    <div class="card card-custom bg-primary card-stretch gutter-b">
                        <!--begin::ody-->
                        <div class="card-body">
                            <i class="la fa-road fa-2x"></i>
                            <!--end::Svg Icon-->
                            </span>
                            <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{expropriatedPropertyByType(2)->count}}</span>
                            <span class="font-weight-bold font-size-sm text-white">Total {{expropriatedPropertyByType(2)->name}}</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 26-->
                </div>
                <div class="col-md-3">
                    <!--begin::Stats Widget 29-->
                    <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{asset('assets/media/svg/shapes/abstract-2.svg')}})">
                        <!--begin::Body-->
                        <div class="card-body">
												<i class="la la-house-damage fa-2x"></i>
                                                    <!--end::Svg Icon-->
												</span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{expropriatedPropertyByType(1)->count}}</span>
                            <span class="font-weight-bold font-size-sm">Total {{expropriatedPropertyByType(1)->name}}</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 29-->
                </div>

                <div class="col-md-3">
                    <!--begin::Stats Widget 27-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-2x svg-icon-success">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
												 <i class="la la-tree fa-2x"></i>
                                                    <!--end::Svg Icon-->
												</span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{expropriatedPropertyByType(3)->count}}</span>
                            <span class="font-weight-bold font-size-sm">Total {{expropriatedPropertyByType(3)->name}}</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 27-->
                </div>
                <div class="col-md-3">
                    <!--begin::Stats Widget 27-->
                    <div class="card card-custom bg-warning card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-2x svg-icon-white">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24"></rect>
															<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
															<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
															<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
															<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                            <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{number_format($totalTransactions)}}</span>
                            <span class="font-weight-bold font-size-sm text-white">Total Transactions Amount</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 27-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div c  lass="card card-body rounded shadow-sm border-0 h-100">
                        <h4> Expropriated Properties per Categories</h4>
                        <div id="chart_12" class="d-flex justify-content-center"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="card-spacer bg-white card-rounded flex-grow-1 h-100">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col px-3 py-2 ">
                                <div class="font-size-sm text-muted font-weight-bold">Total Rejected</div>
                                <div class="font-weight-bolder" >{{totalRejected()}}</div>
                            </div>
                            <div class="col px-3 py-2">
                                <div class="font-size-sm text-muted font-weight-bold">Total Approved</div>
                                <div class="font-weight-bolder" >{{number_format(totalApproved())}}</div>
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col">
                                <hr>
                                <h4 class="mb-4"> Recent Expropriations</h4>
                                <div class="flex-grow-1">

                                    @foreach($latestExpropriation as $latest)
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-between mb-10">
                                            <div class="d-flex align-items-center mr-2">
                                                <div>
                                                    <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">{{optional($latest->propertyType)->name}}</a>
                                                    <div class="font-size-sm text-muted font-weight-bold mt-1">
                                                        {{optional($latest->citizen)->name}}</div>
                                                    <span class="text-muted font-weight-bold">{{getExpropriationItems($latest)}}</span>
                                                </div>
                                            </div>
                                            <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">{{$latest->amount}} RWF</div>
                                        </div>
                                        <!--end::Item-->
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <!--end::Row-->
                    </div>
                </div>

            </div>

            <div class="row mt-10">
                <div class="col-md-12">
                    <div class="card card-body rounded shadow-sm border-0 h-100">
                        <h4> Total Claims Per Year </h4>
                        <div id="sales-per-month"></div>
                    </div>
                </div>
            </div>



            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
@section("scripts")
    <script>
        let data = @json($expropriatedPropertiesByCategory);
        // Shared Colors Definition
        const primary = '#6993FF';
        const success = '#1BC5BD';
        const info = '#8950FC';
        const warning = '#FFA800';
        const danger = '#F64E60';
        $('.nav-dashboard').addClass('menu-item-active');

        let pieData=@json(chargesPerService());
        console.log(pieData);
        var options1 = {
            series: Object.values(pieData),
            chart: {
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },
            labels: Object.keys(pieData),
            fill: {
                type: 'gradient',
            },
            legend: {
                formatter: function (val, opts) {
                    return val + " : " + opts.w.globals.series[opts.seriesIndex].toLocaleString()
                },
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val.toLocaleString();
                    }
                }
            },
            // title: {
            //     text: "Beneficiaries by Gender"
            // },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chartId = "#charges-per-service"
        var chart1 = new ApexCharts(document.querySelector(chartId), options1);
        chart1.render();

        var _demo13 = function () {
            let data=@json(chargesPerMonth());
            const apexChart = "#charges-per-month";
            var options12 = {
                series:[
                    {
                        name: "Total Charges",
                        data: Object.values(data)
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: Object.keys(data),
                },
                yaxis: {
                    title: {
                        text: 'RWF'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "RWF "+val.toLocaleString()
                        }
                    }
                }
            };

            var chart12 = new ApexCharts(document.querySelector(apexChart), options12);
            chart12.render();
        }

        var _demo12 = function () {
            let data=@json(salesPerMonth());
            const apexChart = "#sales-per-month";
            var options12 = {
                series:[
                    {
                        name: "Total Sales",
                        data: Object.values(data)
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: Object.keys(data),
                },
                yaxis: {
                    title: {
                        text: 'RWF'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "RWF "+val.toLocaleString()
                        }
                    }
                }
            };

            var chart12 = new ApexCharts(document.querySelector(apexChart), options12);
            chart12.render();
        }
        $(function () {
            _demo13();
            _demo12();
            _demo1();
        });

        var _demo1 = function () {
            const apexChart = "#chart_12";
            var options = {
                series: Object.values(data),
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: Object.keys(data),
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: [primary, success, warning, danger, info]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }

    </script>
@stop
