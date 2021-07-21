<!DOCTYPE html>
<html lang="es">
<?php
	require_once 'inc/conn.php';
	require_once('inc/session.php');
	include("encabezado.php"); 
	include("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,1);
	generar_breadcrumbs($camino_nav,0,"Sistemas operativos"); 

	# Datos sistemas operativos
	if (!perfil_valido(1)) {
		header("location:index.php");
	}

	$sql = "SELECT sistop.*, estado.creacion, tipo.tipo_desc FROM sistop
			LEFT JOIN estado ON estado.sistop_id = sistop.sistop_id
			LEFT JOIN tipo ON tipo.tipo_id = estado.tipo_id
			ORDER BY tipo.tipo_id, nombre, version ";
	$rs = $db->query($sql);
	
	$lista="";
	
	if (!$rs) {
		print_r($db->errorInfo());  #CUIDADO - mensajes de error en desarrollo  - en producción se emite mensaje amigable y que no muestre información del sistema
	} else {
		foreach($rs as $fila) {
			if (is_null($fila['tipo_desc'])) {
				$tipo = "__sin tipo__ ";
				$creacion = "";
				$agregarTipo = " <a href='sistop_tipo.php?opcion=A&sistop_id={$fila['sistop_id']}'>Agregar tipo</a> ";
			} else {
				$tipo=utf8_encode($fila['tipo_desc']);
				$creacion="(".date('d-m-Y',strtotime($fila['creacion'])).")";
				$modificarTipo=" <a href='sistop_tipo.php?opcion=M&sistop_id={$fila['sistop_id']}'>Modificar tipo</a> ";
			}
			$nombre = utf8_encode($fila['nombre']);
			$version = utf8_encode($fila['version']);
			$lista.="<li>".
					"  <strong>$tipo, </strong> ". 
					"  $nombre, $version,  $creacion | ".
					"  <a href='sistop_abm.php?opcion=M&sistop_id={$fila['sistop_id']}'>Modificar</a> | ".
					"  <a href='#' onclick='javascript:borrar({$fila['sistop_id']});'>Borrar</a> | ".
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
	<script type="text/javascript">
		function ajax_conn(params,url) {
			var ajax_url; 
			/*
				Obtiene una instancia del objeto XMLHttpRequest con el que JavaScript puede comunicarse con el servidor 
				de forma asíncrona intercambiando datos entre el cliente y el servidor sin interferir en el comportamiento 
				actual de la página. 
			*/
			if(window.XMLHttpRequest) {
				conn = new XMLHttpRequest();
			}
			else if(window.ActiveXObject) {  // ie 6
				conn = new ActiveXObject("Microsoft.XMLHTTP");
			}

			conn.onreadystatechange = respuesta;  	
			/*
				Preparar la funcion de respuesta cuando exista un cambio de estado se llama a la funcion respuesta (para que 
				maneja la respuesta recibida) la URL solicitada podría devolver HTML, JavaSript, CSS, texto plano, imágenes, 
				XML, JSON, etc.
			*/
						
			ajax_url = url+'?' + params;   				
			conn.open( "GET",ajax_url,true);
			/*
				método XMLHttpRequest.open. 
				- método: el método HTTP a utilizar en la solicitud Ajax. GET o POST.
				url: dirección URL que se va a solicitar, la URL a la que se va enviar la solicitud.
				async: true (asíncrono) o false (síncrono).  -- asíncronico: no se espera la respuesta del servidor - 
				sincronico: Se espera la repuesta del servidor
			*/
			conn.send(); // Enviamos la solicitud - por metodo GET
			/*  
				Metodo POST  
				conn.open('POST', url); // Si se utiliza el método POST, la solicitud necesita ser enviada como si fuera un formulario
				conn.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				conn.send(parametros);
			*/
		}

		function respuesta() {
			/*
				El valor de readyState 4 indica que la solicitud Ajax ha concluido 
				y la respuesta desde el servidor está disponible en XMLHttpRequest.responseText
			*/
			if(conn.readyState == 4) { 			// Estado de conexión es completo - response.success
				if(conn.status == 200) {		// Estado devuelto por el HTTP fue "OK" 
												// conn.responseText - repuesta del servidor
					if ( conn.responseText==1) {
						location.reload();  // Se borro un Sipo - Se refresca la pagina
					} else {
						alert("El Sistema operativo no se pudo borrar porque tiene un Tipo asociado");
					} 
				}
			}
		}

		function borrar(id) {
			var errores=0;
			
			// Validar ID
			// Armar parametros a enviar - forma param1=valo1&param2=valor2 ...
			params="sistop_id=" + id;
				// Archivo,  al que se le solcita una tarea  (URL que se va a solicitar via AJAX)
			url="sistop_borrar.php";
			
			if (errores==0) {
				if (confirm('¿Está seguro que quiere borrar el Sistema operativo?')) {
					ajax_conn(params,url);
				}
			}
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
			<h2>ABM de Sistemas operativos</h2>
			<a href="sistop_abm.php?opcion=A">&raquo; Agregar un sistema operativo</a>
			<h3>Listado de sistemas operativos</h3>
			<ul>
				<?= $lista ?>
			</ul>	
		</div>
	</main>
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>