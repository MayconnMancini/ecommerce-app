@extends('layouts.main')

@section('title', 'Produto')

@section('content')
    <div class="container">

        <div class="mt-3 mb-3">
            <a class="btn btn-primary" href="{{ route('produtos.index') }}">Voltar</a>
        </div>

        <div id="produtos-create-container" class="col-md-6">
            <h1>Produto</h1>

            <form action="/produtos" method="POST">
                @csrf
                <div class="form-group">
                  <label for="nome">Id</label>
                  <input type="text" class="form-control" id="id" name="id" value="{{ $produto->id }}" readonly>
              </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" readonly>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao"
                    value="{{ $produto->descricao }}" readonly>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="text" class="form-control" id="preco" name="preco" value="{{ $produto->preco }}" readonly>
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque"
                    value="{{ $produto->estoque }}" readonly>
                </div>
               
            </form>
        </div>
    </div>

@endsection
