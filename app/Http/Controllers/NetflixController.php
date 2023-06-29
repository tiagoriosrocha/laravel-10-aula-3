<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Titulo;

class NetflixController extends Controller
{
    private function carregarDados(){
        return (new FastExcel)->import('netflix_titles-2020.xlsx', function($umItem){
            return new Titulo([
                'id'        => $umItem['id'],
                'tipo'      => $umItem['type'],
                'titulo'    => $umItem['title'],
                'diretor'   => $umItem['director'],
                'ano'       => $umItem['release_year'],
                'duracao'   => $umItem['duration'],
                'resumo'    => $umItem['description'],
                'pais'      => $umItem['country'],
            ]);  
        });
    }

    public function exibirTodosItens(){
        $collection = $this->carregarDados();
        $collection = $collection->sortBy("titulo"); //ordenando os elementos
        return view('exibirTitulos',["titulos" => $collection]);
    }

    public function exibirPorPais($nomePais){
        $collection = $this->carregarDados();
        
        $colecaoFiltrada = $collection->filter(function ($umItem) use ($nomePais) {
            return false !== stristr($umItem->pais, $nomePais);
        });
        $collection = $collection->sortBy("titulo");

        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }

    public function getPorId($id){
        $collection = $this->carregarDados();
        $umTitulo = $collection->where("id",$id)->first();
        return view('exibirUmTitulo',["umTitulo" => $umTitulo]);
    }

    public function getPorDiretor($diretor){
        $collection = $this->carregarDados();
        $colecaoFiltrada = $collection->where("diretor",$diretor);
        $colecaoFiltrada = $colecaoFiltrada->sortBy("titulo");
        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }

}
