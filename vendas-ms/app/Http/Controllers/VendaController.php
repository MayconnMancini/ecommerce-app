<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use App\Models\Venda_item;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;


class VendaController extends Controller
{
  private function calcularVenda(Venda $venda)
  {

    $itens = $venda->produtos;
    $venda->total = $venda->calcularTotal($itens);
    $venda->save();
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $vendas = Venda::all();
    return view('vendas.index', compact('vendas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $produtos = Produto::all();
    //$clientes = Cliente::all();
    return view('vendas.create', compact(['produtos']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $venda = new Venda();
    $venda->dataVenda = now();
    $venda->usuario_id = "implementar";
    $venda->pagamento_id = "implementar";
    $venda->total = 0;

    $venda->save();

    return redirect()->route('vendas.edit', $venda->id)->with('msg_success', 'Venda criada. Adicione os itens ao carrinho');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $venda = Venda::findOrFail($id);
    $itens = $venda->produtos;
        
    return view('vendas.show', compact(['venda','itens']) );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $produtos = Produto::all();
    $venda = Venda::findOrFail($id);
    $itens = $venda->produtos;

    return view('vendas.edit', compact(['venda', 'produtos', 'itens']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate(
      [
        'quantidade' => [
          'required'
        ],

      ],

      [
        'nomeVendedor.require' => 'Preencha o nome do Vendedor',
        'nomeVendedor.min' => 'O nome nao tem mais que um caractere',
      ],
      [
        'quantidade.require' => 'Campo quantidade não preenchido',
      ],

    );

    $venda = Venda::findOrFail($id);

    $venda->dataVenda = now();
    $venda->usuario_id = $request->usuario_id;
    $venda->pagamento_id = $request->pagamento_id;
    $venda->total = $request->total;

    $venda->save();

    if (isset($_POST['btn-finalizar-venda'])) {

      $this->calcularVenda($venda);

      return redirect()->route('vendas.index')->with('msg_success', 'Venda Salva com sucesso');
    }

    $id = $venda->id; // retorna o id da venda

    $id_produto = $request->produto;
    $quantidade = $request->quantidade;
    $produto = Produto::findOrFail($id_produto);
    
    // adiciona o produto na tabela produto_venda
    try {

      $venda->produtos()->attach([$id_produto => [
        'id' => Str::uuid(),
        'preco' => $produto->preco,
        'quantidade' => $quantidade,
        'subtotal' => $produto->preco * $quantidade
      ]]);

      $this->calcularVenda($venda);
      return redirect()->route('vendas.edit', $id)->with('msg_success', 'Item adcionado');

    } catch (\Exception $e) {

      return redirect()->route('vendas.edit', $id)
        ->with('msg_error', 'E R R O !! Este item ja foi adicionado ao carrinho: -  ' . $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    $venda = Venda::findOrFail($id);
    $venda->delete();

    return redirect()->route('vendas.index')
      ->with('msg_success', 'Venda removida com sucesso.');
  }

  public function deleteItens(Venda $venda, String $id)
  {

    $itens = $venda->produtos;
    foreach ($itens as $i) {
      if ($i->pivot->id == $id) {
        $venda_item = Venda_item::findOrFail($i->pivot->id);
        $venda_item->delete();
      }
    }

    $this->calcularVenda($venda);

    return redirect()->route('vendas.edit', $venda->id)
      ->with('msg_success', 'Item removido com sucesso.');
  }
}
