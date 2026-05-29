<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    public function index() {
        $produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];
        return view('produtos.index', compact('produtos'));
    }

    public function show($id) {
        $tecnologias = [
            0 => ['nome' => 'Laravel', 'descricao' => 'O framework PHP mais popular do mundo, excelente para criar sistemas web modernos.'],
            1 => ['nome' => 'PHP', 'descricao' => 'A linguagem que roda nos bastidores de grande parte dos sites da internet.'],
            2 => ['nome' => 'Python', 'descricao' => 'Muito utilizada para Inteligência Artificial, Ciência de Dados e scripts de automação.'],
            3 => ['nome' => 'JavaScript', 'descricao' => 'A linguagem responsável por dar vida, animações e interatividade às páginas web.'],
            4 => ['nome' => 'Java', 'descricao' => 'Uma tecnologia corporativa robusta, muito usada em grandes bancos e aplicações Android.'],
            5 => ['nome' => 'C', 'descricao' => 'Uma das linguagens mais rápidas e tradicionais, ideal para sistemas operacionais e hardware.'],
            6 => ['nome' => 'C#', 'descricao' => 'Linguagem poderosa da Microsoft, muito forte no mercado corporativo e na criação de jogos.'],
            7 => ['nome' => 'Cobol', 'descricao' => 'Uma linguagem clássica criada nos anos 60, ainda indispensável para sistemas bancários antigos.'],
            8 => ['nome' => 'Rust', 'descricao' => 'Uma linguagem moderna com foco total em alta performance e segurança extrema de memória.'],
            9 => ['nome' => 'Go', 'descricao' => 'Desenvolvida pelo Google, criada para ser simples, rápida e excelente para serviços em nuvem.']
        ];

        $tecnologia = $tecnologias[$id] ?? null;

        return view('produtos.show', compact('tecnologia'));
    }
}