@extends('layouts.app')

@section('content')
<form>
    <div class="form-group">
    <label>Nuevo Color</label>
    <input type="text" class="form-control" placeholder="Ingrese nuevo color">
    <input type="color" name="color" class="form-control">
  </div>
</form>
@endsection
