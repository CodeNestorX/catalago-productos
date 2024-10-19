<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
    
        // Si el correo no existe, devolver un mensaje específico para el correo
        if (!$user) {
            return back()->withErrors([
                'email' => 'El correo electrónico proporcionado no está registrado.',
            ])->withInput($request->only('email'));
        }
    
        // Si el correo es correcto pero la contraseña no, mostrar error de contraseña
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'La contraseña proporcionada es incorrecta.',
            ])->withInput($request->only('password'));
        }
    
        // Si ambos son correctos, iniciar sesión
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
