@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1 style="display: inline-block">Stock for <a href="/Productos/{{$producto->productoId}}" title="">{{$producto->productoNombre}}</a></h1>
        <button type="submit" class="btn btn-primary pull-right btn-follower" id="btnadd">Add Stock</button>
        {{-- <button id="btnadd" class="btn btn-primary">Agregar Nuevo</button> --}}
    </div>
    <form class="form-horizontal" role="form" method="POST" action="/Stock/{{$producto->productoId}}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <input type="hidden" name="productoId" id="productoId" value="{{$producto->productoId}}">
        {{-- <input type="hidden" name="stockOptions" value="1" id="stockOptions"> --}}
        <table id="tblprod" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            {{-- {{dd(count($stocks))}} --}}
            @if(count($stocks) == 0)
                @php($index = 0)
            @endif
                @foreach($stocks as $index => $stock)
                {{-- {{dd($stock)}} --}}
                {{-- $index+1 --}}
                <tr id="row{{$index}}">
                    <td><a href="/Productos/{{$producto->productoId}}" title="">{{$producto->productoNombre}}</a></td>
                    <td>
                        <div>
                            <select class="form-control" name="talleId[]">
                                @foreach($talles as $talle)
                                    @if($stock->talleId == $talle->talleId)
                                        <option value="{{$talle->talleId}}" selected>{{$talle->talleNombre}}</option>
                                    @else
                                        <option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div>
                            <select class="form-control" name="colorId[]">
                                @foreach($colores as $color)
                                  @if($stock->colorId == $color->colorId)
                                        <option value="{{$color->colorId}}" selected>{{$color->colorNombre}}</option>
                                    @else
                                        <option value="{{$color->colorId}}">{{$color->colorNombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </td> 
                    <td>
                        <input id="stockCantidad" type="tel" class="form-control" name="stockCantidad[]" value="{{$stock->stockCantidad}}">
                    </td> 
                    <td><button type="button" name="remove" id="{{$index}}" class="btn btn-danger btn_remove">X</button></td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <input type="submit" id="submit" class="btn btn-success pull-right" value="Save" />  
    </form>

</div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if ({{$index}} == 0) {
            var count = 0;
            // alert("message")
        }else{
            var count = {{$index}};
            // alert("message2")
        }

        $(document).on("click","#btnadd",function( event ) {  
        count++;
        // event.preventDefault();
        $('#tblprod tr:last').after('<tr id="row'+count+'"><td><a href="/Productos/{{$producto->productoId}}" title="">{{$producto->productoNombre}}</a></td><td><div><select class="form-control" name="talleId[]">@foreach($talles as $talle)<option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>@endforeach</select></div></td><td><div><select class="form-control" name="colorId[]">@foreach($colores as $color)<option value="{{$color->colorId}}">{{$color->colorNombre}}</option>@endforeach</select></div></td> <td><input id="stockCantidad" type="tel" class="form-control" name="stockCantidad[]"></td><td><button type="button" name="remove" id="'+count+'" class="btn btn-danger btn_remove">X</button></td></td>  </tr>');
        })
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");  
           $('#row'+button_id+'').remove();  
        });  
    });

    </script>
@endsection
@section('extra-js')
    {{-- <script src="/js/addInput.js" type="text/javascript"></script> --}}
@endsection
