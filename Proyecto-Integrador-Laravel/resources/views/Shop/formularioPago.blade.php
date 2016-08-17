@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>Check Out</h1>
      </div>
      <div class="row">
      </div>

	<div class="panel-group" id="accordion">
	    {{-- <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 class="panel-title">
	          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Delivery Details</a>
	        </h4>
	      </div>
	      <div id="collapse1" class="panel-collapse collapse in">
	        <div class="panel-body">
		        
	        </div>
	      </div>
	    </div> --}}
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 class="panel-title">
	          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Payment Method</a>
	        </h4>
	      </div>
	      <div id="collapse2" class="panel-collapse collapse">
	        <div class="panel-body">
	        	<form class="form-horizontal" role="form" method="POST" action="/Productos" enctype="multipart/form-data">
		            {{ csrf_field() }}
		            {{-- <input name="_method" type="hidden" value="PUT"> --}}
		            <div class="form-group{{ $errors->has('productoNombre') ? ' has-error' : '' }}">
		                <label for="productoNombre" class="col-md-4 control-label">Full name printed in credit card:</label>
		                <div class="col-md-6">
		                    <input id="productoNombre" type="text" class="form-control" name="productoNombre" placeholder="Full Name">
		                    @if ($errors->has('productoNombre'))
		                      <span class="help-block">
		                        <strong>{{ $errors->first('productoNombre') }}</strong>
		                      </span>
		                    @endif
		                </div>
		            </div>

		            <div class="form-group{{ $errors->has('productoPrecio') ? ' has-error' : '' }}">
		                <label for="productoPrecio" class="col-md-4 control-label">Document of card owner:</label>
		                <div class="col-md-6">
		                    <input id="productoPrecio" type="number" class="form-control" name="productoPrecio"  placeholder="ingrese un precio">
		                    @if ($errors->has('productoPrecio'))
		                      <span class="help-block">
		                        <strong>{{ $errors->first('productoPrecio') }}</strong>
		                      </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group{{ $errors->has('generoId') ? ' has-error' : '' }}">
		                <label for="generoId" class="col-md-4 control-label">Choose Credit Card</label>
		                <div class="col-md-6">
		                  <select id="generoId" name="generoId" class="form-control">
		                    <option value="">Select a Credit Card</option>
		                    <option>Visa</option>
							<option>Mastercard</option>
							<option>American Express</option>
							<option>Tarjeta Shopping</option>
							<option>Cabal</option>
							<option>Diners</option>
							<option>Argencard</option>
							<option>Naranja</option>
							<option>Nativa Martercard</option>
							<option>Cencosud</option>
							<option>CMR</option>
							<option>Cordial</option>
							<option>Cordobesa</option>
		                  </select>
		                    @if ($errors->has('generoId'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('generoId') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group">
					  <label for="id" class="col-md-4 control-label">Good Thru</label>
					  <div class="input-group col-md-6">
					    <div class="input-group-btn">
					      <select class="form-control col-md-5" name="id" id="id">
					        <option value="">Select a month</option>
							<option value="1">01</option>
							<option value="2">02</option>
							<option value="3">03</option>
							<option value="4">04</option>
							<option value="5">05</option>
							<option value="6">06</option>
							<option value="7">07</option>
							<option value="8">08</option>
							<option value="9">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
					      </select>
					    </div>
					    		{{-- <div>/</div> --}}
					    <div class="input-group-btn">
					      <select class="form-control col-md-5" name="nr" id="nr">
					        <option value="">Select a Year</option>
							<option value="2016">16</option>
							<option value="2017">17</option>
							<option value="2018">18</option>
							<option value="2019">19</option>
							<option value="2020">20</option>
							<option value="2021">21</option>
							<option value="2022">22</option>
							<option value="2023">23</option>
							<option value="2024">24</option>
							<option value="2025">25</option>
							<option value="2026">26</option>
							<option value="2027">27</option>
							<option value="2028">28</option>
							<option value="2029">29</option>
							<option value="2030">30</option>
							<option value="2031">31</option>
							<option value="2032">32</option>
							<option value="2033">33</option>
							<option value="2034">34</option>
							<option value="2035">35</option>
							<option value="2036">36</option>
							<option value="2037">37</option>
							<option value="2038">38</option>
							<option value="2039">39</option>
							<option value="2040">40</option>
							<option value="2041">41</option>
							<option value="2042">42</option>
							<option value="2043">43</option>
							<option value="2044">44</option>
							<option value="2045">45</option>
							<option value="2046">46</option>
							<option value="2047">47</option>
							<option value="2048">48</option>
							<option value="2049">49</option>
							<option value="2050">50</option>
							<option value="2051">51</option>
							<option value="2052">52</option>
							<option value="2053">53</option>
							<option value="2054">54</option>
							<option value="2055">55</option>
							<option value="2056">56</option>
					      </select>
					    </div>
					  </div>	
					</div>

		            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
		              <label for="categoriaId" class="col-md-4 control-label">Dues:</label>
		              <div class="col-md-6">
		                <select id="categoriaId" name="categoriaId" class="form-control">
		                  <option value="">select a Due</option>
		                  <option value="">1</option>
		                  <option value="">3</option>
		                  <option value="">6</option>
		                  <option value="">9</option>
		                  <option value="">12</option>
		                </select>
		                  @if ($errors->has('gender'))
		                      <span class="help-block">
		                          <strong>{{ $errors->first('gender') }}</strong>
		                      </span>
		                  @endif
		              </div>
		            </div>
		            <div class="form-group{{ $errors->has('productoPrecio') ? ' has-error' : '' }}">
		                <label for="productoPrecio" class="col-md-4 control-label">Security code:</label>
		                <div class="col-md-6">
		                    <input id="productoPrecio" type="number" class="form-control" name="productoPrecio"  placeholder="ingrese un precio">
		                    @if ($errors->has('productoPrecio'))
		                      <span class="help-block">
		                        <strong>{{ $errors->first('productoPrecio') }}</strong>
		                      </span>
		                    @endif
		                </div>
		            </div>
		        </form>
	        </div>
	      </div>
	    </div>
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <h4 class="panel-title">
	          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Check Out</a>
	        </h4>
	      </div>
	      <div id="collapse3" class="panel-collapse collapse">
	        <div class="panel-body">
	        	<table class="table table-bordered">
            <thead>
              {{-- <tr>
                <th colspan="2">Category</th>
                <th colspan="2">Sub Category</th>
                <th>Edit</th>
              </tr> --}}
              <tr>
                <th class="table-image">Avatar</th>
                <th>Name</th>
                <th>Detalls</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>SubTotal</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="5" style="text-align: right">Sub Total</th>
                <th colspan="1">{{Cart::subtotal()}}</th>
              </tr>
              <tr>
                {{-- <td colspan="2">&nbsp;</td> --}}
                <td colspan="5" style="text-align: right">Tax</td>
                <td colspan="1">{{Cart::tax()}}</td>
              </tr>
              <tr>
                {{-- <td colspan="2">&nbsp;</td> --}}
                <th colspan="5" style="text-align: right">Total</th>
                <th colspan="1">{{Cart::total()}}</th>

              </tr>
            </tfoot>
            <tbody>
              @if(Cart::count() !== 0)
                @foreach(Cart::content() as $producto)
                  {{-- {{dd($producto->options->color)}} --}}
                  
                  <tr>
                    <td class="table-image">
                      <img src="/assets/{{$producto->options->userId}}/products/{{$producto->options->productoFoto}}" alt="" width="60" height="60" class="img-thumbnail">{{-- {{$producto->rowId}} --}}
                    </td>
                    <td><a href="/Productos/{{$producto->id}}" title="">{{$producto->name}}</a></td>
                    <td>
                      <ul style="list-style: none">
                        <li>Description:{{$producto->price}}</li>
{{--                           @foreach($talles as $talle)
                            @if($talle->talleId == $producto->options->size)
                              <li>Size: {{$talle->talleNombre}}</li>
                            @endif
                          @endforeach
                          @foreach($colores as $color)
                            @if($color->colorId == $producto->options->color)
                              <li>Color: {{$color->colorNombre}}</li>
                            @endif
                          @endforeach --}}
                      </ul>
                    </td>
                    <td>{{$producto->qty}}</td>
                    <td>$ {{$producto->price}}</td>
                    <td>{{$producto->subtotal}}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="5" class="warning" ">No products in your Cart</td>
                </tr>
              @endif
            </tbody>
          </table>
	        </div>
	      </div>
	    </div>
  	</div>
	<a href="/Shop/CheckOutFinal" title="" class="pull-right"><button type="button" class="btn btn-primary">Confirm Order</button></a>
    </div>
</div>
@endsection
@section('extra-js')   
  <script src="/js/categorias.js" type="text/javascript"></script>
@endsection
