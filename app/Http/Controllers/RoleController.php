<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Tables\Roles;
use App\Models\Permission;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\DestroyRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('role_access');
        SEO::title('Roles');
        return view('roles.index', [
            'roles' => Roles::class,
        ]);
    }
    public function create()
    {
        $this->authorize('role_create');
        SEO::title('Agregar Rol');
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {

        $this->authorize('role_create');
        $role = Role::create(
            [
                'title' => $request->title,
            ]
        );

        $role->permissions()->sync($request->permissions);

        Toast::title('Operación exitosa')
            ->message('Nuevo rol agregado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {
        $this->authorize('role_edit');
        SEO::title('Editar Rol');
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('role_edit');
        $role->update(
            [
                'title' => $request->title,
            ]
        );

        $role->permissions()->sync($request->permissions);

        Toast::title('Operación exitosa')
            ->message('El rol ha sido actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('roles.index');
    }

    public function destroy(DestroyRoleRequest $request, Role $role)
    {
        $this->authorize('role_delete');
        $role->delete();
        Toast::title('Operación exitosa')
            ->info()
            ->message('El rol ha sido eliminado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('roles.index');
    }
}
