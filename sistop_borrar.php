<?php
	require 'inc/session.php';
	require 'inc/conn.php';
	$sistop_id = (isset($_GET['sistop_id']) && !empty($_GET['sistop_id']))? $_GET['sistop_id']:0;

	# Verificar que sea numero
	$rta = 0;
	$borrar = false;

	if ($sistop_id<>0) {
		$sql = "SELECT * FROM estado WHERE sistop_id = $sistop_id";
		$rs = $db -> query($sql) -> fetch();
		
		if (!$rs) {  // 
			$borrar = true;
		}
		$rs = null;
			
		if ($borrar) { 
			$sql = "DELETE FROM sistop WHERE sistop_id = ?";  // $sistop_id
			$sql = $db -> prepare($sql);
			$sqlvalue = [$sistop_id];
			
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