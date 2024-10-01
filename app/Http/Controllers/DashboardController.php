<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import model User atau model lain yang ingin ditampilkan

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function adminIndex()
    {
        $users = User::all(); // Ambil semua data dari tabel users
        return view('dashboardadmin', compact('users'));
    }
}
