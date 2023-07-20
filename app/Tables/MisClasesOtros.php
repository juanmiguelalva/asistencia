<?php

namespace App\Tables;

use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class MisClasesOtros extends AbstractTable
{

    public function __construct()
    {
        //
    }

    public function authorize(Request $request)
    {
        return Gate::allows('misclases_access');
    }

    public function for()
    {
        return Clase::query()
            ->where('user_id', Auth::user()->id)
            ->whereNotIn('dia', [date('N')]) // Excluir el día de hoy
            ->orderBy('dia')
            ->orderBy('hora_inicio')
            ->get();
    }

    public function configure(SpladeTable $table)
    {
        $table
            // ->togglecolumn()
            // ->withGlobalSearch(columns: ['id', 'user.name', 'curso.nombre'])
            // ->column('id', sortable: true, exportAs: false)
            // ->column('dia', sortable: true)
            ->column('curso.nombre', label: 'Curso', sortable: false, canBeHidden: false)
            ->column('nombredia', label: 'Día', sortable: false, canBeHidden: false)
            ->column('hora_inicio', sortable: false, canBeHidden: false)
            ->column('hora_fin', sortable: false, canBeHidden: false);
        // ->column('user.name', label: 'Docente', sortable: false)
        // ->column('asistencia', exportAs: false);
        // ->paginate(5);
    }
}
