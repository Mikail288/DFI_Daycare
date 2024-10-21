<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChildController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'nama_pendamping' => 'nullable|string|max:255',
        ]);

        $child = Child::create([
            'user_id' => $request->user_id,
            'nama' => $request->nama,
            'nama_pendamping' => $request->nama_pendamping,
        ]);

        return redirect()->back()->with('success', 'Anak berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();

        return redirect()->route('dashboardanak')->with('success', 'Data anak berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');

        $validatedData = $request->validate([
            'nama_pendamping' => 'required|string',
            'tanggal' => 'required|date_format:d-m-Y',
            'makan_pagi' => 'nullable|string',
            'makan_siang' => 'nullable|string',
            'makan_sore' => 'nullable|string',
            'makan_pagi_custom' => 'nullable|string',
            'makan_siang_custom' => 'nullable|string',
            'makan_sore_custom' => 'nullable|string',
            'susu_pagi' => 'nullable|integer',
            'susu_siang' => 'nullable|integer',
            'susu_sore' => 'nullable|integer',
            'air_putih_pagi' => 'nullable|integer',
            'air_putih_siang' => 'nullable|integer',
            'air_putih_sore' => 'nullable|integer',
            'bak_pagi' => 'nullable|integer',
            'bak_siang' => 'nullable|integer',
            'bak_sore' => 'nullable|integer',
            'bab_pagi' => 'nullable|integer',
            'bab_siang' => 'nullable|integer',
            'bab_sore' => 'nullable|integer',
            'tidur_pagi' => 'nullable|integer',
            'tidur_siang' => 'nullable|integer',
            'tidur_sore' => 'nullable|integer',
            'kegiatan_outdoor' => 'nullable|array',
            'kegiatan_outdoor_lainnya' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'kegiatan_indoor' => 'nullable|array',
            'kegiatan_indoor_lainnya' => 'nullable|string|max:255',
        ]);

        $tanggal = Carbon::createFromFormat('d-m-Y', $validatedData['tanggal'])->format('Y-m-d');

        // Handle custom makan inputs
        foreach (['pagi', 'siang', 'sore'] as $waktu) {
            if ($validatedData["makan_$waktu"] === 'custom') {
                $validatedData["makan_$waktu"] = $validatedData["makan_{$waktu}_custom"] ?? 'custom';
            }
            unset($validatedData["makan_{$waktu}_custom"]);
        }

        $kegiatanOutdoor = $request->kegiatan_outdoor ?? [];
        $kegiatanOutdoorLainnya = $request->kegiatan_outdoor_lainnya;

        if (in_array('lainnya', $kegiatanOutdoor) && $kegiatanOutdoorLainnya) {
            $key = array_search('lainnya', $kegiatanOutdoor);
            if ($key !== false) {
                unset($kegiatanOutdoor[$key]);
                $kegiatanOutdoor[] = $kegiatanOutdoorLainnya;
            }
        }

        $validatedData['kegiatan_outdoor'] = json_encode($kegiatanOutdoor);

        unset($validatedData['kegiatan_outdoor_lainnya']);

        $kegiatanIndoor = $request->kegiatan_indoor ?? [];
        $kegiatanIndoorLainnya = $request->kegiatan_indoor_lainnya;

        if (in_array('lainnya', $kegiatanIndoor) && $kegiatanIndoorLainnya) {
            $key = array_search('lainnya', $kegiatanIndoor);
            if ($key !== false) {
                unset($kegiatanIndoor[$key]);
                $kegiatanIndoor[] = $kegiatanIndoorLainnya;
            }
        }

        $validatedData['kegiatan_indoor'] = json_encode($kegiatanIndoor);

        unset($validatedData['kegiatan_indoor_lainnya']);

        $validatedData['tanggal'] = $tanggal;
        $child->update($validatedData);

        ChildHistory::where('child_id', $child->id)
            ->whereDate('tanggal', $tanggal)
            ->delete();

        $childHistory = new ChildHistory($validatedData);
        $childHistory->child_id = $child->id;
        $childHistory->save();

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui dan riwayat terbaru disimpan.');
    }

    public function editStatus($id)
    {
        $child = Child::findOrFail($id);
        $today = Carbon::now()->format('Y-m-d');
        $todayHistory = $child->histories()
            ->whereDate('tanggal', $today)
            ->latest()
            ->first();

        if ($todayHistory) {
            $child->fill($todayHistory->toArray());
            $child->tanggal = $today;
            $child->kegiatan_outdoor = json_decode($todayHistory->kegiatan_outdoor, true);
            $child->kegiatan_indoor = json_decode($todayHistory->kegiatan_indoor, true);
        } else {
            $child->tanggal = $today;
            $child->kegiatan_outdoor = json_decode($child->kegiatan_outdoor, true);
            $child->kegiatan_indoor = json_decode($child->kegiatan_indoor, true);
        }

        return view('updatestatus', compact('child'));
    }
}
