@extends('layouts.app')

@section('title', 'Editar Horário da Turma: ' . $turma->nome)

@section('content')
<header class="page-header">
    <h1>Editar Horário: {{ $turma->nome }}</h1>
</header>

@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ $errors->first() }}
    </div>
@endif

<form action="{{ route('horarios.update', $turma->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="schedule-grid">
        @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
            <div class="schedule-slot">
                <h3>{{ ucfirst($dia) }}</h3>

                @foreach ($campoHorarios->where('dia_semana', $dia) as $slot)
                    <div style="margin-bottom: 1rem;">
                        <label>{{ ucfirst($dia) }} - Aula {{ $slot->posicao }}:</label>

                        @php
                            $horario_selecionado = $horarioAtual->get($slot->id);
                        @endphp

                        <select name="alocacoes[{{ $slot->id }}][uc_id]" required>
                            <option value="">-- UC --</option>
                            @foreach ($ucs as $uc)
                                <option value="{{ $uc->id }}" {{ ($horario_selecionado && $horario_selecionado->uc_id == $uc->id) ? 'selected' : '' }}>
                                    {{ $uc->nome }}
                                </option>
                            @endforeach
                        </select>

                        <select name="alocacoes[{{ $slot->id }}][professor_id]" required>
                            <option value="">-- Professor --</option>
                            @foreach ($professores as $professor)
                                <option value="{{ $professor->id }}" {{ ($horario_selecionado && $horario_selecionado->professor_id == $professor->id) ? 'selected' : '' }}>
                                    {{ $professor->nome }}
                                </option>
                            @endforeach
                        </select>

                        <select name="alocacoes[{{ $slot->id }}][sala_id]" required>
                            <option value="">-- Sala --</option>
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}" {{ ($horario_selecionado && $horario_selecionado->sala_id == $sala->id) ? 'selected' : '' }}>
                                    {{ $sala->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar Horário</button>
        <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</form>
@endsection
