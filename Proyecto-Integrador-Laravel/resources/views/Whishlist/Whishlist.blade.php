@extends('layouts.app')
@section('title')
  - Whishlist
@endsection
@section('content')
<div class="container-fluid">
  <section id="breadcrumb">
    <ol class="breadcrumb">
      <li class="active"><a href="#">Whishlist</a></li>
    </ol>
  </section>
  <div class="container">
    <div class="page-header">
      <h1 style="display: inline-block">Whishlist</h1>
    </div>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Avatar</th>
          <th>Name</th>
          <th>Detalls</th>
          <th>Price</th>
          <th>Edit</th>
          <th>SubTotal</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="5" style="text-align: right">Sub Total</th>
          <th colspan="1">$ {{Cart::instance('wishlist')->subtotal()}}</th>
        </tr>
        <tr>
          <td colspan="5" style="text-align: right">Tax</td>
          <td colspan="1">$ {{Cart::instance('wishlist')->tax()}}</td>
        </tr>
        <tr>
          <th colspan="5" style="text-align: right">Total</th>
          <th colspan="1">$ {{Cart::instance('wishlist')->total()}}</th>
        </tr>
      </tfoot>
      <tbody>
        @if(Cart::count() !== 0)
          @foreach(Cart::instance('wishlist')->content() as $producto)
            <tr>
              <td>
                <img src="/assets/{{$producto->options->userId}}/products/{{$producto->options->productoFoto}}" alt="" width="60" height="60">{{-- {{$producto->rowId}} --}}
              </td>
              <td><a href="/Productos/{{$producto->id}}" title="">{{$producto->name}}</a></td>
              <td>
                <ul style="list-style: none">
                  <li>Description:{{$producto->price}}</li>
                  @foreach($talles as $talle)
                    @if($talle->talleId == $producto->options->size)
                      <li>Size: {{$talle->talleNombre}}</li>
                    @endif
                  @endforeach
                  @foreach($colores as $color)
                    @if($color->colorId == $producto->options->color)
                      <li>Color: {{$color->colorNombre}}</li>
                    @endif
                  @endforeach
                </ul>
              </td>
              <td>$ {{$producto->price}}</td>
                <td>
                  <a href="/Whishlist/{{$producto->productoId}}/switchToCart" title=""><button type="button" class="btn btn-success" data-toggle="modal" data-target="#addToCartModal" data-whatever="{{$producto->id}}">Add to Cart </button></a>
                  <form action="/Whishlist/{{$producto->rowId}}" method="POST" class="form-delete">
                    {{csrf_field()}}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                  </form>
                </td>
              <td>$ {{$producto->subtotal}}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="7" class="warning">No products in your Wishlist</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>


@endsection

@section('extra-js')
  <script src="/js/modalAddToCart.js" type="text/javascript"></script>
@endsection
