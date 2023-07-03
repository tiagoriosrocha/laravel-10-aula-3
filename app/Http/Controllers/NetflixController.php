<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel; //faço import na classe que vai me auxiliar a carregar dados de uma planilha. Projeto disponível em: https://github.com/rap2hpoutre/fast-excel
use App\Models\Titulo; //faço import de uma classe MODEL que irá armazenar as propriedades de um título.

class NetflixController extends Controller
{
    /**
     * Método carregarDados()
     * Este método simplesmente irá retornar um collection com todos os objetos títulos dentro
     * Ou seja, se na planilha tiver 1000 títulos, ele irá criar 1000 objetos da classe (Model) Título
     * com os seguintes campos: id, tipo, titulo, diretor, ano, duracao, resumo, pais.
     * 
     * Nota 1: A primeira linha da planilha deve conter os nomes dos campos, e devem ser os seguintes:
     * id, type, title, director, release_year, duration, description, country.
     * 
     * Nota 2: A planilha não pode conter campos vazios.
     */
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

    /**
     * Método exibirTodosItens
     * este método carrega os dados (chama o método carregarDados), 
     * após, ordena os elementos pelo título e envia para uma view que
     * irá exibir todos os itens
     */
    public function exibirTodosItens(){
        $collection = $this->carregarDados();
        $collection = $collection->sortBy("titulo"); //ordenando os elementos
        return view('exibirTitulos',["titulos" => $collection]);
    }

    /**
     * Método ordenarPorTipo
     * este método recebe um parâmetro que é o nome do campo que o
     * usuário deseja ordenar os títulos.
     * Vou usar este método quando o usuário clicar nos links do menu
     * principal, para ordenar os itens pelo título, pelo nome do diretor
     * ou pelo ano de release.
     */
    public function ordenarPorTipo($tipo){
        $collection = $this->carregarDados();
        $collection = $collection->sortBy($tipo);
        return view('exibirTitulos',["titulos" => $collection]);
    }

    /**
     * Método buscaPorTitulo1
     * Este método carrega todos os títulos e faz um filtro
     * dos itens utilizando o método where da classe collection
     * o objetivos é filtrar os itens pelo título.
     * Após filtrar, ele ordena os elementos pelo título e envia 
     * os elementos para uma view.
     * 
     * Nota 1: Este método não é muito bom, porque é necessário 
     * receber o nome completo do título na busca para então filtrar.
     * Por exemplo: se você colocar a palavra "love" no campo de busca,
     * não irá retornar nada porque não tem nenhum título que o nome inteiro
     * seja love.
     */
    public function buscaPorTitulo1(Request $request){
        $campoBusca = $request->input('busca');
        $collection = $this->carregarDados();
        $colecaoFiltrada = $collection->where("titulo",$campoBusca);
        $colecaoFiltrada = $colecaoFiltrada->sortBy("titulo");
        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }

    /**
     * Método buscaPorTitulo2
     * Este método é semelhante ao método anterior, a principal
     * diferença é que ele consegue filtrar por palavras ou caracteres
     * contidos no título.
     * Por exemplo, você pode buscar pela palavra "love", ele irá retornar 
     * todos os títulos que contenham esta palavra.
     */
    public function buscaPorTitulo2(Request $request){
        $campoBusca = $request->input('busca');
        $collection = $this->carregarDados();

        //utilizao o método filter da classe collection e utilizo o método stristr para fazer a comparação de strings
        $colecaoFiltrada = $collection->filter(function ($umTitulo) use ($campoBusca) {
            return false !== stristr($umTitulo->titulo, $campoBusca);
        });

        $colecaoFiltrada = $colecaoFiltrada->sortBy("titulo");
        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }

    /**
     * Método getPorId
     * este método recebe por parâmetro um id do título. Após,
     * carrega os dados e utilizando o método where da classe
     * collection, pega o primeiro item que tenha o id consultado
     */
    public function getPorId($id){
        $collection = $this->carregarDados();
        $umTitulo = $collection->where("id",$id)->first();
        return view('exibirUmTitulo',["umTitulo" => $umTitulo]);
    }
    
    /**
     * Método exibirPorPais
     * Este método ira receber por parâmetro o nome de um país que deseja buscar,
     * Após o carregamento dos dados, será executado o método filter da classe collection
     * 
     * Nota 1: No campo country da planilha, por vezes, ele armazena o nome de mais de um país,
     * por exemplo, se um item foi gravado no Brasil e nos Estados Unidos, o campo irá conter Brazil, United States. 
     * Esta forma de filtragem, ele consegue procurar pelo nome do país pesquisado dentro de todo este campo.
     */
    public function exibirPorPais($nomePais){
        $collection = $this->carregarDados();
        
        $colecaoFiltrada = $collection->filter(function ($umItem) use ($nomePais) {
            return false !== stristr($umItem->pais, $nomePais);
        });

        $collection = $collection->sortBy("titulo");

        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }  

    /**
     * Método getPorDiretor
     * Método recebe por parâmetro o nome de um diretor.
     * Método semelhante ao anterior
     */
    public function getPorDiretor($diretor){
        $collection = $this->carregarDados();

        $colecaoFiltrada = $collection->filter(function ($umItem) use ($diretor) {
            return false !== stristr($umItem->diretor, $diretor);
        });

        $collection = $collection->sortBy("titulo");

        return view('exibirTitulos',["titulos" => $colecaoFiltrada]);
    }
}
