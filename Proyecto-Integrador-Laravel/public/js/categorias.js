var miSelectCategorias = document.querySelector('#categoriaIdParent');

miSelectCategorias.onchange = function(evento){
		evento.preventDefault();

		var opcionesCategoriaIdParent = miSelectCategorias.options;
		var indiceElegidoCategoriaIdParent = miSelectCategorias.selectedIndex;
		var categoriaIdParent = opcionesCategoriaIdParent[indiceElegidoCategoriaIdParent].value;

		console.log(categoriaIdParent);
		var xmlhttpSubcategoria  =  new  XMLHttpRequest (); 
		xmlhttpSubcategoria.onreadystatechange  =  function () {
			if  (xmlhttpSubcategoria.readyState  ==  4  && xmlhttpSubcategoria.status  ==  200 ) { 

				var subCategoria = JSON.parse(xmlhttpSubcategoria.responseText);
					// console.log(subCategoria);
					var thead = document.querySelector('#categoriaId');
					thead.innerHTML = '';
					thead.innerHTML = thead.innerHTML + '<option value=""> Seleccionar una Sub Categoria</option>';
				for(var propiedadSubCategoria in subCategoria) {
					// subcat = subCategoria[propiedadSubCategoria];
					// console.log(subcat.categoriaNombre);
					var valueSubCategoria = subCategoria[propiedadSubCategoria];
						// console.log(valueSubCategoria);
					thead.innerHTML = thead.innerHTML + '<option value="' + valueSubCategoria.categoriaId + '">' + valueSubCategoria.categoriaNombre + '</option>'
				}
				// console.log(subCategoria[categoriaId]);
			}
		};
		xmlhttpSubcategoria.open ( "GET", "/getSubCategorias/" + categoriaIdParent ,true );
		xmlhttpSubcategoria.send ();
}