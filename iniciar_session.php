<?php
	require 'inc/conn.php';
	define('SEMILLA','34a@$#aA9823$');
	session_start();

	/*
	Perfiles
		A - administrador - puede ingresar cargo y personas
		E - empleado - puede ingresar cargo
	*/

	#recupera los datos de usuario y contraseña
	$legajo =(isset($_POST['legajo']) && !empty($_POST['legajo']))? trim($_POST['legajo']):"";
	$psw =(isset($_POST['psw']) && !empty($_POST['psw']))? trim($_POST['psw']):"";

	#Validar datos
		// legajo - contraseña
		
	# generar la clave encriptada con el psw ingresado por el usuario
	$salt = SEMILLA;		# semilla - valor fijo
	$psw_encript = hash('sha512', $salt.$psw);		# $salt puede ponerse delante o detrás de $psw - sha512 (algoritmo) - devuelve 128 caracteres
	$psw=null;
	
	# buscar el psw guardado en la base de datos para el legajo ingresado  
	# 	- el psw se generó de la misma forma que se genero la clave encriptada anteriormente
	$loguin=0;
	$sql = "SELECT user_psw, user_perfil
			FROM usuario
			WHERE legajo=? ";
	$sql = $db->prepare($sql);
	$sqlvalue=[$legajo];
	$rs = $sql->execute($sqlvalue);
	
	if ($rs) {
		if ($rs=$sql->fetch()) {
			$psw_user=$rs['user_psw'];
			if ($psw_user == $psw_encript) {
				$loguin=1;
				
				# se cargan todas las variables de session necesitadas
				$_SESSION['user'] = $legajo;
				$_SESSION['perfil'] = $rs['user_perfil'];

				# recuperar el nombre del empleado
				$sql = "SELECT nombre, apellido
						FROM trabaja
						INNER JOIN personas ON personas.pers_id=trabaja.pers_id
						WHERE trabaja.legajo=? ";
				$sql = $db->prepare($sql);
				$sqlvalue=[$legajo];
				$rs1 = $sql->execute($sqlvalue);
				
				if ($rs1=$sql->fetch()) {
					$_SESSION['nombre'] = "{$rs1['apellido']}, {$rs1['nombre']}";
				}
				$rs1=null;	
			} 
		}
	}
	
	$rs=null;
	$db=null;

	if ($loguin==0) {
		$_SESSION["user"]="";
	}
	header("location:index.php");	
?>