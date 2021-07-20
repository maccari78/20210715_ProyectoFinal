<!DOCTYPE html>
<html lang="es">
<?php
	require_once 'inc/conn.php';  # Crea la conexión a la BD
	require_once('inc/session.php');
	include("encabezado.php"); 
	include("pie.php"); 
	generar_tit($titulo);
	generar_menu($menu_ppal,0);
	generar_breadcrumbs($camino_nav,0,"Inicio"); 
?>
<head>
	<meta charset="utf-8">
	<title>Historia de los Sistemas operativos</title>	
	<meta name="description" content="breve descripcion del sitio">
	<meta name="keywords" content="palabraclave1,palabraclave2,palabraclave3">
	<meta name="robots" content="index,nofollow" >
	<link rel="shortcut icon" href="images/HTML5_logo.jpg" type="image/x-icon"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilos.css">
	
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js" ></script>
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
			</nav>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="images/sistop_UNIX.jpg" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="images/sistop_BSD.jpg" alt="Second slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="images/sistop_MINIX.jpg" alt="Third slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="images/sistop_AIX.jpg" alt="Fourth slide">
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<div class="div_ini" >
				<h3> Sobre nosotros</h3>
				<p>Trabajo final del alumno: Danilo Maccari</p>
			</div>
			<br class="clear">
			<div class="div_ini" style="float:left;width:45%;">
				<h3>Novedades <span class="badge badge-secondary">New</span></h3> 
				<p>Próximamente creación de paginas web dinámicas<br>Desarrollo web Fullstack</p>
			</div>
			<div class="div_ini" style="float:right;width:45%;">
				<h3> Servicios</h3>
				<p>Reparación, venta y asesoramiento de software y hardware</p>
			</div>
			<br class="clear">
		</div>		
	</main>	
	<footer>
		<?=pie()?>
	</footer>
</body>
</html>