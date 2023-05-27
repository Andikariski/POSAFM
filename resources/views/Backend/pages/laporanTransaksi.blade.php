@extends('layouts.main')
@section('container')
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
<link href="{{ url('style/dist/css/custome.css')}}" rel="stylesheet"/>
<style>
  .bg{
    border-radius: 5px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 1px 7px 0px;
  }
</style>
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
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
                <div class="card cstm" style="height: 100%">
                    <div class="card-header">
                        <h4 class="card-title"><font color="white">Grafik Transaksi Penjualan</font></h4>
                    </div>
                    <div class="card-body" style="width:65%">
                      <div class="form-group mb-4">
                        <label for="exampleFormControlSelect1"><font style="font-size: 17px">Filter Grafik Laporan</font></label>
                        <select id="filter" class="form-control select" style="width: 40%">
                            <option value="Harian">Grafik Minggu Ini (Harian)</option>
                            <option value="Mingguan">Grafik Bulan Ini (Mingguan)</option>
                            <option value="Bulanan">Grafik Tahun Ini (Bulanan)</option>
                        </select>
                      </div>
                        <div class="mt-4">
                            <canvas id="transaksi"></canvas>
                        </div>
                        {{-- <ul class="list-inline text-center mt-2">
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#FF8300"></i>Omset</h6>
                            </li>
                            <li class="list-inline-item">
                                <h6><i class="fa fa-circle mr-1" style="color:#00C928"></i>Profit</h6>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
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

{{-- CHART js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.min.js" integrity="sha512-fYE9wAJg2PYbpJPxyGcuzDSiMuWJiw58rKa9MWQICkAqEO+xeJ5hg5qPihF8kqa7tbgJxsmgY0Yp51+IMrSEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  const transaksiChart = $('#transaksi');
  var chart;

// Fungsi untuk mengambil data yang difilter dari model database
function fetchData(filter) {
    fetch('/filter-data/' + filter)
        .then(response => response.json())
        .then(data => {
            // Memproses data dari response
            var labels = data.map(item => item.tanggal);
            var values = data.map(item => item.transaksi);

            // Memperbarui data grafik
            chart.data.labels = labels;
            chart.data.datasets[0].data = values;
            // chart.data.options.maintainAspectRatio = true;
            // chart.data.options.responsive = true;
            // chart.height = 80;
            chart.update();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

chart = new Chart(transaksiChart, {
    type: 'line',
    data: {
            labels: [],
            datasets: [{
              label: 'Jumlah Transaksi',
              data: [],
              borderWidth: 3,
              pointRadius: 4,
              pointHoverRadius: 8
            }]
          },
          options: {
            responsive : true,
            maintainAspectRatio : true,
            plugins:{
              legend:{
                display: false,
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize : 1
                }
              }
            }
          }
 });
// Inisialisasi grafik awal
fetchData('Harian');

// Mendengarkan perubahan pada elemen filter
document.getElementById('filter').addEventListener('change', function() {
    var selectedFilter = this.value;
    fetchData(selectedFilter);
});

</script>

<script>
  $(document).ready(function() {
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
              pointRadius: 4,
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
                beginAtZero: true,
                ticks: {
                  stepSize : 1
                }
              }
            }
          }
        });
    });

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
              backgroundColor: '#00CCB3'
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
  })
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