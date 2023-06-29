<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    use HasFactory;
    protected $fillable = ['id','tipo', 'titulo', 'pais','diretor','ano','duracao','resumo']; 
}
