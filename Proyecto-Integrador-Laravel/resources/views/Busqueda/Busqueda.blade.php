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
                {{-- {{dd(count($productos))}} --}}
                @if(count($productos) > 0)
                  @foreach($productos as $producto)
                    <div class="col-xs-6 col-sm-3" >
                    <div class="thumbnail">
                      <img src="/img/{{$producto->productoFoto}}" alt="..." class="productoFoto">
                      <div class="caption">
                        <h3><a href="Productos/{{$producto->productoId}}" title="Details">{{$producto->productoNombre}}</a></h3>
                        <p>$ {{$producto->productoPrecio}}</p>
                        <p>{{$producto->categoria->categoriaNombre}}</p>
                        <p>Usuario: <a href="User/{{$producto->users_id}}" title="">{{$producto->usuario->full_name}}</a></p>
                        <p><a href="" class="btn btn-primary" role="button">Buy</a> {{-- <a href="#" class="btn btn-default" role="button">View</a> --}}</p>
                      </div>
                    </div>
                  </div>
                    @endforeach
                  @else
                    <div class="bg-warning">
                      <p>No se encontraron productos con esa busqueda.</p>
                      <button type="" class="btn btn-success"><a href="{{URL::previous()}}" title="">Volver</a></button>
                    </div>
                  @endif
              </div>
            </section>
        </div>
    </div>
    </div>
</div>

@endsection
