@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>Edit Color</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Colores/{{$color->colorId}}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group{{ $errors->has('colorNombre') ? ' has-error' : '' }}">
            <label for="colorNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="colorNombre" type="text" class="form-control" name="colorNombre" value="{{$color->colorNombre}}">
                @if ($errors->has('colorNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('colorNombre') }}</strong>
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
