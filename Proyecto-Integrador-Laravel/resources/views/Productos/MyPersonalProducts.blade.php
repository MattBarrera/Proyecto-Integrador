@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
    {{-- {{dd($users)}} --}}
    @foreach($users as $user)
    <div class="page-header">
      <h1 style="display: inline-block">{{$user->full_name}}</h1>
        {{-- {{dd($follower)}} --}}
        {{-- @if(is_null($follower)) --}}
            {{-- <a href="/Follow/{{$user->id}}" title=""><button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-btn fa-user-plus"></i>Follow</button></a> --}}
        {{-- @else --}}
            <a href="/Follow/{{$user->id}}" title=""><button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-check"></i> Following</button></a>  
        {{-- @endif --}}
        
      </div>
      
      <div class="row">
        <section id="productos">
          <div class="productos">
            @foreach($productos as $producto)
            @if($producto->users_id == $user->id)
              <div class="col-xs-6 col-sm-3" >
                <div class="thumbnail">
                  <img src="/img/{{$producto->productoFoto}}" alt="" class="productoFoto">
                  <div class="caption">
                    <h3><a href="Productos/{{$producto->productoId}}" title="Details">{{$producto->productoNombre}}</a></h3>
                    <p>$ {{$producto->productoPrecio}}</p>
                    <p>{{$producto->categoria->categoriaNombre}}</p>
                    <p>Usuario: <a href="User/{{$producto->users_id}}" title="">{{$producto->usuario->full_name}}</a> </p>
                    <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                  </div>
                </div>
              </div>
              @endif
            @endforeach
          </div>
        </section>
      </div>
    @endforeach
    </div>
@endsection