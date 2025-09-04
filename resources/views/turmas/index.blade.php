@extends('layouts.app')

@section('title', 'Lista de Turmas')

@section('content')
<header class="page-header">
    <h1>Lista de Turmas</h1>
</header>

<div class="turmas-container" style="padding: 1rem;">
    <a href="{{ route('turmas.create') }}" class="btn btn-primary">Criar Nova Turma</a>

    <table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Representante</th>
            <th>Aulas</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($turmas as $turma)
        <tr>
            <td>{{ $turma->nome }}</td>
            <td>{{ $turma->representante }}</td>
            <td>
                <div class="schedule-grid table-grid">
                    @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
                        <div class="schedule-slot table-slot">
                            <strong>{{ ucfirst($dia) }}</strong>
                            <div>{{ $turma->{$dia . '_1'} }}</div>
                            <div>{{ $turma->{$dia . '_2'} }}</div>
                        </div>
                    @endforeach
                </div>
            </td>
            <td>
                <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-secondary">Editar</a>
                <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
