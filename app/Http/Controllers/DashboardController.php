<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $children = $user->children;
        $selectedChild = null;

        if ($request->route('child_id')) {
            $selectedChild = $children->find($request->route('child_id'));
        }

        return view('dashboard', compact('children', 'selectedChild'));
    }

    public function adminIndex()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $users = User::all();
            return view('dashboardadmin', compact('users'));
        }

        return redirect("login")->withErrors('Kamu tidak memiliki akses ke dashboard admin. Silahkan login kembali');
    }
}
