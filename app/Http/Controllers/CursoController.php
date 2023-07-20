<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Curso;
use App\Tables\Cursos;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;

class CursoController extends Controller
{

    public function index()
    {
        $this->authorize('cursos_access');
        return view('cursos.index', [
            'cursos' => Cursos::class,
        ]);
    }
    public function create()
    {
        $this->authorize('cursos_create');
        $ciclos = Ciclo::all();
        return view('cursos.create', compact('ciclos'));
    }

    public function store(StoreCursoRequest $request)
    {
        $this->authorize('cursos_create');
        $ciclo = Ciclo::findOrFail($request->ciclo_id);
        $curso = Curso::create(
            $request->validated() + ['ciclo_id' => $ciclo->id],
        );
        Toast::title('Operación exitosa')
            ->message('Nuevo curso agregado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('cursos.index');
    }

    public function edit(Curso $curso)
    {
        $this->authorize('cursos_edit');
        $ciclos = Ciclo::all();
        return view('cursos.edit', compact('curso', 'ciclos'));
    }

    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        $this->authorize('cursos_edit');
        $curso->update($request->validated());
        Toast::title('Operación exitosa')
            ->message('El curso ha sido actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('cursos.index');
    }

    public function destroy(Curso $curso)
    {
        $this->authorize('cursos_delete');
        $curso->delete();
        Toast::title('Operación exitosa')
            ->info()
            ->message('El curso ha sido eliminado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('cursos.index');
    }
}
