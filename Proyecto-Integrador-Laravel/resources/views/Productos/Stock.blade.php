@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1 style="display: inline-block">New Stock</h1>
        <button type="submit" class="btn btn-primary pull-right btn-follower" id="btnadd">Add Stock</button>
        {{-- <button id="btnadd" class="btn btn-primary">Agregar Nuevo</button> --}}
    </div>
    <form class="form-horizontal" role="form" method="POST" action="/Stock/">
        {{ csrf_field() }}
        <input type="hidden" name="productoId" id="productoId" value="{{$producto->productoId}}">
        {{-- <input type="hidden" name="stockOptions" value="1" id="stockOptions"> --}}
        <table id="tblprod" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$producto->productoNombre}}</td>
                    <td>
                        <div>
                            <select class="form-control" name="talleId[]">
                                @foreach($talles as $talle)
                                  <option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div>
                            <select class="form-control" name="colorId[]">
                                @foreach($colores as $color)
                                  <option value="{{$color->colorId}}">{{$color->colorNombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td> 
                    <td>
                        <input id="stockCantidad" type="tel" class="form-control" name="stockCantidad[]">
                    </td> 
                    <td><button type="button" name="remove" id="1" class="btn btn-danger btn_remove">X</button></td></td>
                </tr>
            </tbody>
        </table>
        <input type="submit" id="submit" class="btn btn-success pull-right" value="Save" />  
    </form>

</div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        var count = 1;
        $(document).on("click","#btnadd",function( event ) {  
        count++;
            event.preventDefault();
            $('#tblprod tr:last').after('<tr><td>prubea</td><td><div><select class="form-control" name="talleId[]">@foreach($talles as $talle)<option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>@endforeach</select></div></td><td><div><select class="form-control" name="colorId[]">@foreach($colores as $color)<option value="{{$color->colorId}}">{{$color->colorNombre}}</option>@endforeach</select></div></td> <td><input id="stockCantidad" type="tel" class="form-control" name="stockCantidad[]"></td><td><button type="button" name="remove" id="'+count+'" class="btn btn-danger btn_remove">X</button></td></td>  </tr>');

            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
            });  
        })
    });

    </script>
@endsection
