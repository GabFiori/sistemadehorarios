<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'representante',
        'segunda_1', 'segunda_2',
        'terca_1', 'terca_2',
        'quarta_1', 'quarta_2',
        'quinta_1', 'quinta_2',
        'sexta_1', 'sexta_2',
    ];
}
