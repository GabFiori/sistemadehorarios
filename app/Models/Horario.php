<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'turma_id',
        'campo_horario_id',
        'uc_id',
        'professor_id',
        'sala_id',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function campoHorario()
    {
        return $this->belongsTo(CampoHorario::class);
    }

    public function uc()
    {
        return $this->belongsTo(Uc::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
