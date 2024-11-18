<table class="table">
    <thead class="thead-light">
        <tr>
            <th>Nama</th>
            <th>Masuk Pagi 07:00</th>
            <th>Keluar Siang 12:00</th>
            <th>Masuk Siang 13:00</th>
            <th>Keluar Sore 17:00</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataAbsensiKaryawanAll as $item)
            <tr>
                <td class="pt-4">{{ $item->karyawan->name }}</td>
                <td>
                    @if ($item->masuk_pagi_status === 'belum_absen')
                        @if ($jamSaatIni > 12)
                            <p class="bg-danger py-2 text-center text-white rounded-pill">Tidak Absen</p>
                        @else
                            <p class="bg-secondary py-2 text-center text-white rounded-pill">Belum Absen</p>
                        @endif
                    @elseif($item->masuk_pagi_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->masuk_pagi_status === 'terlambat')
                        <p class="bg-warning py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</p>
                    @else
                        <p class="bg-success py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->masuk_pagi)->format('H : i') }}</p>
                    @endif
                </td>
                <td>
                    @if ($item->keluar_siang_status === 'belum_absen')
                        @if ($jamSaatIni > 13)
                            <p class="bg-danger py-2 text-center text-white rounded-pill">Tidak Absen</p>
                        @else
                            <p class="bg-secondary py-2 text-center text-white rounded-pill">Belum Absen</p>
                        @endif
                    @elseif($item->keluar_siang_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->keluar_siang_status === 'terlambat')
                        <p class="bg-warning py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}
                        </p>
                    @else
                        <p class="bg-success py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_siang)->format('H : i') }}
                        </p>
                    @endif
                </td>
                <td>
                    @if ($item->masuk_siang_status === 'belum_absen')
                        @if ($jamSaatIni > 16)
                            <p class="bg-danger py-2 text-center text-white rounded-pill">Tidak Absen</p>
                        @else
                            <p class="bg-secondary py-2 text-center text-white rounded-pill">Belum Absen</p>
                        @endif
                    @elseif($item->masuk_siang_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->masuk_siang_status === 'terlambat')
                        <p class="bg-warning py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}
                        </p>
                    @else
                        <p class="bg-success py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->masuk_siang)->format('H : i') }}
                        </p>
                    @endif
                </td>
                <td>
                    @if ($item->keluar_sore_status === 'belum_absen')
                        @if ($jamSaatIni > 19)
                            <p class="bg-danger py-2 text-center text-white rounded-pill">Tidak Absen</p>
                        @else
                            <p class="bg-secondary py-2 text-center text-white rounded-pill">Belum Absen</p>
                        @endif
                    @elseif($item->keluar_sore_status === 'tidak_hadir')
                        <p class="bg-danger py-2 text-center text-white rounded-pill">tidak hadir</p>
                    @elseif($item->keluar_sore_status === 'terlambat')
                        <p class="bg-warning py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}
                        </p>
                    @else
                        <p class="bg-success py-2 text-center text-white rounded-pill">
                            {{ \Carbon\Carbon::parse($item->keluar_sore)->format('H : i') }}
                        </p>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">karyawan belum absen</td>
            </tr>
        @endforelse
    </tbody>
</table>
