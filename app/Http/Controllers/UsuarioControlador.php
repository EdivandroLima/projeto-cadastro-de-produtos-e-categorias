<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UsuarioControlador extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

    	return view('editar-foto');

    }

    public function update(Request $request, $id)
    {
    	$request->validate([
    		'foto_usuario'=>'required'
    	]);

    	if (Auth::user()->id == $id) {

    		$arquivo= Auth::user()->img_perfil;
	        if (!empty($arquivo)) {
	        	Storage::disk('public')->delete($arquivo);
	        }

    		$path= $request->file('foto_usuario')->store('img/perfil', 'public');

	        $user= User::find($id);
	        $user->img_perfil= $path;
	        $user->save();
	        return redirect()->route('editarfoto');
	    }

    	return response('Erro de usuário', 404);
    }

}




