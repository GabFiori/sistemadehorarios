@extends('layouts.app')

@section('title', 'Visão Geral dos Horários')

@section('content')
<header class="page-header">
    <h1>Visão Geral dos Horários</h1>
</header>

@if (session('success'))
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<div class="turmas-container" style="padding: 1rem;">
    <table>
        <thead>
            <tr>
                <th>Nome da Turma</th>
                <th>Representante</th>
                <th>Horário Resumido</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($turmas as $turma)
            <tr>
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->representante }}</td>
                <td>
                    <div class="schedule-grid table-grid">
                        @php
                            $horarioOrganizado = $turma->horarios->keyBy('campo_horario_id');
                        @endphp

                        @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
                            <div class="schedule-slot table-slot">
                                <strong>{{ ucfirst($dia) }}</strong>
                                @foreach ($campoHorarios->where('dia_semana', $dia) as $slot)
                                    @php
                                        $aula = $horarioOrganizado->get($slot->id);
                                    @endphp
                                    <div>
                                        <small>{{ $aula->uc->nome ?? '---' }}</small>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </td>
                <td>
                    <a href="{{ route('horarios.show', $turma) }}" class="btn btn-secondary">Ver</a>
                    <a href="{{ route('horarios.edit', $turma) }}" class="btn btn-secondary">Editar</a>

                    <form action="{{ route('horarios.destroy', $turma) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja limpar todo o horário desta turma?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Limpar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <p>Nenhuma turma encontrada. Rode o comando <code>php artisan migrate:fresh --seed</code> para popular o banco de dados.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
