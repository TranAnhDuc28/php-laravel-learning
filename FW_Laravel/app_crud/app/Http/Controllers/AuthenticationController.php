<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthenticationController extends Controller
{
    public function login()
    {

    }

    public function processLogin()
    {

    }

    /**
     * @return Factory|View|Application|object
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * @return RedirectResponse
     */
    public function processRegister(): RedirectResponse
    {
        $data = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'confirmed']
        ]);

        $user = User::query()->create($data);

        Auth::login($user);

        request()->session()->regenerate();

        return redirect()->route('member.dashboard');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
