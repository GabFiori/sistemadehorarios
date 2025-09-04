@extends('layouts.app')

@section('title', 'Editar Turma')

@section('content')
<h1>Editar Turma</h1>

<form action="{{ route('turmas.update', $turma->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nome da Turma:</label>
    <input type="text" name="nome" value="{{ $turma->nome }}">

    <label>Representante:</label>
    <input type="text" name="representante" value="{{ $turma->representante }}">

    @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
        <label>{{ ucfirst($dia) }} - Aula 1:</label>
        <input type="text" name="{{ $dia }}_1" value="{{ $turma[$dia . '_1'] }}">

        <label>{{ ucfirst($dia) }} - Aula 2:</label>
        <input type="text" name="{{ $dia }}_2" value="{{ $turma[$dia . '_2'] }}">
    @endforeach

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
</form>

<a href="{{ route('turmas.index') }}" class="btn btn-secondary" style="display:inline-block; margin-top: 1rem;">Voltar</a>
@endsection
