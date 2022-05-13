@extends('layouts.main')

@section('title', 'Novo produto')

@section('content')
    <div class="container">

        <div class="mt-3 mb-3">
            <a class="btn btn-primary" href="/">Voltar</a>
        </div>

        <div id="produtos-create-container" class="col-md-6">
            <h1>Cadastrar produto</h1>

            <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto" value="{{ $produto->nome }}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao"
                        placeholder="Descrição do produto" value="{{ $produto->descricao }}">
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço do produto" value="{{ $produto->preco }}">
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque"
                        placeholder="Estoque do produto" value="{{ $produto->estoque }}">
                </div>
                <input type="submit" value="Salvar" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
