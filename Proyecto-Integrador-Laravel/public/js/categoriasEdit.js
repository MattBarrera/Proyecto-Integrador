var categoriaIdParent = document.getElementById('categoriaIdParent').selectedIndex;
var categoriaId = document.querySelector('#categoriaIdHidden').value;

		var xmlhttpSubcategoria  =  new  XMLHttpRequest (); 
		xmlhttpSubcategoria.onreadystatechange  =  function () {
			if  (xmlhttpSubcategoria.readyState  ==  4  && xmlhttpSubcategoria.status  ==  200 ) { 

				var subCategoria = JSON.parse(xmlhttpSubcategoria.responseText);
					// console.log(subCategoria);
					var thead = document.querySelector('#categoriaId');
					thead.innerHTML = '';
					// <?php if (isset($producto->categoriaId)) { ?> var subCategoriaId = <?php echo $producto->categoriaId }?>
					// var subCategoriaId = <?php echo("hola");?>;
					// console.log(subCategoriaId);
					if (subCategoria.length == 0) {
						thead.innerHTML = thead.innerHTML + '<option value=""> No Existen SubCategorias para esa categoria</option>';
					}else{
						thead.innerHTML = thead.innerHTML + '<option value=""> Seleccionar una Sub Categoria</option>';
						// console.log(subCategoria.length);
						for(var propiedadSubCategoria in subCategoria) {
							// subcat = subCategoria[propiedadSubCategoria];
							// console.log(subcat.categoriaNombre);
							var valueSubCategoria = subCategoria[propiedadSubCategoria];
								if (categoriaId == valueSubCategoria.categoriaId) {
									// console.log(categoriaId);
									thead.innerHTML = thead.innerHTML + '<option value="' + valueSubCategoria.categoriaId + '" selected>' + valueSubCategoria.categoriaNombre + '</option>'
								}else{
									thead.innerHTML = thead.innerHTML + '<option value="' + valueSubCategoria.categoriaId + '">' + valueSubCategoria.categoriaNombre + '</option>'
								}
						}
					}
				// console.log(subCategoria[categoriaId]);
			}
		};
		xmlhttpSubcategoria.open ( "GET", "/getSubCategorias/" + categoriaIdParent ,true );
		xmlhttpSubcategoria.send ();

var miSelectCategorias = document.querySelector('#categoriaIdParent');

// console.log(categoriaId);
miSelectCategorias.onchange = function(evento){
		evento.preventDefault();

		var opcionesCategoriaIdParent = miSelectCategorias.options;
		var indiceElegidoCategoriaIdParent = miSelectCategorias.selectedIndex;
		var categoriaIdParent = opcionesCategoriaIdParent[indiceElegidoCategoriaIdParent].value;

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