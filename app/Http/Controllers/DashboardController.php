<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import model User atau model lain yang ingin ditampilkan
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function adminIndex()
    {
        // Cek apakah pengguna yang sedang login adalah admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = User::all(); // Ambil semua data dari tabel users
            return view('dashboardadmin', compact('users'));
        }

        // Jika bukan admin, redirect ke halaman login dengan pesan error
        return redirect("login")->withErrors('Oops! You do not have access to the admin dashboard');
    }
}
