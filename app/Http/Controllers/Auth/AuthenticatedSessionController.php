<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    public function admincreate(): View
    {
        return view('auth.admin_login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->usertype !== 'patient') {
                Auth::logout();
                return response()->json(['error' => 'You are not authorized'], 403);
            }

            config(['app.timezone' => 'Asia/Manila']);
            $user->last_login_at = Carbon::now()->format('M j, Y');
            $user->login_at = Carbon::now()->format('h:ia');
            $user->save();

            return response()->json(['user' => $user, 'custom_id' => $user->custom_id]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }
       

    public function adminstore(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->usertype !== 'admin' && $user->usertype !== 'staff') {
            Auth::logout();
            return redirect()->back()->with('message', 'You are not authorized.');
        }
        config(['app.timezone' => 'Asia/Manila']);
        $user->last_login_at = Carbon::now()->format('M j, Y');
        $user->login_at = Carbon::now()->format('h:ia');
        $user->save();  

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        config(['app.timezone' => 'Asia/Manila']);
        $user = Auth::user();
        $user->logout_at = Carbon::now()->format('h:ia');
        $user->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
