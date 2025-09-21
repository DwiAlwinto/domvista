<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani autentikasi pengguna dan mengarahkan mereka
    | ke halaman tujuan setelah login. Menggunakan trait untuk menyediakan
    | fungsionalitas login secara otomatis dan aman.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * Bisa di-override dengan method redirectTo() di bawah.
     *
     * @var string
     */
    // protected $redirectTo = '/home'; // TIDAK DIGUNAKAN — ganti dengan dinamis

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Tentukan URL redirect setelah login sukses (lebih fleksibel & aman).
     * Contoh: beda role → beda dashboard.
     *
     * @return string
     */
    public function redirectTo()
    {
        // Contoh logika redirect berdasarkan role
        if (auth()->user()->hasRole('admin')) {
            return '/admin/dashboard';
        }

        // Atau cukup redirect ke dashboard user biasa
        return '/dashboard';
    }

    /**
     * Override untuk mencatat percobaan login gagal — proteksi & audit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // 🔍 LOG KE LARAVEL — BISA DIINTEGRASIKAN KE SENTRY / EMAIL ALERT
        Log::warning('⚠️ Percobaan Login Gagal', [
            'email'      => $request->email ?? 'tidak diisi',
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp'  => now(),
        ]);

        // 🚫 KIRIM RESPON ERROR BAWAAN LARAVEL
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Logout user & invalidate session — proteksi tambahan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();     // Hapus session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/'); // Redirect ke landing page
    }
}