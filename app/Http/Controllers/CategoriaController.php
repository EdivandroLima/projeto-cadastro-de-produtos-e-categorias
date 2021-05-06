<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\Categoria;

class CategoriaController extends Controller
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
        $categorias= Categoria::where('user_id', Auth::user()->id)->paginate(10);
        return view('categorias', compact(['categorias']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nome'=> 'required|min:3|'.Rule::unique('categorias')->where('user_id',Auth::id())->where('nome', $request->nome)
        ]);

        $cat= new Categoria();
        $cat->nome= $request->nome;
        $cat->user_id= Auth::user()->id;
        $cat->save();
        return redirect()->route('categorias.index','add=success');

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
            'editar_nome'=> 'required|min:3',
            'id_categoria'=> 'exists:categorias,id'
        ]);

        $cat= Categoria::find($request->id_categoria);
        if (isset($cat)) {
            $cat->nome= $request->editar_nome;
            $cat->save();

            return redirect()->route('categorias.index','edit=success');
        }
        return response('Categoria não foi encontrada!', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat= Categoria::find($id);
        if (isset($cat) && (Auth::id() == $cat->user_id)) {
            $cat->delete();
            return redirect()->route('categorias.index','delete=success');
        }
        return response('Categoria não foi encontrada!', 404);
    }
}
