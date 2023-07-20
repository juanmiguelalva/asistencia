<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "dia",
        "hora_inicio",
        "hora_fin",
        "curso_id",
    ];

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function curso_id()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function getNombrediaAttribute()
    {
        $numero_dia = $this->dia;
        $fecha_dia = Carbon::now();
        $fecha_dia->startOfWeek(Carbon::SUNDAY);
        $fecha_dia->addDays($numero_dia);
        return ucfirst($fecha_dia->locale('es')->dayName);
    }

    public function getDocenteAttribute()
    {
        return $this->user->lastname . ' ' . $this->user->name;
    }
}
