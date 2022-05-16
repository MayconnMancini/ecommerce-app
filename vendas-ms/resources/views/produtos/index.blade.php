@extends('layouts.main')

@section('title', 'Produtos')

@section('content')

    <div class="container">
        <div class="py-5 text-center">
            <h2>Produtos</h2>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <a href="{{ route('produtos.create') }}" class="btn btn-primary active" role="button"
                    aria-pressed="true">Novo Produto</a>
            </div>
        </div>

        @if (session('msg_success'))
            <div class="alert alert-success" role="alert">
                {{ session('msg_success') }}
            </div>
        @endif

        @if (session('msg_error'))
            <div class="alert alert-danger" role="alert">
                {{ session('msg_error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preco</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($produtos as $p)
                            <tr>
                                <th scope="row">{{ $p->id }}</th>
                                <td scope="row">{{ $p->nome }}</td>
                                <td scope="row">{{ $p->descricao }}</td>
                                <td scope="row">{{ $p->preco }}</td>
                                <td scope="row">{{ $p->estoque }}</td>
                                <td>
                                    <form action="{{ route('produtos.destroy', $p->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Apagar
                                        </button>
                                        <a class="btn btn-primary btn-sm active"
                                            href="{{ route('produtos.show', $p->id) }}">
                                            Detalhes
                                        </a>
                                        <a class="btn btn-secondary btn-sm active"
                                            href="{{ route('produtos.edit', $p->id) }}">
                                            Editar
                                        </a>
                                    </form>
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
        </div>
    </div>


@endsection
