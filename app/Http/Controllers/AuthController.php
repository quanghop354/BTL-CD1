<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Try to authenticate with email or username
        $user = User::where('email', $credentials['email_or_username'])
                    ->orWhere('username', $credentials['email_or_username'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email_or_username' => 'Email/Username hoặc mật khẩu không đúng.',
        ])->onlyInput('email_or_username');
    }

    public function redirectToGoogle()
    {
        if (!env('GOOGLE_CLIENT_ID') || !env('GOOGLE_CLIENT_SECRET')) {
            return redirect()->route('login')->withErrors(['google' => 'Google OAuth chưa được cấu hình. Vui lòng liên hệ quản trị viên.']);
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google' => 'Không thể kết nối Google. Vui lòng thử lại.']);
        }
    }

    public function handleGoogleCallback()
    {
        if (!env('GOOGLE_CLIENT_ID') || !env('GOOGLE_CLIENT_SECRET')) {
            return redirect()->route('login')->withErrors(['google' => 'Google OAuth chưa được cấu hình. Vui lòng liên hệ quản trị viên.']);
        }

        try {
            $user = Socialite::driver('google')->user();
            $authUser = $this->findOrCreateUser($user);
            Auth::login($authUser);
            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google' => 'Có lỗi xảy ra khi đăng nhập bằng Google.']);
        }
    }

    /**
     * Tìm hoặc Tạo Người Dùng từ Google OAuth
     * 
     * Hàm này được gọi khi người dùng đăng nhập bằng Google:
     * 1. Nếu người dùng đã từng đăng nhập bằng Google → Trả về người dùng hiện tại
     * 2. Nếu là lần đầu → Tạo tài khoản mới với vai trò 'user' (mặc định)
     * 
     * @param \Laravel\Socialite\Contracts\User $googleUser Thông tin người dùng từ Google
     *        - Contains: id, name, email, avatar, etc.
     * 
     * @return \App\Models\User Đối tượng User đã được lưu trong database
     */
    protected function findOrCreateUser($googleUser)
    {
        // Kiểm tra xem người dùng này có từng đăng nhập bằng Google chưa
        // Tìm trong bảng users cột google_id
        $user = User::where('google_id', $googleUser->id)->first();

        // Nếu tìm thấy người dùng → Trả về người dùng cũ (không tạo lại)
        if ($user) {
            return $user;
        }

        // Người dùng lần đầu đăng nhập bằng Google → Tạo tài khoản mới
        // Gán vai trò mặc định là 'user' (độc giả thường)
        return User::create([
            'name' => $googleUser->name,           // Lấy tên từ Google
            'email' => $googleUser->email,         // Lấy email từ Google
            'google_id' => $googleUser->id,        // Lưu ID Google để lần sau nhận diện
            'password' => Hash::make(str()->random(24)), // Tạo mật khẩu ngẫu nhiên (không dùng)
            'role' => 'user',                      // Mặc định vai trò là 'user'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function editProfile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];

        // Update password if provided
        if (!empty($validated['new_password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
    }
}
