$(document).ready(function(){ 
        var count = 1;
        $(document).on("click","#btnadd",function( event ) {  
        count++;
        // event.preventDefault();
        $('#tblprod tr:last').after('<tr id="row'+count+'"><td>{{$producto->productoNombre}}</td><td><div><select class="form-control" name="talleId[]">@foreach($talles as $talle)<option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>@endforeach</select></div></td><td><div><select class="form-control" name="colorId[]">@foreach($colores as $color)<option value="{{$color->colorId}}">{{$color->colorNombre}}</option>@endforeach</select></div></td> <td><input id="stockCantidad" type="tel" class="form-control" name="stockCantidad[]"></td><td><button type="button" name="remove" id="'+count+'" class="btn btn-danger btn_remove">X</button></td></td>  </tr>');
        })
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");  
           $('#row'+button_id+'').remove();  
        });  
    });