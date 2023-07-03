<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NetflixController; //faço o import da classe do tipo Controller

//Rota principal que lista todos os itens
Route::get('/', [NetflixController::class,'exibirTodosItens']);

//Rota em que eu recebo um parâmetro, que é o nome do campo que eu quero ordenar os itens, pode ser por título, por diretor, por ano. Vou usar isto nos links do menu superior
Route::get('/ordenar/{propriedade}', [NetflixController::class,'ordenarPorTipo']);

//Rota do tipo POST para receber os dados do campo de busca, após, procuro os títulos que fazem match com o campo de busca
Route::post('/buscaportitulo', [NetflixController::class,'buscaPorTitulo2']);

//Rota que recebo um id por parâmetro, que é o ID do título, vou utilizar para exibir os detalhes de um determinado item com id recebido
Route::get('/buscaid/{id}', [NetflixController::class,'getPorId']);

//Rota para receber no link o nome de um país e buscar os respectivos títulos
Route::get('/buscapais/{pais}', [NetflixController::class,'exibirPorPais']);

//rota para receber no link o nome do diretor e buscar os respectivos títulos
Route::get('/buscadiretor/{diretor}', [NetflixController::class,'getPorDiretor']);