<?php

namespace App\Tables;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class Users extends AbstractTable
{

    public function __construct()
    {
        //
    }

    public function authorize(Request $request)
    {
        return Gate::allows('user_access');
    }

    public function for()
    {
        return User::query();
    }

    public function configure(SpladeTable $table)
    {
        $roles = Role::pluck('title', 'id')->toArray();
        $table
            ->withGlobalSearch(columns: ['id', 'name', 'lastname', 'email'])
            ->column('id', sortable: true)
            ->column('foto')
            ->column('name', label: 'Nombres', sortable: true)
            ->column('lastname', label: 'Apellidos', sortable: true)
            ->column('roles.title', label: 'Rol', sortable: false)
            ->column('email', sortable: true)
            ->column('acciones')
            ->selectFilter('roles.id', $roles, label: 'Roles')
            ->paginate(10);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
