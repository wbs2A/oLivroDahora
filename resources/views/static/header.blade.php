<header class="header-area">
    <div class="container">
        <div class="header-wrap">
            <div
                    class="header-top d-flex justify-content-between align-items-lg-center navbar-expand-lg"
            >
                <div class="col menu-left">
                    <a class="active" href="{{ route('home') }}">Home</a>
                    <a href="{{ route('categoria') }}">Categoria</a>
                    <a href="{{ route('contato') }}">Contato</a>
                </div>
                <div class="col-5 text-lg-center mt-2 mt-lg-0">
              <span class="logo-outer">
                <span class="logo-inner">
                  <a href="index.html"
                  ><img class="mx-auto" src="{{asset("storage/img/logo.png")}}" alt=""
                      /></a>
                </span>
              </span>
                </div>
                <nav class="col navbar navbar-expand-lg justify-content-end">
                    <!-- Toggler/collapsibe Button -->
                    <button
                            class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapsibleNavbar"
                    >
                        <span class="lnr lnr-menu"></span>
                    </button>

                    <!-- Navbar links -->
                    <div
                            class="collapse navbar-collapse menu-right"
                            id="collapsibleNavbar"
                    >
                        <ul class="navbar-nav justify-content-center w-100">
                            <li class="nav-item hide-lg">
                                <a class="nav-link" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item hide-lg">
                                <a class="nav-link" href="{{route('categoria')}}">Categoria</a>
                            </li>
                            <li class="nav-item">
                                <form class="form-inline nav-link m-0" method="POST" action="{{ route('busca') }}">
                                    @csrf
                                  <input class="form-control col-9" name="busca" type="search" placeholder="" aria-label="Search">
                                  <button class="btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </li>
                            <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-my-menu" aria-labelledby="navbarDropdown">
                                        @if(Auth::check())
                                            <a class="row" href="{{route('perfil')}}">{{ Auth::user()->name }}</a>
                                                <hr class="half-rule"/>
                                            <a class="row" href="{{route('logout')}}"><i class="fas fa-walking"></i>Sair</a>

                                        @else
                                            <a  class="dropdown-item nav-link row p-0 m-0 text-center" href="{{ route('login') }}"><i class="fa m-2 fa-sign-in" aria-hidden="true"></i>Acessar</a>
                                            <a  class="dropdown-item nav-link row p-0 m-0 text-center" href="{{ route('register') }}"><i class="fa m-2 fa-user-plus" aria-hidden="true"></i>Registrar-se</a>
                                        @endif
                                    </div> 
                            </li>

                            <!-- <li class="nav-item checkout">
                                    <a class="nav-link col" 
                                    @if(Auth::check())
                                        href="{{route('carrinho')}}"
                                    @endif
                                    >
                                        <i class="fa fa-shopping-cart row justify-content-end mr-3" aria-hidden="true"></i>
                                        <span id="checkout_items" class="checkout_items row justify-content-end mr-3">0</span>
                                    </a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>