<table class="table" id="tabel-absensi-karyawan">
    <thead class="thead-light">
        <tr>
            <th>Masuk Pagi / 07:00</th>
            <th>Keluar Siang / 12:00</th>
            <th>Masuk Siang / 13:00</th>
            <th>Keluar Sore / 17:00</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataAbsensiKaryawan as $item)
            <tr>
                <td class="d-grid">
                    @if ($item->masuk_pagi_status === 'belum_absen')
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="masuk_pagi">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">
                            </span>
                        </button>
                    @elseif($item->masuk_pagi_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->masuk_pagi_status === 'terlambat')
                        <button class="col-12 btn btn-warning btn-rounded">
                            {{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</button>
                    @else
                        <button
                            class="col-12 btn btn-success btn-rounded">{{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</button>
                    @endif
                </td>
                <td class="d-grid">
                    @if ($item->keluar_siang_status === 'belum_absen')
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="keluar_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class=" spinner-border spinner-border-sm d-none" role="status">
                            </span>
                        </button>
                    @elseif($item->keluar_siang_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->keluar_siang_status === 'terlambat')
                        <button
                            class="col-12 btn btn-warning btn-rounded">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</button>
                    @else
                        <button
                            class="col-12 btn btn-success btn-rounded">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</button>
                    @endif
                </td>
                <td class="d-grid">
                    @if ($item->masuk_siang_status === 'belum_absen')
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="masuk_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class=" spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @elseif($item->masuk_siang_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->masuk_siang_status === 'terlambat')
                        <button
                            class="col-12 btn btn-warning  btn-rounded">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</button>
                    @else
                        <button
                            class="col-12 btn btn-success  btn-rounded">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</button>
                    @endif
                </td>
                <td>
                    @if ($item->keluar_sore_status === 'belum_absen')
                        <button type="button" class="col-12 btn  btn-primary btn-rounded btn-absensi"
                            data-type="keluar_sore">
                            <span class="button-text">absen sekarang</span>
                            <span class=" spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @elseif($item->keluar_sore_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->keluar_sore_status === 'terlambat')
                        <p class="bg-warning py-2 text-center text-dark rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}
                        </p>
                    @else
                        <p class="bg-success py-2 text-center text-dark rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}</p>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    @if ($jamSaatIni > 9)
                        <p class="bg-danger py-2 text-center text-white rounded-pill">kamu tidak absen</p>
                    @else
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="masuk_pagi">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @endif
                </td>
                <td>
                    @if ($jamSaatIni > 13)
                        <p class="bg-danger py-2 text-center text-white rounded-pill">kamu tidak absen</p>
                    @else
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="keluar_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @endif
                </td>
                <td>
                    @if ($jamSaatIni > 16)
                        <p class="bg-danger py-2 text-center text-white rounded-pill">kamu tidak absen</p>
                    @else
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="masuk_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @endif
                </td>
                <td>
                    @if ($jamSaatIni > 20)
                        <p class="bg-danger py-2 text-center text-white rounded-pill">kamu tidak absen</p>
                    @else
                        <button type="button" class="col-12 btn btn-primary btn-rounded btn-absensi"
                            data-type="keluar_sore">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
