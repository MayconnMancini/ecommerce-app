
@extends('layouts.main')

@section('title','Vendas')

@section('content')

<div class="container">
    <div class="py-5 text-center">
        <h2>Vendas</h2>
    </div>
    <div class="row mb-2">
        <div class="col-md-12" >
            <a href="{{ route('vendas.create')}}" class="btn btn-primary active" 
                role="button" aria-pressed="true">Nova Venda</a>
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

    @if(count($vendas)>0)
    <div class="row">
        <div class="col-md-12" >
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Id.Usuario</th>
                    <th scope="col">Id.Pagamento</th>
                    <th scope="col">Total</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

            @foreach($vendas as $v) 
                <tr>
                    <th scope="row">{{ $v->id}}</th>
                    <td>{{$v->dataVenda }}</td>
                    <td>{{$v->usuario_id}}</td>
                    <td>{{$v->pagamento_id}}</td>
                    <td>{{$v->total}}</td>
                    <td>
                        <form action="{{ route('vendas.destroy', $v->id) }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                Apagar
                            </button>                            
                            <a class="btn btn-primary btn-sm active" 
                                href="{{ route('vendas.show', $v->id) }}">
                                Detalhes
                            </a>
                            <a class="btn btn-secondary btn-sm active" 
                                href="{{ route('vendas.edit',$v->id) }}">
                                Editar
                            </a>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
            </table>

        </div>
    </div>
    @endif
    
</div>

@endsection