<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalCategorias = Categoria::where('user_id', $user->id)->count();
        $totalProductos = Producto::where('user_id', $user->id)->count();

        return view('profile.index', compact('totalCategorias', 'totalProductos'));
    }

    public function showChangePassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('La contraseña actual es incorrecta.');
                }
            }],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Contraseña actualizada exitosamente.');
    }

    public function destroy()
    {
        $user = User::find(auth()->id());
        
        // Eliminar registros relacionados
        Categoria::where('user_id', $user->id)->delete();
        Producto::where('user_id', $user->id)->delete();
        
        // Eliminar usuario (soft delete)
        $user->delete();

        return redirect()->route('login')
            ->with('success', 'Tu cuenta ha sido eliminada.');
    }
}
