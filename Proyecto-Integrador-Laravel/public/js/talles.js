var miRadioOptions = document.getElementsByName('colorId');
// console.log(miRadioOptions)
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
					// console.log(talles.talleNombre);
					var thead = document.querySelector('#talles');
					thead.innerHTML = '';
				
					for(var propiedadTalle in talles) {
						var valueTalle = talles[propiedadTalle];
						// thead.innerHTML = thead.innerHTML + '<option value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</option>'
						thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
					}
			}
		};
		xmlhttpTalles.open ( "GET", "/getTalles/" + miRadioOption ,true );
		xmlhttpTalles.send ();



// var miRadioOptions = document.getElementsByName('colorId');
// console.log(miRadioOptions)
		miRadioOptions.onclick = function(e){
			// e.preventDefault();
	        var miRadioOption = miRadioOptions.value;
	        console.log(miRadioOption);

		var xmlhttpTalles  =  new  XMLHttpRequest (); 
		xmlhttpTalles.onreadystatechange  =  function () {
			if  (xmlhttpTalles.readyState  ==  4  && xmlhttpTalles.status  ==  200 ) { 

				var talles = JSON.parse(xmlhttpTalles.responseText);
					// console.log(talles.talleNombre);
					var thead = document.querySelector('#talles');
					thead.innerHTML = '';
				
					for(var propiedadTalle in talles) {
						var valueTalle = talles[propiedadTalle];
						// thead.innerHTML = thead.innerHTML + '<option value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</option>'
						thead.innerHTML = thead.innerHTML + '<label for="talleId" class="radio-inline" ><input type="radio" id="talleId" name="talleId" value="' + valueTalle.talle.talleId + '">' + valueTalle.talle.talleNombre + '</label>' 
					}
			}
		};
		xmlhttpTalles.open ( "GET", "/getTalles/" + miRadioOption ,true );
		xmlhttpTalles.send ();
	};
