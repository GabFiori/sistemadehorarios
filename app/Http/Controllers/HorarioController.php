<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Horario;
use App\Models\Professor;
use App\Models\Sala;
use App\Models\Uc;
use App\Models\CampoHorario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class HorarioController extends Controller
{
    public function index()
    {
        //dd('Cheguei no controller e no método index');
        $turmas = Turma::with('horarios.campoHorario', 'horarios.uc', 'horarios.professor', 'horarios.sala')
            ->orderBy('nome')
            ->get();

        $campoHorarios = CampoHorario::all();

        return view('horarios.index', compact('turmas', 'campoHorarios'));
    }


    public function show(Turma $turma)
    {
        $campoHorarios = CampoHorario::all();
        $horarioAtual = $turma->horarios()->with('uc', 'professor', 'sala')->get()->keyBy('campo_horario_id');

        return view('horarios.show', compact('turma', 'campoHorarios', 'horarioAtual'));
    }

    public function edit(Turma $turma)
    {
        $professores = Professor::orderBy('nome')->get();
        $salas = Sala::orderBy('nome')->get();
        $ucs = Uc::orderBy('nome')->get();
        $campoHorarios = CampoHorario::all();
        $horarioAtual = $turma->horarios->keyBy('campo_horario_id');

        return view('horarios.edit', compact('turma', 'professores', 'salas', 'ucs', 'campoHorarios', 'horarioAtual'));
    }

    public function update(Request $request, Turma $turma)
    {
        $alocacoes = $request->input('alocacoes', []);

        DB::beginTransaction();
        try {
            foreach ($alocacoes as $campoHorarioId => $dados) {
                if (empty($dados['uc_id']) || empty($dados['professor_id']) || empty($dados['sala_id'])) {
                    Horario::where('turma_id', $turma->id)->where('campo_horario_id', $campoHorarioId)->delete();
                    continue;
                }

                $conflito = Horario::where('campo_horario_id', $campoHorarioId)
                    ->where('turma_id', '!=', $turma->id)
                    ->where(function ($query) use ($dados) {
                        $query->where('professor_id', $dados['professor_id'])
                            ->orWhere('sala_id', $dados['sala_id']);
                    })->first();

                if ($conflito) {
                    DB::rollBack();
                    $slot = CampoHorario::find($campoHorarioId);
                    throw ValidationException::withMessages([
                        'conflito' => "Conflito em {$slot->dia_semana} na {$slot->posicao}ª aula. O Professor ou a Sala já está alocado(a) para a turma " . $conflito->turma->nome . "."
                    ]);
                }

                Horario::updateOrCreate(
                    ['turma_id' => $turma->id, 'campo_horario_id' => $campoHorarioId],
                    ['uc_id' => $dados['uc_id'], 'professor_id' => $dados['professor_id'], 'sala_id' => $dados['sala_id']]
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocorreu um erro inesperado ao salvar: ' . $e->getMessage());
        }

        return redirect()->route('horarios.index')->with('success', 'Horário da turma ' . $turma->nome . ' atualizado com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        Horario::where('turma_id', $turma->id)->delete();

        return redirect()->route('horarios.index')->with('success', 'Horário da turma ' . $turma->nome . ' foi limpo.');
    }
}
