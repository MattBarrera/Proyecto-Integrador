<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Clothes Shop</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    {{-- Bootstrap Multiple Select --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                  <div class="logo">
                    {{-- <img src="img/.png" alt=""> --}} Clothes Shop
                  </div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/Store') }}">Store</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    {{-- <div class="input-group col-md-3">
                        <input type="text" class="form-control" placeholder="Buscar" name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div> --}}
                    {{-- <form class="form-inline">
                          <input type="text" class="form-control" placeholder="Search...">
                    </form> --}}
                    <form action="/Busqueda" method="GET" class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" name="q" placeholder="Search...">
                          </div>
                    </form>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle aAvatar" data-toggle="dropdown" role="button" aria-expanded="false">
                            @if(Auth::user()->avatar == 'avatar_2x.png')
                                <img src="/assets/avatar_2x.png" class="img-circle" width="40" alt="user_avatar">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            @else
                                <img src="/assets/{{Auth::user()->id}}/profile/{{Auth::user()->avatar}}" class="img-circle" width="40" height="40" alt="user_avatar">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            @endif
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/MyProducts">My Products</a></li>
                                <li><a href="/MyHistoricProducts">My Historic Products</a></li>
                                <li><a href="/MyPersonalProducts">My Personal Products</a></li>
                                <li><a href="/Empresa">My Pages</a></li>
                                @if(Auth::user()->roleId < 3)
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Super Admin</li>
                                    <li><a href="/Generos">Genders</a></li>
                                    <li><a href="/Categorias">Categories</a></li>
                                    <li><a href="/Colores">Colors</a></li>
                                    <li><a href="/Talles">Sizes</a></li>
                                @endif
                                    <li role="separator" class="divider"></li>
                                <li><a href="/User/{{Auth::user()->id}}/edit">My Acount</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                            <li><a href="/Shop"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart ({{Cart::instance('default')->count()}})</a></li>
                            <li><a href="/Whishlist"><i class="fa fa-heart" aria-hidden="true"></i> ({{Cart::instance('wishlist')->count()}})</a></li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

    @include('Includes.footer')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    {{-- Bootstrap Multiple Selects JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
