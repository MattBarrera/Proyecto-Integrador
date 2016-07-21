@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Producto</h1>
      </div>
      
      <div class="row">
        {{-- {{dd($producto, $colores, $talles)}} --}}
              <section class="detalleProducto">
      <form action="" >
        <!--aca va el titulo del producto-->
          <h2>{{$producto->productoNombre}}</h2>

        <!--descripcion completa del producto-->
          <p>{{$producto->productoDescripcion}}</p>

        <!--precio del producto con el titulo-->
          <h3>Precio:</h3>
          <p>{{$producto->productoPrecio}}</p>

        <!--precio del producto con el titulo-->
          <h3>Color:</h3>
          @foreach($colores as $color)
          <div class="inline">
              <input type="radio" id="color1" name="color" value="{{$color->colorId}}">
              <label for="color1">{{$color->colorNombre}}</label>
          </div>
          @endforeach
          
        <!--precio del producto con el titulo-->
          <h3>Talle:</h3>
          @foreach($talles as $talle)
          <div class="inline">
              <input type="radio" id="talle1" name="talle" value="{{$talle->talleId}}">
              <label for="talle1">{{$talle->talleNombre}}</label>
          </div>
          @endforeach
          <input type="submit" class="btn btn-success" value="Comprar"></input>
      </form>
      </section>
      </div>

    </div>
@endsection