<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    public function index() {
       $produtos = ['Carro', 'Casa', 'Notebook'];
       return view('produtos.index', compact('produtos'));
    }
}    
