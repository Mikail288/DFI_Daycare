<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildHistory;
use Illuminate\Http\Request;

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
            'sudah_makan' => 'required|boolean',
            'sudah_minum_obat' => 'required|boolean',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
            'nama_pendamping' => 'nullable|string|max:255',
        ]);

        $child->saveHistory();

        $child->update($validatedData);

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui');
    }
}
