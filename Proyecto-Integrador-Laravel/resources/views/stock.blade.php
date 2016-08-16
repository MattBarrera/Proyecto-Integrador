@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="page-header">
    	<h1>New Category</h1>
  	</div>
	<form class="form-horizontal" role="form" method="POST" action="">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="waistStock" class="col-md-4 control-label">Waist</label>
            <div class="col-md-6">
                <select>
                    @foreach($talles as $talle)
                      <option value="{{$talle->talleId}}">{{$talle->talleNombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="colorStock" class="col-md-4 control-label">Color</label>
            <div class="col-md-6">
                <select>
                    @foreach($colores as $color)
                      <option value="{{$color->colorId}}">{{$color->colorNombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="cantidadStock" class="col-md-4 control-label">Quantity</label>
            <div class="col-md-6">
                <input id="cantidadStock" type="tel" class="form-control" name="cantidadStock">
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
