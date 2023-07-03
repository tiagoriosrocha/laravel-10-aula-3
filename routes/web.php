<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NetflixController;

Route::get('/',                         [NetflixController::class,'exibirTodosItens']);
Route::get('/ordenar/{propriedade}',    [NetflixController::class,'ordenarPorTipo']);
Route::post('/buscaportitulo',          [NetflixController::class,'buscaPorTitulo2']);
Route::get('/buscaid/{id}',             [NetflixController::class,'getPorId']);
Route::get('/buscapais/{pais}',         [NetflixController::class,'exibirPorPais']);
Route::get('/buscadiretor/{diretor}',   [NetflixController::class,'getPorDiretor']);