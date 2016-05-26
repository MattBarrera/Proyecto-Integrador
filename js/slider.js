window.addEventListener("load", function () {

		/** javascript slide-show **/
		var cons = 1;
		function slide_show(){
		var elemento = document.getElementById('galeria').getElementsByTagName('li');	
		for(var n=cons; n <= elemento.length; n++){		
		 elemento[n].className = 'selected';
		 for(var i = 0; i<elemento.length; i++){
		  if(i!=cons){
		   elemento[i].className = 'noselected';
		  }		
		 }
		  cons++;							
		  break;
		 }	
		 if(cons >= elemento.length){
		  cons = 0;		
		 }
		 return false;
		}
		
		 setInterval(slide_show, 5000);

		
		/**
		 * Navegación por botones
		 */
		var navegar = function () {
			var elemento = document.getElementById('galeria').getElementsByTagName('li');
			var pos = 0;
			for (var i=0; i<elemento.length; i++) {
				if (elemento[i].className == "selected") {
					elemento[i].className = "noselected";
					pos = i;
				}
			}
			/** Pulsar Anterior **/
			if (this.id == "prev" && pos > 0) {
				elemento[pos-1].className = "selected";
			} else if (this.id == "prev") {
				elemento[elemento.length-1].className = "selected";
			} 
			
			/** Pulsar Siguiente **/
			if (this.id == "next" && pos < elemento.length-1) {
				elemento[pos+1].className = "selected";		
			} else if (this.id == "next") {
				elemento[0].className = "selected";
			}
			return false;
		};

		var desplazar = function () {
			var nav = document.querySelectorAll(".nav");
			for (var i=0; i<nav.length; i++) {
				nav[i].onclick = navegar; 
			}
		};

		window.onload = function (){
			new desplazar();
		};

});