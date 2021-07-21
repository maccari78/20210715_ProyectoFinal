<!DOCTYPE html>
<html lang="es">
<?php
	require 'inc/session.php';
	require 'inc/conn.php';  #crea la conexión a la BD
	include_once("encabezado.php"); 
	include_once("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,1);
	generar_breadcrumbs($camino_nav,0,"ABM"); 

	# Pregunta si se hizo clic en el botón 'enviar', es decir si se enviaron los datos ingresados en el formulario al servidor
	$btn = (isset($_POST['enviar']) && !empty($_POST['enviar']))? true : false;
	
	function inicializar_vars() {
		global $nombre, $version;
		$nombre = $version = "";
	}
	
	# recupera datos enviados por el metodo post	
	function recuperar_datos() {
		global $nombre, $version, $sistop_id, $opcion, $creacion;
		$nombre = (isset($_POST["nombre"]) && !empty($_POST["nombre"]))? $_POST["nombre"]: "";
		$version = (isset($_POST['version']) && !empty($_POST['version']))? $_POST['version']: ""; 
		$sistop_id = (isset($_POST['sistop_id']) && !empty($_POST['sistop_id']))? $_POST['sistop_id']: "";
		$opcion = (isset($_POST["opcion"]) && !empty($_POST["opcion"]))? $_POST["opcion"]: "A";
		$creacion = (isset($_POST["creacion"]) && !empty($_POST["creacion"]))? $_POST["creacion"]: "A";
	}

	#funcion que valida los datos recuprados del formulario 
	function validar_datos(){
		// validar nombre, version, creacion ...
	}
 	
	inicializar_vars();
	
	if (!$btn) { 
		# no hizo clic en el botón 'enviar' (de version submit), la solicitud viene de la página sistop.php (por medio de un enlace 
		# utilizando metodo GET), puede ser un alta o modificacion. Recuperar el id de la persona y version de operación por medio 
		# del método GET el id y version deben ser cargados en los inputs ocultos del formulario para saber que operación fue la que 
		# se solicitó seleccionar los datos según el identificador de la persona personasdo
		
		$sistop_id = (isset($_GET['sistop_id']) && !empty($_GET['sistop_id']))? $_GET['sistop_id']:"";
		$opcion = (isset($_GET['opcion']) && !empty($_GET['opcion']))? $_GET['opcion']:"A"; 
		
		# Valida datos personasdos - $sistop_id - $version 
		# validar_datos();
		# si es un alta inicaliza los datos en vacio, sino busca los datos del sistema	
		
		if ($opcion == "A") {
			inicializar_vars();
		} else {
			$sql = "SELECT sistop.*, estado.creacion FROM sistop
					INNER JOIN estado ON estado.sistop_id = sistop.sistop_id";
			$rs = $db->query($sql)->fetch();
			
			if ($rs){
				$nombre = $rs['nombre'];
				$version = $rs['version'];
				$creacion = $rs['creacion'];
			} else {
				print_r($db->errorInfo());  #desarrollo
			}
			$rs = null;
		}
	} else {
		# Hizo clic en el boton submit - envio los datos del formulario a procesar en el servidor
		# Grabamos los datos enviados por el método POST en el formulario en la BD
		# Recuperar todos los datos (Incluso los campos ocultos) por el método POST

		recuperar_datos();
		validar_datos();  #SIEMPRE VALIDAR DATOS 
	
		# Chequear que no se ingrese un documento que ya exista
		###############################		
		# Ver si es una modificación o un alta
		
		if ($opcion == "M") {
			$sql = "UPDATE sistop SET sistop_id=?, nombre=?, version=? WHERE sistop_id = $sistop_id";
			$sql = $db->prepare($sql);
			$sqlvalue = [$sistop_id, $nombre, $version];
			$rs = $sql -> execute($sqlvalue);

			if (!$rs) {
				print_r($db->errorInfo());  #desarrollo
			} else {
				header("location: sistop.php");
			}
			$rs = null;

		} else {   #es un alta 
			$sql = "INSERT INTO sistop(sistop_id, nombre, version) VALUES(?, ?, ?)"; 
			$sql = $db -> prepare($sql);
			$sqlvalue = [$sistop_id, $nombre, $version];
			$rs = $sql->execute($sqlvalue);

			if (!$rs) {
				print_r($db -> errorInfo());  #desarrollo
			} else {
				header("location: sistop.php");
				# Una vez hecho el alta o modificación volver a la página sistop.php
			}
			$rs = null;
		}
	}
	$rs = null;
    $db = null;
?>
<head>
	<meta http-equiv = "Content-Type" content = "text/html;charset=utf-8">
	<title>Historia de los Sistemas operativos</title>	
	<meta name = "description" content = "breve descripcion del sitio">
	<meta name = "keywords" content = "palabraclave1,palabraclave2,palabraclave3">
	<meta name = "robots" content = "index,nofollow" >
	<link rel="shortcut icon" href="images/HTML5_logo.jpg" type="image/x-icon"/>
	<link rel = "stylesheet" href = "css/estilos.css">
	<script type = "text/javascript">
		function validar() {
		var errores = 0;
			// valida datos ingresados en el formulario
			// si datos ok -- return true  sino return false
			
			if (errores == 0) {
				return true;
			} else {
				alert('No has ingresado una version');
				return false;
			}
		}
	</script>
</head>
<body>
	<header>
		<?php echo generar_barra(); ?>
		<div id = "encab">
			<?= $titulo ?>
			<?= $menu_ppal ?>
		</div>
	</header>
	<main id = "cuerpo">
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
			<?= $camino_nav ?>
			<h3>Agregar sistema operativo</h3>
			<form action = "sistop_abm.php" method = "post" onsubmit="return validar()">
				<fieldset> 
					<legend>Datos</legend>
					<label for = "nombre">Nombre</label>
					<input type = "text" name = "nombre" id = "nombre" value = "<?=$nombre?>" maxlength = "60"><br>
					<label for = "version">Version</label>
					<input type = "decimal" name = "version" id = "version" value = "<?=$version?>" maxlength = "60" require><br>
					<label for = "creacion">Fecha de creacion</label>
					<input type = "date" name = "creacion" id = "creacion" value = "<?=$creacion?>" maxlength = "60"><br><br>
					<input type = "hidden" name = "opcion" id = "opcion" value = "<?= $opcion ?>">
					<input type = "hidden" name = "sistop_id" id = "sistop_id" value = "<?= $sistop_id ?>">
				</fieldset>
				<fieldset id = "btn" style = "text-align:right;">
					<input type = "submit" name = "enviar" value = "Enviar Datos">
					<input type = "reset" name = "cancelar" value = "Cancelar">
				</fieldset>
			</form>
		</div>
	</main>
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>