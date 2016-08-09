@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">My Empresas</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">My empresas</h1>
        <a href="/Empresa/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Empresa</button>
        </a>  
      </div>
      <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Avatar</th>
                <th>Nombre</th>
                <th>Email</th>
                {{-- <th>CUIT</th> --}}
                <th>Phone Number</th>
                {{-- <th>Address</th> --}}
                <th>Total Products</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($empresas as $empresa)
                <tr>
                  <td><img class="img-thumbnail" src="/assets/1/pages/{{$empresa->empresaFoto}}" alt=""></td>
                  <td><a href="/Empresa/{{$empresa->empresaId}}" title="">{{$empresa->empresaNombre}}</a></td>
                  <td>{{$empresa->empresaEmail}}</td>
                  {{-- <td>{{$empresa->empresaCUIT}}</td> --}}
                  <td>{{$empresa->empresaTelefono}}</td>
                  {{-- <td>{{$empresa->empresaDireccion}}</td> --}}
                  <td><a href="/Empresa/{{$empresa->empresaId}}" title="">{{$empresa->productos($empresa->empresaId)}}</a></td>
                  <td>
                    <a href="/Empresa/{{$empresa->empresaId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower">
                        <i class="fa fa-btn fa-user-plus"></i>
                        Add Admin
                      </button>
                    </a>
                    <a href="/Empresa/{{$empresa->empresaId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower">
                        <i class="glyphicon glyphicon-edit"></i>
                        
                      </button>
                    </a>
                    <form action="/Empresa/{{$empresa->empresaId}}" method="POST" class="form-delete">
                      {{csrf_field()}}
                      {{ method_field('delete') }}
                       <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    </form>
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
</div>


@endsection
