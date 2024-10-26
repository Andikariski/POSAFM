@extends('layouts.main')
@section('container')
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>

<!-- This Page CSS -->
<link href="{{  url('style/assets/libs/morris.js/morris.css')}}" rel="stylesheet">
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                {{-- <h2 class="page-title text-truncate text-dark font-weight-medium mb-1"><strong>بِسْــــــــــــــــــمِ اللهِ الرَّحْمَنِ الرَّحِيْمِ</strong></h2> --}}
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
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
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Pelanggan</h6>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium mt-1">{{ $jumlahPelanggan }}</h2>
                                <span class="badge bg-primary font-12 text-white font-weight-medium ml-2 d-lg-block d-md-none">Orang</span>
                            </div>
                            <h6 class="text-muted mt-1 w-100 text-truncate" style="text-color:#00C453 "><i class="fas fa-arrow-up" style="color: #00C453"></i> 10%, Dari hari kemarin</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="user-plus" style="width:40px; height:40px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi Hari Ini</h6>
                            <div class="d-inline-flex align-items-center">
                                <h2 class="text-dark mb-1 font-weight-medium mt-1">{{ $totalTransaksi }}</h2>
                                <span class="badge bg-success font-12 text-white font-weight-medium ml-2 d-lg-block d-md-none">Transaksi</span>
                            </div>
                            <h6 class="text-muted mt-1 w-100 text-truncate" style="text-color:#00C453 "><i class="fas fa-arrow-up" style="color: #00C453"></i> 10%, Dari hari kemarin</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="shopping-cart" style="width:40px; height:40px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-right">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Omset Hari Ini</h6>
                            <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium mt-2">
                                <sup class="set-doller">Rp </sup>{{ number_format($omsetHariIni) }}</h2>
                            <h6 class="text-muted mt-1 w-100 text-truncate" style="text-color:#00C453 "><i class="fas fa-arrow-down" style="color: #ff425c"></i> 15%, Dari hari kemarin</h6>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="dollar-sign" style="width:40px; height:40px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div>
                            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Profit Hari Ini</h6>
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium mt-2">
                                    <sup class="set-doller">Rp </sup>{{ number_format($profitHariIni) }}</h2>
                                    <h6 class="text-muted mt-1 w-100 text-truncate" style="text-color:#00C453 "><i class="fas fa-arrow-up" style="color: #00C453"></i> 10%, Dari hari kemarin</h6>
                            </div>
                        </div>
                        <div class="ml-auto mt-md-3 mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="bar-chart-2" style="width:40px; height:40px"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card cstm" style="height: 95%">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Status Transaksi</font></h4>
                    </div>
                    <div class="card-body">
                        {{-- <div id="morris-donut-chart"></div> --}}
                        <div>
                            <canvas id="chart-pie"></canvas>
                        </div>
                        <ul class="list-inline text-center mt-4">
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#00C453"></i>Lunas Lunas</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#FF425C"></i>Belum Lunas</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card cstm" style="height: 95%">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Grafik Pendapatan Mingguan, {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</font></h4>
                    </div>
                    <div class="card-body">
                        {{-- <div id="morris-bar-chart"></div> --}}
                        <div>
                            <canvas id="chart-bar"></canvas>
                        </div>
                        <ul class="list-inline text-center mt-2">
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#FF8300"></i>Omset</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#00C928"></i>Profit</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card cstm" style="height: 95%">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Top 5 Produk Terlaris</font></h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th width="70px">No</th>
                                    <th>Nama Produk</th>
                                    <th width="150px">Produk Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($produkTerlaris as $item)    
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ strtoupper($item->nama_produk) }}</td>
                                    {{-- <td>{{ $item->totalProduk }} Produk</td> --}}
                                    <td><span class="badge bg-success font-16 text-white">{{ $item->totalProduk }} Produk</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                    <div class="card cstm" style="height: 95%">
                        <div class="card-header">
                            <h4 class="card-title"><font color="white">Free Card</font></h4>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endsection
  {{-- Chart Moriss--}}
  <script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ url('style/dist/js/custom.min.js')}}"></script>
  
  {{-- CHART js --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.min.js" integrity="sha512-fYE9wAJg2PYbpJPxyGcuzDSiMuWJiw58rKa9MWQICkAqEO+xeJ5hg5qPihF8kqa7tbgJxsmgY0Yp51+IMrSEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


{{-- script grafik donuts --}}
<script>
    $(document).ready(function() {
        $.getJSON('data-transaksi-mingguan', function(data){
        var transaksiMingguan = $('#chart-pie');
        new Chart(transaksiMingguan, {
            type: 'doughnut',
            data: {
                labels :['Lunas','Belum Lunas'],
                datasets : [{
                    label: 'Sebanyak',
                    data: data,
                    backgroundColor: ['#00C928','#FF425C']
            }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'top',
                    },
                }
            },
        });
    });

    $.getJSON('data-pemasukan-mingguan', function(data){
        var tanggal   = data.map(function(index){
                        return index.tanggal;
        })
        var omset   = data.map(function(index){
                        return index.omset;
        })
        var profit   = data.map(function(index){
                        return index.profit;
        })

        // console.log(tanggal,omset,profit);
        var pemasukanMingguan = $('#chart-bar');
        new Chart(pemasukanMingguan, {
                type: 'bar',
                data: {
                    labels: tanggal,
                    datasets :[
                        {
                        label: 'Omset',
                        data: omset,
                        backgroundColor: '#FF8300',
                        },
                        {
                        label: 'Profit',
                        data: profit,
                        backgroundColor: '#00C928',
                        },
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display : false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                        }
                    }
                }
        });
    });
})
</script>
  