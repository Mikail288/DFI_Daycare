<?php

namespace App\Http\Controllers;

use App\Models\Child;
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
}
