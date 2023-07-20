<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clase;
use App\Models\Curso;
use App\Tables\Clases;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreClaseRequest;
use App\Http\Requests\UpdateClaseRequest;

class ClaseController extends Controller
{
    public function index()
    {
        $this->authorize('clases_access');
        return view('clases.index', [
            'clases' => Clases::class,
        ]);
    }
    public function create()
    {
        $this->authorize('clases_create');
        $users = User::all();
        $cursos = Curso::all();
        return view('clases.create', compact('users', 'cursos'));
    }

    public function store(StoreClaseRequest $request)
    {
        $this->authorize('clases_create');
        $curso = Curso::findOrFail($request->curso_id);
        $user = User::findOrFail($request->user_id);

        $clase = Clase::create(
            $request->validated() + ['user_id' => $user->id] + ['curso_id' => $curso->id],
        );
        Toast::title('Operación exitosa')
            ->message('Nueva clase agregada')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('clases.index');
    }

    public function edit(Clase $clase)
    {
        $this->authorize('clases_edit');
        $users = User::all();
        $cursos = Curso::all();
        return view('clases.edit', compact('clase', 'users', 'cursos'));
    }

    public function update(UpdateClaseRequest $request, Clase $clase)
    {
        $this->authorize('clases_edit');
        $clase->update($request->validated());
        Toast::title('Operación exitosa')
            ->message('La clase ha sido actualizada')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->back();;
    }

    public function destroy(Clase $clase)
    {
        $this->authorize('clases_delete');
        $clase->delete();
        Toast::title('Operación exitosa')
            ->info()
            ->message('La clase ha sido eliminada')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('clases.index');
    }
}
