@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <!-- aca va el titulo del producto -->
      <div class="page-header">
        <h1>{{$producto->productoNombre}}</h1>
      </div>
      @if (session()->has('success_message'))
            <div class="alert alert-success" id="closeAlert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('success_message') }}
            </div>
        @endif
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
          <form action="/Shop" method="POST" id="fromProducto">
            {{ csrf_field() }}
            <input type="hidden" name="productoId" id="productoId" value="{{$producto->productoId}}">
            <!-- precio del producto -->
            <h3><strong>$ {{$producto->productoPrecio}}<sup>00</sup></strong></h3>
              <!-- Color del producto con el titulo -->
              <h3>Color:</h3>
            {{-- @if(count($producto->color)>0)  --}}
                <div id="colorId">
              @foreach($stocks as $stock)
                <label for="{{$stock->color->colorId}}" class="radio-inline">
                  <input type="radio" id="{{$stock->color->colorId}}" name="colorId" value="{{$stock->color->colorId}}">{{$stock->color->colorNombre}}
                </label>
              @endforeach
                </div>
            {{-- @endif  --}}
              <!-- precio del producto con el titulo -->
              <h3>Size:</h3>
            {{-- @if(count($producto->talle)>0) --}}
                <div id="talles" style="margin-bottom: 2em;" required>
                </div>
            {{-- @endif --}}
            {{-- <input type="submit" class="btn btn-success" value="Buy"></input> --}}
            {{-- <a type="submit" class="btn btn-primary" role="button">Buy</a> --}}
            {{-- <a href="/Shop/{{$producto->productoId}}" class="btn btn-success" role="button">Buy</a> --}}
            {{-- @if($producto->getStokTotalAttribute() == 0) --}}
              {{-- <p class="sinStock">Sin Stock</p> --}}
              {{-- <button type="button" class="btn btn-success" id="buy" disabled="disabled">Buy</button> --}}
            {{-- @else --}}
              <button type="submit" class="btn btn-success" id="buy" formaction="/Shop" >Buy</button>
            {{-- @endif --}}
              {{-- <div id="buttons" >style="display: inline-block;
                
              </div> --}}
                <button type="submit" class="btn btn-primary" formaction="/Whishlist" >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                  </button>
            {{-- <a href="/Whishlist/{{$producto->productoId}}" class="btn btn-primary" role="button"><i class="fa fa-heart-o" aria-hidden="true"></i></a> --}}
            {{-- <button type="submit" class="btn btn-primary" formaction="/Whishlist/{{$producto->productoId}}"><i class="fa fa-heart-o" aria-hidden="true"></i></button> --}}
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
@section('extra-js')   
  <script src="/js/talles.js" type="text/javascript"></script>
  <script src="/js/closeAlert.js" type="text/javascript"></script>
@endsection