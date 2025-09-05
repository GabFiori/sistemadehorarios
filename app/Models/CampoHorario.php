<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampoHorario extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'dia_semana',
        'posicao',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
