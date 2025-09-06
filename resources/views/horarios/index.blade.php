@extends('layouts.app')

@section('title', 'Sistema de Horários')

@section('content')
    <header class="page-header">
        <h1>Sistema de Horários</h1>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UniFil">
        </div>
    </header>

    <div class="main-container">
        @if (session('success'))
            <div class="alert alert-success"
                style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="turmas-grid-container">
            @forelse ($turmas as $turma)
                <a href="{{ route('horarios.show', $turma) }}" class="turma-card">
                    <h3>{{ $turma->nome }}</h3>
                    <div class="horario-visual-grid">
                        @php
                            $horarioOrganizado = $turma->horarios->keyBy('campo_horario_id');
                        @endphp

                        @foreach ($campoHorarios as $slot)
                            @php
                                $aula = $horarioOrganizado->get($slot->id);
                            @endphp
                            <div class="horario-visual-slot {{ $aula ? 'preenchido' : '' }}">
                                {{ $aula->uc->nome ?? '' }}
                            </div>
                        @endforeach
                    </div>
                </a>
            @empty
                <div class="alert alert-warning" style="grid-column: 1 / -1;">
                    <p>Nenhum horário cadastrado no sistema.</p>
                </div>
            @endforelse
        </div>

        <div class="page-actions">
            <a href="{{ route('horarios.create') }}" class="btn btn-primary">Adicionar</a>
        </div>
    </div>
@endsection
