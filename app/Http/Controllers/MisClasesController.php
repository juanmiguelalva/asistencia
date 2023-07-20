<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Clase;
use App\Models\Reporte;
use App\Tables\MisClases;
use Illuminate\Http\Request;
use App\Tables\MisClasesOtros;
use ProtoneMedia\Splade\Facades\Toast;

class MisClasesController extends Controller
{
    public static function canRegisterAsistencia(Clase $clase): bool
    {
        $now = Carbon::now();
        $start = Carbon::parse($clase->hora_inicio)->subMinutes(15);
        $end = Carbon::parse($clase->hora_fin)->addMinutes(15);
        return $now->dayOfWeek == $clase->dia && $now->between($start, $end);
    }

    public function index()
    {
        $this->authorize('misclases_access');
        return view(
            'mis_clases.index',
            [
                'claseso' => MisClasesOtros::class,
            ],
            [
                'clases' => MisClases::class,
            ]
        );
    }


    public function store(Request $request)
    {
        $this->authorize('misclases_access');

        // dd(Carbon::now()->toDateTimeString());
        $clase = Clase::findOrFail($request->id);



        if (!(now() >= \Carbon\Carbon::parse($clase->hora_inicio)->subMinutes(15) && now() <= \Carbon\Carbon::parse($clase->hora_fin))) {
            Toast::title('Ha ocurrido un error')
                ->warning()
                ->message('No se ha registrado su asistencia.')
                ->rightBottom()
                ->autoDismiss(10);
        } else {
            $reporte = Reporte::create([
                'user_id' => $clase->user_id,
                'curso_id' => $clase->curso_id,
            ]);
            Toast::title('Operación exitosa')
                ->success()
                ->message('Se ha registrado su asistencia a la clase del curso ' . $clase->curso->nombre)
                ->rightBottom()
                ->autoDismiss(10);
        }


        return redirect()->route('mis_clases.index');
    }
}
