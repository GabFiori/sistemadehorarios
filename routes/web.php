<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HorarioController;

Route::get('/', fn() => redirect()->route('horarios.index'));

Route::get('horarios', [HorarioController::class, 'index'])->name('horarios.index');

Route::prefix('turmas/{turma}/horario')->name('horarios.')->group(function () {
    Route::get('/', [HorarioController::class, 'show'])->name('show');
    Route::get('/editar', [HorarioController::class, 'edit'])->name('edit');
    Route::put('/', [HorarioController::class, 'update'])->name('update');
    Route::delete('/', [HorarioController::class, 'destroy'])->name('destroy');
});
