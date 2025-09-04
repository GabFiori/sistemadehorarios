@extends('layouts.app')

@section('title', 'Criar Nova Turma')

@section('content')
<header class="page-header">
    <h1>Criar Nova Turma</h1>
</header>

<form action="{{ route('turmas.store') }}" method="POST">
    @csrf

    <label for="nome">Nome da Turma:</label>
    <input type="text" name="nome" id="nome" value="{{ old('nome') }}">

    <label for="representante">Representante:</label>
    <input type="text" name="representante" id="representante" value="{{ old('representante') }}">

    <div class="schedule-grid">
    @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
        <div class="schedule-slot">
            <label>{{ ucfirst($dia) }} - Aula 1:</label>
            <input type="text" name="{{ $dia }}_1">

            <label>{{ ucfirst($dia) }} - Aula 2:</label>
            <input type="text" name="{{ $dia }}_2">
        </div>
    @endforeach
</div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</form>
@endsection
