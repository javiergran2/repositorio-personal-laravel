<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Lista de clientes (para gestión interna)
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Mostrar formulario de registro (público)
     */
    public function create()
    {
        return view('users.register'); // Vista pública de registro
    }

    /**
     * Guardar nuevo cliente (registro público)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dni' => 'nullable|string|max:20|unique:users',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date|before:-18 years', // Mayor de 18 años
            'membership_type' => 'required|in:basic,premium',
        ]);

        // Crear cliente - por defecto NO verificado (admin debe verificar)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dni' => $request->dni,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'membership_type' => $request->membership_type,
            'membership_expires_at' => now()->addMonths($request->membership_type == 'premium' ? 6 : 3),
            'verified' => false, // Necesita verificación del admin
            'is_active' => true,
        ]);

        // Auto-login después de registro
        auth()->login($user);

        return redirect()->route('dashboard')
            ->with('success', '¡Registro exitoso! Tu cuenta está pendiente de verificación.');
    }

    /**
     * Mostrar perfil del cliente
     */
    public function show(User $user)
    {
        // Solo puede ver su propio perfil o admin
        if (auth()->id() !== $user->id) {
            abort(403, 'No autorizado');
        }
        
        return view('users.profile', compact('user'));
    }

    /**
     * Mostrar formulario para editar perfil
     */
    public function edit(User $user)
    {
        // Solo puede editar su propio perfil
        if (auth()->id() !== $user->id) {
            abort(403, 'No autorizado');
        }
        
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar perfil del cliente
     */
    public function update(Request $request, User $user)
    {
        // Solo puede actualizar su propio perfil
        if (auth()->id() !== $user->id) {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'birth_date' => 'required|date|before:-18 years',
        ]);

        // Solo permitir cambiar ciertos campos
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('users.show', $user)
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Eliminar cuenta (soft delete)
     */
    public function destroy(User $user)
    {
        // Solo puede eliminar su propia cuenta
        if (auth()->id() !== $user->id) {
            abort(403, 'No autorizado');
        }

        $user->delete();
        
        auth()->logout();
        
        return redirect('/')
            ->with('success', 'Tu cuenta ha sido eliminada.');
    }

    /**
     * Verificar cliente (acción de admin)
     */
    public function verify(User $user)
    {
        $user->verify();
        
        return redirect()->route('users.index')
            ->with('success', 'Cliente verificado exitosamente.');
    }

    /**
     * Activar/Desactivar cliente (acción de admin)
     */
    public function toggleStatus(User $user)
    {
        $user->toggleStatus();
        
        $status = $user->is_active ? 'activado' : 'desactivado';
        return redirect()->route('users.index')
            ->with('success', "Cliente $status exitosamente.");
    }
}