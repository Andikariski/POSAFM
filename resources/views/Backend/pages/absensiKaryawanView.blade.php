@extends('layouts.main')
@section('container')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success p-4 mr-3 rounded-pill" style="opacity: 0.5;">
                                    <i data-feather="user" class="feather-icon" width="32" height="32"
                                        color="white"></i>
                                </div>
                                <div>
                                    <p>Selamat Bekerja</p>
                                    <h1>{{ auth()->user()->name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="bg-info p-4 mr-3 rounded-circle" style="opacity: 0.5;">
                                    <i data-feather="calendar" class="feather-icon" width="40" height="40"
                                        color="white"></i>
                                </div>
                                <div>
                                    <p>Hari Ini</p>
                                    <h1>{{ $tanggalHariIni }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white card">
                <p class="text-white card-header bg-secondary">Absen Kamu Hari Ini</p>
                <div class="table-responsive px-4 mt-2">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-success" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">tepat waktu</p>
                        </div>
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-warning" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">terlambat</p>
                        </div>
                        <div class="d-flex align-items-center mr-4">
                            <div class="bg-danger" style="width: 12px; height:12px; border-radius: 2px;"></div>
                            <p class="mt-3 ml-2">tidak absen / tidak hadir</p>
                        </div>
                    </div>

                    @include('Backend.components.tabelAbsensiKaryawan', [
                        'dataAbsensiKaryawan' => $dataAbsensiKaryawan,
                    ])

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // menampilkan loading status di button input absensi
            function setButtonLoading(button, isLoading) {
                const spinner = button.find('.spinner-border');
                const text = button.find('.button-text');

                if (isLoading) {
                    spinner.removeClass('d-none');
                    text.addClass('d-none');
                    button.prop('disabled', true);
                } else {
                    spinner.addClass('d-none');
                    text.removeClass('d-none');
                    button.prop('disabled', false);
                }
            }

            function validateAttendanceTime(type) {
                const hour = new Date().getHours();

                switch (type) {
                    case 'masuk_pagi':
                        return hour >= 6 && hour <= 9;
                    case 'keluar_siang':
                        return hour >= 11 && hour < 13;
                    case 'masuk_siang':
                        return hour >= 13 && hour < 16;
                    case 'keluar_sore':
                        return hour >= 17 && hour < 20;
                    default:
                        return false;
                }
            }

            // Handle button clicks
            $(document).on("click", ".btn-absensi", function() {
                let button = $(this);
                let type = button.data('type');

                // validasi jam absen karyawan
                if (!validateAttendanceTime(type)) {
                    Swal.fire({
                        title: "Uppss",
                        text: "bukan waktu untuk absen",
                        icon: 'error',
                    });
                    return;
                }

                // menampilkan status loading
                setButtonLoading(button, true)

                // Disable button to prevent double submission
                button.prop('disabled', true);

                // Get current time in HH:mm format
                let now = new Date();
                let time = ('0' + now.getHours()).slice(-2) + ':' +
                    ('0' + now.getMinutes()).slice(-2);

                // make the AJAX request
                $.ajax({
                    url: '{{ route('tambah-absensi-karyawan') }}', // Make sure to define this route
                    method: 'POST',
                    data: {
                        fkid_user: '{{ auth()->id() }}', // Assuming you're using auth
                        type: type,
                        time: time
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Berhasil Melakukan Absen",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $.ajax({
                            url: '{{ route('data-absensi-updated') }}', // Define this route to fetch updated table data
                            method: 'GET',
                            success: function(data) {
                                $('#tabel-absensi-karyawan').html(data);
                            },
                            error: function(xhr) {
                                console.error('Gagal mengupdate data absen:',
                                    xhr);
                            }
                        });
                    },
                    error: function(xhr) {
                        // Handle errors
                        let errorMessage = 'An error occurred';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        alert('Error: ' + errorMessage);

                        // Re-enable the button
                        button.prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
