@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Size</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">Categories</h1>
        <a href="/SubCategorias/create" title="" >
          <button type="submit" class="btn btn-success pull-right btn-follower" style="margin-left:10px"> New Sub Categoria</button>
        </a>
        <a href="/Categorias/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Categoria</button>
        </a>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th colspan="2">Category</th>
                <th colspan="2">Sub Category</th>
                {{-- <th>Edit</th> --}}
              </tr>
              <tr>
                <th>Name</th>
                <th>Edit</th>
                <th>Name</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categorias as $categoria)
                <tr >
                  <td rowspan="{{count($categoria->subcategorias)+1}}"><a href="/Categorias/{{$categoria->categoriaId}}" title="">{{$categoria->categoriaNombre}}</a></td>
                  <td rowspan="{{count($categoria->subcategorias)+1}}">
                    <a href="/Categorias/{{$categoria->categoriaId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower sinMargen">
                        <i class="glyphicon glyphicon-edit"></i>                 
                      </button>
                    </a>
                    <form action="/Categorias/{{$categoria->categoriaId}}" method="POST" class="form-delete">
                      {{csrf_field()}}
                      {{ method_field('delete') }}
                       <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    </form>
                  </td>
                  @if(count($categoria->subcategorias)+1 !== 1)
                    @foreach($categoria->subcategorias as $subCategoria)
                      <tr>
                        <td>
                          <a href="/Categorias/{{$subCategoria->categoriaId}}" title="">{{$subCategoria->categoriaNombre}}</a>
                        </td>
                        <td>
                          <a href="/SubCategorias/{{$subCategoria->categoriaId}}/edit" title="" class="form-delete">
                            <button type="submit" class="btn btn-success btn-follower sinMargen">
                              <i class="glyphicon glyphicon-edit"></i>                 
                            </button>
                          </a>
                          <form action="/SubCategorias/{{$subCategoria->categoriaId}}" method="POST" class="form-delete">
                            {{csrf_field()}}
                            {{ method_field('delete') }}
                             <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    {{-- <tr> --}}
                      <td colspan="2"> No Sub Categories</td>
                      {{-- <td></td> --}}
                    {{-- </tr> --}}
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
</div>


@endsection
