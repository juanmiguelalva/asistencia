<?php

namespace App\Tables;

use App\Models\User;
use App\Models\Ciclo;
use App\Models\Clase;
use App\Models\Curso;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Clases extends AbstractTable
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
        return Gate::allows('clases_access');
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Clase::query()->orderBy('dia')->orderBy('hora_inicio');
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
            ->column('id', sortable: true, exportAs: false)
            ->column('nombredia', label: 'Día', sortable: false)
            ->column('hora_inicio', sortable: true)
            ->column('hora_fin', sortable: true)
            ->column('docente', label: 'Docente', sortable: false)
            ->column('curso.nombre', label: 'Curso', sortable: false)
            ->when(Gate::allows('clases_edit') || Gate::allows('clases_create'), function ($table) {
                $table->column('acciones', exportAs: false);
            })
            ->selectFilter('user_id', $users, label: 'Docentes')
            ->selectFilter('curso_id', $cursos, label: 'Cursos')
            ->selectFilter('curso.ciclo_id', $ciclos, label: 'Ciclos')
            ->selectFilter('dia', label: 'Día', options: [
                1 => 'Lunes',
                2 => 'Martes',
                3 => 'Miercoles',
                4 => 'Jueves',
                5 => 'Viernes',
                6 => 'Sábado',
                7 => 'Domingo',
            ])
            ->export()
            ->bulkAction(
                label: 'Eliminar clases seleccionadas',
                each: fn (Clase $clase) => $clase->delete(),
                confirm: 'Eliminar clases',
                confirmText: '¿Está seguro de esta acción?',
                confirmButton: 'Confirmar',
                cancelButton: 'Cancelar',
                after: fn () => Toast::title('Operación exitosa')
                    ->info()
                    ->message('Las clases han sido eliminadas')
                    ->rightBottom()
                    ->autoDismiss(10)
            )
            ->paginate(10);
    }
}
