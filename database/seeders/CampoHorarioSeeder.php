<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampoHorario;

class CampoHorarioSeeder extends Seeder
{
    public function run(): void
    {
        $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];
        foreach ($dias as $dia) {
            CampoHorario::create(['dia_semana' => $dia, 'posicao' => 1]);
            CampoHorario::create(['dia_semana' => $dia, 'posicao' => 2]);
        }
    }
}
