@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">My Business</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">My Business</h1>
        <a href="/Empresa/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Business</button>
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
                <th>Admins</th>
                {{-- <th>Address</th> --}}
                <th>Total Products</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($empresas as $empresa)
              {{-- {{dd($empresa)}} --}}
                <tr>
                  <td><img class="img-thumbnail" src="/assets/1/pages/{{$empresa->empresaFoto}}" alt="" width="50" height="50"></td>
                  <td><a href="/Empresa/{{$empresa->empresaId}}" title="">{{$empresa->empresaNombre}}</a></td>
                  <td>{{$empresa->empresaEmail}}</td>
                  {{-- <td>{{$empresa->empresaCUIT}}</td> --}}
                  <td>{{$empresa->empresaTelefono}}</td>
                  <td>
                    <ul>
                      @foreach($empresa->usuarios as $usuario)
                      {{-- {{dd()}} --}}
                        <li style="list-style: none">{{$usuario->usuario->full_name}} {{$usuario->empresaOwner == 1 ?'(Owner)':''}}</li>
                        
                      @endforeach
                    </ul>
                  </td>
                  {{-- <td>{{$empresa->empresaDireccion}}</td> --}}
                  {{-- {{dd($usuario)}} --}}
                  <td><a href="/Empresa/{{$empresa->empresaId}}" title="">{{$empresa->productos($empresa->empresaId)}}</a></td>
                  <td>
                    <a href="/Empresa/{{$empresa->empresaId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower">
                        <i class="glyphicon glyphicon-edit"></i>
                      </button>
                    </a>
                    @foreach($empresa->usuarios as $usuario)
                      @if($usuario->users_id == Auth::user()->id && $usuario->empresaOwner == 1)
                        <a href="/Empresa/{{$empresa->empresaId}}/addAdmin" title="" class="form-delete">
                          <button type="submit" class="btn btn-success btn-follower">
                            <i class="fa fa-btn fa-user-plus"></i>Admin
                          </button>
                        </a>
                        <form action="/Empresa/{{$empresa->empresaId}}" method="POST" class="form-delete">
                          {{csrf_field()}}
                          {{ method_field('delete') }}
                           <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                        </form>
                      @endif
                    @endforeach
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
</div>


@endsection
