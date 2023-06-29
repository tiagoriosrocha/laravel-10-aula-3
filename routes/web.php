<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NetflixController;

Route::get('/', [NetflixController::class,'exibirTodosItens']);
Route::get('/buscapais/{pais}', [NetflixController::class,'exibirPorPais']);
Route::get('/buscaid/{id}', [NetflixController::class,'getPorId']);
Route::get('/buscadiretor/{diretor}', [NetflixController::class,'getPorDiretor']);
