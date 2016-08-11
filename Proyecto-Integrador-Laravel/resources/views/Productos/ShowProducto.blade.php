@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>{{$producto->productoNombre}}</h1>
      </div>
      <div class="row">
        <section class="detalleProducto">
          <form action="/Shop/{{$producto->productoId}}" method="POST">
<<<<<<< Updated upstream
          {{ csrf_field() }}
=======
          {{csrf_token()}}
          <div id="detalleProductoFoto" style="float: left; margin-left: 11%;">
>>>>>>> Stashed changes
            @if($producto->productoFoto !== 'artsinfoto.gif')
                    <img src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" class="productoFoto">
                  @else
                    <img src="/assets/{{$producto->productoFoto}}" alt="" class="productoFoto">
                  @endif
          </div>
              
                  <!-- Separo la foto de lo demas con otro div para hacer un float left -->
                  <!-- hice el css inline para probarlo, no encuentro el css donde tocarlo -->
              <div id="detalleProdutoDatos" style="float: right; margin-right: 31%;">
              <!--aca va el titulo del producto-->


              <!--descripcion completa del producto-->


              <!--precio del producto-->
                
                <h3><strong>$ {{$producto->productoPrecio}}<sup>00</sup></strong></h3>
                {{-- {{dd(count($talles))>0}} --}}
              @if(count($producto->color)>0) 
              <!--precio del producto con el titulo-->
                <h3>Color:</h3>
                
                @foreach($producto->color as $color)
                  <div class="inline">
                      <input type="radio" required id="colorId" name="colorId" value="{{$color->colorId}}">
                      <label for="colorId">{{$color->color->colorNombre}}</label>
                  </div>
                @endforeach
              @endif 

              @if(count($producto->talle)>0)
              <!--precio del producto con el titulo-->
                <h3>Talle:</h3>
                @foreach($producto->talle as $talle)
                  <div class="inline">
                      <input type="radio" required id="talleId" name="talleId" value="{{$talle->talleId}}">
                      <label for="talleId">{{$talle->talle->talleNombre}}</label>
                  </div>
                @endforeach
              @endif
              <br>
            <input type="submit" class="btn btn-success" value="Buy"></input>
            </div>
          </form>
          <br>
          
        </section>
      </div>
      <br>
      <br>
      <br>
      <br>
        <div style="text-align: center;">
            <h2>Descripcion del Producto</h2>
                    <!--descripcion completa del producto-->
                <p>Descripcion: {{$producto->productoDescripcion}}</p>
          </div>
    </div>
    
@endsection