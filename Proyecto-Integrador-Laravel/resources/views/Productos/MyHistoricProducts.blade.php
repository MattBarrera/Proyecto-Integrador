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
                <div class="col-xs-6 col-sm-3" >
                  @include('Includes.producto', ['producto' => $producto])
                    <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-primary" role="button">edit</a> 
                    <form action="/Productos/{{$producto->productoId}}/ReActivar" method="POST" class="form-delete">
                      {{csrf_field()}}
                      {{-- {{ method_field('delete') }} --}}
                      <button type="submit" class="btn btn-success">Re activar</button>
                    </form>
                    {{-- <a href="Productos/{{$producto->productoId}}/edit" class="btn btn-danger" role="button">delete</a> --}}
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
