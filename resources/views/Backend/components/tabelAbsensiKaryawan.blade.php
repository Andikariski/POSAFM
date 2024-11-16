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
                <td>
                    @if ($item->masuk_pagi_status !== 'belum_absen')
                        <input type="checkbox" {{ $item->masuk_pagi ? 'checked' : '' }} onclick="return false;">
                    @endif
                    @if ($item->masuk_pagi_status === 'belum_absen')
                        <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="masuk_pagi">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">
                            </span>
                        </button>
                    @elseif($item->masuk_pagi_status === 'tidak_hadir')
                        <label class="ml-2 text-danger">tidak hadir</label>
                    @elseif($item->masuk_pagi_status === 'terlambat')
                        <label
                            class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</label>
                    @else
                        <label
                            class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</label>
                    @endif
                </td>
                <td>
                    @if ($item->keluar_siang_status !== 'belum_absen')
                        <input type="checkbox" {{ $item->keluar_siang ? 'checked' : '' }} onclick="return false;">
                    @endif
                    @if ($item->keluar_siang_status === 'belum_absen')
                        <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="keluar_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">
                            </span>
                        </button>
                    @elseif($item->keluar_siang_status === 'tidak_hadir')
                        <label class="ml-2 text-danger">tidak hadir</label>
                    @elseif($item->keluar_siang_status === 'terlambat')
                        <label
                            class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</label>
                    @else
                        <label
                            class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}</label>
                    @endif
                </td>
                <td>
                    @if ($item->masuk_siang_status !== 'belum_absen')
                        <input type="checkbox" {{ $item->masuk_siang ? 'checked' : '' }} onclick="return false;">
                    @endif
                    @if ($item->masuk_siang_status === 'belum_absen')
                        <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="masuk_siang">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @elseif($item->masuk_siang_status === 'tidak_hadir')
                        <label class="ml-2 text-danger">tidak hadir</label>
                    @elseif($item->masuk_siang_status === 'terlambat')
                        <label
                            class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</label>
                    @else
                        <label
                            class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}</label>
                    @endif
                </td>
                <td>
                    @if ($item->keluar_sore_status !== 'belum_absen')
                        <input type="checkbox" {{ $item->keluar_sore ? 'checked' : '' }} onclick="return false;">
                    @endif
                    @if ($item->keluar_sore_status === 'belum_absen')
                        <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="keluar_sore">
                            <span class="button-text">absen sekarang</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status">

                            </span>
                        </button>
                    @elseif($item->keluar_sore_status === 'tidak_hadir')
                        <label class="ml-2 text-danger">tidak hadir</label>
                    @elseif($item->keluar_sore_status === 'terlambat')
                        <label
                            class="ml-2 text-warning">{{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}</label>
                    @else
                        <label
                            class="ml-2 text-success">{{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}</label>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td>
                    <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="masuk_pagi">
                        <span class="button-text">absen sekarang</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status">

                        </span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="keluar_siang">
                        <span class="button-text">absen sekarang</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status">

                        </span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="masuk_siang">
                        <span class="button-text">absen sekarang</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status">

                        </span>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary btn-rounded btn-absensi" data-type="keluar_sore">
                        <span class="button-text">absen sekarang</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status">

                        </span>
                    </button>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
