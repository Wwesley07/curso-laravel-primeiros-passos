<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    public function index() {
       $produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];
       return view('produtos.index', compact('produtos'));
    }
    public function show($id) {
        $produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];
        $produto = $produtos[$id] ?? null;
        return view('produtos.show', compact('produto'));
    }
}    
