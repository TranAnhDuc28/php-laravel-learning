<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LeaveDays;
use App\Models\User;
use App\Services\CommonService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    private CommonService $commonService;

    public function __construct(CommonService $commonService)
    {
        $this->commonService = $commonService;
    }

    public function edit(Request $request, $id): View
    {
        $currentUser = $request->user();
        if ($currentUser->isMem() && $currentUser->isAd()) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $user = User::findOrFail($id);

        // Kiểm tra quyền edit
        if ($currentUser->isMod() && in_array($user->role, [0, 9])) {
            abort(403, __('messages.mesError.perDeny'));
        }

        return view('auth.edit', compact('user'));
    }

    /**
     * Xử lý cập nhật user
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $currentUser = $request->user();
        if ($currentUser->isMem() && $currentUser->isAd()) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $user = User::findOrFail($id);

        // Kiểm tra quyền edit
        if ($currentUser->isMod() && in_array($user->role, [0, 9])) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'join_date' => 'required|date',
            'role' => $request->user()->isMod() ? 'required|in:1,2' : 'required|in:0,1,2,9',
        ];

//        // Thêm validate role nếu là admin
//        if ($currentUser->isAd()) {
//            $validationRules['role'] = 'required|in:0,1,2';
//        }

        // Thêm validate password nếu có
        if ($request->filled('password')) {
            $validationRules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        $validatedData = $request->validate($validationRules);

        // Cập nhật thông tin
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->join_date = $validatedData['join_date'];
        $user->role = $validatedData['role'];

        // Cập nhật role chỉ khi là admin
//        if ($currentUser->isAd() && isset($validatedData['role'])) {
//            $user->role = $validatedData['role'];
//        }

        // Cập nhật password nếu có
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Xóa user
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $currentUser = $request->user();
        if ($currentUser->isMem()) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $user = User::findOrFail($id);

        // Kiểm tra quyền xóa
        if ($currentUser->isMod() && in_array($user->role, [0, 9])) {
            abort(403, __('messages.mesError.perDeny'));
        }

        // Ngăn không cho xóa chính mình
        if ($user->id === $currentUser->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully!');
    }

    public function index(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser->isMem()) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $forms = User::query()
            ->when($currentUser->isMod(), function ($query) {
                return $query->whereIn('role', [1, 2]);
            })
            ->when($currentUser->isAd(), function ($query) {
                return $query->whereIn('role', [0, 1, 2]);
            })
            ->when($currentUser->isPu(), function ($query) {
                return $query;
            })
            ->orderBy('id')
            ->paginate(50);
        return view('user.index', compact('forms'));
    }
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        if ($request->user()->isMem()) {
            abort(403, __('messages.mesError.perDeny'));
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->isMem()) {
            abort(403, __('messages.mesError.perDeny'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => $request->user()->isMod() ? 'required|in:1,2' : 'required|in:0,1,2,9',
            'join_date' => 'required|date',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->validate(['role'])) {
            return back()
                ->withErrors(['role' => 'You are not Administrator.'])
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'join_date' => $request->join_date,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        LeaveDays::create([
            'user_id' => $user->id,
            'days_off' => 0,
            'award_days_off' => 0,
            'days_off_to_june' => 0,
            'year' => now()->year
        ]);

//        Auth::login($user);

//        return redirect(route('dashboard', absolute: false));
        return redirect()->route('user.index')
            ->with('success', 'Account registration successful!');
    }
}
