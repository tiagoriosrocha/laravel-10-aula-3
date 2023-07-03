<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Este é um Model Título
 * Eu vou armazenar as propriedades de um título em um
 * objeto da classe Título.
 */
class Titulo extends Model
{
    use HasFactory;

    //aqui eu listo todos os itens que eu "vou deixar" que sejam
    //"preenchidos" no meu Model.
    protected $fillable = ['id',
                           'tipo', 
                           'titulo', 
                           'pais',
                           'diretor',
                           'ano',
                           'duracao',
                           'resumo']; 
}
