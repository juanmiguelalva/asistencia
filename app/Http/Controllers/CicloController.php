<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Tables\Ciclos;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreCicloRequest;
use App\Http\Requests\UpdateCicloRequest;

class CicloController extends Controller
{
    public function index()
    {
        $this->authorize('ciclos_access');
        return view('ciclos.index', [
            'ciclos' => Ciclos::class,
        ]);
    }

    public function create()
    {
        $this->authorize('ciclos_create');
        return view('ciclos.create');
    }

    public function store(StoreCicloRequest $request)
    {
        $this->authorize('ciclos_create');
        $ciclo = Ciclo::create(
            $request->validated(),
        );
        Toast::title('Operación exitosa')
            ->message('Nuevo ciclo agregado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('ciclos.index');
    }

    public function edit(Ciclo $ciclo)
    {
        $this->authorize('ciclos_edit');
        return view('ciclos.edit', compact('ciclo'));
    }

    public function update(UpdateCicloRequest $request, Ciclo $ciclo)
    {
        $this->authorize('ciclos_edit');
        $ciclo->update($request->validated());
        Toast::title('Operación exitosa')
            ->message('El ciclo ha sido actualizado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('ciclos.index');
    }
    public function destroy(Ciclo $ciclo)
    {
        $this->authorize('ciclos_delete');
        $ciclo->delete();
        Toast::title('Operación exitosa')
            ->info()
            ->message('El ciclo ha sido eliminado')
            ->rightBottom()
            ->autoDismiss(10);
        return redirect()->route('ciclos.index');
    }
}
