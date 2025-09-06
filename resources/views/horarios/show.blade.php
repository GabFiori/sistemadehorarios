@extends('layouts.app')

@section('title', 'Horário da Turma: ' . $turma->nome)

@section('content')
    <header class="page-header">
        <div class="header-content" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <h1>Horário: <strong>{{ $turma->nome }}</strong></h1>
            <span style="font-weight: normal;"><strong>Representante:</strong> {{ $turma->representante }}</span>
        </div>
    </header>

    <div class="main-container" style="padding: 2rem;">
        <div class="schedule-grid">
            @foreach (['segunda', 'terça', 'quarta', 'quinta', 'sexta'] as $dia)
                <div class="schedule-slot">
                    <h3>{{ ucfirst($dia) }}</h3>
                    @foreach ($campoHorarios->where('dia_semana', $dia) as $slot)
                        @php
                            $aula = $horarioAtual->get($slot->id);
                        @endphp
                        <div style="padding: 0.5rem 0; min-height: 80px;">
                            <p style="margin: 0;">
                                <strong>Aula {{ $slot->posicao }}:</strong><br>
                                {{ $aula->uc->nome ?? 'Vago' }} <br>
                                <em><small>Prof. {{ $aula->professor->nome ?? '---' }} | Sala:
                                        {{ $aula->sala->nome ?? '---' }}</small></em>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="page-footer-actions">
            <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Voltar para Visão Geral</a>

            <div class="actions-group">
                <a href="{{ route('horarios.edit', $turma) }}" class="btn btn-primary">Editar Horário</a>
                <form action="{{ route('horarios.destroy', $turma) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja limpar todo o horário desta turma?');"
                    class="inline-form"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Limpar Horário</button>
                </form>
            </div>
        </div>
    </div>
@endsection
