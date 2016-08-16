@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Store</a></li>
          {{-- <li><a href="#">Women</a></li>
          <li><a href="#">Clothes</a></li>
          <li><a href="#">Shoes</a></li>
          <li><a href="#">Accesories</a></li>
          <li class="active">Data</li> --}}
          {{-- {{Cart::content()}} --}}
        </ol>
      </section>
    <div class="row" style="margin-bottom:20px;">
    <div class="container">
      <div class=" col-md-2" style="background: #f5f5f5">
        <p>Generos</p>
        <ul>
          @foreach($generos as $genero)
            <li><a href="">{{$genero->generoNombre}}</a></li>
          @endforeach
        </ul>
        @foreach($categorias as $categoria)
          <p><a href="/Busqueda?cat={{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</a></p>
          @foreach($categoria->subcategorias as $subCategoria)
            <ul>
              <li><a href="/Busqueda?cat={{$subCategoria->categoriaId}}">{{$subCategoria->categoriaNombre}}</a></li>
            </ul>
          @endforeach
        @endforeach
      </div>
      <div class="col-md-10 container">
        <section id="productos">
          <div class="productos">
            {{-- <center> <h2>FEATURED PRODUCTS</h2> </center> --}}
            <div class="row">
            @foreach($productos as $producto)
            {{-- {{dd($producto)}} --}}
            <div class="col-xs-6 col-sm-3" >
              @include('Includes.producto', ['producto' => $producto])
              {{-- {{dd($producto->productoId)}} --}}
              {{-- {{ dd( Cart::search( ['id' => $producto->productoId] ) ) }} --}}
                {{-- @if(Cart::search(['id' => $producto->productoId])) --}}
                  <p>
                    <a href="/Productos/{{$producto->productoId}}" class="btn btn-primary" role="button">Buy</a>
                {{-- @else --}}
                    <a href="/Whishlist/{{$producto->productoId}}" class="btn btn-primary" role="button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                  </p>
                {{-- @endif --}}
                </div> {{-- end caption inside the include--}}
              </div> {{-- end thumbnail inside the include--}}
            </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
          </div>
        </section>
      </div>
    </div>
    </div>
</div>

@endsection
