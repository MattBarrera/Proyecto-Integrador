@extends('layouts.app')

@section('content')

<div class="container">
  	<div class="page-header">
    	<h1>New Sub Category</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/SubCategorias">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('categoriaIdParent') ? ' has-error' : '' }}">
            <label for="categoriaIdParent" class="col-md-4 control-label">Category</label>

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
        <div class="form-group{{ $errors->has('categoriaNombre') ? ' has-error' : '' }}">
            <label for="categoriaNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="categoriaNombre" type="text" class="form-control" name="categoriaNombre" >
                @if ($errors->has('categoriaNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoriaNombre') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </div>
        </form>
</div>
@endsection
