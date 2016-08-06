@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Empresas</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/empresas') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
                            <label for="mail" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="mail" type="mail" class="form-control" name="mail">

                                @if ($errors->has('mail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cuit') ? ' has-error' : '' }}">
                            <label for="cuit" class="col-md-4 control-label">CUIT</label>

                            <div class="col-md-6">
                                <input id="cuit" type="number" class="form-control" name="cuit">

                                @if ($errors->has('cuit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cuit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="telefono" type="number" class="form-control" name="telefono">

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion">

                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fechaAlta') ? ' has-error' : '' }}">
                            <label for="fechaAlta" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <input id="fechaAlta" type="date" class="form-control" name="fechaAlta">

                                @if ($errors->has('fechaAlta'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fechaAlta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                            <label for="usuario" class="col-md-4 control-label">User</label>

                            <div class="col-md-6">
                                <input id="usuario" type="text" class="form-control" name="usuario">

                                @if ($errors->has('usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Update
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
