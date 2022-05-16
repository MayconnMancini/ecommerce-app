<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;

class ProdutoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $produtos = Produto::all();
    //return $produtos;
    return view('produtos.index', ['produtos' => $produtos]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('produtos.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'nome' => 'required',
      'descricao' => 'required',
      'preco' => 'required',
      'estoque' => 'required'
    ]);

    $produto = new Produto;

    $produto->nome = $request->nome;
    $produto->descricao = $request->descricao;
    $produto->preco = $request->preco;
    $produto->estoque = $request->estoque;

    $produto->save();

    return redirect()->route('produtos.index')
      ->with('msg', 'Produto cadastrado com sucesso.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {

    $produto = Produto::findOrFail($id);

    return view('produtos.show', ['produto' => $produto]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $produto = Produto::findOrFail($id);

    return view('produtos.edit', ['produto' => $produto]);
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
    $request->validate([
      'nome' => 'required',
      'descricao' => 'required',
      'preco' => 'required',
      'estoque' => 'required'
    ]);


    $produto = Produto::findOrFail($id);
    $produto->nome = $request->get('nome');
    $produto->descricao = $request->get('descricao');
    $produto->preco = $request->get('preco');
    $produto->estoque = $request->get('estoque');

    $produto->update();

    return redirect()->route('produtos.index')
      ->with('msg', 'Produto atualizado com sucesso.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $produto = Produto::findOrFail($id);

    if ($produto->delete()) {
      return redirect()->route('produtos.index')
        ->with('msg', 'Produto excluido com sucesso.');
    } else {
      return redirect()->route('produtos.index')
        ->with('msg', 'Erro ao excluir produto.');
    }
  }
}
