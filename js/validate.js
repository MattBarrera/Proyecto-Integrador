window.addEventListener("load", function () {
	var btnRegistrar = document.querySelector('#btnRegistrar');
	
	btnRegistrar.onclick = function(event){
		
		event.preventDefault();
		
		var error = document.querySelector('#errorRegister');
		var form = document.getElementById('formRegister');
		var name = form.elements[0].value
		var lastName = form.elements[1].value
		var email = form.elements[2].value
		var telefono = form.elements[3].value
		var fechaNacimiento = form.elements[4].value;

		var sexoIndice = form.elements[5].selectedIndex;
		var sexoOptions = form.elements[5].options;
		var sexo = sexoOptions[sexoIndice].value;
		
		//mejorar sexo
		var password = form.elements[6].value
		var confPassword = form.elements[7].value
		var terminos = form.elements[8].checked;
		var listadoErrores = document.querySelector('.listadoErrores');
		
		//si alguno de los inputs no se lleno se muestra el div de error
			if (name == "" || lastName == "" || email =="" || telefono =="" || fechaNacimiento =="" || sexo =="" || password =="" || confPassword =="" || password !== confPassword || terminos == "") {
				error.style.display = "block";
				listadoErrores.innerHTML = listadoErrores.innerHTML = "";
				
				if (name == "" ) {
					//si el nombre no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Nombre</li>";
				}
				if (lastName ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Apellido</li>";
				}
				if (email ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Email</li>";
				}
				if (telefono ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Telefono</li>";
				}
				if (fechaNacimiento ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Fecha de Nacimiento</li>";
				}
				if (sexo ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Sexo</li>";
				}
				if (password ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Contraseña</li>";
				}
				if (confPassword ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Completar el campo Confirmar Contraseña</li>";
				}
				if (password !==  confPassword) {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Las Contraseñas no coinciden</li>";
				}
				if (terminos ==  "") {
					//si el apellido no se completo se agrega un li al div error
					listadoErrores.innerHTML = listadoErrores.innerHTML += "<li>Debe aceptar los Terminos y Acuerdos</li>";
				}
			}else{
					//capturo el modal
					var modalGracias = document.getElementById('myModalRegister');
					//muestro el modal ni vien entra en el else
					modalGracias.style.display = "block";
					//capturo la X para cerrar el modal
					var span = document.getElementsByClassName("close")[1];

					// When the user clicks on <span> (x), close the modal
					span.onclick = function() {
					    modalGracias.style.display = "none";
					}
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					    if (event.target == modalGracias) {
					        modalGracias.style.display = "none";
					    }
					}

					// capturo el header
					var headerGracias = document.querySelector('.headerGracias');
					//Agregar titulo con variables de nombre
					headerGracias.innerHTML = headerGracias.innerHTML = "Gracias por registrarte " + name + " " + lastName + "!";
					//capturo el mensaje
					var mensajeRegister = document.querySelector('.mensajeRegister');
					//muestro el mensaje de form dinamica
					mensajeRegister.innerHTML = mensajeRegister.innerHTML = "En minutos te va a estar llegando un mail a "+ email +" para confirmar tu cuenta, y asi poder ingresar a la misma! ";
					
					//capturo el button close
					var closeModal = document.querySelectorAll('.closeModal')[1];
					//muestro el button close
					closeModal.style.display = "block";
					//reseteo el form
					form.reset();
					//cierro el modal
					closeModal.onclick = function(){
						modalGracias.style.display = "none";
					}
					var error = document.querySelector('#errorRegister');
					// oculto el div de error
					error.style.display = "none";
			}
	}

});