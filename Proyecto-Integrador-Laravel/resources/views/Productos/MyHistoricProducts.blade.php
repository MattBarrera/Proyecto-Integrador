@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Store</a></li>
          {{-- <li><a href="#">Women</a></li>
          <li><a href="#">Clothes</a></li>
          <li><a href="#">Shoes</a></li>
          <li><a href="#">Accesories</a></li>
          <li class="active">Data</li> --}}
        </ol>
      </section>
    <div class="row">
    <div class="container">
        {{-- <div class="aside col-md-2" style="background: #f5f5f5">
            <p>Generos</p>
            <ul>
                @foreach($generos as $genero)
                <li><a href="">{{$genero->generoNombre}}</a></li>
                @endforeach
            </ul>
            @foreach($categorias as $categoria)
            <p><a href="">{{$categoria->categoriaNombre}}</a></p>
                @foreach($subCategorias->sortBy('asc') as $subCategoria)
                    @if($categoria->categoriaId == $subCategoria->categoriaIdParent)
                    <ul>
                        <li><a href="">{{$subCategoria->categoriaNombre}}</a></li>
                    </ul>
                    @endif
                @endforeach
            @endforeach
        </div> --}}
        <div class="col-md-10 container">
            <section id="productos">
              <div class="productos">
                {{-- <center> <h2>PRODUCTOS DESTACADOS</h2> </center> --}}
                <div class="row">
                @foreach($productos as $producto)
                  <div class="col-md-4 col-sm-3" >
                    <div class="thumbnail">
                      <img src="/img/{{$producto->productoFoto}}" alt="..." class="productoFoto">
                      <div class="caption">
                        <h3><a href="Productos/{{$producto->productoId}}" title="Details">{{$producto->productoNombre}}</a></h3>
                        <p>$ {{$producto->productoPrecio}}</p>
                        <p>{{$producto->subCategoria->categoriaNombre}}</p>
                        @if($producto->users_id == Auth::user()->id)
                            <p>Usuario: <a href="User/{{$producto->users_id}}/edit" title="">{{$producto->usuario->full_name}}</a></p>
                        @else
                            <p>Usuario: <a href="User/{{$producto->users_id}}" title="">{{$producto->usuario->full_name}}</a></p>
                        @endif
                        <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-primary" role="button">edit</a> 
                        <form action="/Productos/{{$producto->productoId}}/ReActivar" method="POST" class="form-delete">
                          {{csrf_field()}}
                          {{-- {{ method_field('delete') }} --}}
                          <button type="submit" class="btn btn-success">Re activar</button>
                        </form>
                        {{-- <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-danger" role="button">delete</a> --}}
                      </div>
                    </div>
                  </div>
                  @endforeach
              </div>
            </section>
        </div>
    </div>
    </div>
</div>

@endsection
