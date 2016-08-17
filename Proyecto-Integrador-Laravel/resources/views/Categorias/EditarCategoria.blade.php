@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>New Category</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Categorias/{{$categoria->categoriaId}}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group{{ $errors->has('categoriaNombre') ? ' has-error' : '' }}">
            <label for="categoriaNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="categoriaNombre" type="text" class="form-control" name="categoriaNombre" value="{{$categoria->categoriaNombre}}">
                @if ($errors->has('categoriaNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categoriaNombre') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
        </div>
        </form>
</div>
@endsection
