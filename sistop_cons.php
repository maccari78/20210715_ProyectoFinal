<!DOCTYPE html>
<html lang="es">
<?php
	require_once 'inc/conn.php';
	require_once('inc/session.php');	
	include("encabezado.php"); 
	include("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,3);
	generar_breadcrumbs($camino_nav,0,"Consultas"); 
	$tipo = (isset($_POST["tipo"]) && !empty($_POST["tipo"]))? $_POST["tipo"]:0;
	$creacion = (isset($_POST["creacion"]) && !empty($_POST["creacion"]))? trim($_POST["creacion"]):null; 
	$orden = (isset($_POST["orden"]) && !empty($_POST["orden"]))? $_POST["orden"]:0;
	
	// 1 - Sistema operativo --  2 - Estado actual
	# busca los tipos disponibles y se presentan en una lista
	function lista_tipos(&$lista_c,&$tipo_desc) {	
		global $db, $tipo;
		$lista_c =  " <select id='tipo' name='tipo' style='width:17%;' >". 
					"	<option value=0 selected>&laquo;Todos&raquo;</option>";
		$sql  = " SELECT * FROM tipo ORDER BY tipo_desc";
		$rs = $db->query($sql);
			
		if (!$rs) {
			// mensaje error 
		} else {
			$tipo_desc = "";
			foreach ($rs as $row) {
				$seleccionado = "";
				if ($tipo == $row['tipo_id']) {
					$tipo_desc = $row['tipo_desc'];
					$seleccionado = "selected";
				}
				$lista_c .= "<option value='{$row['tipo_id']}' $seleccionado>". utf8_encode($row['tipo_desc'])."</option>"; 
			}
		}
		$lista_c .= "</select>";
		$rs=null;
	}	
	$filtro="";
	$orden_sql="";
	$col="5";	

	# VALIDAR - tipo sea entero 
	#		  - orden sea entero
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
	lista_tipos ($lista_c,$tipo_desc);  #lista de tipos

	#armar filtro para la consulta
	$titfilt = "Listado de sistemas operativos"; 
	$titfiltro = "";
	$filtro="";
	
	if ($tipo <> 0) {
		$titfiltro .= " - Tipo: $tipo_desc";  
		$filtro .= "tipo.tipo_id = $tipo" ;
	}

	if ($creacion <> "") {
		$titfiltro .= " - Fecha creación desde: ".date("d/m/Y", strtotime($creacion));	
		if ($filtro!=="")  $filtro .= " 	AND " ;
		$filtro .= " 	creacion >='$creacion' ";
	}
	
	if ($orden==1) 
		$orden_sql .= "tipo.tipo_desc, nombre";
		
	if ($orden==2) 
		$orden_sql .= "tipo.tipo_desc, actual";
	
	if (trim($filtro)=="")  {
		$filtro = " 0=0 ";  
	}

	if ($orden_sql=="") $orden_sql = "tipo.tipo_desc, version ";

	$sql = "SELECT sistop.*, tipo.*, estado.actual, estado.creacion FROM sistop
			INNER JOIN estado ON estado.sistop_id = sistop.sistop_id
			INNER JOIN tipo ON tipo.tipo_id = estado.tipo_id
			WHERE $filtro ORDER BY $orden_sql";
	$rs = $db->query($sql);

	if (!$rs ) { 
		print_r($db->errorInfo()); # mensaje en desarrollo
		echo "<tr><td colspan='<?=$col?>'><br>&nbsp;&nbsp; - No se encuentran datos para el filtro ingresado.</td></tr>";
		exit;
	}
?>
<head>
	<meta charset="utf-8">
	<title>Historia de los Sistemas operativos</title>
	<meta name="description" content="breve descripcion del sitio">
	<meta name="keywords" content="palabraclave1,palabraclave2,palabraclave3">
	<meta name="robots" content="index,nofollow" >
	<link rel="shortcut icon" href="images/HTML5_logo.jpg" type="image/x-icon"/>
	<link rel="stylesheet" href="css/estilos.css">
	<script type="text/javascript">
		function listado() {
			var errores=0;

			// valida datos ingresados en el formulario
			// si datos ok -- return true  -- sino return false
			if (errores==0) {
				document.getElementById("datos").method = "post";
				document.getElementById("datos").action = "sistOp_cons.php";
				document.getElementById("datos").submit(); 	
				return true;
			} else {
				return false;
			}
		}

		function excel() { // validar datos .....
			document.getElementById("datos").method = "post";
			document.getElementById("datos").action = "sistOp_xls.php";
			document.getElementById("datos").submit(); 
		}		
	</script>	
</head>
<body>
	<header>
		<?php echo generar_barra(); ?>	
		<div id="encab">
			<?=$titulo?>
			<?=$menu_ppal?>
		</div>
	</header>
	<main id="cuerpo">
		<div class="container">
			<nav aria-label="breadcrumb">
			<div style="border: 3px solid black; padding-left:1%; padding-right:1%;">
				<a href="index.php">Inicio |</a>
				<a href="script1.php">UNIX | </a>
				<a href="script2.php">BSD | </a>	
				<a href="script3.php">Apple | </a>
				<a href="seccion4.php">Software libre | </a>
				<a href="seccion5.php">Microsoft | </a>
				<a href="#piePagina">Pie pagina | </a>
				<a href="otherStuff/2020_Examen_Final_Temas.pdf" target="_blank">Temas |</a>
				<a href="otherStuff/2020_Trabajo_Final_Proyecto.pdf" target="_blank">Proyecto |</a>
				<a href="otherStuff/descripcion.pdf" target="_blank">Descrición |</a>
				<a href="http://www.google.com" target="_blank">Google</a>
			</div><br>
		<?= $camino_nav?>	
		<div class="cons_opcion">
			<form  name="datos" id="datos" method="post" action="sistOp_cons.php" onsubmit= "return listado();"> 
			<div style="text-align:right;" id="cons_print">
				<a href="javascript:window.print();" title="Imprimir listado.">
					<img src='images/print.png' title="Imprimir listado." alt="icono imprimir." style="border:0;width:32px;height:32px;">
				</a>
					&nbsp;&nbsp;
				<a href="javascript:excel()" title='Excel del listado.'>
					<img src='images/excel.png' title='Excel del listado.' alt="icono Excel." style="border:0;width:28px;height:28px;"> 
				</a>
			</div>
			<fieldset> 
				<legend>Opciones</legend>
					<?=$lista_c?> &nbsp; &nbsp;
				<label for="creacion">Desde:</label>
				<input type="text" id="creacion" name="creacion" value="<?php if (!is_null($creacion)){?><?=trim(date("d/m/Y", strtotime($creacion)))?><?php }?>" size="6" maxlength="10" title="Fecha ingreso - formato: dd/mm/aaaa">
				<span style="font-size:0.8em;color:#666;font-weight:normal; padding-left:10;">(dd/mm/aaaa)</span>
				<span>Orden: </span>
				<input type="radio" name="orden" id="orden1" value="1" <?php if ($orden==1) {?> checked="checked" <?php }?>> 
				<label for="orden1">Sistema operativo</label>
				<input type="radio" name="orden" id="orden2" value="2" <?php if ($orden==2) {?> checked="checked" <?php }?>> 
				<label for="orden2">Estado actual</label>
				<input type="submit" id="Mostrar" name="Mostrar" value="Mostrar Listado">
			</fieldset>	
			</form>
		</div>
		<br class="clear">
		<h2 class="constit"><?=$titfilt?></h2>
		<p class="constit1"><?=$titfiltro?></p>
		<table width="90%" class="cons_tabla"> 
			<tr>
				<th>Tipo</th>
				<th>Estado actual</th>
				<th>Versión actual</th>
				<th>Nombre</th>
				<th>Fecha de creación</th>
			</tr>
			<?php 		
				$tipo = 0;
				$tot = $total=0;
				$subtotal = "";
			
				if ($rs ) {      
					foreach ($rs as $reg) {  
						if ($tipo <> $reg['tipo_id']) {   
							$subtotal="";

							if ($tot<>0) {
								$subtotal="<td colspan=$col class='cons_txt1'> total: $tot</td> ";
							}
						
			?>					
			<tr><?=$subtotal?></tr>
			<tr>
				<td colspan=<?=$col?> class="cons_txt"> <?php echo utf8_encode($reg['tipo_desc']); ?></td> 
			</tr>
				<?php  
						$tipo = $reg['tipo_id']; 
						$tot=0;
					}
					$sistop = utf8_encode($reg['nombre']);
				?>
					<tr class="constxt1">
						<td>&nbsp;</td>
						<td><?=$reg['actual']?></td>
						<td><?=$reg['version']?></td>
						<td><?=$sistop?></td>
						<td><?=date("d-m-Y", strtotime($reg['creacion']))?></td>
					</tr>
				<?php
					$tot++;
					$total++;
				}
				
				if ($tot<>0) {
					$subtotal="<tr><td colspan=$col class='cons_txt1'>total: $tot</td></tr> ";
				}
				
				if ($total<>0) {
					$subtotal.="<tr><td colspan=$col class='cons_txt1'>Total sistemas operativos: $total</td></tr> ";
				} else {
					$subtotal.="<tr><td colspan=$col>No se encuentran datos para el filtro ingresado</td></tr> ";
				}		
				echo $subtotal;
			}
			?>	
		</table>
	</main>
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>