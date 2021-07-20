<?php 
	$dbhost="127.0.0.1";  // localhost
	$dbport =""; 
	$dbname="obligatoria03";
	$usuario="usuario_web";
	$contrasenia="trabajoF147!";
	$strCnx = "mysql:dbname=$dbname;host=$dbhost";  // ;charset=utf8
	$db ="";

	try {
		$db = new PDO($strCnx, $usuario, $contrasenia);
		$db->setAttribute(PDO::ATTR_CASE,PDO::CASE_LOWER); # para referenciar en minuscula el so de las columnas
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); # Relizar el FETCh ASSOC por defecto para ahorrar memoria
	} catch (PDOException $e) {
		print "Error: " . $e->getMessage() . "<br/>";   # cambiar por un error personalizado 
		die();
	}
?>