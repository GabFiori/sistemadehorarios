@extends('layouts.app')
@section('title', 'Editar Horário: ' . $turma->nome)
@section('content')
    <header class="page-header">
        <h1>Editar Horário: {{ $turma->nome }}</h1>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger"
            style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('horarios.update', $turma->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('horarios._form')

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    @endsection
