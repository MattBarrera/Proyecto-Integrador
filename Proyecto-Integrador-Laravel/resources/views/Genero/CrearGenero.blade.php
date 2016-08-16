@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>New Gender</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Generos">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('generoNombre') ? ' has-error' : '' }}">
            <label for="generoNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="generoNombre" type="text" class="form-control" name="generoNombre" >
                @if ($errors->has('generoNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('generoNombre') }}</strong>
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
