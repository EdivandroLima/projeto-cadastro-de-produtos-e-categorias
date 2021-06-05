@extends('layout.app', ['current'=>'categorias', 'titulo'=>'Categorias'])

@section('content')

    <div class="d-flex flex-wrap justify-content-between justify-align-center">
        <h1 class="m-0 p-0 h2 my-3">Categorias</h1>

        <div class="my-3">
            <button type="button" class="btn btn-slateblue" data-toggle="modal" data-target="#novacategoria"><i
                    class="fas fa-plus"></i></button>


        </div>
    </div>
    @if (isset($_GET['add']) && $_GET['add'] == 'success')
        <div class="my-3 alert alert-success text-center">
            Categoria adicionada com sucesso.
        </div>
    @elseif(isset($_GET['delete']) && $_GET['delete'] == 'success')
        <div class="my-3 alert alert-danger text-center">
            Categoria deletada com sucesso.
        </div>

    @elseif(isset($_GET['edit']) && $_GET['edit'] == 'success')
        <div class="my-3 alert alert-success text-center">
            Categoria editada com sucesso.
        </div>
    @endif


    <div class="card mb-5">
        <div class="card-header">

            Exibindo de {{ $categorias->firstItem() }} - {{ $categorias->lastItem() }} ({{ $categorias->total() }}
            total)
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Categora</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($categorias) == 0)
                        <tr>
                            <td colspan="3" class="text-center">
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#novacategoria">
                                    Adicione uma categoria</button>
                            </td>
                        </tr>
                    @endif


                    @foreach ($categorias as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->nome }}</td>
                            <td>
                                <form method="post" action="{{ route('categorias.destroy', $cat->id) }}">
                                    <button type="button" onclick="editar({{ $cat->id }}, '{{ $cat->nome }}')"
                                        class="btn btn-sm"><i class="fas fa-edit fa-lg text-slateblue"></i></button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"><i
                                            class="fas fa-trash-alt fa-lg text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $categorias->links() }}
        </div>
    </div>

    <!-- Modal Add Categoria -->
    <div class="modal fade" id="novacategoria" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('categorias.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoriaModalLabel">Nova Categoria </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome" class="sr-only">Nome</label>
                            <input required type="text" name="nome" placeholder="Nome"
                                class="form-control form-control-lg {{ $errors->has('nome') ? 'is-invalid' : '' }}">

                            @if ($errors->has('nome'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nome') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-slateblue">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Categoria -->
    <div class="modal fade" id="editarcategoria" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('categorias.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoriaModalLabel">Editar Categoria </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_categoria" id='id_categoria'>
                            <label for="editar_nome" class="sr-only">Nome</label>
                            <input required id="editar_nome" type="text" name="editar_nome" placeholder="Nome"
                                class="form-control form-control-lg {{ $errors->has('editar_nome') ? 'is-invalid' : '' }}">

                            @if ($errors->has('editar_nome'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('editar_nome') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-slateblue">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('script')
    <script>
        @if ($errors->has('nome'))
            $('#novacategoria').modal('show')
        @elseif($errors->has('editar_nome'))
            $('#editarcategoria').modal('show')
        @endif
        $('input').keyup(function() {
            $(this).removeClass('is-invalid')
        })

        function editar(id, nome) {
            $('#editar_nome').val(nome)
            $('#id_categoria').val(id)
            $('#editarcategoria').modal('show')
        }

    </script>
@endsection

@endsection
