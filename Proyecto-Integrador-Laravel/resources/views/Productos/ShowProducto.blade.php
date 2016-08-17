@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <!-- aca va el titulo del producto -->
      <div class="page-header">
        <h1>{{$producto->productoNombre}}</h1>
      </div>
      <div class="row" style="margin-bottom: 2em;">
        <!-- Separo la foto de lo demas con otro div para hacer un float left -->
        <div id="detalleProductoFoto" class="detalleProductoFoto">
          @if($producto->productoFoto !== 'artsinfoto.gif')
            <img  src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" class="productoFoto">
          @else
            <img  src="/assets/{{$producto->productoFoto}}" alt="" class="productoFoto">
          @endif
        </div>             
        <!-- hice el css inline para probarlo, no encuentro el css donde tocarlo -->
        <div id="detalleProdutoDatos" class="detalleProdutoDatos">
          <form action="/Shop/{{$producto->productoId}}" method="POST">
            {{csrf_field()}}
            <!-- precio del producto -->
            <h3><strong>$ {{$producto->productoPrecio}}<sup>00</sup></strong></h3>
            @if(count($producto->color)>0) 
              <!-- precio del producto con el titulo -->
              <h3>Color:</h3>
              @foreach($producto->color as $color)
                <div class="inline">
                  <input type="radio" required id="colorId" name="colorId" value="{{$color->colorId}}">
                  <label for="colorId">{{$color->color->colorNombre}}</label>
                </div>
              @endforeach
            @endif 
            @if(count($producto->talle)>0)
              <!-- precio del producto con el titulo -->
              <h3>Talle:</h3>
              @foreach($producto->talle as $talle)
                <div class="inline">
                  <input type="radio" required id="talleId" name="talleId" value="{{$talle->talleId}}">
                  <label for="talleId">{{$talle->talle->talleNombre}}</label>
                </div>
              @endforeach
            @endif
            {{-- <input type="submit" class="btn btn-success" value="Buy"></input> --}}
            {{-- <a type="submit" class="btn btn-primary" role="button">Buy</a> --}}
            <a href="/Shop/{{$producto->productoId}}" class="btn btn-success" role="button">Buy</a>
            <button type="submit" class="btn btn-success">Buy</button>
            <a href="/Whishlist/{{$producto->productoId}}" class="btn btn-primary" role="button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <div class="clear"></div>
      <!-- descripcion completa del producto -->
      <div style="text-align: center; margin-top: 2em;border-top: 1px solid #eee;">
        <h2>Description of Product</h2>
        <!-- descripcion completa del producto -->
        <p>{{$producto->productoDescripcion}}</p>
      </div>

      @foreach($productosInteres as $producto)
            {{-- {{dd($producto)}} --}}
            <div class="col-xs-4 col-md-4 item" >
            <div class="thumbnail">
              @include('Includes.producto', ['producto' => $producto])
                  {{-- <p> --}}
                    {{-- <a href="/Productos/{{$producto->productoId}}" class="btn btn-primary" role="button">Buy</a> --}}
                    {{-- <a href="/Whishlist/{{$producto->productoId}}" class="btn btn-primary" role="button"><i class="fa fa-heart-o" aria-hidden="true"></i></a> --}}
                  {{-- </p> --}}
                </div> {{-- end caption inside the include--}}
              </div> {{-- end thumbnail inside the include--}}
            </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
    </div>
    
@endsection