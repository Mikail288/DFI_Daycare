<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return View|RedirectResponse
     */
    public function registration(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('auth.registration');
        }

        return redirect("login")->withErrors('Oops! You do not have access to the registration page.');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('dashboardadmin')
                            ->withSuccess('You have Successfully logged in as Admin');
            } else {
                return redirect()->intended('dashboard')
                            ->withSuccess('You have Successfully logged in');
            }
        }

        return redirect("login")->withErrors('Oops! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan informasi pengguna yang sedang login
        $currentUser = Auth::user();
       
        $data = $request->all();
        $user = $this->create($data);
        
        // Kembalikan sesi pengguna yang sedang login
        Auth::login($currentUser);

        return redirect("dashboardadmin")->withSuccess('Great! You have successfully registered a new account.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard(): View|RedirectResponse
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withErrors('Oops! You do not have access to the dashboard');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    
    /**
     * Write code on Method
     *
     * @return View|RedirectResponse
     */
    public function dashboardAdmin(): View|RedirectResponse
    {
        if(Auth::check() && Auth::user()->role == 'admin'){
            return view('dashboardadmin');
        }

        return redirect("login")->withErrors('Oops! You do not have access to the admin dashboard');
    }
    
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function edit($id): View|RedirectResponse
    {
        $user = User::find($id);

        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('auth.edit', compact('user'));
        }

        return redirect("login")->withErrors('Oops! You do not have access to edit users.');
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $passwordChanged = false;

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $passwordChanged = true;
        }

        $user->role = $request->role;
        $user->save();

        if (Auth::user()->id == $id && $passwordChanged) {
            Auth::logout();
            return redirect()->route('login')->withErrors('You have changed your password. Please login again.');
        }

        return redirect()->route('dashboardadmin')->withSuccess('User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('dashboardadmin')->withSuccess('User deleted successfully.');
    }
}