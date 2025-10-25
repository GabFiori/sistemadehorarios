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
        $turmas = Turma::whereHas('horarios')
            ->with('horarios.campoHorario', 'horarios.uc', 'horarios.professor', 'horarios.sala')
            ->orderBy('nome')
            ->get();
        $campoHorarios = CampoHorario::all();
        return view('horarios.index', compact('turmas', 'campoHorarios'));
    }

    public function create()
    {
        $turmas = Turma::doesntHave('horarios')->orderBy('nome')->get();

        $professoresPorDia = $this->getProfessoresAgrupadosPorDia();

        $salas = Sala::orderBy('nome')->get();
        $ucs = Uc::orderBy('nome')->get();
        $campoHorarios = CampoHorario::all();
        $horarioAtual = collect();

        return view('horarios.create', compact('turmas', 'professoresPorDia', 'salas', 'ucs', 'campoHorarios', 'horarioAtual'));
    }

    public function store(Request $request)
    {
        $request->validate(['turma_id' => 'required|exists:turmas,id']);
        $turma = Turma::find($request->input('turma_id'));
        $alocacoes = $request->input('alocacoes', []);

        if ($turma->horarios()->exists()) {
            throw ValidationException::withMessages([
                'turma_id' => 'Esta turma já possui um horário cadastrado. Para alterá-lo, por favor, use a opção "Editar" na tela do horário desta turma'
            ]);
        }

        $alocacoes = $request->input('alocacoes', []);

        DB::beginTransaction();
        try {
            foreach ($alocacoes as $campoHorarioId => $dados) {
                $this->processarSlotDeHorario($turma, $campoHorarioId, $dados, false);
            }
            DB::commit();
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocorreu um erro inesperado ao salvar: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('horarios.index')->with('success', 'Horário da turma ' . $turma->nome . ' criado com sucesso!');
    }

    public function show(Turma $turma)
    {
        $campoHorarios = CampoHorario::all();
        $horarioAtual = $turma->horarios()->with('uc', 'professor', 'sala')->get()->keyBy('campo_horario_id');
        return view('horarios.show', compact('turma', 'campoHorarios', 'horarioAtual'));
    }

    public function edit(Turma $turma)
    {
        $professoresPorDia = $this->getProfessoresAgrupadosPorDia();

        $salas = Sala::orderBy('nome')->get();
        $ucs = Uc::orderBy('nome')->get();
        $campoHorarios = CampoHorario::all();
        $horarioAtual = $turma->horarios->keyBy('campo_horario_id');

        return view('horarios.edit', compact('turma', 'professoresPorDia', 'salas', 'ucs', 'campoHorarios', 'horarioAtual'));
    }

    public function update(Request $request, Turma $turma)
    {
        $alocacoes = $request->input('alocacoes', []);

        DB::beginTransaction();
        try {
            foreach ($alocacoes as $campoHorarioId => $dados) {
                $this->processarSlotDeHorario($turma, $campoHorarioId, $dados, true);
            }
            DB::commit();
        } catch (ValidationException $e) {
            throw $e;
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

    private function processarSlotDeHorario(Turma $turma, int $campoHorarioId, array $dados, bool $isUpdate): void
    {
        //verificando se o slot de horário está vago
        $isVago = empty($dados['uc_id']) || empty($dados['professor_id']) || empty($dados['sala_id']);

        if ($isVago) {
            if ($isUpdate) {
                Horario::where('turma_id', $turma->id)->where('campo_horario_id', $campoHorarioId)->delete();
            }
            return;
        }
        //se está vago, verifica se está em função de edição, se sim, ele apaga a aula do database, visto que
        //o usuário apagou os dados de um slot que talvez antes estivesse preenchido

        $this->verificarConflito($turma, $campoHorarioId, $dados, $isUpdate);

        if ($isUpdate) {
            Horario::updateOrCreate(
                ['turma_id' => $turma->id, 'campo_horario_id' => $campoHorarioId],
                ['uc_id' => $dados['uc_id'], 'professor_id' => $dados['professor_id'], 'sala_id' => $dados['sala_id']]
            );
        } else {
            Horario::create([
                'turma_id' => $turma->id,
                'campo_horario_id' => $campoHorarioId,
                'uc_id' => $dados['uc_id'],
                'professor_id' => $dados['professor_id'],
                'sala_id' => $dados['sala_id']
            ]);
        }
    }

    private function verificarConflito(Turma $turma, int $campoHorarioId, array $dados, bool $isUpdate): void
    {
        $query = Horario::where('campo_horario_id', $campoHorarioId);
        if ($isUpdate) {
            $query->where('turma_id', '!=', $turma->id);
        }

        $conflito = $query->where(function ($q) use ($dados) {
            $q->where('professor_id', $dados['professor_id'])
                ->orWhere('sala_id', $dados['sala_id']);
        })->first();

        if ($conflito) {
            $slot = CampoHorario::find($campoHorarioId);
            throw ValidationException::withMessages([
                'conflito' => "Conflito em {$slot->dia_semana} na {$slot->posicao}ª aula. O Professor ou a Sala já está alocado(a) para a turma " . $conflito->turma->nome . "."
            ]);
        }
    }

    private function getProfessoresAgrupadosPorDia(): array
    {
        $todosProfessores = Professor::orderBy('nome')->get(['id', 'nome', 'dias_disponiveis']);
        $professoresPorDia = [];
        $diasDaSemana = ['segunda', 'terça', 'quarta', 'quinta', 'sexta'];

        foreach ($todosProfessores as $professor) {
            $diasDisponiveis = !empty($professor->dias_disponiveis) ? explode(',', $professor->dias_disponiveis) : $diasDaSemana;

            foreach ($diasDisponiveis as $dia) {
                $diaLimpo = trim(strtolower($dia));
                if (in_array($diaLimpo, $diasDaSemana)) {
                    $professoresPorDia[$diaLimpo][] = $professor;
                }
            }
        }
        return $professoresPorDia;
    }
}
