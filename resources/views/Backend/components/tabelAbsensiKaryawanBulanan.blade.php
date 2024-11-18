<table class="table table-bordered" id="tabel-absensi-bulanan">
    <thead>
        <tr class="bg-secondary text-white">
            <th rowspan="2">No</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Total Hari</th>
            <th colspan="4" class="text-center">Masuk Pagi</th>
            <th colspan="4" class="text-center">Keluar Siang</th>
            <th colspan="4" class="text-center">Masuk Siang</th>
            <th colspan="4" class="text-center">Keluar Sore</th>
        </tr>
        <tr style="background-color: aliceblue;">
            {{-- Masuk Pagi --}}
            <th style="background-color: rgba(204, 202, 246, 0.15);">Tepat</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Telat</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Absen</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Sakit</th>
            {{-- Keluar Siang --}}
            <th>Tepat</th>
            <th>Telat</th>
            <th>Absen</th>
            <th>Sakit</th>
            {{-- Masuk Siang --}}
            <th style="background-color: rgba(204, 202, 246, 0.15);">Tepat</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Telat</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Absen</th>
            <th style="background-color: rgba(204, 202, 246, 0.15);">Sakit</th>
            {{-- Keluar Sore --}}
            <th>Tepat</th>
            <th>Telat</th>
            <th>Absen</th>
            <th>Sakit</th>
        </tr>
    </thead>
    <tbody>
        @if (auth()->user()->is_admin)
            @forelse($laporanAbsensi as $index => $laporan)
                <tr style="background-color: aliceblue;">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan['nama_karyawan'] }}</td>
                    <td>{{ $laporan['total_hari'] }}</td>
                    {{-- Masuk Pagi Stats --}}
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_pagi']['tepat_waktu'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_pagi']['terlambat'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_pagi']['tidak_hadir'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $laporan['masuk_pagi']['sakit'] }}
                    </td>
                    {{-- Keluar Siang Stats --}}
                    <td>{{ $laporan['keluar_siang']['tepat_waktu'] }}</td>
                    <td>{{ $laporan['keluar_siang']['terlambat'] }}</td>
                    <td>{{ $laporan['keluar_siang']['tidak_hadir'] }}</td>
                    <td>{{ $laporan['keluar_siang']['sakit'] }}</td>
                    {{-- Masuk Siang Stats --}}
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_siang']['tepat_waktu'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_siang']['terlambat'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">
                        {{ $laporan['masuk_siang']['tidak_hadir'] }}
                    </td>
                    <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $laporan['masuk_siang']['sakit'] }}
                    </td>
                    {{-- Keluar Sore Stats --}}
                    <td>{{ $laporan['keluar_sore']['tepat_waktu'] }}</td>
                    <td>{{ $laporan['keluar_sore']['terlambat'] }}</td>
                    <td>{{ $laporan['keluar_sore']['tidak_hadir'] }}</td>
                    <td>{{ $laporan['keluar_sore']['sakit'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="23" class="text-center alert alert-secondary">Tidak ada data absensi untuk periode
                        ini
                    </td>
                </tr>
            @endforelse
        @else
            @forelse($laporanAbsensi as $index => $laporan)
                @if ($laporan['nama_karyawan'] === auth()->user()->name)
                    <tr style="background-color: aliceblue;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $laporan['nama_karyawan'] }}</td>
                        <td>{{ $laporan['total_hari'] }}</td>
                        {{-- Masuk Pagi Stats --}}
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_pagi']['tepat_waktu'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_pagi']['terlambat'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_pagi']['tidak_hadir'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $laporan['masuk_pagi']['sakit'] }}
                        </td>
                        {{-- Keluar Siang Stats --}}
                        <td>{{ $laporan['keluar_siang']['tepat_waktu'] }}</td>
                        <td>{{ $laporan['keluar_siang']['terlambat'] }}</td>
                        <td>{{ $laporan['keluar_siang']['tidak_hadir'] }}</td>
                        <td>{{ $laporan['keluar_siang']['sakit'] }}</td>
                        {{-- Masuk Siang Stats --}}
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_siang']['tepat_waktu'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_siang']['terlambat'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">
                            {{ $laporan['masuk_siang']['tidak_hadir'] }}
                        </td>
                        <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $laporan['masuk_siang']['sakit'] }}
                        </td>
                        {{-- Keluar Sore Stats --}}
                        <td>{{ $laporan['keluar_sore']['tepat_waktu'] }}</td>
                        <td>{{ $laporan['keluar_sore']['terlambat'] }}</td>
                        <td>{{ $laporan['keluar_sore']['tidak_hadir'] }}</td>
                        <td>{{ $laporan['keluar_sore']['sakit'] }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="23" class="text-center alert alert-secondary">Tidak ada data absensi untuk periode
                        ini
                    </td>
                </tr>
            @endforelse
        @endif
    </tbody>
</table>

{{-- table detail waktu dan status absen karyawan --}}
<table class="table table-bordered mt-5">
    <thead class="bg-secondary text-white">
        <tr>
            @if (auth()->user()->is_admin)
                <th>Nama</th>
            @endif
            <th>Tanggal</th>
            <th>Masuk Pagi</th>
            <th>Status</th>
            <th>Keluar Siang</th>
            <th>Status</th>
            <th>Masuk Siang</th>
            <th>Status</th>
            <th>Keluar Sore</th>
            <th>Status</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @if (auth()->user()->is_admin)
            @if ($laporanAbsensi !== null && count($laporanAbsensi) > 0)
                @foreach ($laporanAbsensi as $absensiKaryawan)
                    @foreach ($absensiKaryawan['records'] as $record)
                        <tr style="background-color: aliceblue;">
                            <td>{{ $absensiKaryawan['nama_karyawan'] }}</td>
                            <td>{{ Carbon::parse($record->tanggal_absen)->isoFormat('D MMMM Y') }}</td>
                            <td style="background-color: rgba(204, 202, 246, 0.15);">
                                {{ $record->masuk_pagi ? Carbon::parse($record->masuk_pagi)->format('H:i') : '-' }}
                            </td>
                            <td style="background-color: rgba(204, 202, 246, 0.15);">
                                {{ formatStatus($record->masuk_pagi_status) }}</td>
                            <td>{{ $record->keluar_siang ? Carbon::parse($record->keluar_siang)->format('H:i') : '-' }}
                            </td>
                            <td>{{ formatStatus($record->keluar_siang_status) }}</td>
                            <td style="background-color: rgba(204, 202, 246, 0.15);">
                                {{ $record->masuk_siang ? Carbon::parse($record->masuk_siang)->format('H:i') : '-' }}
                            </td>
                            <td style="background-color: rgba(204, 202, 246, 0.15);">
                                {{ formatStatus($record->masuk_siang_status) }}</td>
                            <td>{{ $record->keluar_sore ? Carbon::parse($record->keluar_sore)->format('H:i') : '-' }}
                            </td>
                            <td>{{ formatStatus($record->keluar_sore_status) }}</td>
                            <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $record->notes ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @else
                <tr>
                    <td class="alert alert-secondary mt-4 text-center" colspan="11">Tidak ada data absensi untuk
                        periode
                        ini
                    </td>
                </tr>
            @endif
        @else
            @if ($laporanAbsensi !== null && count($laporanAbsensi) > 0)
                @foreach ($laporanAbsensi as $absensiKaryawan)
                    @if ($absensiKaryawan['nama_karyawan'] === auth()->user()->name)
                        @foreach ($absensiKaryawan['records'] as $record)
                            <tr style="background-color: aliceblue;">
                                <td>{{ Carbon::parse($record->tanggal_absen)->isoFormat('D MMMM Y') }}</td>
                                <td style="background-color: rgba(204, 202, 246, 0.15);">
                                    {{ $record->masuk_pagi ? Carbon::parse($record->masuk_pagi)->format('H:i') : '-' }}
                                </td>
                                <td style="background-color: rgba(204, 202, 246, 0.15);">
                                    {{ formatStatus($record->masuk_pagi_status) }}</td>
                                <td>{{ $record->keluar_siang ? Carbon::parse($record->keluar_siang)->format('H:i') : '-' }}
                                </td>
                                <td>{{ formatStatus($record->keluar_siang_status) }}</td>
                                <td style="background-color: rgba(204, 202, 246, 0.15);">
                                    {{ $record->masuk_siang ? Carbon::parse($record->masuk_siang)->format('H:i') : '-' }}
                                </td>
                                <td style="background-color: rgba(204, 202, 246, 0.15);">
                                    {{ formatStatus($record->masuk_siang_status) }}</td>
                                <td>{{ $record->keluar_sore ? Carbon::parse($record->keluar_sore)->format('H:i') : '-' }}
                                </td>
                                <td>{{ formatStatus($record->keluar_sore_status) }}</td>
                                <td style="background-color: rgba(204, 202, 246, 0.15);">{{ $record->notes ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @else
                <tr>
                    <td class="alert alert-secondary mt-4 text-center" colspan="11">Tidak ada data absensi untuk
                        periode
                        ini
                    </td>
                </tr>
            @endif
        @endif
    </tbody>
</table>
