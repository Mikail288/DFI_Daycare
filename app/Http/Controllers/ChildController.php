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

        // Validasi input
        $validatedData = $request->validate([
            'nama_pendamping' => 'required|string',
            'tanggal' => 'required|date_format:d-m-Y',
            'makan_pagi' => 'nullable|string',
            'makan_siang' => 'nullable|string',
            'makan_sore' => 'nullable|string',
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
        ]);

        // Konversi tanggal ke format Y-m-d
        $tanggal = Carbon::createFromFormat('d-m-Y', $validatedData['tanggal'])->format('Y-m-d');

        // Proses kegiatan outdoor
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

        // Hapus kegiatan_outdoor_lainnya dari validatedData karena tidak ada kolom seperti itu
        unset($validatedData['kegiatan_outdoor_lainnya']);

        // Update data di tabel children
        $validatedData['tanggal'] = $tanggal;
        $child->update($validatedData);

        // Hapus entri sebelumnya untuk tanggal yang sama (jika ada)
        ChildHistory::where('child_id', $child->id)
            ->whereDate('tanggal', $tanggal)
            ->delete();

        // Simpan data baru ke child_history
        $childHistory = new ChildHistory($validatedData);
        $childHistory->child_id = $child->id;
        $childHistory->save();

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui dan riwayat terbaru disimpan.');
    }

    public function editStatus($id)
    {
        $child = Child::findOrFail($id);
        
        // Ambil data riwayat untuk tanggal hari ini
        $today = Carbon::now()->format('Y-m-d');
        $todayHistory = $child->histories()
            ->whereDate('tanggal', $today)
            ->latest()
            ->first();

        // Jika ada riwayat hari ini, gunakan data tersebut
        if ($todayHistory) {
            $child->fill($todayHistory->toArray());
            $child->tanggal = $today;
            $child->kegiatan_outdoor = json_decode($todayHistory->kegiatan_outdoor, true);
        } else {
            // Jika tidak ada riwayat hari ini, gunakan data dari tabel children
            $child->tanggal = $today;
            $child->kegiatan_outdoor = json_decode($child->kegiatan_outdoor, true);
        }

        return view('updatestatus', compact('child'));
    }
}
