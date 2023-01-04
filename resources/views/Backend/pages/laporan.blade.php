@extends('layouts.main')
@section('container')
<link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
<!-- This Page CSS -->
<link href="{{  url('style/assets/libs/morris.js/morris.css')}}" rel="stylesheet">
<style>
.accordion {
  width: 100%;
  margin: 0 auto;
  overflow: hidden;
  border-radius: 4px;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.accordion-header {
  display: flex;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  width: 100%;
  background: #1f8dd6;
  border: none;
  outline: none;
  border-bottom: 1px solid #54a0ff;
  color: #f3f3f3;
  cursor: pointer;
}

.accordion-header.active {
  background-color: #1070b1;
}
.accordion-header.active i {
  transform: rotate(180deg);
  transition: all 0.3s ease-in-out;
}

.accordion-body {
  padding: 0 1rem;
  background-color: #ffffff;
  max-height: 0;
  overflow: hidden;
  transition: all 0.3s ease-in-out;
  box-shadow: 10px 10px black;
  
}

.accordion-body.active {
  max-height: 100rem;
  padding: 1rem;}

.conteiner{
    width: 650px;
    background-color: white;
    padding: 30px;
}

.tab_box{
    width: 100%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    border-bottom: 2px solid rgba(229,229,229);
    position: relative;

}
.tab_box .tab_btn{
    font-size: 15px;
    font-weight: 300;
    color: #919191;
    background: none;
    border: none;
    padding: 18px;
    cursor: pointer;
}

.tab_box .tab_btn.active{
    color: #1f8dd6;

}

.content_box{
    padding: 20px;
}

.content_box .content{
    display: none;
    animation: moving .5s ease;
}
@keyframes moving{
    from{transform: translateX(50px); opacity: 0;}
    to{transform: translateX(0px); opacity: 1;}
}

.content_box .content.active{
    display: block;
}

.content_box .content h2{
    margin-bottom: 10px;
}

.line{
    position:absolute;
    top: 57px;
    left: 130px;
    width: 90px;
    height: 5px;
    background-color: blue;
    border-radius: 10px;
    transition: all .3s ease-in-out;
}


</style>
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
                    <strong>Pemasukan Bulan Januari</strong><i class="fas fa-angle-down"></i>
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
                        {{-- <li class="nav-item">
                            <a href="#other-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block"><strong>Other</strong></span>
                            </a>
                        </li> --}}
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="omset-b2">
                            <div id="morris-bar-omset" class="omset"></div>
                            <ul class="list-inline text-center mt-2">
                                <li class="list-inline-item">
                                    <h6><i class="fa fa-circle mr-1" style="color:#ee4800"></i>Omset Bulan Januari</h6>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="profit-b2">
                            <div id="morris-bar-profit" class="profit"></div>
                            <ul class="list-inline text-center mt-2">
                                <li class="list-inline-item">
                                    <h6><i class="fa fa-circle mr-1" style="color:#ee4800"></i>Profit Bulan Januari</h6>
                                </li>
                            </ul>       
                        </div>
                        {{-- <div class="tab-pane" id="other-b2">
                            <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et
                                magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                                ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                                quis enim.</p>
                            <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                                dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div> --}}
                    </div>
                  </div>
                </div>  
              </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="container">
        <div class="tab_box">
            <button class="tab_btn active">Omset</button>
            <button class="tab_btn">Profit</button>
            <button class="tab_btn">Other</button>
            <div class="line"></div>
        </div>
        <div class="content_box">
            <div class="content active">
                <h2>Omset</h2>
                <div id="morris-bar-omset"></div>
                    <ul class="list-inline text-center mt-2">
                        <li class="list-inline-item">
                            <h6><i class="fa fa-circle mr-1" style="color:#00C453"></i>Omset Bulan Januari</h6>
                        </li>
                    </ul>
            </div>
            <div class="content">
                <h2>Profit</h2>
                <div id="morris-bar-profit"></div>
                    <ul class="list-inline text-center mt-2">
                        <li class="list-inline-item">
                            <h6><i class="fa fa-circle mr-1" style="color:#00C453"></i>Profit Bulan Januari</h6>
                        </li>
                    </ul>    
            </div>
            <div class="content">
                <h2>Other</h2>
                Tets aja
            </div>
        </div>
    </div>
</div> --}}
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
{{-- <script src="{{ url('style/dist/js/pages/morris/morris-data.js')}}"></script> --}}

<script>
    $(document).ready(function(){
    var Omset = Morris.Bar({
        element: 'morris-bar-omset',
        data: [{
            y: '2006',
            a: 90,
            b: 90,
            c: 60
        }, {
            y: '2007',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: '2008',
            a: 50,
            b: 40,
            c: 30
        }, {
            y: '2009',
            a: 75,
            b: 65,
            c: 40
        },
        {
            y: '2010',
            a: 75,
            b: 65,
            c: 40
        },
        {
            y: '2011',
            a: 75,
            b: 65,
            c: 40
        },
        {
            y: '2012',
            a: 75,
            b: 65,
            c: 40
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['A', 'B'],
        barColors:['#01caf1', '#5f76e8'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true,
        barSizeRatio:0.5,
        redraw: true,
        
    });

   var Profit = Morris.Bar({
        element: 'morris-bar-profit',
        data: [{
            y: '2006',
            a: 25000,
            b: 90,
            c: 60
        }, {
            y: '2007',
            a: 20000,
            b: 65,
            c: 40
        }, {
            y: '2008',
            a: 23000,
            b: 40,
            c: 30
        }, {
            y: '2009',
            a: 28000,
            b: 65,
            c: 40
        },{
            y: '2010',
            a: 21000,
            b: 65,
            c: 40
        },
        {
            y: '2011',
            a: 27000,
            b: 65,
            c: 40
        },
        {
            y: '2012',
            a: 24000,
            b: 65,
            c: 40
        }],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['A'],
        barColors:['#00C453'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        barSizeRatio:0.5,
        resize: true,
        redraw: true
    });

$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    var target = $(e.target).attr("href") // activated tab
    // alert(e.target.href)
    switch (target) {
        case "#omset-b2":
            Omset.redraw();
        break;
        case "#profit-b2":
            Profit.redraw();
            let element_svg = document.querySelector(".profit svg");
            element_svg.style.setProperty("width", "100%");
        break;
    }
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

// window.onclick = (e) => {
//   if (!e.target.matches(".accordion-header")) {
//     acc_btns.forEach((btn) => btn.classList.remove("active"));
//     acc_contents.forEach((acc) => acc.classList.remove("active"));
//   }
// };
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