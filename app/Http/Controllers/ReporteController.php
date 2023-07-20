<?php

namespace App\Http\Controllers;

use App\Tables\Reportes;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $this->authorize('user_access');
        return view('reporte.index', [
            'reporte' => Reportes::class,
        ]);
    }
}
