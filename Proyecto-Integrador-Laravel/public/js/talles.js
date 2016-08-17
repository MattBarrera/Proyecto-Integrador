var productoId = document.getElementById('productoId').value;
// console.log(productoId.value)
var miRadioOptions = document.getElementsByName('colorId');
var buttonBuy = document.getElementById('buttons');
// console.log(miRadioOptions)
miRadioOptions[0].checked = true;
	for (var i = 0; i < miRadioOptions.length; i++) {
		if (miRadioOptions[i].checked) {
        // do whatever you want with the checked radio
        var miRadioOption = miRadioOptions[i].value;
        // console.log(miRadioOption);
        // only one radio can be logically checked, don't check the rest
        break;
    	}
	}

		// console.log(categoriaIdParent);
		var xmlhttpTalles  =  new  XMLHttpRequest (); 
		xmlhttpTalles.onreadystatechange  =  function () {
			if  (xmlhttpTalles.readyState  ==  4  && xmlhttpTalles.status  ==  200 ) { 

				var talles = JSON.parse(xmlhttpTalles.responseText);
					// console.log(talles);
					var thead = document.querySelector('#talles');
					thead.innerHTML = '';
				
					for(var propiedadTalle in talles) {
						var valueTalle = talles[propiedadTalle];
						// console.log(valueTalle.stockCantidad);
						// thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
						if (valueTalle.stockCantidad > 0) {
							thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
						}else{
							thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" style="color:red;"><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
						}
					}
			}
		};
		xmlhttpTalles.open ( "GET", "/getTalles/" + miRadioOption + "/" + productoId ,true );
		xmlhttpTalles.send ();



// console.log(productoId)
	// console.log(miRadioOptions)
	// miRadioOptions.onclick = function(){
	// 	for (var i = 0; i < miRadioOptions.length; i++) {
	// 		if (miRadioOptions[i].checked) {
	//         // do whatever you want with the checked radio
	//         var miRadioOption = miRadioOptions[i].value;
	//         // console.log(miRadioOption);
	//         // only one radio can be logically checked, don't check the rest
	//         break;
	//     	}
	// 	}

		// $('input').attr('name','colorId').change (function(e){
		$('input[name=colorId]').change (function(e){
			// e.preventDefault();
	        var miRadioOptionChange = this.value;
	        // console.log(miRadioOptionChange);

		var xmlhttpTalles  =  new  XMLHttpRequest (); 
		xmlhttpTalles.onreadystatechange  =  function () {
			if  (xmlhttpTalles.readyState  ==  4  && xmlhttpTalles.status  ==  200 ) { 

				var talles = JSON.parse(xmlhttpTalles.responseText);
					// console.log(talles);
					var thead = document.querySelector('#talles');
					// console.log(thead)
					thead.innerHTML = '';
				
					for(var propiedadTalle in talles) {
						var valueTalle = talles[propiedadTalle];
						if (valueTalle.stockCantidad > 0) {
							thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
						}else{
							thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" style="color:red;"><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
						}
						// thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
					}
			}
		};
		
		xmlhttpTalles.open ( "GET", "/getTalles/" + miRadioOptionChange + "/" + productoId ,true );
		xmlhttpTalles.send ();
		// console.log(algo);
	});
		console.log($('input[name=talleId]'))
		$('input[name=talleId]').change (function(e){
			// e.preventDefault();
	        var miRadioOptionChange = this.value;
	        console.log(miRadioOptionChange);

		var xmlhttpTalles  =  new  XMLHttpRequest (); 
		xmlhttpTalles.onreadystatechange  =  function () {
			if  (xmlhttpTalles.readyState  ==  4  && xmlhttpTalles.status  ==  200 ) { 

				var talles = JSON.parse(xmlhttpTalles.responseText);
					// console.log(talles);
					// var thead = document.querySelector('#talles');

					// console.log(thead)
					// thead.innerHTML = '';
				
					for(var propiedadTalle in talles) {
						var valueTalle = talles[propiedadTalle];
						if (valueTalle.stockCantidad > 0) {
							buttonBuy.innerHTML = buttonBuy.innerHTML + '<button type="submit" class="btn btn-success" id="buy" formaction="/Shop" >Buy</button>' 
						}else{
							buttonBuy.innerHTML = buttonBuy.innerHTML + '<button type="submit" class="btn btn-success" id="buy" disabled="disabled" formaction="/Shop" >Buy</button>' 
						}
						// thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" required id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
					}
			}
		};
		
		xmlhttpTalles.open ( "GET", "/getTalles/" + miRadioOptionChange + "/" + productoId ,true );
		xmlhttpTalles.send ();
		// console.log(algo);
	});








