<h1>Detalhes da Tecnologia</h1>

@if($tecnologia)
    <p>Você selecionou: <strong>{{ $tecnologia['nome'] }}</strong></p>
    
    <p>💡 <strong>O que é?</strong></p>
    <p>{{ $tecnologia['descricao'] }}</p>
@else
    <p>Tecnologia não encontrada.</p>
@endif

<hr>
<a href="{{ route('produtos.index') }}"> Voltar para a listagem</a>