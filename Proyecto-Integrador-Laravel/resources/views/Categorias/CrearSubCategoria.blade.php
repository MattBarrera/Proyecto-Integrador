@extends('layouts.app')

@section('content')
<form>
	<div class="form-group">
	    <select>
	    	<option value="default">Genero</option>
	    	<option>Clothing</option>
	    	<option>Shoes</option>
	    	<option>Accesories</option>
	    </select>
	</div>
  <div class="form-group">
	    <label>Nuevo Sub Categoria</label>
	    <input type="text" class="form-control" placeholder="Ingrese nuevo sub-genero">
	</div>
</form>
<div class="container">
  	<div class="page-header">
    	<h1>New Color</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Colores/">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('categoriaIdParent') ? ' has-error' : '' }}">
            <label for="categoriaIdParent" class="col-md-4 control-label">Genero</label>

            <div class="col-md-6">
            {{-- {{dd($generos)}} --}}
            <select name="categoriaIdParent" class="form-control" required>
                <option value="">Seleccionar un genero</option>
                @foreach($categorias as $categoria)
                    <option value="{{$genero->generoId}}">{{$genero->generoNombre}}</option>
                @endforeach
            </select>
                @if ($errors->has('categoriaIdParent'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoriaIdParent') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('colorNombre') ? ' has-error' : '' }}">
            <label for="colorNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="colorNombre" type="text" class="form-control" name="colorNombre" >
                @if ($errors->has('colorNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('colorNombre') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>
        </div>
        </form>
</div>
@endsection
