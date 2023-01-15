@extends('layouts.main')
@section('container')
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>
<link href="{{  url('style/assets/libs/morris.js/morris.css')}}" rel="stylesheet">

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $headPage }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('riwayatTransaksiPenjualan') }}">Admin / {{ $headPage }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="accordion">
                <div class="accordion-item">
                  <button class="accordion-header">
                    <strong>Pemasukan Bulan {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</strong><i class="fas fa-angle-down"></i>
                  </button>
                  <div class="accordion-body">
                    <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#omset-b2" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block"><strong>Omset</strong></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profit-b2" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block"><strong>Profit</strong></span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="omset-b2">
                            {{-- <div id="morris-bar-omset" class="omset"></div> --}}
                            <div>
                                <canvas id="chart-omset"></canvas>
                            </div>
                            <ul class="list-inline text-center mt-2">
                                <li class="list-inline-item">
                                    <h6><i class="fa fa-circle mr-1" style="color:#ee4800"></i>Omset Bulan {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</h6>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="profit-b2">
                            {{-- <div id="morris-bar-profit" class="profit"></div> --}}
                            <div>
                                <canvas id="chart-profit"></canvas>
                            </div>
                            <ul class="list-inline text-center mt-2">
                                <li class="list-inline-item">
                                    <h6><i class="fa fa-circle mr-1" style="color:#ee4800"></i>Profit Bulan {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</h6>
                                </li>
                            </ul>       
                        </div>
                    </div>
                  </div>
                </div>  
              </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12">
            <div class="accordion">
                <div class="accordion-item">
                  <button class="accordion-header">
                    <strong>Transaksi Penjualan Bulan {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</strong><i class="fas fa-angle-down"></i>
                  </button>
                  <div class="accordion-body">
                    {{-- <div id="morris-bar-transaksi" class="omset"></div> --}}
                    <div>
                        <canvas id="chart-transaksi"></canvas>
                    </div>
                            <ul class="list-inline text-center mt-4">
                                <li class="list-inline-item">
                                    <h6><i class="fa fa-circle mr-1" style="color:#ee4800"></i>Transaksi Penjualan {{ Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'))->isoFormat('MMMM YYYY') }}</h6>
                                </li>
                            </ul>
                  </div>
                </div>  
              </div>
        </div>
    </div>
    <div>
      <canvas id="line-chart"></canvas>
  </div>
</div>
</div>
</div>
{{-- </div> --}}

{{-- Modal Ubah Data --}}
<div id="modalAction" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        {{-- Ambil dari blade action --}}
    </div>
</div>

{{-- Modal Detail Produk --}}
<div id="modalActionDetail" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{-- Ambil dari blade action --}}
    </div>
</div>
{{-- Modal Ubah Data End--}}

{{-- Chart Moriss--}}
<script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ url('style/dist/js/custom.min.js')}}"></script>

<script src="{{ url('style/assets/libs/raphael/raphael.min.js')}}"></script>
<script src="{{ url('style/assets/libs/morris.js/morris.min.js')}}"></script>

{{-- CHART js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.min.js" integrity="sha512-fYE9wAJg2PYbpJPxyGcuzDSiMuWJiw58rKa9MWQICkAqEO+xeJ5hg5qPihF8kqa7tbgJxsmgY0Yp51+IMrSEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$.getJSON('data-jumlah-transaksi-bulanan', function(data){
            var tanggal   = data.map(function(index){
                return index.tanggal;
            })
            var transaksi = data.map(function(index){
                return index.transaksi;
            })
            
        const transaksiChart = $('#chart-transaksi');
        new Chart(transaksiChart, {
          type: 'line',
          data: {
            labels: tanggal,
            datasets: [{
              label: 'Jumlah Transaksi',
              data: transaksi,
              borderWidth: 3,
              pointRadius: 5,
              pointHoverRadius: 8
            }]
          },
          options: {
            plugins:{
              legend:{
                display: false,
              }
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    });
</script>
<script>
// $(document).ready(function(){
    $.getJSON('data-pemasukan-bulanan', function(data){
        
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

        var omsetChart = $('#chart-omset');
        new Chart(omsetChart, {
          type: 'bar',
          data: {
            labels: tanggal,
            datasets: [{
              label: 'Omset',
              data: omset,
              borderWidth: 0,
              backgroundColor: '#FA6A00'
            }]
          },
          tension: 0.4,
          options: {
            plugins:{
              legend:{
                display: false,
              }
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });


        var profitChart = $('#chart-profit');
        new Chart(profitChart, {
          type: 'bar',
          data: {
            labels: tanggal,
            datasets: [{
              label: 'Profit',
              data: profit,
              borderWidth: 0,
              backgroundColor: '#00C450'
            }]
          },
          tension: 0.4,
          options: {
            plugins:{
              legend:{
                display: false,
              }
            },
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    });

    // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    // var target = $(e.target).attr("href") // activated tab
    // // alert(e.target.href)
    // switch (target) {
    //     case "#omset-b2":
    //         alert('Omset');
    //         profitChart.destroy();
    //     break;
    //     case "#profit-b2":
    //         alert('Profit');
    //         omsetChart.destroy();
    //     break;
    // }
    // });
// });
</script>

<script>
const acc_btns = document.querySelectorAll(".accordion-header");
const acc_contents = document.querySelectorAll(".accordion-body");

acc_btns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    acc_contents.forEach((acc) => {
      if (
        e.target.nextElementSibling !== acc &&
        acc.classList.contains("active")
      ) {
        acc.classList.remove("active");
        acc_btns.forEach((btn) => btn.classList.remove("active"));
      }
    });

    const panel = btn.nextElementSibling;
    panel.classList.toggle("active");
    btn.classList.toggle("active");
  });
});
</script>

<script>
    const tabs = document.querySelectorAll('.tab_btn');
    const all_content = document.querySelectorAll('.content');

    tabs.forEach((tab,index)=>{
        tab.addEventListener('click',(e)=>{
            tabs.forEach(tab=>{tab.classList.remove('active')});
            tab.classList.add('active');    

            var line  = document.querySelector('.line');
            line.style.width = e.target.offsetWidth + "px";
            line.style.left = e.target.offsetLeft + "px";

            all_content.forEach(content=>{content.classList.remove('active')});
            all_content[index+1].classList.add('active');
        })
    })
</script>

@endsection