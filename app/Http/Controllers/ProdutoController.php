<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $produtos = Produto::where('user_id', Auth::id())->paginate(10);
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('produtos', compact(['produtos', 'categorias']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => [
                'required', 'min:3',
                Rule::unique('produtos')->where('user_id', Auth::id())->where('nome', $request->nome)
            ],
            'preco' => 'required',
            'estoque' => 'required',
            'categoria' => 'required|exists:categorias,id',
        ]);

        $prod = new Produto();
        $prod->nome = $request->nome;
        $prod->preco = $request->preco;
        $prod->user_id = Auth::id();
        $prod->estoque = $request->estoque;
        $prod->categoria_id = $request->categoria;
        $prod->save();
        return redirect()->route('produtos.index', 'add=success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id_produto' => 'exists:produtos,id',
            'editar_nome' => 'required|min:3',
            'editar_preco' => 'required',
            'editar_estoque' => 'required',
            'editar_categoria' => 'required|exists:categorias,id',
        ]);

        $prod = Produto::find($request->id_produto);
        if (isset($prod)) {
            $prod->nome = $request->editar_nome;
            $prod->preco = $request->editar_preco;
            $prod->estoque = $request->editar_estoque;
            $prod->categoria_id = $request->editar_categoria;
            $prod->save();
            return redirect()->route('produtos.index', 'add=success');

            echo "<pre>";
            print_r($request->all());
        }
        return response('Produto não foi encontrada!', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Produto::find($id);

        if (isset($prod) && (Auth::id() == $prod->user_id)) {
            $prod->delete();
            return redirect()->route('produtos.index', 'delete=success');
        }
        return response('Produto não foi encontrada!', 404);
    }
}
