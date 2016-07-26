@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post">
     <div class="form-group ">
      <label class="control-label requiredField" for="productoNombre">
       Nombre
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="productoNombre" name="productoNombre" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="message">
       Descripcion
      </label>
      <textarea class="form-control" cols="40" id="message" name="message" placeholder="ingrese una descripcion" rows="10"></textarea>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="ProductoPrecio">
       Precio
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="ProductoPrecio" name="ProductoPrecio" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="categoriaId">
       Sub Categoria
      </label>
      <select class="select form-control" id="categoriaId" name="categoriaId">
       <option value="First Choice">
        First Choice
       </option>
       <option value="Second Choice">
        Second Choice
       </option>
       <option value="Third Choice">
        Third Choice
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label " for="categoriaId">
       Sub Categoria
      </label>
      <select class="select form-control form-control" id="categoriaId" name="categoriaId">
       <option value="First Choice">
        First Choice
       </option>
       <option value="Second Choice">
        Second Choice
       </option>
       <option value="Third Choice">
        Third Choice
       </option>
      </select>
     </div>
     <div class="form-group ">
      <label class="control-label " for="productoComo">
       Subir Producto Como
      </label>
      <select class="select form-control" id="productoComo" name="productoComo">
       <option value="First Choice">
        First Choice
       </option>
       <option value="Second Choice">
        Second Choice
       </option>
       <option value="Third Choice">
        Third Choice
       </option>
      </select>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
