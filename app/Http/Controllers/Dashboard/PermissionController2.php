<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PutRequest;
use App\Http\Requests\Permission\StoreRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Muestra una lista paginada de todos los permisos.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('dashboard/permission/index', compact('permissions'));
    }

    /**
     * Muestra el formulario para crear un nuevo permiso.
     */
    public function create()
    {
        $permission = new Permission();
        return view('dashboard.permission.create', compact('permission'));
    }

    /**
     * Almacena un nuevo permiso en la base de datos.
     */
    public function store(StoreRequest $request)
    {
        Permission::create($request->validated());
        return to_route('permission.index')->with('status', 'Permission created');
    }

    /**
     * Muestra los detalles de un permiso específico.
     */
    public function show(Permission $permission)
    {
        return view('dashboard/permission/show', ['permission' => $permission]);
    }

    /**
     * Muestra el formulario para editar un permiso.
     */
    public function edit(Permission $permission)
    {
        return view('dashboard.permission.edit', compact('permission'));
    }

    /**
     * Actualiza un permiso específico.
     */
    public function update(PutRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        return to_route('permission.index')->with('status', 'Permission updated');
    }

    /**
     * Elimina un permiso específico.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return to_route('permission.index')->with('status', 'Permission deleted');
    }
}