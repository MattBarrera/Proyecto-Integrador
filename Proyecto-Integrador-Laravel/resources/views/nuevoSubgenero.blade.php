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
	    <label>Nuevo Sub-genero</label>
	    <input type="text" class="form-control" placeholder="Ingrese nuevo sub-genero">
	</div>
</form>
@endsection
