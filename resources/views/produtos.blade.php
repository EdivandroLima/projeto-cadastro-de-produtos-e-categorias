@extends('layout.app', ['current'=>'produtos', 'titulo'=>'Produtos'])

@section('content')

    <div class="d-flex flex-wrap justify-content-between justify-align-center">
        <h1 class="m-0 p-0 h2 my-3">Produtos</h1>

        <div class="my-3">
            <button type="button" class="btn btn-indigo" data-toggle="modal" data-target="#novoproduto"><i
                    class="fas fa-plus"></i></button>
        </div>
    </div>

    @if (isset($_GET['add']) && $_GET['add'] == 'success')
        <div class="my-3 alert alert-success text-center">
            Produto adicionado com sucesso.
        </div>
    @elseif(isset($_GET['delete']) && $_GET['delete'] == 'success')
        <div class="my-3 alert alert-danger text-center">
            Produto deletado com sucesso.
        </div>

    @elseif(isset($_GET['edit']) && $_GET['edit'] == 'success')
        <div class="my-3 alert alert-success text-center">
            Produto editado com sucesso.
        </div>
    @endif



    <div class="card mb-5">
        <div class="card-header">
            Exibindo de {{ $produtos->firstItem() }} - {{ $produtos->lastItem() }} ({{ $produtos->total() }} total)
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Categoria</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($produtos) == 0)
                        <tr>
                            <td colspan="6" class="text-center">
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#novoproduto">
                                    Adicione um produto</button>
                            </td>
                        </tr>
                    @endif

                    @foreach ($produtos as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->nome }}</td>
                            <td>{{ 'R$ ' . number_format($prod->preco, 2, ',', '.') }}</td>
                            <td>{{ $prod->estoque }}</td>
                            <td>{{ $prod->categoria->nome }}</td>
                            <td>
                                <form method="post" action="{{ route('produtos.destroy', $prod->id) }}">
                                    <button type="button"
                                        onclick="editar({{ $prod->id }}, '{{ $prod->nome }}', '{{ $prod->preco }}', '{{ $prod->estoque }}', '{{ $prod->categoria_id }}')"
                                        class="btn btn-sm"><i class="fas fa-edit fa-lg text-indigo"></i></button>
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
            {{ $produtos->links() }}
        </div>
    </div>


    <!-- Modal Add Novo Produto -->
    <div class="modal fade" id="novoproduto" tabindex="-1" role="dialog" aria-labelledby="AddProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('produtos.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddProdutoModalLabel">Novo Produto </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">

                        <div class="form-group col-12">
                            <label for="nome" class="sr-only">Nome</label>
                            <input required id="nome" type="text" name="nome" placeholder="Nome"
                                class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}">
                            @if ($errors->has('nome'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nome') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="preco" class="sr-only">Preço</label>
                            <input required id="preco" type="number" step="any"  min='0' max='999999.99' name="preco" placeholder="Preço"
                                class="form-control {{ $errors->has('preco') ? 'is-invalid' : '' }}">
                            @if ($errors->has('preco'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('preco') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="estoque" class="sr-only">Estoque</label>
                            <input required id="estoque" type="number" step="any" min='0' max='999999999' name="estoque" placeholder="Estoque"
                                class="form-control {{ $errors->has('estoque') ? 'is-invalid' : '' }}">
                            @if ($errors->has('estoque'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estoque') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <label for="categoria" class="sr-only">Categoria</label>
                            <select id="categoria" name="categoria"
                                class="custom-select {{ $errors->has('categoria') ? 'is-invalid' : '' }}">
                                <option value="0">-- Selecione uma categoria --</option>
                                @foreach ($categorias as $cat)

                                    <option value="{{ $cat->id }}">{{ $cat->nome }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('categoria'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('categoria') }}
                                </div>
                            @endif
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-indigo">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Produto -->
    <div class="modal fade" id="editarproduto" tabindex="-1" role="dialog" aria-labelledby="EditarProdutoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('produtos.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_produto" id='id_produto'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditarProdutoModalLabel">Editar Produto </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">

                        <div class="form-group col-12">
                            <label for="editar_nome" class="sr-only">Nome</label>
                            <input required id="editar_nome" type="text" name="editar_nome" placeholder="Nome"
                                class="form-control {{ $errors->has('editar_nome') ? 'is-invalid' : '' }}">
                            @if ($errors->has('editar_nome'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('editar_nome') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="editar_preco" class="sr-only">Preço</label>
                            <input required id="editar_preco" type="number" step="any" min='0' max='999999.99' name="editar_preco"
                                placeholder="Preço"
                                class="form-control {{ $errors->has('editar_preco') ? 'is-invalid' : '' }}">
                            @if ($errors->has('editar_preco'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('editar_preco') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-6">
                            <label for="editar_estoque" class="sr-only">Estoque</label>
                            <input required id="editar_estoque" type="number" step="any" min='0' max='999999999' name="editar_estoque"
                                placeholder="Estoque"
                                class="form-control {{ $errors->has('editar_estoque') ? 'is-invalid' : '' }}">
                            @if ($errors->has('editar_estoque'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('editar_estoque') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <label for="editar_categoria" class="sr-only">Categoria</label>
                            <select id="editar_categoria" name="editar_categoria"
                                class="custom-select {{ $errors->has('editar_categoria') ? 'is-invalid' : '' }}">
                                <option>-- Selecione uma categoria --</option>
                                @foreach ($categorias as $cat)

                                    <option value="{{ $cat->id }}">{{ $cat->nome }}</option>

                                @endforeach
                            </select>
                            @if ($errors->has('editar_categoria'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('editar_categoria') }}
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-indigo">Salvar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@section('script')
    <script>
        @if ($errors->any())
            @if ($errors->has('nome') || $errors->has('estoque') || $errors->has('preco') || $errors->has('categoria'))
                $('#novoproduto').modal('show')
            @else
                $('#editarproduto').modal('show')
            @endif
        @endif
        $('input').keyup(function() {
            $(this).removeClass('is-invalid')
        })
        $('select').change(function() {
            $(this).removeClass('is-invalid')
        })

        function editar(id, nome, preco, estoque, categoria_id) {
            $('#editar_nome').val(nome)
            $('#editar_preco').val(preco)
            $('#editar_estoque').val(estoque)
            $('#editar_categoria').val(categoria_id)
            $('#id_produto').val(id)
            $('#editarproduto').modal('show')
        }

    </script>
@endsection

@endsection
