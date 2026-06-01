<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // <-- Agregar esta línea


class UserController extends Controller
{
    public function index()
    {
        //$users = User::paginate(10);

        // Verificar permiso para ver usuarios
        if (!Auth::user()->hasPermissionTo('editor.user.index')) {
            abort(403, 'No tienes permiso para ver usuarios');
        }

        // Filtrar usuarios según el rol del usuario autenticado
        // Si NO es Admin, solo ve usuarios 'regular' (editores)
        // Si es Admin, ve todos los usuarios
        $users = User::when(!Auth::user()->hasRole('Admin'), function ($query) {
            return $query->where('role', 'regular'); // regular = editor
        })->paginate(10);

        return view('dashboard/user/index', compact('users'));
    }

    public function create()
    {
        if (! auth()->user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }
        $user = new User();
        return view('dashboard.user.create', compact('user'));
    }

    public function store(StoreRequest $request)
    {
        if (! auth()->user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }
        $data = $request->validated();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'rol' => 'admin',
        ]);
        return to_route('user.index')->with('status', 'User created');
    }

     public function show(User $user)
    {
        // Verificar el Gate
        Gate::authorize('update-view-user-admin', $user);

        return view('dashboard/user/show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        // Verificar el Gate
        Gate::authorize('update-view-user-admin', $user);

        // Verificar permiso específico de edición
        if (!Auth::user()->hasPermissionTo('editor.user.update')) {
            abort(403, 'No tienes permiso para editar usuarios');
        }

        return view('dashboard.user.edit', compact('user'));
    }

     public function update(PutRequest $request, User $user)
    {
        Gate::authorize('update-view-user-admin', $user);

        if (!Auth::user()->hasPermissionTo('editor.user.update')) {
            abort(403);
        }

        $user->update($request->validated());
        return to_route('user.index')->with('status', 'User updated');
    }

     public function destroy(User $user)
    {
        Gate::authorize('update-view-user-admin', $user);

        if (!Auth::user()->hasPermissionTo('editor.user.destroy')) {
            abort(403);
        }

        $user->delete();
        return to_route('user.index')->with('status', 'User deleted');
    }
}