@extends('layouts.app')

@section('content')

<form>
	<h3>Choose Credit Card</h3>
	<select>
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
	<div class="form-group">
		<label>Credit Card Number:<sup>*</sup></label>
		<input type="tel" maxlength="30" required title="Completa este dato." id="cardNumber">
	</div>
	<div class="form-group">
		<label>Good Thru:<sup>*</sup></label>
		<select>
			<option value="">Month</option>
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
		<span>/</span>
		<select>
			<option value="">Year</option>
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
	<div class="form-group">
		<label>Full name printed in credit card:<sup>*</sup></label>
		<input type="text" size="40" maxlength="50" required title="Complete este dato" id="cardOwner">
	</div>
	<div class="form-group">
		<label>Document of card owner:<sup>*</sup></label>
		<input type="tel" maxlength="25" size="15" required title="Complete este dato" id="dniTarjeta">
	</div>
	<div class="form-group">
		<label>Security code:<sup>*</sup></label>
		<input type="tel" maxlength="4" required title="Complete este dato" id="securityCardCode">
	</div>
	<div class="form-group">
		<label>Dues:<sup>*</sup></label>
		<ul>
			<li>
				<input type="radio" value="1">
				<label>1</label>
			</li>
			<li>
				<input type="radio" value="3">
				<label>3</label>
			</li>
			<li>
				<input type="radio" value="6">
				<label>6</label>
			</li>
			<li>
				<input type="radio" value="9">
				<label>9</label>
			</li>
			<li>
				<input type="radio" value="12">
				<label>12</label>
			</li>
		</ul>
	</div>
</form>

@endsection