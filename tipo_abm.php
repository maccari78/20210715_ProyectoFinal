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
		global $tipo_id, $tipo_desc;
		$tipo_id = $tipo_desc = "";
	}
	
	# recupera datos enviados por el metodo post	
	function recuperar_datos() {
		global $tipo_id, $tipo_desc, $opcion;
		$tipo_id = (isset($_POST["tipo_id"]) && !empty($_POST["tipo_id"]))? $_POST["tipo_id"]: "";
		$tipo_desc = (isset($_POST['tipo_desc']) && !empty($_POST['tipo_desc']))? $_POST['tipo_desc']: ""; 
		$opcion = (isset($_POST["opcion"]) && !empty($_POST["opcion"]))? $_POST["opcion"]: "A";
	}

	#funcion que valida los datos recuprados del formulario 
	function validar_datos(){
		// validar tipo_id, tipo_desc, creacion ...
	}
 	
	inicializar_vars();
	
	if (!$btn) { 
		# no hizo clic en el botón 'enviar' (de tipo_desc submit), la solicitud viene de la página sistop.php (por medio de un enlace 
		# utilizando metodo GET), puede ser un alta o modificacion. Recuperar el id de la persona y tipo_desc de operación por medio 
		# del método GET el id y tipo_desc deben ser cargados en los inputs ocultos del formulario para saber que operación fue la que 
		# se solicitó seleccionar los datos según el identificador de la persona personasdo
		
		$tipo_id = (isset($_GET['tipo_id']) && !empty($_GET['tipo_id']))? $_GET['tipo_id']:"";
		$opcion = (isset($_GET['opcion']) && !empty($_GET['opcion']))? $_GET['opcion']:"A"; 
		
		#Valida datos personasdos - 	 $tipo_id-$tipo_desc 
		#validar_datos();
		#si es un alta inicaliza los datos en vacio, sino busca los datos del tipo	
		
		if ($opcion == "A") {
			inicializar_vars();
		} else {
			$sql = "SELECT * FROM tipo WHERE tipo_id = $tipo_id";
			$rs = $db->query($sql)->fetch();
			
			if ($rs){
				$tipo_id = $rs['tipo_id'];
				$tipo_desc = $rs['tipo_desc'];
			} else {
				print_r($db->errorInfo());  #desarrollo
			}
			$rs = null;
		}
	} else {
		# Hizo clic en el boton submit - envio los datos del formulario a procesar en el servidor
		# Grabamos los datos enviados por el método POST en el formulario en la BD
		# Recuperar todos los datos (incluso los campos ocultos) por el método POST

		recuperar_datos();
		validar_datos();  #SIEMPRE VALIDAR DATOS 
	
		# Chequear que no se ingrese un documento que ya exista
		###############################		
		# Ver si es una modificación o un alta
		
		if ($opcion == "M") {
			$sql = "UPDATE tipo SET tipo_id=?, `tipo_desc`=? WHERE tipo_id = $tipo_id";
			$sql = $db->prepare($sql);
			$sqlvalue = [$tipo_id, $tipo_desc];
			$rs = $sql -> execute($sqlvalue);

			if (!$rs) {
				print_r($db->errorInfo());  #desarrollo
			} else {
				header("location: tipo.php");
			}
			$rs = null;

		} else {   #es un alta 
			$sql = "INSERT INTO tipo(tipo_id, `tipo_desc`) VALUES(?, ?)"; 
			$sql = $db -> prepare($sql);
			$sqlvalue = [$tipo_id, $tipo_desc];
			$rs = $sql->execute($sqlvalue);

			if (!$rs) {
				print_r($db -> errorInfo());  #desarrollo
			} else {
				header("location: tipo.php");
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
				return false;
			}
		}
	</script>
</head>
<body>
	<div id = "encabprint"> Empresa - Logo	</div>
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
				<h3>Agregar tipo</h3>
			<form action = "tipo_abm.php" method = "post" onsubmit="return validar()">
				<fieldset> 
					<legend>Datos</legend>
					<label for = "tipo_desc">Descripcion:</label>
					<input type = "text" name = "tipo_desc" id = "tipo_desc" value = "<?=$tipo_desc?>" maxlength = "60"><br><br>			
					<input type = "hidden" name = "opcion" id = "opcion" value = "<?= $opcion ?>">
					<input type = "hidden" name = "tipo_id" id = "tipo_id" value = "<?= $tipo_id ?>">
				</fieldset>
				<fieldset id = "btn" style = "text-align:right;">
					<legend>&nbsp;</legend>
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