<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Child;

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

    public function childIndex()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $children = Child::with('user')->get();
            $users = User::where('role', 'user')->get();
            return view('dashboardanak', compact('children', 'users'));
        }

        return redirect("login")->withErrors('Anda tidak memiliki akses ke dashboard anak. Silakan login kembali');
    }
}
