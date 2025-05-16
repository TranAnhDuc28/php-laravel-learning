<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show form for Login.
     *
     * @return Response|\Illuminate\Contracts\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Process Login.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|Response
     */
    public function processLogin(Request $request)
    {
        // Validate input.
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);
        $username = $validated['username'];
        $password = $validated['password'];

        $credentials = [
            'username' => $username,
            'password' => $password,
            'role' => [UserRole::Admin, UserRole::Manager],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('pages.dashboard');
        }

        return back()->withErrors([
            'username' => __('auth.invalid credentials'),
        ])->onlyInput('username');
    }

    /**
     * Process Logout.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|Response
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect(route('auth.showLogin'));
    }

    /**
     * Show Profile screen.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showProfile(Request $request)
    {
        return view('');
    }

    /**
     * Show ChangePassword screen.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showChangePassword(Request $request)
    {
        return view('');
    }

    /**
     * Process ChangePassword.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processChangePassword(Request $request)
    {
        // Validate.
        $validated = $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);
        $current_password = $validated['current_password'];
        $new_password = $validated['new_password'];

        // Match the current Password.
        if (!Hash::check($current_password, auth()->user()->password)) {
            return back()->with('error', __('user.change_password_error'));
        }

        // Update the new Password.
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($new_password),
            'password_changed_at' => Carbon::now(),
        ]);

        return back()->with('status', __('user.change_password_success'));
    }
}
