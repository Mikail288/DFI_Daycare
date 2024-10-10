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
            'sudah_makan' => 'required|boolean',
            'sudah_minum_obat' => 'required|boolean',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Child::create($request->all());

        return redirect()->route('dashboardadmin')->with('success', 'Anak berhasil ditambahkan.');
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
        ]);

        $child->saveHistory();

        $child->update($validatedData);

        return redirect()->route('dashboardanak')->with('success', 'Status anak berhasil diperbarui');
    }
}
