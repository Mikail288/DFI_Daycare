<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $validatedData = $request->validate([
            'makan_pagi' => 'nullable|string',
            'makan_siang' => 'nullable|string',
            'makan_sore' => 'nullable|string',
            'makan_pagi_custom' => 'nullable|string',
            'makan_siang_custom' => 'nullable|string',
            'makan_sore_custom' => 'nullable|string',
            'tanggal' => 'required|date_format:d-m-Y',
            'keterangan' => 'nullable|string',
            'nama_pendamping' => 'nullable|string|max:255',
            'susu_pagi' => 'nullable|integer|min:0',
            'susu_siang' => 'nullable|integer|min:0',
            'susu_sore' => 'nullable|integer|min:0',
            'air_putih_pagi' => 'nullable|integer|min:0',
            'air_putih_siang' => 'nullable|integer|min:0',
            'air_putih_sore' => 'nullable|integer|min:0',
            'bak_pagi' => 'nullable|integer|min:0',
            'bak_siang' => 'nullable|integer|min:0',
            'bak_sore' => 'nullable|integer|min:0',
            'bab_pagi' => 'nullable|integer|min:0',
            'bab_siang' => 'nullable|integer|min:0',
            'bab_sore' => 'nullable|integer|min:0',
            'tidur_pagi' => 'nullable|integer|min:0',
            'tidur_siang' => 'nullable|integer|min:0',
            'tidur_sore' => 'nullable|integer|min:0',
        ]);

        $child->saveHistory();

        $child->update([
            'makan_pagi' => $validatedData['makan_pagi'] === 'custom' ? $validatedData['makan_pagi_custom'] : $validatedData['makan_pagi'],
            'makan_siang' => $validatedData['makan_siang'] === 'custom' ? $validatedData['makan_siang_custom'] : $validatedData['makan_siang'],
            'makan_sore' => $validatedData['makan_sore'] === 'custom' ? $validatedData['makan_sore_custom'] : $validatedData['makan_sore'],
            'tanggal' => \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['tanggal'])->format('Y-m-d'),
            'keterangan' => $validatedData['keterangan'],
            'nama_pendamping' => $validatedData['nama_pendamping'],
            'susu_pagi' => $validatedData['susu_pagi'],
            'susu_siang' => $validatedData['susu_siang'],
            'susu_sore' => $validatedData['susu_sore'],
            'air_putih_pagi' => $validatedData['air_putih_pagi'],
            'air_putih_siang' => $validatedData['air_putih_siang'],
            'air_putih_sore' => $validatedData['air_putih_sore'],
            'bak_pagi' => $validatedData['bak_pagi'],
            'bak_siang' => $validatedData['bak_siang'],
            'bak_sore' => $validatedData['bak_sore'],
            'bab_pagi' => $validatedData['bab_pagi'],
            'bab_siang' => $validatedData['bab_siang'],
            'bab_sore' => $validatedData['bab_sore'],
            'tidur_pagi' => $validatedData['tidur_pagi'],
            'tidur_siang' => $validatedData['tidur_siang'],
            'tidur_sore' => $validatedData['tidur_sore'],
        ]);

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui');
    }

    public function editStatus($id)
    {
        $child = Child::findOrFail($id);
        return view('updatestatus', compact('child'));
    }
}
