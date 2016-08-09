@extends('layouts.app')

@section('content')

<div class="container">
  	<div class="page-header">
    	<h1>New Sub Category</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Colores/">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('categoriaIdParent') ? ' has-error' : '' }}">
            <label for="categoriaIdParent" class="col-md-4 control-label">Categoria</label>

            <div class="col-md-6">
            {{-- {{dd($generos)}} --}}
            <select name="categoriaIdParent" class="form-control" required>
                <option value="">Seleccionar una Categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->categoriaId}}">{{$categoria->categoriaNombre}}</option>
                @endforeach
            </select>
                @if ($errors->has('categoriaIdParent'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoriaIdParent') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('categoriaId') ? ' has-error' : '' }}">
            <label for="categoriaId" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="categoriaId" type="text" class="form-control" name="categoriaId" >
                @if ($errors->has('categoriaId'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoriaId') }}</strong>
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
