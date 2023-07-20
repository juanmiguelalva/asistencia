<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "curso_id",
        "created_at",
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
    public function getDocenteAttribute()
    {
        return $this->user->lastname . ' ' . $this->user->name;
    }

    public function getFechaAttribute()
    {
        $carbonDate = Carbon::parse($this->created_at);
        return $carbonDate->toDateString();;
    }
    public function getHoraAttribute()
    {
        $carbonDate = Carbon::parse($this->created_at);
        return $carbonDate->format('H:i:s');
    }
}
