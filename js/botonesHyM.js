//window.addEventListener("load", function botonesMujerYhombre () {
// window.onload = function botonesMujerYhombre (){

	//var fotos= Array.prototype.slice.call(document.getElementsByClassName('fotos'))

		//button.forEach(function(cadafoto) {
		//	cadafoto.addEventListener("onmouseover", function(){
			//	document.getElementsByClassName('oculto').style.display="block";
	 		//})
	//	});

//});


//Si a todoas las fotos que lleven los botones de Hombre y Mujer le ponemos Class 'fotos', y a los botones les ponemos class 'oculto'
window.addEventListener("load", function botonesMujerYhombre () {
var fotos= Array.prototype.slice.call(document.getElementsByClassName('fotoCategoria'))
fotos.forEach(function(fotos) {
  fotos.addEventListener("mouseover", function(){
	var botonesFoto= Array.prototype.slice.call(document.getElementsByClassName('botonFoto'))
	forEach(document.getElementsByClassName(botonesFoto).style.display="block";
  })
});
});
