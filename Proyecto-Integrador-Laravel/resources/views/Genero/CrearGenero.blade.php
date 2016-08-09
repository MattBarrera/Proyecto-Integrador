@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>New Gender</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Genero/">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" >
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
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
