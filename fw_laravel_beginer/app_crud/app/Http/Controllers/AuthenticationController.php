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
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function processLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Hàm attempt() dùng để xác thực thông tin đăng nhập của người dùng
        // Nó sẽ kiểm tra email/password trong $credentials có khớp với bản ghi trong DB không
        // Nếu đúng:
        // - Tự động đăng nhập user đó vào hệ thống
        // - Hàm sẽ trả về true
        // - Đồng thời khởi tạo session cho user
        // Nếu sai: trả về false
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /* @var User $user */
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('member.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
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
