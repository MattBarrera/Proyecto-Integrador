@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>New Size</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="/Talles/{{$talle->talleId}}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group{{ $errors->has('talleNombre') ? ' has-error' : '' }}">
            <label for="talleNombre" class="col-md-4 control-label">Name:</label>
            <div class="col-md-6">
                <input id="talleNombre" type="text" class="form-control" name="talleNombre" value="{{$talle->talleNombre}}">
                @if ($errors->has('talleNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('talleNombre') }}</strong>
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
