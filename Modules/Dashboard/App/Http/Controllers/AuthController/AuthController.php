<?php

namespace Modules\Dashboard\App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('dashboard::login.index');
    }


    public function create()
    {
        return view('dashboard::create');
    }



    // login function
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'អុីម៉ែលរបស់លោកអ្នកមិនត្រឹមត្រូវ!']);
        }
         // Check if user is blocked
        if (!$user->userDetail->is_active) {
            return back()->withInput()->withErrors(['email' => 'គណនីរបស់លោកអ្នកត្រូវបានបិទ!']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withInput()->withErrors(['password' => 'ពាក្យសម្ងាត់របស់លោកអ្នកមិនត្រឹមត្រូវ!']);
        }
        Auth::login($user, $request->filled('remember'));

        if ($request->filled('remember')) {
            Cookie::queue('remember_email', $request->email, 60 * 24 * 365 * 10); // 10 years
            Cookie::queue('remember_password', $request->password, 60 * 24 * 365 * 10);
        }

        return redirect()->route('admin.index')->with('message', 'Login successful!');
    }


    // logout function
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('message', 'Logout successful!');
    }


    public function show($id)
    {
        return view('dashboard::show');
    }


    public function edit($id)
    {
        return view('dashboard::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
