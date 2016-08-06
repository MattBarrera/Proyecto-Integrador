@extends('layouts.app')

@section('content')
<main >
  <section id="breadcrumb">
    <ol class="breadcrumb">
      <li><a href="#">Men</a></li>
      <li><a href="#">Women</a></li>
      <li><a href="#">Clothes</a></li>
      <li><a href="#">Shoes</a></li>
      <li><a href="#">Accesories</a></li>
      <li class="active">Data</li>
    </ol>
  </section>

  <section style="position:relative">
    <div id="social" style="position:absolute;top:15px">
      <div><a href="http://www.facebook.com"> <img src="{{ asset('img/facebook.svg') }}" class="social" /></a></div>
      <div><a href="http://www.google.com"> <img src="{{ asset('img/google.svg') }}" class="social" /></a></div>
      <div><a href="http://www.linkedin.com"> <img src="{{ asset('img/linkedin.svg') }}" class="social"  /></a></div>
      <div><a href="http://www.twitter.com"> <img src="{{ asset('img/twitter.svg') }}" class="social" /></a></div>
      <div><a href="mailto:biancapallaro@gmail.com"><img src="{{ asset('img/email.svg') }}" class="social" /></a></div>
      <div><a href="http://www.youtube.com"><img src="{{ asset('img/youtube.svg') }}" class="social" /></a></div>
    </div>
  </section>

  <div class="jumbotron">
    <center>
      <h1>Welcome to your own Clothes Shop!</h1>
      <p>Buy and sell products in just 50 seconds</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
    </center>
  </div>
  <section class="container-fluid">
    <div class="col-md-4">
      <center><h2>CLOTHING</h2></center>
      <img src="{{ asset('img/jeans.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Store" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="" title="">Men</a></button>
      </center>
    </div>
    <div class="col-md-4">
      <center><h2>SHOES</h2></center>
      <img src="{{ asset('img/shoesmen.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Store" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="" title="">Men</a></button>
      </center>
    </div>
    <div class="col-md-4">
      <center><h2>ACCESORIES</h2></center>
      <img src="{{ asset('img/hola3.jpg') }}" alt="..." class="img-rounded" style="width:90%">
      <center>
        <button type="button" class="btn btn-danger btn-follower" ><a href="/Store" title=""> Women</a></button>
        <button type="button" class="btn btn-info btn-follower"><a href="" title="">Men</a></button>
      </center>
    </div>
  </section>
        <section id="productos">
          <div class="container-fluid">
            <center><h2>PRODUCTOS DESTACADOS</h2> </center>
            @foreach($productos as $producto)
              <div class="col-xs-6 col-sm-3">
                  @include('Includes.producto', ['producto' => $producto])
                    <p><a href="" class="btn btn-primary" role="button">Buy</a></p>
                  </div> {{-- end caption inside the include--}}
                </div> {{-- end thumbnail inside the include--}}
              </div> {{-- end col-xs-6 col-sm-3 --}}
            @endforeach
          </div>
        </section>
</main>
@endsection


