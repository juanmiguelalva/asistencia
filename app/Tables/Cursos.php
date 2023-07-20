<?php

namespace App\Tables;

use App\Models\Ciclo;
use App\Models\Curso;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Cursos extends AbstractTable
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
        return auth()->check();
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Curso::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $ciclos = Ciclo::pluck('nombre', 'id')->toArray();
        $escuelas = [
            'MH' => 'Medicina Humana',
            'EN' => 'Enfermería',
        ];
        $table
            ->withGlobalSearch(columns: ['id', 'codigo', 'nombre', 'ciclo.nombre'])
            ->column('id', sortable: true)
            ->column('codigo', label: 'Código', sortable: true)
            ->column('nombre', sortable: true)
            ->column('ciclo.nombre', label: 'Ciclo')
            ->column('escuela', as: fn ($escuelas, $curso) => $curso->nescuela(), sortable: true)
            ->column('acciones')
            ->selectFilter('escuela', $escuelas, label: 'Escuela')
            ->selectFilter('ciclo_id', $ciclos, label: 'Ciclo')
            ->bulkAction(
                label: 'Eliminar cursos seleccionados',
                each: fn (Curso $curso) => $curso->delete(),
                confirm: 'Eliminar cursos',
                confirmText: '¿Está seguro de esta acción?',
                confirmButton: 'Confirmar',
                cancelButton: 'Cancelar',
                after: fn () => Toast::title('Acción exitosa')
                    ->info()
                    ->message('Los cursos han sido eliminados')
                    ->rightBottom()
                    ->autoDismiss(10)
            )
            ->paginate(5);

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
        // ->export()
    }
}
