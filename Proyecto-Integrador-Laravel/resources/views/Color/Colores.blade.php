@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section id="breadcrumb">
        <ol class="breadcrumb">
          <li class="active"><a href="#">Colors</a></li>
        </ol>
      </section>
    <div class="container">
      <div class="page-header">
        <h1 style="display: inline-block">Colors</h1>
        <a href="/Colores/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Color</button>
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
              @foreach($colores as $color)
                <tr>
                  <td><a href="/Colores/{{$color->colorId}}" title="">{{$color->colorNombre}}</a></td>
                  <td>
                    <a href="/Colores/{{$color->colorId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower sinMargen">
                        <i class="glyphicon glyphicon-edit"></i>                 
                      </button>
                    </a>
                    <form action="/Colores/{{$color->colorId}}" method="POST" class="form-delete">
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
