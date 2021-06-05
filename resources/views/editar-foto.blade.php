@extends('layout.app', ['current'=>'editarfoto', 'titulo'=>'Editar foto de usuário'])

@section('content')

    <div class="card col-12 col-md-7 mx-auto my-5 py-4">
        <form method="post" action="{{ route('editarfoto.update', Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body text-center">
                <h4 class="card-title">Editar foto de usuário</h4>
                <img src="{{ asset(!empty(Auth::user()->img_perfil) ? Auth::user()->img_perfil : 'img/profile.png') }}"
                    width="150" height="150" class="rounded-circle">

                <div class="form-group my-3">
                    <input type="file" name="foto_usuario" class="border p-1 rounded">
                </div>

                <button type="submit" class="btn btn-indigo mt-3">Salvar</button>
            </div>
        </form>

    </div>




@endsection
