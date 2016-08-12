@extends('layouts.app')

@section('content')

<div class="container">
  	<div class="page-header">
    	<h1>Admin's</h1>
  	</div>

    <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{$user->usuario->full_name}} {{$user->empresaOwner == 1 ?'(Owner)':''}}</td>
                  <td>{{$user->usuario->email}}</td>
                  <td>
                  {{-- {{dd($user->users_id)}} --}}
                  @if($user->empresaOwner !== 1)
                    <form action="/Empresa/{{$empresaId}}/destroyAdmin" method="POST" class="form-delete">
                        {{csrf_field()}}
                        {{ method_field('delete') }}
                        <input type="hidden" name="inputHidden" value="{{$user->users_id}}">
                        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    </form>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      @if (session()->has('errors'))
            <div class="alert alert-danger alert-dismissible fade in" id="closeAlert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <center><p>{{ session()->get('errors')->first() }}</p></center>
            </div>
        @endif
	<form class="form-horizontal" role="form" method="POST" action="/Empresa/{{$empresaId}}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Email:</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" >
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-success"><i class="fa fa-btn fa-user-plus" aria-hidden="true"></i> Add Admin</button>
            </div>
        </div>
        </form>
</div>
@endsection
@section('extra-js')
<script src="/js/closeAlert.js" type="text/javascript"></script>
@endsection
