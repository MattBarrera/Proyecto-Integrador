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
                          <label class="control-label requiredField" for="productoNombre"> Name </label>
                          <input class="form-control" id="productoNombre" name="productoNombre" type="text" placeholder="ingrese un Nombre"/>
                        </div>
                        <div class="form-group ">
                          <label class="control-label " for="productoDescripcion">Description</label>
                          <textarea class="form-control" id="productoDescripcion" name="productoDescripcion" placeholder="ingrese una descripcion" rows="2"></textarea>
                        </div>
                        <div class="form-group ">
                          <label class="control-label requiredField" for="ProductoPrecio">Price<span class="asteriskField">*</span></label>
                          <input class="form-control" id="ProductoPrecio" name="ProductoPrecio" type="number" placeholder="ingrese un Precio"/>
                        </div>
                        <div class="form-group ">
                          <label class="control-label " for="categoriaIdParent">Category</label>
                          <select class="select form-control" id="categoriaIdParent" name="categoriaIdParent">
                            <option value="">Select a Category</option>
                            @foreach($categorias as $categoria)
                              <option value="{{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group ">
                          <label class="control-label " for="categoriaId">Sub Category</label>
                          <select class="select form-control form-control" id="categoriaId" name="categoriaId">
                            <option value="">First select a category</option>
                          </select>
                        </div>
                        <div class="form-group ">
                          <label class="control-label " for="productoComo">Upload Product As</label>
                          <select class="select form-control" id="productoComo" name="productoComo">
                            <option value="First Choice">First Choice</option>
                            <option value="Second Choice">Second Choice</option>
                            <option value="Third Choice">Third Choice</option>
                          </select>
                        </div>
                        <div class="form-group">

                          <div><button class="btn btn-primary " name="submit" type="submit">Submit</button></div>
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

@endsection
