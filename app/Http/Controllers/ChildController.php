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
            'sudah_minum_obat' => 'required|boolean',
            'tanggal' => 'required|date_format:d-m-Y',
            'keterangan' => 'nullable|string',
            'nama_pendamping' => 'nullable|string|max:255',
        ]);

        $child->saveHistory();

        $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['tanggal'])->format('Y-m-d');

        $child->update([
            'makan_pagi' => $validatedData['makan_pagi'] === 'custom' ? $validatedData['makan_pagi_custom'] : $validatedData['makan_pagi'],
            'makan_siang' => $validatedData['makan_siang'] === 'custom' ? $validatedData['makan_siang_custom'] : $validatedData['makan_siang'],
            'makan_sore' => $validatedData['makan_sore'] === 'custom' ? $validatedData['makan_sore_custom'] : $validatedData['makan_sore'],
            'sudah_minum_obat' => $validatedData['sudah_minum_obat'],
            'tanggal' => $tanggal,
            'keterangan' => $validatedData['keterangan'],
            'nama_pendamping' => $validatedData['nama_pendamping'],
        ]);

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui');
    }

    public function editStatus($id)
    {
        $child = Child::findOrFail($id);
        return view('updatestatus', compact('child'));
    }
}
