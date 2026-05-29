<h1>Detalhes do Produto</h1>
@if($produto)
<p>O produto selecionado foi : <strong>{{ $produto }}</strong></p>
@else
 <p>Produto não encontrado.</p>
@endif
<hr>
<a href="{{ route('produtos.index') }}"> Voltar para a listagem</a>