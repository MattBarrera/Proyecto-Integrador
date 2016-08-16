@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Store</a></li>
        </ol>
      </section>
    <div class="row">
    <div class="container">
        <div class="col-md-10 container">
            <section id="productos">
              <div class="productos">
                <div class="row">
                @foreach($productos as $producto)
                <div class="col-xs-6 col-sm-3" >
                  @include('Includes.producto', ['producto' => $producto])
                    <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-primary" role="button">Edit</a> 
                    <a href="Productos/{{$producto->productoId}}/ReActivar" class="btn btn-success" role="button">Re Activate</a> 

                    </div> {{-- end caption --}}
                  </div> {{-- end thumbnail --}}
                </div> {{-- end col-xs-6 col-sm-3 --}}
                @endforeach
              </div>
            </section>
        </div>
    </div>
    </div>
</div>

@endsection
