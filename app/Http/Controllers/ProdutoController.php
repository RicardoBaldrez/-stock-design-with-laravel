<?php

namespace estoque\Http\Controllers;

use Illuminate\Support\Facades\DB;
use estoque\Produto;
use estoque\Categoria;
use estoque\Jogo;
use Request;
use estoque\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['novo', 'remove']]);
    }

    public function lista()
    {
        $produtos = Jogo::all();

        return view('produto.listagem')->with('produtos', $produtos); // ou return view('produto/listagem')...
    }

    public function mostra($id)
    {
        $produto = Jogo::find($id);

        if(empty($produto)) {
            return '<h3>O produto não existe!</h3>';
        }
       
        return view('produto.detalhes')->with('produto', $produto);
    }

    public function novo()
    {
        return view('produto.formulario')->with('categorias', Categoria::all());
    }

    public function adiciona(ProdutoRequest $request)
    {
        $params = Request::all();
        $jogo = new Jogo($params);
        $jogo->save();        
        // OU Jogo::create(Request::all());

        return redirect()->action('ProdutoController@lista')->withInput(Request::only('nome'));
        // Ou return redirect('/produtos')->withInput();  withInput guarda todos os dados da requisição anterior 
    }

    public function remove($id)
    {
        $produto = Jogo::find($id);
        $produto->delete();

        return redirect()->action('ProdutoController@lista');
    }

    public function json()
    {
        $produtos = DB::select('select * from jogos');
        return $produtos; // Ou return response()->json($produtos);
    }
}