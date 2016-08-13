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
        {{-- <a href="/SubCategorias/create" title="" >
          <button type="submit" class="btn btn-success pull-right btn-follower" style="margin-left:10px"> New Sub Categoria</button>
        </a>
        <a href="/Categorias/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Categoria</button>
        </a> --}}
      </div>
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              {{-- <tr>
                <th colspan="2">Category</th>
                <th colspan="2">Sub Category</th>
                <th>Edit</th>
              </tr> --}}
              <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Price</th>
                {{-- <th>Quantity</th> --}}
                <th>Edit</th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="4" style="text-align: right">Sub Total</th>
                <th colspan="1">$ {{Cart::instance('wishlist')->subtotal()}}</th>
              </tr>
              {{-- <tr>
                <td colspan="4" style="text-align: right">Tax</td>
                <td colspan="1">$ {{Cart::instance('wishlist')->tax()}}</td>
              </tr> --}}
              <tr>
                <th colspan="4" style="text-align: right">Total</th>
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
                    <td>$ {{$producto->price}}</td>
                   {{--  <form action="/Shop/{{$producto->rowId}}/update" method="POST" class="form-delete">
                        {{csrf_field()}} --}}
                      {{-- <td><input class="form-control" type="number" value="{{$producto->qty}}" name="productoQty" style="text-align: center"></td> --}}
                      <td>
                        {{-- <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Add to cart</button></a> --}}
                        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addToCartModal" data-productId="{{$producto->id}}">
                          Add to cart
                        </button> --}}
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addToCartModal" data-whatever="{{$producto->id}}">Add to Cart </button>
                        
                          <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="addToCartModalLabel"></h4>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label" style="text-align: left">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                  </div>
                                  <div class="radio-inline">
                                      {{-- @foreach($colores as $color) --}}
                                    <label>
                                      <input type="radio" name="optionsRadios" id="optionsRadios" value="option1" checked>
                                      Color 1
                                    </label>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                    </form>
                      <form action="/Whishlist/{{$producto->rowId}}" method="POST" class="form-delete">
                        {{csrf_field()}}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                      </form>
                    </td>
                    <td>$ {{$producto->subtotal}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="6" class="warning" ">No products in your Wishlist</td>
                </tr>
              @endif
            </tbody>
          </table>
      </div>
    </div>
</div>


@endsection

@section('extra-js')
<script src="/js/modalAddToCart.js" type="text/javascript"></script>
@endsection
