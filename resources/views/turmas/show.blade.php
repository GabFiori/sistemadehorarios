@extends('layouts.app')

@section('title', 'Detalhes da Turma')

@section('content')
<h1>Detalhes da Turma</h1>

<p><strong>Nome:</strong> {{ $turma->nome }}</p>
<p><strong>Representante:</strong> {{ $turma->representante }}</p>

@foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia)
    <p><strong>{{ ucfirst($dia) }}:</strong> {{ $turma[$dia . '_1'] }} e {{ $turma[$dia . '_2'] }}</p>
@endforeach

<a href="{{ route('turmas.index') }}" class="btn btn-secondary" style="display:inline-block; margin-top: 1rem;">Voltar</a>
@endsection
