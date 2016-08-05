@extends('layouts.app')

@section('content')
<!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">{{$user->full_name}}</h1>
        {{-- {{dd($follower)}} --}}
        @if(is_null($follower))
            <a href="/Follow/{{$user->id}}" title=""><button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-btn fa-user-plus"></i>Follow</button></a>
        @else
            <a href="/Follow/{{$user->id}}" title=""><button type="submit" class="btn btn-primary pull-right btn-follower"><i class="fa fa-check"></i> Following</button></a>  
        @endif
      </div>
      
      <div class="row">
        <section id="productos">
          <div class="productos">
            
            @foreach($productos as $producto)
              <div class="col-xs-6 col-sm-3" >
                    @include('Includes.producto', ['producto' => $producto])
                    <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                      </div> {{-- end caption inside the include--}}
                    </div> {{-- end thumbnail inside the include--}}
                  </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
          </div>
        </section>
        
      </div>

    </div>
@endsection