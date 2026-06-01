<?php

namespace App\View\Components\Dashboard\role\permission;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class Manage extends Component
{
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function render(): View|string
    {
        return view('components.dashboard.role.permission.manage', [
            'permissionsRole' => $this->role->permissions, // Permisos ya asignados
            'permissions' => Permission::get() // Todos los permisos disponibles
        ]);
    }

   public function handle(Role $role)
    {
        $permission = Permission::findOrFail(request('permission'));
        $role->givePermissionTo($permission);

        if (request()->ajax()) {
            return response()->json($permission); // Devuelve el permiso en JSON
        } else {
            return redirect()->back();
        }
}

    public function delete(Role $role)
    {
        //dd(request('permission'))  ;
        $permission = Permission::find(request('permission'));
        $role->revokePermissionTo($permission);

        if (request()->ajax()) {
            return response()->json(['message' => 'ok']);
        } else {
            return redirect()->back();
        }
    }
}