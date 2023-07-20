<?php

namespace App\Models;

use App\Models\Ciclo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        "codigo",
        "ciclo_id",
        "nombre",
        "escuela",
        // "horas_t",
        // "horas_p",
        // "creditos",
    ];

    public function ciclo_id()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }
    public function nescuela()
    {
        $escuelas = [
            'MH' => 'Medicina Humana',
            'EN' => 'Enfermería',
        ];

        return $escuelas[$this->escuela] ?? '';
    }
}
