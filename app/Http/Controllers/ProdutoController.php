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
    public function show($id) {
        $produtos = ['Carro', 'Casa', 'Notebook'];
        $produto = $produtos[$id] ?? null;
        return view('produtos.show', compact('produto'));
    }
}    
