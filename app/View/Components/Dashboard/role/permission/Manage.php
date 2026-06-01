<?php

namespace App\View\Components\Dashboard\role\permission;

use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate; // <-- Agregar

class Manage extends Component
{
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

     public function render()
    {
        return view('components.dashboard.role.permission.manage', [
            'permissionsRole' => $this->role->permissions,
            'permissions' => Permission::get()
        ]);
    }

    public function handle(Role $role)
    {
        Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $role->givePermissionTo($permission);
        //return redirect()->back();
        
        if (request()->ajax()) {
            return response()->json($permission);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Role $role)
    {
        Gate::authorize('is-admin');
        $permission = Permission::find(request('permission'));
        $role->revokePermissionTo($permission);
        //return redirect()->back();

        if (request()->ajax()) {
            return response()->json(['message' => 'ok']);
        } else {
            return redirect()->back();
        }
    }

   
}