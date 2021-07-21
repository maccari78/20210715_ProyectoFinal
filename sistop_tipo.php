<!DOCTYPE html>
<html lang="es">
<?php	
	require 'inc/session.php';
	require 'inc/conn.php';  #crea la conexión a la BD
	include_once("encabezado.php"); 
	include_once("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,1);
	generar_breadcrumbs($camino_nav,0,"Persona-tipo"); 

	#pregunta si se hizo clic en el botón 'enviar', es decir si se enviaron los datos ingresados en el formulario al servidor
	$btn =(isset($_POST['enviar']) && !empty($_POST['enviar']))? true:false;
		
	function inicializar_vars() {
		global $nombre, $version, $tipo_id, $actual, $creacion;
		$nombre = $version = "";
		$tipo_id = $actual = 0;
		$creacion = null;
	}

	# recupera datos enviados por el metodo post	
	function recuperar_datos() {
		global $sistop_id, $opcion, $tipo_id, $actual, $creacion ;
		$sistop_id = (isset($_POST['sistop_id']) && !empty($_POST['sistop_id']))? $_POST['sistop_id']:"";
		$opcion = (isset($_POST['opcion']) && !empty($_POST['opcion']))? $_POST['opcion']: "A";  
		$tipo_id = (isset($_POST['tipo_id']) && !empty($_POST['tipo_id']))? $_POST['tipo_id']: 0; 
		$actual = (isset($_POST['actual']) && !empty($_POST['actual']))? $_POST['actual']: "A";
		$creacion = (isset($_POST["creacion"]) && !empty($_POST["creacion"]))? $_POST["creacion"]: "A";
	}

	#funcion que valida los datos recuprados del formulario 
	function validar_datos(){
		global $creacion; 
		// primero se chequea que esté bien la fecha 
		$c = explode("/", $creacion);
		$creacion = "{$c[2]}-{$c[1]}-{$c[0]}";
		$creacion = date("Y-m-d",strtotime($creacion));  # pasar creacion a un formato valido para la BD 	
		// ...
	}
		
	inicializar_vars();
		
	if (!$btn) { 
		# no hizo clic en el botón 'enviar'(de tipo submit), la solicitud viene de la página personas.php (por medio de un enlace 
		# utilizando metodo GET) puede ser un alta o modificacion de tipo recuperar el id de la persona y tipo de operación por 
		# medio del método GET el id y tipo deben ser cargados en los inputs ocultos del formulario para saber que operación fue 
		# la que se solicitó

		#seleccionar los datos según el identificador de la persona ingresado
		$sistop_id =(isset($_GET['sistop_id']) && !empty($_GET['sistop_id']))? $_GET['sistop_id']:"";
		$opcion =(isset($_GET['opcion']) && !empty($_GET['opcion']))? $_GET['opcion']:"A"; 

		// Valida datos ingresados -  $sistop_id - $opcion 
		#validar_datos();
			
		# selecciono los datos del empleado 
		$tipo_id="";
		$leg_lect = ($opcion == "M")? "readonly":"";
		
		$sql = "SELECT * FROM sistop
				LEFT JOIN estado ON estado.sistop_id = sistop.sistop_id
				WHERE sistop.sistop_id = $sistop_id";
				#sistop_id solo es ambiguo - nombre.sistop_id
		$rs = $db->query($sql)->fetch();
		
		if ($rs){
			$nombre = $rs['nombre'];
			$version = $rs['version'];
			$actual = $rs['actual'];
			$tipo_id = (!is_null($rs['tipo_id']) )? $rs['tipo_id']: 0;
		
			if (!is_null($rs['creacion'])) {
				$fecha= date("d/m/Y",strtotime($rs['creacion']));
			}
		} else {
			print_r($db->errorInfo());  #desarrollo
		}
		$rs=null;

		# busca los tipos disponibles y se presentan en una lista
		$sql  = "SELECT tipo_id, tipo_desc ";
		$sql .= "FROM tipo ";
		$sql .= "ORDER BY tipo_desc";
		$rs = $db->query($sql);
	
		$lista_c =  "<select id = 'tipo_id' name = 'tipo_id' style='width:30%;'>". 
					"<option value=0>&laquo;Seleccione una opción&raquo;</option>";
	
		foreach ($rs as $row) {
			$seleccionado = ($tipo_id == $row['tipo_id'])? "selected": "";	
			$lista_c .= "<option value='{$row['tipo_id']}' $seleccionado>{$row['tipo_desc']}</option>"; 
		}
		$lista_c .= "</select>";
		$rs=null;
	} else {
		#hizo clic en el boton submit - envio los datos del formulario a procesar en el servidor
		# grabamos los datos enviados por el método POST en el formulario en la BD
		# recuperar todos los datos (incluso los campos ocultos) por el método POST

		recuperar_datos();
		validar_datos();  #SIEMPRE VALIDAR DATOS 
	
		#VERIFICAR que se entre un solo tipo por persona
		#  -- consulta tener en cuenta que no se agrega un tipo a una persona que ya tiene
		##########################################
		#  VERIFICAR que el legajo sea unico - buscar si se ingreso en la tabla el legajo ingresado
		#		Si es un alta hay que hacer un select * from trabaja where legajo=LegajoIngresado
		#		Si es una modificación se inhabilita el campo legajo

		#ver si es una modificación o un alta
		if ($opcion == "M") {
			$sql=	"UPDATE estado SET tipo_id = ?, creacion = ?
					 WHERE sistop_id = $sistop_id";
			$sql = $db-> prepare($sql);
			$sqlvalue = [$tipo_id, $creacion];
			$rs = $sql-> execute($sqlvalue);

			if (!$rs) {
				print_r($db->errorInfo());  #desarrollo
			} else {
				header("location: sistop.php");
			}
			$rs=null;

		} else {   #es un alta 
			$sql = "INSERT INTO estado(actual, sistop_id, tipo_id, creacion) VALUES(?, ?, ?, ?)"; 
			$sql = $db->prepare($sql);
			$sqlvalue=[$actual, $sistop_id, $tipo_id, $creacion];
			$rs = $sql->execute($sqlvalue);
			
			if (!$rs) {
				print_r($db->errorInfo());  #desarrollo
			} else {
				header("location: sistop.php");
				# Una vez hecho el alta o modificación volver a la página sistop.php
			}
			$rs=null;
		}
	}
	$rs=null;
	$db=null;
?>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>Sistemas operativos</title>
	<meta name="description" content="Breve historia de los sistemas operativos">
	<meta name="keywords" content="palabraclave1, palabraclave2, palabraclave3">
	<meta name="robots" content="index, nofollow" >
	<link rel="shortcut icon" href="images/HTML5_logo.jpg" type="image/x-icon"/>
	<link rel="stylesheet" href="css/estilos.css">
	
	<script type="text/javascript">
		function validar() {
			var errores=0;
			// valida datos ingresados en el formulario
			// si datos ok -- return true  sino return false
			if (errores==0) {
				return true;
			} else {
				return false;
			}
		}
	</script>
</head>
<body>
	<div id="encabprint"> Empresa - Logo	</div>
	<header>
		<?php echo generar_barra(); ?>
		<div id="encab">
			<?= $titulo?>
			<?= $menu_ppal?>
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
			<h3>Tipo de sistema operativo</h3>
			<form action="sistop_tipo.php" method="post" onsubmit="return validar()" >
				<fieldset > 
					<legend>Datos</legend>
					<span><strong>Nombre:</strong> <?=$nombre?> </span><br>
					<span><strong>Estado actual:</strong> <?=$actual?> </span><br>
					<label for="tipo_id">Tipos</label>
					<?=$lista_c?>
					<input type="hidden" name="opcion" id="opcion" value="<?=$opcion?>">
					<input type="hidden" name="sistop_id" id="sistop_id" value="<?=$sistop_id?>">
				</fieldset>
				<fieldset id = "btn" style="text-align:right;">
					<input type="submit" name="enviar" value="Enviar Datos">
					<input type="reset" name="cancelar" value="Cancelar">
				</fieldset>
			</form>
		</div>
	</main>
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>