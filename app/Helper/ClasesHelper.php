<?php

namespace App\Helper;

use Carbon\Carbon;
use App\Models\Clase;
use App\Models\Reporte;

class ClasesHelper
{
    public static function canRegister(Clase $clase): bool
    {
        $now = Carbon::now();
        $start = Carbon::parse($clase->hora_inicio)->subMinutes(15);
        $end = Carbon::parse($clase->hora_fin);
        return $now->dayOfWeek == $clase->dia && $now->between($start, $end);
    }

    public static function isRegistered(Clase $clase)
    {
        $currentDate = Carbon::today()->toDateString();
        $reporte = Reporte::where('curso_id', $clase->curso_id)
            ->where('user_id', $clase->user_id)
            ->whereDate('created_at', '=', $currentDate)
            ->first();

        if ($reporte) {
            $hora1 = Carbon::createFromFormat('H:i:s', $clase->hora_inicio);
            $diferencia = $hora1->diffInMinutes($reporte->created_at);
            if ($diferencia >= 40) {
                return '
                <span class="inline-flex items-center bg-red-100 text-red-800 font-medium mr-2 ps-3 pe-4 py-1 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pe-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    Tardanza
                </span>';
            } else {
                return '<span class="inline-flex items-center bg-green-100 text-green-700 font-medium mr-2 ps-3 pe-4 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pe-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> Registrada
                        </span>';
            }
        } else {
            return false;
        }
    }
}
