@extends('layouts.app')

@section('content')
<main >
  <section id="breadcrumb" class="container-fluid">
    <ol class="breadcrumb" style="background-color:#337AB7;">
      <li><a href="#" style="color:white;">Men</a></li>
      <li><a href="#" style="color:white;">Women</a></li>
      <li><a href="#" style="color:white;">Clothes</a></li>
      <li><a href="#" style="color:white;">Shoes</a></li>
      <li><a href="#" style="color:white;" >Accesories</a></li>
    </ol>
  </section>

  <section style="position: fixed">
    <div id="social" style="position:absolute;top:15px">
      <div><a href="http://www.facebook.com"> <img src="{{ asset('img/facebook.svg') }}" class="social" /></a></div>
      <div><a href="http://www.twitter.com"> <img src="{{ asset('img/twitter.svg') }}" class="social" /></a></div>
      <div><a href="mailto:biancapallaro@gmail.com"><img src="{{ asset('img/email.svg') }}" class="social" /></a></div>
    </div>
  </section>

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{ asset('img/silent.jpg') }}" alt="First slide">
    </div>
    <div class="item">
      <img src="{{ asset('img/galeria2.jpg') }}" alt="Second slide">
    </div>
    <div class="item">
      <img src="{{ asset('img/galeria3.jpg') }}" alt="Third slide">
    </div>
  </div>
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="icon-prev" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="icon-next" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  <section class="container-fluid">
    <div class="col-md-4">
      <center><h2>CLOTHING</h2></center>
      <img src="{{ asset('img/jeans.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Busqueda?gen=2" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="/Busqueda?gen=1" title="">Men</a></button>
      </center>
    </div>
    <div class="col-md-4">
      <center><h2>SHOES</h2></center>
      <img src="{{ asset('img/shoesmen.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Busqueda?gen=2" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="/Busqueda?gen=1" title="">Men</a></button>
      </center>
    </div>
    <div class="col-md-4">
      <center><h2>ACCESORIES</h2></center>
      <img src="{{ asset('img/hola3.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Busqueda?gen=2" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="/Busqueda?gen=1" title="">Men</a></button>
      </center>
    </div>
  </section>
        <section id="productos">
          <div class="container-fluid" style="margin-top:35px; margin-bottom:-40px;">
            <center><h2>FEATURED PRODUCTS</h2> </center>
            @foreach($productos as $producto)
              <div class="col-xs-6 col-sm-3">
                  @include('Includes.producto', ['producto' => $producto])
                    <p><a href="/Shop/{{$producto->productoId}}" class="btn btn-primary" role="button">Add to Cart</a></p>
                  </div> {{-- end caption inside the include--}}
                </div> {{-- end thumbnail inside the include--}}
              </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
          </div>
        </section>
</main>
@endsection
