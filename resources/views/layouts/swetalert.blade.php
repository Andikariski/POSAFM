{{-- <script src="{{ url('js/sweetalert/sweetalert.min.js')}}"></script> --}}
<script src="{{ url('js/sweetalert/sweetalert2.all.min.js') }}"></script>

@if (Session::has('alert-success'))
    <script>
      Swal.fire({
        icon    : 'success',
        title   : 'Berhasil',
        text    : '{!! Session::get('alert-success') !!}',
        // footer: '<a href="">Why do I have this issue?</a>'
      })
    </script>
@endif

@if (Session::has('alert-failed'))
    <script>
        swal("Tidak Dapat Menjadwalkan","{!! Session::get('alert-failed') !!}",{
            icon : "warning",
            buttons:{        			
				confirm: {
			        className : 'btn btn-info'
				}
			},
        });
    </script>
@endif

{{-- 
 swal("Great Job!","{!! Session::get('alert-success') !!}",{
            icon : "success",
            buttons:{        			
				confirm: {
			        className : 'btn btn-success'
				}
			},
        }); --}}