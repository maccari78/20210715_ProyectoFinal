<?php
	session_start();  # Iniciar o reanuda la sesión	
	$user = (isset($_SESSION["user"]) && !empty($_SESSION["user"]))? trim($_SESSION["user"]):""; 
	$perfil = (isset($_SESSION["perfil"]) && !empty($_SESSION["perfil"]))? trim($_SESSION["perfil"]):""; 

	if ($user=="") {		
		# echo "sin seccion";
		# Usuario invalido - Si existe alguna sesion la destruye
		unset($_SESSION["user"]);
		$_SESSION = array();
		session_destroy();
	} else {
		/*
			Operaciones relacionadas a la sesion
			por ej: 
				- Cargar datos de sesión, 
				- Verificar tiempo de la sesion,
				- Eliminar datos de sesión, luego de un determinado tiempo
				- Cambiar ID de sesión 
				- Registrar datos de usuario logueado, etc.
			*/		
	}	
?>