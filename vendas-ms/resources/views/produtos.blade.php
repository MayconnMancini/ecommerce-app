@extends('layouts.main')

@section('title','Produtos')

@section('content')

<h1>View Produtos</h1>

<a href="/">Voltar</a>

<h1>Listagem de produtos</h1>
<hr>
<div class="container">
    <table class="table table-bordered table-striped table-sm">
        <thead>
      <tr>
          <th>#</th>
          <th>Nome</th>
          <th>descricao</th>
          <th>valor</th>
          <th>estoque</th>
      </tr>
        </thead>
        <tbody>
      @forelse($produtos as $produto)
      <tr>
          <td>{{ $produto->id }}</td>
          <td>{{ $produto->nome }}</td>
          <td>{{ $produto->descricao }}</td>
          <td>{{ $produto->valor }}</td>
          <td>{{ $produto->estoque }}</td>
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