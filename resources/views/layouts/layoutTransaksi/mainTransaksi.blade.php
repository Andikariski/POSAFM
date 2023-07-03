@include('layouts.head')
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    {{-- <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"> --}}
        <!-- ============================================================== -->
        <!-- Header START -->
        @include('layouts.layoutTransaksi.headerTransaksi')
        <!-- Header END -->
        <!-- ============================================================== -->
        
        <!-- Sidebar START -->
        {{-- @include('layouts.sidebar') --}}
        <!-- Sidebar END -->
    

        <!-- Page wrapper START  -->
        <section class="content">
            @yield('container')
        </section>
        <!-- End Page wrapper  -->
    {{-- </div> --}}
{{-- </body> --}}
@include('layouts.footer')
</html>