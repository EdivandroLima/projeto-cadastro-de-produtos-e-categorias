    <header>
        <nav class="navbar navbar-dark shadow navbar-expand-md" style="background: #593066">
            <div class="container">

                @auth
                    <div class="navbar-brand d-flex justify-align-center">

                        <a href="{{ route('editarfoto') }}" title="Editar foto de usuário">
                            <img src="{{ asset(!empty(Auth::user()->img_perfil) ? Auth::user()->img_perfil : 'img/profile.png') }}"
                                width="28" height="28" class="mr-2 rounded-circle">
                        </a>
                        {{ Auth::user()->name }}
                    </div>
                @endauth
                @guest
                    <a href="/" class="navbar-brand" title="Cadastro de Produtos e Categorias"> App CPC </a>
                @endguest


                <button type="button" class="navbar-toggler" data-target="#menu" data-toggle="collapse">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="navbar-collapse collapse" id="menu">
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item {{ $current == 'home' ? 'active' : '' }}">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item {{ $current == 'produtos' ? 'active' : '' }}">
                                <a href="{{ route('produtos.index') }}" class="nav-link">Produtos</a>
                            </li>

                            <li class="nav-item {{ $current == 'categorias' ? 'active' : '' }}">
                                <a href="{{ route('categorias.index') }}" class="nav-link">Categorias</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                                <a href="{{ route('login') }}" class="nav-link">Entrar</a>
                            </li>

                            <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
                                <a href="{{ route('register') }}" class="nav-link">Registre-se</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://github.com/EdivandroLima" target="_blank" class="nav-link"><i
                                        class="fab fa-github fa-sm"></i> Edivandro Lima</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
