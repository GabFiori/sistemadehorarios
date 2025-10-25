<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;
    protected $table = 'professores';
    protected $fillable = [
        'nome',
        'matricula',
        'email',
        'dias_disponiveis'
    ];
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
