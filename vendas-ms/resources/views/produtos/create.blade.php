@extends('layouts.main')

@section('title', 'Novo produto')

@section('content')
    <div class="container">

        <div class="mt-3 mb-3">
            <a class="btn btn-primary" href="/">Voltar</a>
        </div>

        <div id="produtos-create-container" class="col-md-6">
            <h1>Cadastrar produto</h1>

            <form action="/produtos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao"
                        placeholder="Descrição do produto">
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço do produto">
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque"
                        placeholder="Estoque do produto">
                </div>
                <input type="submit" value="Cadastrar produto" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
