@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width='100%'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <body>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td><a href="">Excluir</a></td>
                                <td><a href="">Editar</a></td>
                            </tr>
                        @endforeach
                    </body>
                </table>


                {{ $produtos->appends($request)->links() }}
                <!--
                <br>
                {{ $produtos->count() }} - Total de registros por página
                <br>
                {{ $produtos->total() }} - Total de registros por consulta
                <br>
                {{ $produtos->firstItem() }} - Número do primeiro registro por página
                <br>
                {{ $produtos->lastItem() }} - Número do último registro por página

                -->
                <br>
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})

            </div>
        </div>


    </div>

@endsection
