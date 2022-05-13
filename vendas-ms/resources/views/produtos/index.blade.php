@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

    <div class="container">

        <h1>View Produtos</h1>

        <a class="btn btn-primary" href="/">Voltar</a>
        <a class="btn btn-success" href="produtos/create">Cadastrar produto</a>

        <h1>Listagem de produtos</h1>
        <hr>

        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>descricao</th>
                    <th>preço</th>
                    <th>estoque</th>
                    <th>ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->estoque }}</td>
                        <td>
                          <a class="btn btn-info" href="{{ route('produtos.show',$produto->id) }}">Show</a>    
                          <a class="btn btn-primary" href="{{ route('produtos.edit',$produto->id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Nenhum registro encontrado para listar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
