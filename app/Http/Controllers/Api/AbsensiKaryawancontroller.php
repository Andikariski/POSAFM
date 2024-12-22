<?php

namespace App\Http\Controllers\Api;

use App\Models\AbsensiKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiKaryawancontroller extends BaseController
{
    //
    public function store(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'fkid_user' => 'required|exists:users,id',
                'type' => 'required|in:masuk_pagi,keluar_siang,masuk_siang,keluar_sore',
                'time' => 'required|date_format:H:i'
            ]);

            $now = now();
            $record = AbsensiKaryawan::firstOrCreate([
                'fkid_user' => $validated['fkid_user'],
                'tanggal_absen' => $now->toDateString()
            ]);

            // Attendance configuration
            $konfigAbsensi = [
                'masuk_pagi' => [
                    'order' => 0,
                    'start_time' => '07:00',
                    'end_time' => '10:00'
                ],
                'keluar_siang' => [
                    'order' => 1,
                    'start_time' => '12:00',
                    'end_time' => '13:00'
                ],
                'masuk_siang' => [
                    'order' => 2,
                    'start_time' => '13:00',
                    'end_time' => '16:00'
                ],
                'keluar_sore' => [
                    'order' => 3,
                    'start_time' => '17:00',
                    'end_time' => '20:00'
                ],
            ];

            $currentType = $validated['type'];
            $currentOrder = $konfigAbsensi[$currentType]['order'];

            // Prepare update data
            $updateData = [];

            // Process previous unrecorded attendance
            foreach ($konfigAbsensi as $type => $config) {
                if ($config['order'] < $currentOrder) {
                    if (is_null($record->{$type}) || $record->{$type . '_status'} === 'belum_absen') {
                        $updateData[$type . '_status'] = 'tidak_hadir';
                    }
                }
            }

            // Calculate attendance status
            $status = $this->menghitungStatusKeterlambatan($validated['type'], $validated['time']);

            // Add current attendance data
            $updateData[$currentType] = $validated['time'];
            $updateData[$currentType . '_status'] = $status;

            // Save to database
            DB::beginTransaction();
            $record->update($updateData);
            DB::commit();

            $data = ['absensi' => $record->fresh()];

            return $this->sendResponse($data, 'berhasil melakukan absen');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->sendError('validasi data gagal');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('gagal melakukan absen');
        }
    }

    // UTILITY FUNCTION
    //menghitung status keterlambatan
    private function menghitungStatusKeterlambatan($type, $time)
    {
        $timeObj = Carbon::createFromFormat('H:i', $time);

        switch ($type) {
            case 'masuk_pagi':
                return $timeObj->lt('07:00') ? 'tepat_waktu' : 'terlambat';
            case 'keluar_siang':
                return $timeObj->between('12:00', '12:59') ? 'tepat_waktu' : 'terlambat';
            case 'masuk_siang':
                return $timeObj->lt('13:00') ? 'tepat_waktu' : 'terlambat';
            case 'keluar_sore':
                return $timeObj->between('17:00', '20:00') ? 'tepat_waktu' : 'terlambat';
        }
    }
}
