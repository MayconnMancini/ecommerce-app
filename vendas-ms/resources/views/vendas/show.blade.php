@extends('layouts.main')

@section('title','Venda')

@section('content')

<div class="container"><!-- Inicio container -->
    <div class="py-5 text-center">
        <h2>Detalhes</h2>
    </div>
    <div class="row"><!-- inicio row  principal -->
        <div class="col-md-12" > <!-- grid principal -->
                
            <div class="form-row border p-3 mt-2"> <!-- inicio 1 row -->
                
                <div class="form-group col-md-3">
                    <label for="nome">ID Venda</label>
                    <input type="text" class="form-control" id="idvenda" 
                        name="idvenda" placeholder="idvenda" 
                        value="{{ $venda->id }}" readonly>
                </div>
                
                
                <div class="form-group col-md-3">
                    <label for="nome">Usuario Id</label>
                    <input type="text" class="form-control" id="usuario_id" 
                        name="usuario_id" placeholder="usuario_id" 
                        value="{{ $venda->usuario_id }}" readonly>
                </div>

                <div class="form-group col-md-3">
                <label for="cliente">Pagamento Id</label>
                    <input name="pagamento_id" class="form-control" id = "pagamento_id" name="pagamento_id"
                       value=" {{ $venda->pagamento_id }}" readonly > 
                </div>
                
                <div class="form-group col-md-3">
                    <label for="nome">Data</label>
                    <input type="text" class="form-control" id="data" 
                        name="data" placeholder="data" 
                        value="{{ date('d/m/Y - H:i:s', strtotime($venda->dataVenda))   }}" readonly>
                </div>

                <div class="form-group col-md-3">
                    <label>Valor Total:</label>     
                    <input type="text" name="preco" id="currency" class="form-control"  
                    value="R$ {{ $venda->total }}" readonly>
                </div>

            </div>

            <div class="table mt-2">
                <a href="{{ route('vendas.index') }}" 
                    class="btn btn-primary" role="button" aria-pressed="true">Voltar</a>
            </div>

            <h3 class="mt-4 mb-4">Carrinho de compras</h3><!-- inicio Lista de itens -->

    @if(count($itens)>0)
    <div class="row">
        <div class="col-md-12" >

            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preco</th>
                    <th scope="col">quantidade</th>
                    <th scope="col">Subtotal</th>
                    
                </tr>
            </thead>
            <tbody>

            @foreach($itens as $i) 
                <tr>
                    <th scope="row">{{ $i->pivot->id}}</th>
                    <td>{{$i->nome }}</td>
                    <td>{{$i->preco}}</td>
                    <td>{{$i->pivot->quantidade}}</td>
                    <td>{{$i->preco * $i->pivot->quantidade}}</td>
                </tr>
            @endforeach

            </tbody>
            </table>

        </div>
    </div>
    @endif
  


        </div><!-- fim grid principal -->
    </div><!-- Fim row principal -->
</div><!-- Fim container -->

@endsection