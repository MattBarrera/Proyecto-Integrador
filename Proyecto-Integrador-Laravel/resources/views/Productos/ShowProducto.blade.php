@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Producto</h1>
      </div>
      <div class="row">
        <section class="detalleProducto">
          <form action="" method="POST">
            @if($producto->productoFoto !== 'artsinfoto.gif')
                    <img src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" class="productoFoto">
                  @else
                    <img src="/assets/{{$producto->productoFoto}}" alt="" class="productoFoto">
                  @endif
              <!--aca va el titulo del producto-->
                <h2>{{$producto->productoNombre}}</h2>

              <!--descripcion completa del producto-->
                <p>Descripcion: {{$producto->productoDescripcion}}</p>

              <!--precio del producto-->
                <h3>Precio:</h3>
                <p>$ {{$producto->productoPrecio}}</p>
                {{-- {{dd(count($talles))>0}} --}}
              @if(count($producto->color)>0) 
              <!--precio del producto con el titulo-->
                <h3>Color:</h3>
                
                @foreach($producto->color as $color)
                  <div class="inline">
                      <input type="radio" id="color1" name="color" value="{{$color->colorId}}">
                      <label for="color1">{{$color->color->colorNombre}}</label>
                  </div>
                @endforeach
              @endif 

              @if(count($producto->talle)>0)
              <!--precio del producto con el titulo-->
                <h3>Talle:</h3>
                @foreach($producto->talle as $talle)
                  <div class="inline">
                      <input type="radio" id="talle1" name="talle" value="{{$talle->talleId}}">
                      <label for="talle1">{{$talle->talle->talleNombre}}</label>
                  </div>
                @endforeach
              @endif
            <input type="submit" class="btn btn-success" value="Comprar"></input>
          </form>
        </section>
      </div>

    </div>
@endsection