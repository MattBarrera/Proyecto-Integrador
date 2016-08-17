@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Cart</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">Cart</h1>
      </div>
      @if (session()->has('success_message'))
            <div class="alert alert-success" id="closeAlert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{ session()->get('success_message') }}
            </div>
        @endif
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              {{-- <tr>
                <th colspan="2">Category</th>
                <th colspan="2">Sub Category</th>
                <th>Edit</th>
              </tr> --}}
              <tr>
                <th class="table-image">Avatar</th>
                <th>Name</th>
                <th>Detalls</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Edit</th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="6" style="text-align: right">Sub Total</th>
                <th colspan="1">{{Cart::subtotal()}}</th>
              </tr>
              <tr>
                {{-- <td colspan="2">&nbsp;</td> --}}
                <td colspan="6" style="text-align: right">Tax</td>
                <td colspan="1">{{Cart::tax()}}</td>
              </tr>
              <tr>
                {{-- <td colspan="2">&nbsp;</td> --}}
                <th colspan="6" style="text-align: right">Total</th>
                <th colspan="1">{{Cart::total()}}</th>

              </tr>
            </tfoot>
            <tbody>
              @if(Cart::count() !== 0)
                @foreach(Cart::content() as $producto)
                  {{-- {{dd($producto->options->color)}} --}}
                  
                  <tr>
                    <td class="table-image">
                      <img src="/assets/{{$producto->options->userId}}/products/{{$producto->options->productoFoto}}" alt="" width="60" height="60" class="img-thumbnail">{{-- {{$producto->rowId}} --}}
                    </td>
                    <td><a href="/Productos/{{$producto->id}}" title="">{{$producto->name}}</a></td>
                    <td>
                      <ul style="list-style: none">
                        <li>Description:{{$producto->price}}</li>
                        {{-- @if($producto->options->size != NULL) --}}
                          @foreach($talles as $talle)
                            @if($talle->talleId == $producto->options->size)
                              <li>Size: {{$talle->talleNombre}}</li>
                            @endif
                          @endforeach
                        {{-- @endif --}}
                        {{-- @if($producto->options->color) --}}
                          @foreach($colores as $color)
                            @if($color->colorId == $producto->options->color)
                              <li>Color: {{$color->colorNombre}}</li>
                            @endif
                          @endforeach
                        {{-- @endif --}}
                      </ul>
                    </td>
                    <td>$ {{$producto->price}}</td>
                   {{--  <form action="/Shop/{{$producto->rowId}}/update" method="POST" class="form-delete">
                        {{csrf_field()}} --}}
                      <td>
                        {{-- <input class="form-control" type="number" value="{{$producto->qty}}" id="productoQty" name="productoQty" style="text-align: center"> --}}
                        <select class="quantity form-control" data-id="{{ $producto->rowId }}" >
                          @if(Cart::stock($producto->id,$producto->options->color,$producto->options->size) == 0)
                            <option value="1">Sin Stock</option>
                          @else
                            @for ($i = 1; $i <= Cart::stock($producto->id,$producto->options->color,$producto->options->size); $i++)
                              <option value="{{$i}}" {{ $producto->qty == $i ? 'selected' : '' }} >{{$i}}</option>
                            @endfor
                          @endif
                        </select>
                      </td>
                      <td>
                    </form>
                      <form action="/Shop/{{$producto->rowId}}" method="POST" class="form-delete">
                        {{csrf_field()}}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                      </form>
                    </td>
                    <td>{{$producto->subtotal}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="7" class="warning" ">No products in your Cart</td>
                </tr>
              @endif
            </tbody>
          </table>
          <a href="/Store" title="" class=""><button type="button" class="btn btn-primary">Continue Shopping</button></a>
          <a href="/Shop/CheckOut" title="" class="pull-right"><button type="button" class="btn btn-primary">Check Out</button></a>
      </div>
    </div>
</div>

@endsection
@section('extra-js')
    
<script src="/js/quantity.js" type="text/javascript"></script>
<script src="/js/closeAlert.js" type="text/javascript"></script>
@endsection
