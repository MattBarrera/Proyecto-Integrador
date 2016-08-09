@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Editar Empresa</h1>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="/Empresa/{{$empresa->empresaId}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
            <label for="empresaNombre" class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input id="empresaNombre" type="text" class="form-control" name="empresaNombre" value="{{ $empresa->empresaNombre }}">

                @if ($errors->has('empresaNombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaNombre') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('empresaEmail') ? ' has-error' : '' }}">
            <label for="empresaEmail" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="empresaEmail" type="empresaEmail" class="form-control" name="empresaEmail" value="{{$empresa->empresaEmail}}">

                @if ($errors->has('empresaEmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaEmail') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('empresaCUIT') ? ' has-error' : '' }}">
            <label for="empresaCUIT" class="col-md-4 control-label">CUIT</label>

            <div class="col-md-6">
                <input id="empresaCUIT" type="number" class="form-control" name="empresaCUIT" value="{{$empresa->empresaCUIT}}">

                @if ($errors->has('empresaCUIT'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaCUIT') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('empresaTelefono') ? ' has-error' : '' }}">
            <label for="empresaTelefono" class="col-md-4 control-label">Phone Number</label>

            <div class="col-md-6">
                <input id="empresaTelefono" type="tel" class="form-control" name="empresaTelefono" value="{{$empresa->empresaTelefono}}">

                @if ($errors->has('empresaTelefono'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaTelefono') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('empresaDireccion') ? ' has-error' : '' }}">
            <label for="empresaDireccion" class="col-md-4 control-label">Address</label>

            <div class="col-md-6">
                <input id="empresaDireccion" type="text" class="form-control" name="empresaDireccion" value="{{$empresa->empresaDireccion}}">

                @if ($errors->has('empresaDireccion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaDireccion') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('empresaFoto') ? ' has-error' : '' }}">
            <label for="empresaFoto" class="col-md-4 control-label">Avatar</label>

            <div class="col-md-6">
                <input id="empresaFoto" type="file" class="form-control" name="empresaFoto" value="{{$empresa->empresaFoto}}">

                @if ($errors->has('empresaFoto'))
                    <span class="help-block">
                        <strong>{{ $errors->first('empresaFoto') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success">
                   Edit
                </button>

            </div>
        </div>
    </form>
</div>
@endsection
