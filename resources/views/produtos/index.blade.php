<h1>Lista de dicas para estudos</h1>

<ul>
    @foreach ($produtos as $key => $produto)
        <li>
            <a href="{{ route('produtos.show', ['id' => $key]) }}">
                Ver {{ $produto }}
            </a>
        </li>
    @endforeach
</ul>