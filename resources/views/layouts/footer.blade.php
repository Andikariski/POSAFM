    <script src="{{ url('style/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ url('style/assets/libs/jquery/dist/autoNumeric.js')}}"></script>
    <script src="{{ url('style/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ url('style/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ url('style/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{ url('style/dist/js/feather.min.js')}}"></script>
    <script src="{{ url('style/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{ url('style/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('style/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{ url('style/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{ url('style/assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{ url('style/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{ url('style/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{ url('style/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{ url('style/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{ url('style/dist/js/pages/dashboards/dashboard1.min.js')}}"></script>
    
    <!--Script Datatables -->
    <script src="{{ url('style/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ url('style/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('style/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    {{-- SWEET ALERT --}}
	{{-- <script src="{{ url('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script> --}}
	<script src="{{ url('js/sweetalert/sweetalert2.all.min.js') }}"></script>
	<script src="{{ url('js/sweetalert/sweet.js') }}"></script>
	<script src="{{ url('js/app.js') }}"></script>

     {{-- CALENDAR --}}
    <script src="{{  url('style/assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{  url('style/assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{  url('style/dist/js/pages/calendar/cal-init.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

    {{-- DataTables --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ url('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
	<script src="{{ url('js/select2.js') }}"></script>
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
       All Rights Reserved by AndikaRiski.
   </footer>