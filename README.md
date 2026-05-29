#  Diário de Aprendizado e Documentação - Laravel/HTML/PHP

Este arquivo serve como documentação de progresso, conceitos aprendidos e histórico de resoluções de problemas durante as aulas do curso.

---------------------------------------------------------------

# Módulo: Rotas de Produtos - Módulo de Vendas
*Este bloco gerencia e representa a exibição e os filtros de produtos do sistema.*

```php
// Retorna a página principal do projeto (View Welcome)
Route::get('/', function () {
    return view('welcome');
});

/**
 * Rota Dinâmica de Categoria
 * @param string $nome (Opcional) O nome da categoria. Padrão: 'geral'.
 */
Route::get('/categoria/{nome?}', function ($nome = 'geral') {
    return "Você está na categoria: " . $nome;
});

 --------------------------------------------------------------

# Agrupamento de Rotas com Prefixo
* Organizar rotas que compartilham o mesmo início de URL (prefixo) utilizando o método Route::group do Laravel para melhorar a legibilidade e manutenção. 

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

-----------------------------------------------------------------

Introdução aos Controllers

 O projeto passou por uma grande evolução arquitetural. Deixando de gerenciar respostas diretamente no arquivo de rotas e transferimos a responsabilidade para os Controllers, adotando o padrão MVC (Model-View-Controller).

 1. Criando o Controlador via terminal (Artisan):

 php artisan make:controller ProdutoController

 2. Construindo a Lógica do Controlador (app/Http/Controllers/ProdutoController.php):

 PHP
<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    // Método responsável por listar os produtos (Acessado via GET /produtos)
    public function index() {
        return "index";
    }
    
    // Método preparado para exibir um produto específico baseado no ID
    public function show($id) {
        return "show: " . $id;
    }
}

3. Vinculando a Rota ao Controlador (routes/web.php):

PHP
use App\Http\Controllers\ProdutoController;

Route::get('/produtos', [ProdutoController::class, 'index']);

----------------------------------------------------------------
Views com Blade e Passagem de Dados: 
* Uso prático do motor de renderização Blade, organização em subpastas, uso do método view(), função compact() e a diretiva @foreach.

1. O Controlador estruturado:

PHP
public function index() {
    $produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];
    return view('produtos.index', compact('produtos'));
}

2. A View Renderizando Dinamicamente (resources/views/produtos/index.blade.php):

HTML
<h1>Listagem de Produtos</h1>
<ul>
    @foreach ($produtos as $produto)
        <li>{{ $produto }}</li>
    @endforeach
</ul>

OBS -- > Erros solucionados no processo

InvalidArgumentException: View [nome] not found: Foi Solucionado ajustando a sintaxe para view('pasta.arquivo') apontando para o diretório correto.

ParseError / Syntax Error: Corrigido fechamentos incorretos de aspas, chaves e comentários dentro do controlador.

-----------------------------------------------------------------

Rotas Nomeadas e Parâmetros Dinâmicos:

* Implementação completa da listagem com links dinâmicos e criação de rotas nomeadas com passagem segura de parâmetros via ID para a página de detalhes.

1. Configuração de Rotas (routes/web.php):

PHP
use App\Http\Controllers\ProdutoController;

// Rota para a Listagem principal
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');

// Rota para exibir os detalhes do produto
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');

2. Atualização do Controlador com Tema Customizado (app/Http/Controllers/ProdutoController.php):

PHP
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProdutoController extends BaseController
{
    // Lista todos os produtos customizados (Tecnologias)
    public function index()
    {
        $produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];
        return view('produtos.index', compact('produtos'));
    }

    // Mostra o produto baseado no ID recebido da URL
    public function show($id)
    {
        $lista_produtos = ['Laravel', 'PHP', 'Python', 'JavaScript', 'Java', 'C', 'C#', 'Cobol', 'Rust', 'Go'];

        // Busca o item no array por índice. Se não existir, previne o erro com null
        $produto = $lista_produtos[$id] ?? null;

        return view('produtos.show', compact('produto'));
    }
}

3. Ajuste das Views (Blade): (resources/views/produtos/index.blade.php): listagem

HTML
<h1>Listagem de Produtos</h1>
<ul>
    @foreach ($produtos as $key => $produto)
        <li> 
            <a href="{{ route('produtos.show', ['id' => $key]) }}">
                Ver {{ $produto }}
            </a>
        </li>
    @endforeach
</ul>

Detalhes

HTML
<h1>Detalhes do Produto</h1>

@if($produto)
    <p>O produto selecionado foi: <strong>{{ $produto }}</strong></p>
@else
    <p>Produto não encontrado.</p>
@endif