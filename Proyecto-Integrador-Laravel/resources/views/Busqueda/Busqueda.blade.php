@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
      <ol class="breadcrumb">
        <li class="active"><a href="/Store">Store</a></li>
        {{-- <li><a href="#">Women</a></li>
        <li><a href="#">Clothes</a></li>
        <li><a href="#">Shoes</a></li>
        <li><a href="#">Accesories</a></li>
        <li class="active">Data</li> --}}
      </ol>
    </section>
    <div class="row">
    <div class="container">
    	<div class=" col-md-2" style="background: #f5f5f5">
	        <p>Generos</p>
	        <ul>
          {{-- {{dd(str_contains(Request::fullUrl(), 'http://proyecto-integrador:8004/Busqueda?gen'))}} --}}
            @foreach($generos as $genero)
              @if(substr(Request::getQueryString(), -1)   == $genero->generoId )
               <li ><a href="/Busqueda?gen={{$genero->generoId}}" class="activeFilter">{{$genero->generoNombre}}</a></li>
              @else
                <li ><a href="/Busqueda?gen={{$genero->generoId}}" >{{$genero->generoNombre}}</a></li>
              @endif
            @endforeach
          </ul>
          @foreach($categorias as $categoria)
            @if(substr(Request::getQueryString(), -1)   == $categoria->categoriaId )
              <p><a href="/Busqueda?cat={{$categoria->categoriaId}}" class="activeFilter">{{$categoria->categoriaNombre}}</a></p>
            @else
              <p><a href="/Busqueda?cat={{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</a></p>
            @endif
            @foreach($categoria->subcategorias as $subCategoria)
                <ul>
              @if(substr(Request::getQueryString(), -1)   == $subCategoria->categoriaId )
                <li><a href="/Busqueda?cat={{$subCategoria->categoriaId}}" class="activeFilter">{{$subCategoria->categoriaNombre}}</a></li>
              @else
                <li><a href="/Busqueda?cat={{$subCategoria->categoriaId}}">{{$subCategoria->categoriaNombre}}</a></li>
              @endif
                </ul>
            @endforeach
          @endforeach
       </div>
       
        <div class="col-md-10 container">
            <section id="productos">
              <div class="productos">
                {{-- <center> <h2>PRODUCTOS DESTACADOS</h2> </center> --}}
                {{-- {{dd(count($productos))}} --}}
                @if(count($productos) > 0)
                  @foreach($productos as $producto)
                  <div class="col-xs-6 col-sm-3" >
                    @include('Includes.producto', ['producto' => $producto])
                    <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                      </div> {{-- end caption inside the include--}}
                    </div> {{-- end thumbnail inside the include--}}
                  </div> {{-- end col-xs-6 col-sm-3 --}}
                  @endforeach
                @else
                  <div class="alert alert-warning" role="alert">
                    <center><p>No se encontraron productos con esa busqueda.</p></center>
                    {{-- <button type="" class="btn btn-success"><a href="{{URL::previous()}}" title="">Volver</a></button> --}}
                  </div>
                  <center><h2>Pero poray te pueden interesar estos productos!!</h2></center>
                  @foreach($sugerencias as $producto)
                  <div class="col-xs-6 col-sm-3" >
                    @include('Includes.producto', ['producto' => $producto])
                    <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                      </div> {{-- end caption inside the include--}}
                    </div> {{-- end thumbnail inside the include--}}
                  </div> {{-- end col-xs-6 col-sm-3 --}}
                  @endforeach
                @endif
              </div>
            </section>
        </div>
    </div>
    </div>
</div>

@endsection
