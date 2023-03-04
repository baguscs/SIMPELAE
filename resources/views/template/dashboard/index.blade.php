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
            <div id="incomeChart"></div>
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
                <h2 class="mb-2">8,258</h2>
                <span>Total Pengajuan</span>
            </div>
            <div id="orderStatisticsChart"></div>
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
                    <small class="fw-semibold">825</small>
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
                    <small class="fw-semibold">238</small>
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
                    <small class="fw-semibold">849</small>
                </div>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </div>
    <!--/ Order Statistics -->
    </div>
@endsection