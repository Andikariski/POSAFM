@extends('layouts.main')
@section('container')
<link href="{{ url('style/assets/libs/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" />
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
<!-- This Page CSS -->
<link href="{{  url('style/assets/libs/morris.js/morris.css')}}" rel="stylesheet">
{{-- <style>
    .card-header{
        background-color: #0093ad;
    }
</style> --}}
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning, {{ Auth::user()->name }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
                        <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('D MMMM YYYY') }}</strong>
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="card-group">
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $jumlahPelanggan }}</h2>
                                <span
                                    class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">Orang</span>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate text-purple">Total Pelanggan</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                    class="set-doller">Rp </sup>18,306</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Laba Hari Ini
                            </h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium">1538</h2>
                                <span
                                    class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span>
                            </div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Penjualan</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalTransaksi }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Transaksi Penjualan</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="shopping-cart"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Sales Charts Section -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Status Transaksi</font></h4>
                    </div>
                    <div class="card-body">
                        <div id="morris-donut-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Grafik Pendapatan</font></h4>
                    </div>
                    <div class="card-body">
                        {{-- <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                        <ul class="list-inline text-center mt-5 mb-2">
                            <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                        </ul> --}}
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End Sales Charts Section -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Location and Earnings Charts Section -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <h4 class="card-title mb-0">Earning Statistics</h4>
                            <div class="ml-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a class="dropdown-item" href="#">Insert</a>
                                        <a class="dropdown-item" href="#">Update</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-4 mb-5">
                            <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                        </div>
                        <ul class="list-inline text-center mt-4 mb-0">
                            <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Activity</h4>
                        <div class="mt-4 activity">
                            <div class="d-flex align-items-start border-left-line pb-3">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                        <i data-feather="shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                    <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                        Camera.
                                    </p>
                                    <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start border-left-line pb-3">
                                <div>
                                    <a href="javascript:void(0)"
                                        class="btn btn-danger btn-circle mb-2 btn-item">
                                        <i data-feather="message-square"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                    <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                        ticket</p>
                                    <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start border-left-line">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                        <i data-feather="bell"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                    </h5>
                                    <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                    <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                        Ago</span>
                                    <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-3 border-right pr-0">
                                <div class="card-body border-bottom">
                                    <h4 class="card-title mt-2">Drag & Drop Event</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="calendar-events" class="">
                                                <div class="calendar-events mb-3" data-class="bg-info"><i
                                                        class="fa fa-circle text-info mr-2"></i>Event One</div>
                                                <div class="calendar-events mb-3" data-class="bg-success"><i
                                                        class="fa fa-circle text-success mr-2"></i> Event Two
                                                </div>
                                                <div class="calendar-events mb-3" data-class="bg-danger"><i
                                                        class="fa fa-circle text-danger mr-2"></i>Event Three
                                                </div>
                                                <div class="calendar-events mb-3" data-class="bg-warning"><i
                                                        class="fa fa-circle text-warning mr-2"></i>Event Four
                                                </div>
                                            </div>
                                            <!-- checkbox -->
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="drop-remove">
                                                <label class="custom-control-label" for="drop-remove">Remove
                                                    after drop</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card-body b-l calender-sidebar">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
  {{-- Chart Moriss--}}
  <script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ url('style/dist/js/custom.min.js')}}"></script>
  
  <script src="{{ url('style/assets/libs/raphael/raphael.min.js')}}"></script>
  <script src="{{ url('style/assets/libs/morris.js/morris.min.js')}}"></script>
  {{-- <script src="{{ url('style/dist/js/pages/morris/morris-data.js')}}"></script> --}}
  <script>
    $(document).ready(function(){
        // Morris Donuts chart
        Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Lunas",
            value: {{ $lunas }},

        }, {
            label: "Belum Lunas",
            value: 5,
        }],
        resize: true,
        colors:['#5f76e8', '#01caf1', '#8fa0f3']
    });

    // Morris bar chart
     Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Senin',
            a: 100000,
            // b: 90,
            // c: 60
        }, {
            y: 'Selasa',
            a: 75000,
            // b: 65,
            // c: 40
        }, {
            y: 'Rabu',
            a: 50000,
            // b: 40,
            // c: 30
        }, {
            y: 'Kamis',
            a: 75000,
            // b: 65,
            // c: 40
        }, {
            y: 'Jumat',
            a: 50000,
            // b: 40,
            // c: 30
        }, {
            y: 'Sabtu',
            a: 75000,
            // b: 65,
            // c: 40
        }, {
            y: 'Minggu',
            a: 100000,
            // b: 90,
            // c: 40
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Profit'],
        barColors:['#01caf1', '#5f76e8'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
    })
  </script>
  @endsection
