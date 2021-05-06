@extends('layout.app', ['current'=>'home', 'titulo'=>'Home - Cadastro de Produtos e Categorias'])

@section('content')

    <h1 class="h2 text-center mt-5 text-uppercase">Cadastro de Produtos e Categorias</h1>

    <div class="jumbotron bg-light my-5">
            <div class="card-columns">
            <div class="card bg-warning">{{-- Card --}}
                <div class="card-body">
                    <h3 class="card-title">Sobre</h3>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam tncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam t labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
            </div>{{-- /Card --}}
            <div class="card text-white" style="background: #593066">{{-- Card --}}
                <div class="card-body">
                    <h3 class="card-title">Produtos</h3>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{route('produtos.index')}}" class="btn btn-outline-light btn-block  ">Produtos <i class="fas fa-arrow-right fa-sm ml-2"></i></a>
                </div>
            </div>{{-- /Card --}}

            <div class="card text-white" style="background: #008B8B">{{-- Card --}}
                <div class="card-body">
                    <h3 class="card-title">Categorias</h3>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                    </p>
                </div>
                <div class="card-footer">
                    <a href="{{route('categorias.index')}}" class="btn btn-outline-light btn-block  ">Categorias <i class="fas fa-arrow-right fa-sm ml-2"></i></a>
                </div>
            </div>{{-- /Card --}}

            </div>
    </div>

@endsection