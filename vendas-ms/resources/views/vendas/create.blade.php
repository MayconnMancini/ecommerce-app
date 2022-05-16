@extends('layouts.main')

@section('title','Nova venda')

@section('content')

<div class="container"><!-- Inicio container -->
  <div class="py-5 text-center">
      <h2>Cadastro de Vendas</h2>
  </div>
  <div class="row"><!-- inicio row  principal -->
      <div class="col-md-12" > <!-- grid principal -->

          <form action="{{ route('vendas.store') }}" class="" method="POST"><!-- Inicio form principal -->
              @csrf
              
              <div class="form-row border p-3 mt-2"> <!-- inicio 1 row -->

                  <div class="form-group col-md-4">
                      <label for="nome">Nome do Cliente</label>
                      <input type="text" class="form-control" id="cliente" 
                          name="cliente" placeholder="cliente" required>
                  </div>
  
  
                  <div class="form-group col-md-2">
                      <label for="nome">Status</label>
                      <input type="text" class="form-control" id="status" 
                          name="status" readonly>
                  </div>
  
                  <div class="form-group col-md-2">
                      <label for="nome">Valor Total</label>
                      <input type="number" class="form-control" id="valorTotal" 
                          name="valorTotal" value = "0" readonly> 
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

          </form> <!-- Inicio form principal -->

      </div><!-- fim grid principal -->
  </div><!-- Fim row principal -->
</div><!-- Fim container -->

@endsection