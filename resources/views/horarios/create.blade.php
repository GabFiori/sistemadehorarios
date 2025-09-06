@extends('layouts.app')
@section('title', 'Criar Novo Horário')
@section('content')
    <header class="page-header">
        <h1>Criar Novo Horário</h1>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo UniFil">
        </div>
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

    <form action="{{ route('horarios.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 2rem;">
            <label for="turma_id">Selecione a Turma:</label>
            <select name="turma_id" id="turma_id" required>
                <option value="">-- Selecione uma turma --</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                        {{ $turma->nome }}</option>
                @endforeach
            </select>
        </div>

        @include('horarios._form')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Salvar Novo Horário</button>
            <a href="{{ route('horarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
