<?php

namespace App\Tables;

use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;

class MisClases extends AbstractTable
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
            ->where('dia', [date('N')])
            // ->orderByRaw('ABS(TIMESTAMPDIFF(MINUTE, NOW(), hora_inicio))')
            ->orderBy('dia')
            ->orderBy('hora_inicio');
    }

    public function configure(SpladeTable $table)
    {
        $table
            // ->withGlobalSearch(columns: ['id', 'user.name', 'curso.nombre'])
            // ->column('id', sortable: true, exportAs: false)
            // ->column('dia', sortable: true)
            ->column('asistencia', exportAs: false, canBeHidden: false)
            ->column('curso.nombre', label: 'Curso', sortable: false, canBeHidden: false)
            ->column('nombredia', label: 'Día', sortable: false, canBeHidden: false)
            ->column('hora_inicio', sortable: true, canBeHidden: false)
            ->column('hora_fin', sortable: true, canBeHidden: false);
        // ->column('user.name', label: 'Docente', sortable: false)

        // ->paginate(5);
    }
}
