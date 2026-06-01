<?php

namespace App\View\Components\Dashboard\user\role\permission;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

use Spatie\Permission\Models\Permission;

class Manage extends Component
{
    public function __construct(public User $user)
    {
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.user.role.permission.manage', ['roles' => Role::get(), 'permissions' => Permission::get()]);
    }

    //*****  ROLES

    public function handleRole(User $user)
    {
        $role = Role::findOrFail(request('role'));
        $user->assignRole($role);

        if (request()->ajax()) {
            return response()->json($role);
        } else {
            return back();
        }
    }

    public function deleteRole(User $user)
    {
        $role = Role::find(request('role'));
        $user->removeRole($role);

        if (request()->ajax()) {
            return response()->json(['message' => 'ok']);
        } else {
            return back();
        }
    }

    //*****  PERMISSIONS

    public function handlePermission(User $user)
    {
       // Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $user->givePermissionTo($permission);

        if (request()->ajax()) {
            //axios, jquery ajax fetch...
            return response()->json($permission);
        } else {
            //form
            return redirect()->back();
        }
    }

    function deletePermission(User $user)
    {
       // Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $user->revokePermissionTo($permission);

        if (request()->ajax()) {
            //axios, jquery ajax fetch...
            return response()->json($permission);
        } else {
            //form
            return redirect()->back();
        }
    }
}
