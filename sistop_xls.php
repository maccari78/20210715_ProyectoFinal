<!DOCTYPE html>
<html lang="es">
<?php
	# con esto evitamos que el navegador lo grabe en su caché
	header("Pragma: no-cache");
	header("Expires: 0");
	# indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
	header("Content-type: application/octet-stream");
	# indica al navegador que se está devolviendo un archivo
	header("Content-Disposition: attachment; filename=listado.xls");
	header("Content-type: application/vnd.ms-excel");  
	require 'inc/conn.php';  #crea la conexión a la BD

	$tipo = (isset($_POST["tipo"]) && !empty($_POST["tipo"]))? $_POST["tipo"]:0;
	$creacion = (isset($_POST["creacion"]) && !empty($_POST["creacion"]))? trim($_POST["creacion"]):null; 
	$orden = (isset($_POST["orden"]) && !empty($_POST["orden"]))? $_POST["orden"]:0;
	// 1 - Apellido --  2 - actual	
	$filtro="";
	$orden_sql="";
	$col="5";	

	# valido - tipo sea entero 
	#		 - orden sea entero
			 
	# filtro por una fecha ($creacion)  
	if (!is_null($creacion) && (trim($creacion)<>"")) {  // sale Y/m/d 	
		$creacion = str_replace(array('\'', '-', '.', ','), '/', $creacion); 
		$creacion = str_replace(' ','', $creacion); 
		$patron="/^[0-2][0-9]\/[01][0-9]\/[0-9]{4}/";
		if (preg_match($patron,$creacion)==1) {
			$f = explode('/', $creacion);
			if (checkdate($f[1],$f[0],$f[2])) {   #checkdate(m,d,y)
				$creacion = "$f[2]/$f[1]/$f[0]";  #Y-m-d
			} else {
				$creacion=null;
			}
		} else {
			$creacion=null;
		}
	}

	#armar filtro para la consulta
	$titfilt = "Listado de sistemas operativos"; 
	$titfiltro = "";
	$filtro = "";
	
	if ($tipo <> 0) {
		$titfiltro .= " - tipo: $tipo ";  
		$filtro .= " tipo.tipo_id=$tipo " ;
	}

	if ($creacion <> "") {
		$titfiltro .= " - Fecha de creación: ".date("d/m/Y",strtotime($creacion));		
		if ($filtro!=="")  $filtro .= " 	AND " ;
		$filtro .= "creacion >='$creacion' ";
	}
	
	if ($orden==1) 
		$orden_sql .= "tipo.tipo_desc, actual";
		
	if ($orden==2) 
		$orden_sql .= "tipo.tipo_desc, creacion";

	if ($filtro=="") $filtro=" 0=0 ";
	if ($orden_sql=="") $orden_sql="tipo.tipo_desc, version";
	
	$sql = "SELECT sistOp.*, tipo.*, estado.actual, estado.creacion FROM sistOp
		    INNER JOIN estado ON estado.sistop_id = sistop.sistop_id
			INNER JOIN tipo ON tipo.tipo_id = estado.tipo_id
			WHERE $filtro ORDER BY $orden_sql";
	$rs = $db->query($sql);

	if (!$rs ) { 
		print_r($db->errorInfo()); # Mensaje en desarrollo
		echo "<tr><td colspan='<?=$col?>'><br>&nbsp;&nbsp; - No se encuentran datos para el filtro ingresado.</td></tr>";
		exit;
	}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Historia de los Sistemas operativos</title>
</head>
<body>
	<table> 
		<caption><strong><?=$titfilt?><strong> </caption>
		<tr>
			<th>Tipo</th>
			<th>Estado actual</th>
			<th>Versión actual</th>
			<th>Sistema operativo</th>
			<th>Fecha creación</th>
		</tr>
		<?php 		
			$tipo = 0;

			if ($rs ) {      	 
				foreach ($rs as $reg) {  
		?>
		<h2 class="constit"><?=$titfilt?></h2>
		<tr class="constxt1">
			<td><?=utf8_encode($reg['tipo_desc'])?></td>
			<td><?=$reg['actual']?></td>
			<td><?=$reg['version']?></td>
			<td><?=utf8_encode($reg['nombre'])?></td>
			<td><?=date("d-m-Y",strtotime($reg['creacion']))?></td>
		</tr>
		<?php
				}
			}
		?>	
		</table>	
<?php	
	$rs=null;
    $db=null;
?>
</body>
</html>