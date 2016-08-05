@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">My Products</a></li>
          {{-- <li><a href="#">Women</a></li>
          <li><a href="#">Clothes</a></li>
          <li><a href="#">Shoes</a></li>
          <li><a href="#">Accesories</a></li>
          <li class="active">Data</li> --}}
        </ol>
      </section>
    <div class="row">
    <div class="container">
    <div class="page-header">
      <h1 style="display: inline-block">My Products</h1>
        <a href="/Productos/create" title=""><button type="submit" class="btn btn-success pull-right btn-follower"> New Product</button></a>  
      </div>
        <div class="container">
            <section id="productos">
          <div class="productos">
            
            @foreach($productos as $producto)
            <div class="col-xs-6 col-sm-3" >
              @include('Includes.producto', ['producto' => $producto])
                <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-success" role="button">edit</a> 
                    <form action="/Productos/{{$producto->productoId}}/Baja" method="POST" class="form-delete">
                      {{csrf_field()}}
                      {{-- {{ method_field('delete') }} --}}
                      <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                  </div> {{-- end caption inside the include--}}
                </div> {{-- end thumbnail inside the include--}}
              </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
          </div>
        </section>
        </div>
    </div>
    </div>
</div>

@endsection
