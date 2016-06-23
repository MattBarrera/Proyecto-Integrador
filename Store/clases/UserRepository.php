<?php 
	abstract class UserRepository {
		
		abstract public function existeElMail($mail);

		abstract public function guardarUsuario(Usuario $usuarioAGuardar);
	}

 ?>