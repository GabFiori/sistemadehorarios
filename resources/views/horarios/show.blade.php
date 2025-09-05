@extends('layouts.app')

@section('title', 'Horário da Turma: ' . $turma->nome)

@section('content')
<header class="page-header">
    <h1>Horário: <strong>{{ $turma->nome }}</strong></h1>
    <p><strong>Representante:</strong> {{ $turma->representante }}</p>
</header>

<div class="schedule-grid">
    @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
        <div class="schedule-slot">
            <h3>{{ ucfirst($dia) }}</h3>
            @foreach ($campoHorarios->where('dia_semana', $dia) as $slot)
                @php
                    $aula = $horarioAtual->get($slot->id);
                @endphp
                <div style="padding: 0.5rem 0;">
                    <p>
                        <strong>Aula {{ $slot->posicao }}:</strong><br>
                        {{ $aula->uc->nome ?? 'Vago' }} <br>
                        <em><small>Prof. {{ $aula->professor->nome ?? '---' }} | Sala: {{ $aula->sala->nome ?? '---' }}</small></em>
                    </p>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<div class="form-actions" style="margin-top: 2rem;">
    <a href="{{ route('horarios.edit', $turma) }}" class="btn btn-primary">Editar Horário</a>
    <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
