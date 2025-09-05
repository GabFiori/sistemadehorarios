<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'campus',
        'capacidade'
    ];
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
