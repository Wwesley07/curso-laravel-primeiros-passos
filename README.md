/**
* --------------------------------------------------------------------------
* Rotas de Produtos - Módulo de Vendas 
* --------------------------------------------------------------------------
* * Este bloco a seguir gerencia e representa a exibição e os filtros de produtos do sistema.
* Correspodente aos episódios 11 e 12 do curso(cursolaravel) no Youtube.
* */

// Ele retorna a página primcipal do projeto (View Welcome)
Route::get('/', function () {
    return view('welcome');
});

/**
* Rota Dinâmica de Categoria
* * @param string $nome (Opcional) O nome da categoria. Padrão: 'geral'.
* @return string Texto informativo na tela.
*/
Route::get('/categoria/{nome?}', function ($nome = 'geral') {
    return "Você está na categoria: " . $nome;
});

* -----------------------------------------------------------------------
* Episódio 13; Agrupamento de Rotas com Prefixo
* Neste episódio, aprendi a organizar rotas que compartilham o mesmo início de URL (prefixo) utilizando o método `Route::group` do Laravel.
* O que é e para que serve?

Route::group(['prefix' => 'dashboard'], function () {
// Acessado em: [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard)

    Route::get('/', function () {
        return "Painel Administrativo";
    });
// Acessado em: [http://127.0.0.1:8000/dashboard/usuarios](http://127.0.0.1:8000/dashboard/usuarios)
Route::get('/usuarios', function () {
    return "Listagem de Usuários";
   });
});

* --------------------------------------------------------------------------
* Episódios 14,15 e 16: Introdução aos Controllers (Controladores)
<<<<<<< HEAD
 O projeto passou por uma grande evolução arquitetural. Deixa - se de gerenciar as respostas direto pelo sistema e transferirmos para os *Controllers* e adotando o padrão para **MVC Model-View-Controller).
=======
Neste módulo, o projeto passou por uma grande evolução arquitetural. Deixa - se de gerenciar as respostas direto pelo sistema e transferirmos para os *Controllers* e adotando o padrão para **MVC Model-View-Controller).
>>>>>>> 39826849e0c530383c6fbf83b0d601d5913f0d31
* ------------------------------------------------------------------------
* 1 - Criando o Controlador via terminal (Artisan)
* Para cirar a estrutura base de forma automática, é utiliziado: php artisan make:controller ProdutoController
* 2 - Construindo a Lógica do Controlador (App/Http/Controllers/ProdutoController.php)
PHP

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Importação essencial para a estrutura de controle funcionar nativamente;
use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    // Método responsável por listar os produtos(Acessador via GET /produtos)
     public function index() {
        return "index";
     }
     // Método preparado para exibir um produto específico baseado no ID
     public function show($id) {
        return "show: " . $id;
      }
}

* 3 - Vinculando a Rota ao Controlador(Routes/web.php)
PHP 

<?php

use Illuminate/Support/Facades/Route;
// Importação onrigatória do controlador criado:
use App\Http\Controllers\ProdutoController;
// Sintaxe em array: [ClasseDoController, 'NomeDoMetodo']
Route::get('/produtos', [ProdutoController::class, 'index]);

URL: http://127.0.0.1:8000/produtos

* -------------------------------------------------------------------------------
* Episódio 17 ao 20: Views com Blade e Passagens de Dados;
Estrutura de Pastas de Telas;
O Método View;
A função Compact
@foreach
* 1. O controlador('app/Http/Controller.php')
PHP

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    public function index() {
        // Criando uma lista dinâmica de dados
        $produtos = ['Carro, 'Casa', 'Notebook'];

        // Renderiza a view e passa o array de produto atráves de compact
        return view('produtos.index', compact('produtos'));
    }
}
* 2. A View Renderizando Dinamicamente(resources/views/produtos;index.blade.php)
HTML

<h1>Listagem de Produtos</h1>

<ul>
   @foreach ($produtos as $produto)
      <li>{{ $produto }}</li>
    @endforeach
    </ul>

OBS: Erros que houveram no processo.

* InvalidArgumentException: View [nome] not found: Foi solucionado e caminhando no return view('pasta.arquivo') com a localização real dos arquivos na árvore de diretórios do projeto.

* ParseError / Syntax Error: Corrigido e trazendo o fechamento correto das tags de comentários e chaves de classes do PHP dentro do arquivo do controlador.
* ----------------------------------------------------------------
* Episódio 23: Foi feito a implementação dinâmica de produtos e foi criado uma navegação segura para a página de detalhes de cada item, utilizando parâmetros de URL, controladores e rotas nomeadas no Laravel.
* 1. Rotas(Routes/web.php)
PHP

use App/Http/Controllers/ProdutoController;
use Illuminate\Support\Facades\Route;
 
// Rota para a Listagem principal
Route::get('/produtos', [ProdutoController::class, 'index])->name('produtos.show');

* 2. Controlador(app/Http/Controller/ProdutoController.php)
PHP

namespace App\Http\Controllers;
 
use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController;
{
    // Lista todos os produtos
    public function index()
    {
        $produtos = ['Carro', 'Casa', 'Notebook'];
        return view('produtos.index', compact('produtos'));
    }
    // Mostra o produto específico com base no ID recebido pela URL
    public function show($id)
    {
        $lista_produtos = ['Carro', 'Casa', 'Notebook'];

        // Busca o item no array. Se não existir, retorna null
        $produto = $lista_produtos[$id] ?? null;

        return view('produtos.show', compact('produto'));
    }
}

* 3. Views(resources/views/produtos/index.blade.php)
HTML
<h1>Listagem de Produtos</h1>

@foreach ($produtos as $key => $produtos)
   <li> 
   <a href="{{ route('produtos.show', ['id' => $key]) }}">
     Ver {{ $produtos }}
  </a>
  </li>
  @endforeach
</ul>
  
* OBS: Detalhes(resources/views/produtos/show.blade.php)
HTML

<h1>Detalhes do Produto</h1>
@if($produto)
 <p>O produto selecionado foi: <strong>{{ $produto }}</strong></p>
@else
  <p>Produto não encontrado.</p>
  @endif