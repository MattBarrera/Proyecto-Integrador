@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Agregar Producto</h1>
      </div>
      <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="/Productos" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group{{ $errors->has('productoNombre') ? ' has-error' : '' }}">
                <label for="productoNombre" class="col-md-4 control-label">Nombre:</label>
                <div class="col-md-6">
                    <input id="productoNombre" type="text" class="form-control" name="productoNombre" placeholder="ingrese un nombre" value="{{$producto->productoNombre}}">
                    @if ($errors->has('productoNombre'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoNombre') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('productoDescripcion') ? ' has-error' : '' }}">
                <label for="productoDescripcion" class="col-md-4 control-label">Descripcion:</label>
                <div class="col-md-6">
                    <input id="productoDescripcion" type="text" class="form-control" name="productoDescripcion" placeholder="ingrese una descripcion" value="{{$producto->productoDescripcion}}">
                    @if ($errors->has('productoDescripcion'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoDescripcion') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('productoPrecio') ? ' has-error' : '' }}">
                <label for="productoPrecio" class="col-md-4 control-label">Precio:</label>
                <div class="col-md-6">
                    <input id="productoPrecio" type="number" class="form-control" name="productoPrecio"  placeholder="ingrese un precio" value="{{$producto->productoPrecio}}">
                    @if ($errors->has('productoPrecio'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoPrecio') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('generoId') ? ' has-error' : '' }}">
                <label for="generoId" class="col-md-4 control-label">Genero</label>
                <div class="col-md-6">
                  <select id="generoId" name="generoId" class="form-control">
                    <option value="">Seleccionar un genero</option>
                    @foreach($generos as $genero)
                      @if($producto->generoId == $genero->generoId)
                        <option value="{{$genero->generoId}}" selected>{{$genero->generoNombre}}</option>}
                      @else
                        <option value="{{$genero->generoId}}">{{$genero->generoNombre}}</option>}
                      @endif
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
                <label for="categoriaIdParent" class="col-md-4 control-label">Categoria:</label>
                <div class="col-md-6">
                  <select id="categoriaIdParent" name="categoriaIdParent" class="form-control">
                    <option value="">Seleccionar una Categoria</option>
                    @foreach($categorias as $categoria)
                      @if($producto->categoriaIdParent == $categoria->categoriaId || $producto->categoriaIdParent == 0 && $producto->categoriaId == $categoria->categoriaId)
                        <option value="{{$categoria->categoriaId}}" selected>{{$categoria->categoriaNombre}}</option>
                      @else
                        <option value="{{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</option>
                      @endif
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
              <label for="categoriaId" class="col-md-4 control-label">Sub Categoria:</label>
              <div class="col-md-6">
              <input type="hidden" name="" id="categoriaIdHidden" value="{{$producto->categoriaId}}">
                <select id="categoriaId" name="categoriaId" class="form-control">
                  <option value="">Primero seleccione una Categoria</option>
                    
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
                  <select id="colorId" required name="colorId[]" class="form-control selectpicker" multiple="multiple" title="Seleccionar un Color" value="{{$producto->}}">
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
            </div> --}}
            <div class="form-group{{ $errors->has('talleId') ? ' has-error' : '' }}">
                <label for="talleId" class="col-md-4 control-label">Talle:</label>
                <div class="col-md-6">
                  <select id="talleId" required name="talleId[]" class="form-control selectpicker" multiple="multiple" title="Seleccionar un Talle">
                    <option value="">Seleccionar un Talle</option>
                    @foreach($talles as $talle)
                      {{-- @if($producto->talleId) --}}
                      <option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('talleId'))
                        <span class="help-block">
                            <strong>{{ $errors->first('talleId') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('productoFoto') ? ' has-error' : '' }}">
                <label for="productoFoto" class="col-md-4 control-label">Foto Producto:</label>
                <div class="col-md-6">
                  @if($producto->productoFoto == 'artsinfoto.gif')
                    <img src="/assets/{{$producto->productoFoto}}" alt="" width="200" height="200" class="img-thum">
                  @else
                    <img src="/assets/{{$producto->users_id}}/products/{{$producto->productoFoto}}" alt="" width="200" height= class="img-thum""200" class="img-thum">
                  @endif
                    <input id="productoFoto" type="file" class="form-control" name="productoFoto">
                    @if ($errors->has('productoFoto'))
                      <span class="help-block">
                        <strong>{{ $errors->first('productoFoto') }}</strong>
                      </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
              <label for="empresaId" class="col-md-4 control-label">Subir Como:</label>
              <div class="col-md-6">
                  {{-- {{dd($empresas)}} --}}
                <select id="empresaId" name="empresaId" class="form-control">
                  @if($producto->empresaId == 0)
                    <option value="" selected>{{Auth::user()->full_name}}</option>
                  @else
                    <option value="">{{Auth::user()->full_name}}</option>
                  @endif
                  @if($producto->empresaId != 0)
                    <optgroup label="Empresas">
                      @foreach($empresas as $empresa)
                        @if($producto->empresaId == $empresa->empresaId)
                          <option value="{{$empresa->empresaId}}" selected>{{$empresa->empresa->empresaNombre}}</option>
                        @else
                          <option value="{{$empresa->empresaId}}">{{$empresa->empresa->empresaNombre}}</option>
                        @endif
                      @endforeach
                    </optgroup>
                  @endif
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
                        {{-- <i class="fa fa-btn fa-user"></i> --}} Agregar Prodcuto
                    </button>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>
<script src="/js/categoriasEdit.js" type="text/javascript"></script>
@endsection
