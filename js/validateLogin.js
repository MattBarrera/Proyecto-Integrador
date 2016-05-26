window.addEventListener("load", function () {

	var formLogin = document.querySelector('#formLogin');
	var btnLogin = document.querySelector('#btnLogin');


	btnLogin.onclick = function(event){
		event.preventDefault();
	var email = formLogin.elements[0].value
	var password = formLogin.elements[1].value

		if (email == "" || password == ""){
			var error = document.querySelector('#errorRegister');
				error.style.display = "block";
				var listadoErrores = document.querySelector('.listadoErrores');
			listadoErrores.innerHTML = listadoErrores.innerHTML = "";
			
			if (email == "" ) {
				//si el nombre no se completo se agrega un li al div error
				listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Email</li>";
			}
			if (password ==  "") {
				//si el apellido no se completo se agrega un li al div error
				listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Contraseña</li>";
			}
		}else{
			var error = document.querySelector('#errorRegister');
			alert('login successful');
			error.style.display = "none";
			formLogin.reset();
		}

	}


});