@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Agregar Producto</h1>
      </div>
      <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="/Productos" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- <input name="_method" type="hidden" value="PUT"> --}}
            <div class="form-group{{ $errors->has('productoNombre') ? ' has-error' : '' }}">
                <label for="productoNombre" class="col-md-4 control-label">Name:</label>
                <div class="col-md-6">
                    <input id="productoNombre" type="text" class="form-control" name="productoNombre" placeholder="ingrese un nombre">
                    @if ($errors->has('productoNombre'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoNombre') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('productoDescripcion') ? ' has-error' : '' }}">
                <label for="productoDescripcion" class="col-md-4 control-label">Description:</label>
                <div class="col-md-6">
                    <input id="productoDescripcion" type="text" class="form-control" name="productoDescripcion" placeholder="ingrese una descripcion">
                    @if ($errors->has('productoDescripcion'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoDescripcion') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('productoPrecio') ? ' has-error' : '' }}">
                <label for="productoPrecio" class="col-md-4 control-label">Price:</label>
                <div class="col-md-6">
                    <input id="productoPrecio" type="number" class="form-control" name="productoPrecio"  placeholder="ingrese un precio">
                    @if ($errors->has('productoPrecio'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoPrecio') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('generoId') ? ' has-error' : '' }}">
                <label for="generoId" class="col-md-4 control-label">Gender</label>
                <div class="col-md-6">
                  <select id="generoId" name="generoId" class="form-control">
                    <option value="">Select a Gender</option>
                    @foreach($generos as $genero)
                        <option value="{{$genero->generoId}}">{{$genero->generoNombre}}</option>}
                    @endforeach
                  </select>
                    @if ($errors->has('generoId'))
                        <span class="help-block">
                            <strong>{{ $errors->first('generoId') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                <label for="categoriaIdParent" class="col-md-4 control-label">Category:</label>
                <div class="col-md-6">
                  <select id="categoriaIdParent" name="categoriaIdParent" class="form-control">
                    <option value="">Select a Category</option>
                    @foreach($categorias as $categoria)
                      <option value="{{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('categoria'))
                        <span class="help-block">
                            <strong>{{ $errors->first('categoria') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
              <label for="categoriaId" class="col-md-4 control-label">Sub Category:</label>
              <div class="col-md-6">
                <select id="categoriaId" name="categoriaId" class="form-control">
                  <option value="">First select a category</option>
                </select>
                  @if ($errors->has('gender'))
                      <span class="help-block">
                          <strong>{{ $errors->first('gender') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            {{-- <div class="form-group{{ $errors->has('colorId') ? ' has-error' : '' }}">
                <label for="colorId" class="col-md-4 control-label">Color:</label>
                <div class="col-md-6">
                  <select id="colorId" required name="colorId[]" class="form-control selectpicker" multiple="multiple" title="Seleccionar un Color">
                    @foreach($colores as $color)
                      <option value="{{$color->colorId}}">{{$color->colorNombre}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('colorId'))
                        <span class="help-block">
                            <strong>{{ $errors->first('colorId') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('talleId') ? ' has-error' : '' }}">
                <label for="talleId" class="col-md-4 control-label">Size:</label>
                <div class="col-md-6">
                  <select id="talleId" required name="talleId[]" class="form-control selectpicker" multiple="multiple" title="Seleccionar un Talle">
                    <option value="">Select a Size</option>
                    @foreach($talles as $talle)
                      <option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('talleId'))
                        <span class="help-block">
                            <strong>{{ $errors->first('talleId') }}</strong>
                        </span>
                    @endif
                </div>
            </div> --}}
            <div class="form-group{{ $errors->has('productoFoto') ? ' has-error' : '' }}">
                <label for="productoFoto" class="col-md-4 control-label">Product Picture:</label>
                <div class="col-md-6">
                    <input id="productoFoto" type="file" class="form-control" name="productoFoto">
                    @if ($errors->has('productoFoto'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoFoto') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
              <label for="empresaId" class="col-md-4 control-label">Upload As:</label>
              <div class="col-md-6">
                  {{-- {{dd($empresas)}} --}}
                <select id="empresaId" name="empresaId" class="form-control">
                  <option value="">{{Auth::user()->full_name}}</option>
                    <optgroup label="Empresas">
                  @foreach($empresas as $empresa)
                      <option value="{{$empresa->empresaId}}">{{$empresa->empresa->empresaNombre}}</option>
                    </optgroup>
                  @endforeach
                </select>
                  @if ($errors->has('user'))
                    <span class="help-block">
                      <strong>{{ $errors->first('user') }}</strong>
                    </span>
                  @endif
              </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-success">
                        {{-- <i class="fa fa-btn fa-user"></i> --}} Add Product
                    </button>
                </div>
            </div>
        </form>
      </div>

    </div>
</div>
@endsection
@section('extra-js')   
  <script src="/js/categorias.js" type="text/javascript"></script>
@endsection
