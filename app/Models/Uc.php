<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uc extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'grupo',
        'codigo'
    ];
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
