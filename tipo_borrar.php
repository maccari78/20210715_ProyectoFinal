<?php
	require 'inc/session.php';
	require 'inc/conn.php';
	$tipo_id = (isset($_GET['tipo_id']) && !empty($_GET['tipo_id']))? $_GET['tipo_id']:0;

	# Verificar que sea numero
	$rta = 0;
	$borrar = false;

	if ($tipo_id<>0) {
		$sql = "SELECT * FROM tipo WHERE tipo_id = $tipo_id";
		$rs = $db -> query($sql) -> fetch();
		
		if (!$rs) {  // 
			$borrar = true;
		}
		$rs = null;
			
		if ($borrar) { 
			$sql = "DELETE FROM tipo WHERE tipo_id = ?";  // $tipo_id
			$sql = $db -> prepare($sql);
			$sqlvalue = [$tipo_id];
			
			if (!$sql -> execute($sqlvalue)) {  
				$rta = 0;
			} else {
				$rta = 1;
			}
			$rs = null;
		}
	}
	$db = null;  	
	echo $rta; 
?>