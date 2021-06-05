<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioControlador;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('categorias', CategoriaController::class);
Route::put('categorias', [CategoriaController::class, 'update'])->name('categorias.update');

Route::resource('produtos', ProdutoController::class);
Route::put('produtos', [ProdutoController::class, 'update'])->name('produtos.update');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('editar-foto', [UsuarioControlador::class, 'index'])->name('editarfoto');
Route::put('editar-foto/{id}', [UsuarioControlador::class, 'update'])->name('editarfoto.update');
