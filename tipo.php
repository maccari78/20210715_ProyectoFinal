<!DOCTYPE html>
<html lang="es">
<?php
	require_once 'inc/conn.php';
	require_once('inc/session.php');
	include("encabezado.php"); 
	include("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,2);
	generar_breadcrumbs($camino_nav, 0, "Tipos"); 

	# Datos tipos
	if (!perfil_valido(2)) {
		header("location:index.php");
	}

	$sql = "SELECT tipo.*, tipo_desc FROM tipo
			LEFT JOIN estado ON estado.tipo_id = tipo.tipo_id
			ORDER BY tipo_id, tipo_desc ";
	$rs = $db->query($sql);

	$lista="";

	if (!$rs) {
	print_r($db->errorInfo());  # CUIDADO - mensajes de error en desarrollo  - en producción se emite mensaje amigable 
	                            # y que no muestre información del sistema
	} else {
		foreach($rs as $fila) {
		if (is_null($fila['tipo_desc'])) {
			$tipo = "__sin tipo__ ";
			$creacion = "";
			$agregarTipo = " <a href='sistop_tipo.php?opcion=A&tipo_id={$fila['tipo_id']}'>Agregar tipo</a> ";
		} else {
			$tipo=utf8_encode($fila['tipo_desc']);
			$modificarTipo=" <a href='sistop_tipo.php?opcion=M&tipo_id={$fila['tipo_id']}'>Modificar tipo</a> ";
		}
		$tipo_desc = utf8_encode($fila['tipo_desc']);
		$lista.="<li>".
				"  <strong>$tipo</strong>  ". 
				"  $tipo | ".
				"  <a href='tipo_abm.php?opcion=M&tipo_id={$fila['tipo_id']}'>Modificar</a> | ".
				"  <a href='#' onclick='javascript:borrar({$fila['tipo_id']});'>Borrar</a> | ".
				"  $modificarTipo ".
				"</li>";
		}
	}
	$rs=null;
	$db=null;
?>
<head>
	<meta charset="utf-8">
	<title>Historia de los Sistemas operativos</title>
	<meta name="description" content="breve descripcion del sitio">
	<meta name="keywords" content="palabraclave1,palabraclave2,palabraclave3">
	<meta name="robots" content="index,nofollow" >
	<link rel="shortcut icon" href="images/HTML5_logo.jpg" type="image/x-icon"/>
	<link rel="stylesheet" href="css/estilos.css">
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
			<h2> ABM de tipos </h2>
			<a href="tipo_abm.php?opcion=A">&raquo; Agregar un tipo</a>
			<h3>Listado de tipos</h3>
			<ul>
				<li>
					AIX
					<a href='#' onclick='javascript:borrar(1);'>Borrar</a> |
					<a href='tipo_abm.php?opcion=M&tipo_id=1'>Modificar</a> 	
				</li>
				<li>
					BSD
					<a href='#' onclick='javascript:borrar(2);'>Borrar</a> |
					<a href='tipo_abm.php?opcion=M&tipo_id=2'>Modificar</a>
				</li>
				<li>
					MINIX
					<a href='#' onclick='javascript:borrar(3);'>Borrar</a> |
					<a href='tipo_abm.php?opcion=M&tipo_id=3'>Modificar</a>  
				</li>
				<li>
					CP/M
					<a href='#' onclick='javascript:borrar(4);'>Borrar</a> |
					<a href='tipo_abm.php?opcion=M&tipo_id=4'>Modificar</a>  
				</li>
			</ul>
		</div>
	</main>	
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>