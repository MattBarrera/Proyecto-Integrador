@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Genders</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">Genders</h1>
        <a href="/Generos/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Gender</button>
        </a>  
      </div>
      <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($generos as $genero)
                <tr>
                  <td><a href="/Generos/{{$genero->generoId}}" title="">{{$genero->generoNombre}}</a></td>
                  <td>
                    <a href="/Generos/{{$genero->generoId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower">
                        <i class="glyphicon glyphicon-edit"></i>                 
                      </button>
                    </a>
                    <form action="/Generos/{{$genero->generoId}}" method="POST" class="form-delete">
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
