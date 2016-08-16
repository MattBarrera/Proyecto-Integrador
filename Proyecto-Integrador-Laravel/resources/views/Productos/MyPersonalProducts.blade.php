@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      @foreach($users as $user)
        <div class="page-header">
          <h1 style="display: inline-block">{{$user->full_name}}</h1>
          <a href="/Follow/User/{{$user->id}}" title="">
            <button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-check"></i> Following</button>
          </a>  
        </div>  
        <div class="row">
          <section id="productos">
            <div class="productos">
              @foreach($productos as $producto)
                @if($producto->users_id == $user->id)
                  <div class="col-xs-6 col-sm-3" >
                  <div class="thumbnail">
                    @include('Includes.producto', ['producto' => $producto])
                      <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                      </div> {{-- end caption inside the include--}}
                    </div> {{-- end thumbnail inside the include--}}
                  </div> {{-- end col-xs-6 col-sm-3 --}}
                @endif
              @endforeach
            </div>
          </section>
        </div>
      @endforeach
      @foreach($empresas as $empresa)
        <div class="page-header">
          <h1 style="display: inline-block">{{$empresa->empresaNombre}}</h1>
          <a href="/Follow/Empresa/{{$empresa->empresaId}}" title="">
            <button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-check"></i> Following</button>
          </a>   
        </div>
        <div class="row">
          <section id="productos">
            <div class="productos">
              @foreach($productos as $producto)
                @if($producto->empresaId == $empresa->empresaId)
                  <div class="col-xs-6 col-sm-3" >
                  <div class="thumbnail">
                    @include('Includes.producto', ['producto' => $producto])
                      <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                      </div> {{-- end caption inside the include--}}
                    </div> {{-- end thumbnail inside the include--}}
                  </div> {{-- end col-xs-6 col-sm-3 --}}
                @endif
              @endforeach
            </div>
          </section>
        </div>
      @endforeach
    </div>
@endsection