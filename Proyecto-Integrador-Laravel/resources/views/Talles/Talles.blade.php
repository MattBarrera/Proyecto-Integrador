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
        <h1 style="display: inline-block">Sizes</h1>
        <a href="/Talles/create" title="">
          <button type="submit" class="btn btn-success pull-right btn-follower"> New Size</button>
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
              @foreach($talles as $talle)
                <tr>
                  <td><a href="/Talles/{{$talle->talleId}}" title="">{{$talle->talleNombre}}</a></td>
                  <td>
                    <a href="/Talles/{{$talle->talleId}}/edit" title="" class="form-delete">
                      <button type="submit" class="btn btn-success btn-follower">
                        <i class="glyphicon glyphicon-edit"></i>                 
                      </button>
                    </a>
                    <form action="/Talles/{{$talle->talleId}}" method="POST" class="form-delete">
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
