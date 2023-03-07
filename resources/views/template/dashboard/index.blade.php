@extends('template.core.master')
@section('content')
    <!-- Basic Breadcrumb -->
    <!-- Custom style1 Breadcrumb -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    </nav>

    <div class="row">
    <!-- Total Revenue -->
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Grafik Pengajuan Tahun 
                <script>
                document.write(new Date().getFullYear());
                </script>
            </h5>
            <div id="graphicChart"></div>
            </div>
        </div>
        </div>
    </div>
    <!--/ Total Revenue -->
    
    <!-- Order Statistics -->
    <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
            <h5 class="m-0 me-2">Statistik Pengajuan</h5>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column align-items-center gap-1">
                <h2 class="mb-2">{{ $allSubmission }}</h2>
                <span>Total Pengajuan</span>
            </div>
            <div id="statisticsChart"></div>
            </div>
            <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-success">
                    <i class='bx bx-face'></i>
                </span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <h6 class="mb-0">Kelahiran</h6>
                </div>
                <div class="user-progress">
                    <small class="fw-semibold">{{ $bornSubmission }}</small>
                </div>
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-flag"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <h6 class="mb-0">Kematian</h6>
                </div>
                <div class="user-progress">
                    <small class="fw-semibold">{{ $dieSubmission }}</small>
                </div>
                </div>
            </li>
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                    <h6 class="mb-0">Keterangan Miskin</h6>
                </div>
                <div class="user-progress">
                    <small class="fw-semibold">{{ $ksmSubmission }}</small>
                </div>
                </div>
            </li>
            </ul
        </div>
        </div>
    </div>
    <!--/ Order Statistics -->
    </div>
@endsection
@push('titlePage')
    {{ $titlePage }}
@endpush
@push('js')
    <script>
        "use strict";

        (function () {
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            // Statistics Chart
            // --------------------------------------------------------------------
            const chartOrderStatistics = document.querySelector(
                    "#statisticsChart"
                ),
                orderChartConfig = {
                    chart: {
                        height: 165,
                        width: 130,
                        type: "donut",
                    },
                    labels: ["Kelahiran", "Kematian", "KSM"],
                    series: [85, 15, 50],
                    colors: [
                        config.colors.success,
                        config.colors.warning,
                        config.colors.info,
                    ],
                    stroke: {
                        width: 5,
                        colors: cardColor,
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function (val, opt) {
                            return parseInt(val) + "%";
                        },
                    },
                    legend: {
                        show: false,
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            right: 15,
                        },
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: "75%",
                                labels: {
                                    show: true,
                                    value: {
                                        fontSize: "1.5rem",
                                        fontFamily: "Public Sans",
                                        color: headingColor,
                                        offsetY: -15,
                                        formatter: function (val) {
                                            return parseInt(val) + "%";
                                        },
                                    },
                                    name: {
                                        offsetY: 20,
                                        fontFamily: "Public Sans",
                                    },
                                },
                            },
                        },
                    },
                };
            if (
                typeof chartOrderStatistics !== undefined &&
                chartOrderStatistics !== null
            ) {
                const statisticsChart = new ApexCharts(
                    chartOrderStatistics,
                    orderChartConfig
                );
                statisticsChart.render();
            }

            // Income Chart - Area chart
            // --------------------------------------------------------------------
            const incomeChartEl = document.querySelector("#graphicChart"),
                incomeChartConfig = {
                    series: [
                        {
                            name: "Total Pengajuan",
                            data: [24, 21, 30, 22, 42, 26, 35, 29, 90, 12, 20, 34],
                        },
                    ],
                    chart: {
                        height: 350,
                        parentHeightOffset: 0,
                        parentWidthOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        type: "area",
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        curve: "smooth",
                    },
                    legend: {
                        show: false,
                    },
                    colors: [config.colors.primary],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: shadeColor,
                            shadeIntensity: 0.6,
                            opacityFrom: 0.5,
                            opacityTo: 0.25,
                            stops: [0, 95, 100],
                        },
                    },
                    grid: {
                        borderColor: borderColor,
                        strokeDashArray: 3,
                        padding: {
                            top: -20,
                            bottom: -8,
                            left: -10,
                            right: 8,
                        },
                    },
                    xaxis: {
                        categories: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: true,
                            style: {
                                fontSize: "13px",
                                colors: axisColor,
                            },
                        },
                    },
                };
            if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
                const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                incomeChart.render();
            }

        })();

    </script>
@endpush