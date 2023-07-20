<?php

namespace App\Tables;

use App\Models\Reporte;
use App\Models\User;
use App\Models\Curso;
use App\Models\Ciclo;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;

class Reportes extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return Gate::allows('user_access');
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Reporte::query()->orderBy('created_at');
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.id', '=', 2)
            ->selectRaw("CONCAT(users.lastname, ' ', users.name) AS full_name, users.id")
            ->pluck('full_name', 'id')
            ->toArray();
        $cursos = Curso::pluck('nombre', 'id')->toArray();
        $ciclos = Ciclo::pluck('nombre', 'id')->toArray();
        $table
            ->withGlobalSearch(columns: ['id', 'user.name', 'user.lastname', 'curso.nombre'])
            // ->column('id', sortable: true)
            ->column('docente', label: 'Docente')
            ->column('curso.ciclo.nombre', label: 'Ciclo')
            ->column('curso.nombre', label: 'Curso')
            ->column('curso.nombre', label: 'Curso')
            ->column('fecha', label: 'Fecha')
            ->column('hora', label: 'Hora')
            ->selectFilter('user_id', $users, label: 'Docentes')
            ->selectFilter('curso_id', $cursos, label: 'Cursos')
            ->selectFilter('curso.ciclo_id', $ciclos, label: 'Ciclos')
            ->export()
            ->paginate(10);
        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
