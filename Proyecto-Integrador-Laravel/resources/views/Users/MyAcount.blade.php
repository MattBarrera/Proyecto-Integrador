@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>My Acount</h1>
      </div>
      
      <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="/User/{{$user->id}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="col-md-4 control-label">Apellido</label>

                <div class="col-md-6">
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Telefono</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                <label for="gender" class="col-md-4 control-label">Genero</label>

                <div class="col-md-6">
                  <select id="gender" name="gender" class="form-control">
                    <option value="">Seleccionar un genero</option>
                    @foreach($generos as $genero)
                      @if($user->gender == $genero->generoId)
                        <option value="{{$genero->generoId}}" selected>{{$genero->generoNombre}}</option>}
                      @else
                        <option value="{{$genero->generoId}}">{{$genero->generoNombre}}</option>}
                      @endif
                    @endforeach
                  </select>
                    @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                <label for="birthdate" class="col-md-4 control-label">Fecha de Nacimiento</label>

                <div class="col-md-6">
                    <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ $user->birthdate }}">
                    @if ($errors->has('birthdate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('birthdate') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_anterior') ? ' has-error' : '' }}">
                <label for="avatar" class="col-md-4 control-label">Avatar</label>

                <div class="col-md-6">
                    <input id="avatar" type="file" class="form-control" name="avatar">

                    @if ($errors->has('avatar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_anterior') ? ' has-error' : '' }}">
                <label for="password_anterior" class="col-md-4 control-label">Password Anterior</label>

                <div class="col-md-6">
                    <input id="password_anterior" type="password" class="form-control" name="password_anterior">

                    @if ($errors->has('password_anterior'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_anterior') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        {{-- <i class="fa fa-btn fa-user"></i> --}} Actualizar
                    </button>
                </div>
            </div>
        </form>
      </div>

    </div>
@endsection