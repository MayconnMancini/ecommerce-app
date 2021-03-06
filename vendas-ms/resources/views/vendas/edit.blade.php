@extends('layouts.main')

@section('title','Vendas')

@section('content')

<div class="container"><!-- Inicio container -->
    <div class="py-5 text-center">
        <h2>Editar Venda</h2>
    </div>
    <div class="row"><!-- inicio row  principal -->
        <div class="col-md-12" > <!-- grid principal -->

            <form action="{{ route('vendas.update', $venda->id) }}"  method="POST"><!-- Inicio form principal -->
                
                @csrf
                @method('PUT')
                
                <div class="form-row border p-3 mt-2"> <!-- inicio 1 row -->

                    <div class="form-group col-md-4">
                        <label for="nome">Pagamento ID</label>
                        <input type="text" class="form-control" id="pagamento_id" 
                            name="pagamento_id" placeholder="pagamento_id" 
                            value="{{ $venda->pagamento_id }}" required readonly>
                    </div>
    
                    <div class="form-group col-md-4">
                    <label for="cliente">Usuario</label>
                    <input type="text" class="form-control" id="usuario_id" 
                    name="usuario_id" placeholder="usuario_id" 
                    value="{{ $venda->usuario_id }}" required readonly>
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="nome">Data Venda</label>
                        <input type="text" class="form-control" id="dataVenda" 
                            name="dataVenda" value=" {{ date('d/m/Y - H:i', strtotime($venda->dataVenda)) }}" readonly>
                    </div>
    
                    <div class="form-group col-md-2">
                        <label for="total">Valor Total</label>
                        <input type="number" class="form-control" id="total" 
                            name="total" value="{{ $venda->total }}" readonly> 
                    </div>
    
                    <div class="form-group col-md-12">
                      
                        <button type="submit" name="btn-finalizar-venda" class="btn btn-primary">
                            Salvar Venda
                        </button>
                            <a href="{{ route('vendas.index')}}" 
                                class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                    </div>

                </div><!-- Fim 1 row -->

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

                <div class="col-md-12"> <!-- utilizado COL-7 para ficar uma linha abaixo -->
                    @error("nomeVendedor")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror         
                    @error("quantidade")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror   
                </div>

               
                <div class="form-row border p-3 mt-2"><!-- inicio 2 row -->

                    <div class="form-group col-md-4">
                        <label for="produto">Selecione o produto</label>
                        <select name="produto" class="form-control" id = "produto">
                            @foreach($produtos as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->nome }}
                                </option>
                            @endforeach
                        </select> 
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" 
                            name="quantidade" placeholder="quantidade" min="1" value="1">
                    </div>
    
                    <div class="form-group col-md-4 d-flex align-items-end">
                     
                        <button type="submit" name="btn-adcionar-item" class="btn btn-success ">
                            Adicionar ao carrinho
                        </button>
                
                    </div>

                </div><!-- Fim 2 row -->

                <div class="col-md-12"> <!-- utilizado COL-7 para ficar uma linha abaixo -->
                    @error("nome")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror         
                    @error("preco")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror  
                    @error("estoque")
                    <div class="alert alert-danger my-2" role="alert">
                        {{ $message }}
                    </div>
                    @enderror  
                </div>

            </form> <!-- Inicio form principal -->


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
                    <th scope="col">A????es</th>
                </tr>
            </thead>
            <tbody>

            @foreach($itens as $i) 
                <tr>
                    <th scope="row">{{ $i->pivot->id }}</th>
                    <td>{{$i->nome }}</td>
                    <td>{{$i->preco}}</td>
                    <td>{{$i->pivot->quantidade}}</td>
                    <td>{{$i->preco * $i->pivot->quantidade}}</td>
                    <td>
                        <form action="{{ route('vendas.deleteItens', ['venda' => $venda->id, 'item' => $i->pivot->id]) }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="btn-excluir-item"class="btn btn-danger btn-sm">
                                Apagar
                            </button>                            
                        </form>
                    </td>
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