<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmaController;

Route::get('/', fn () => redirect()->route('turmas.index'));
Route::resource('turmas', TurmaController::class);
