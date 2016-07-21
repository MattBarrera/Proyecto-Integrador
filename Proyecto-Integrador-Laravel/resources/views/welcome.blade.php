@extends('layouts.app')

@section('content')
<main>
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
      <div>
        <a href="http://www.facebook.com"> <img src="{{ asset('img/facebook.svg') }}" width="30" height="40" /></a>
      </div>
      <div>
        <a href="http://www.google.com"> <img src="{{ asset('img/google.svg') }}" width="30" height="40"/></a>
      </div>
      <div>
        <a href="http://www.linkedin.com"> <img src="{{ asset('img/linkedin.svg') }}" width="30" height="40" style: /></a>
      </div>
      <div>
        <a href="http://www.twitter.com"> <img src="{{ asset('img/twitter.svg') }}" width="30" height="40"/></a>
      </div>
      <div>
        <a href="mailto:biancapallaro@gmail.com"><img src="{{ asset('img/email.svg') }}" width="30" height="40"/></a>
      </div>
      <div>
        <a href="http://www.youtube.com"><img src="{{ asset('img/youtube.svg') }}" width="30" height="40"/></a>
      </div>
    </div>
  </section>

  <section id="contenido">
    <div class="jumbotron">
      <center> <h1>Welcome to your own Clothes Shop!</h1>
        <p>Buy and sell products in just 50 seconds</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p> </center>
      </div>
      <div class="row" style="margin-left:15px ; margin-bottom:50px">
        <section class="cateogias">
          <div class="col-md-4">

            <center><h2>CLOTHING</h2></center>
            <img src="{{ asset('img/jeans.jpg') }}" alt="..." class="img-rounded" style="width:90%">
            <center><button type="button" class="btn btn-danger" style="margin:10px">Women</button >
              <button type="button" class="btn btn-info">Men</button></center>
            </div>
            <div class="col-md-4">
              <center><h2>SHOES</h2></center>
              <img src="{{ asset('img/shoesmen.jpg') }}" alt="..." class="img-rounded" style="width:90%">
              <center><button type="button" class="btn btn-danger" style="margin:10px">Women</button >
                <button type="button" class="btn btn-info">Men</button></center>
              </div>
              <div class="col-md-4">
                <center><h2>ACCESORIES</h2></center>
                <img src="{{ asset('img/hola3.jpg') }}" alt="..." class="img-rounded" style="width:90%">
                <center><button type="button" class="btn btn-danger" style="margin:10px">Women</button >
                  <button type="button" class="btn btn-info">Men</button></center>
                </div>
              </div>
            </section>



            <section id="productos">
              <div class="productos">
                <center> <h2>PRODUCTOS DESTACADOS</h2> </center>
                <div class="row">
                  <div class="col-xs-6 col-sm-3" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/sweter.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Coni's sweter</h3>
                        <p>$2000</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail">
                      <img src="{{ asset('img/zapato2.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Camila's shoes</h3>
                        <p>$2000</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-3" style="" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/tapado.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Bianca's Trench</h3>
                        <p>$2000</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-6 col-sm-3" style="" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/zapas.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Daro's Shoes</h3>
                        <p>$1800</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-3" style="" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/zapas.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Daro's Shoes</h3>
                        <p>$1800</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-3" style="" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/tapado.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Bianca's Trench</h3>
                        <p>$1800</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-3">
                    <div class="thumbnail">
                      <img src="{{ asset('img/zapato2.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Camila's Shoes</h3>
                        <p>$1800</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-6 col-sm-3" style="" >
                    <div class="thumbnail">
                      <img src="{{ asset('img/tapado.jpg') }}" alt="..." style="width:50%">
                      <div class="caption">
                        <h3>Bianca's Trench</h3>
                        <p>$1800</p>
                        <p><a href="#" class="btn btn-primary" role="button">Buy</a> <a href="#" class="btn btn-default" role="button">View</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </section>
          </main>
          <footer>
            <center><p> © Clothes Shop - All rights reserved </p></center>
          </footer>
          @endsection
