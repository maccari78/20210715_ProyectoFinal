<!DOCTYPE html>
<html lang="es">
    <?php
        require_once 'inc/conn.php';  #crea la conexión a la BD
        require_once('inc/session.php');
        include("encabezado.php"); 
        include("pie.php"); 
        generar_tit($titulo);
        generar_menu($menu_ppal,0);
        generar_breadcrumbs($camino_nav,0,"Software libre"); 
    ?>
    <head>
        <!-- Para validar la página https://validator.w3.org/ -->
        <title>Historia de los Sistemas operativos</title>
        <meta charset="utf-8"/>
        <meta name="description" content="Actividad obligatoria">
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
            <div style="border: 3px solid black; padding-left:1%; padding-right:1%;">
                <h2>Una breve historia de los sistemas operativos</h2>
            </div><br>        
            <div style="border: 2px dotted blue; padding-left:1%; padding-right:1%;">
                <h3>Y llegó el software libre</h3>
                <p>Si conocías <strong>UNIX</strong> y no viviste la informática de los años 70, seguramente sea porque conoces Linux, también conocido como GNU/Linux.
                Linux es un sistema operativo basado en UNIX pero reescrito desde cero y pensado para   <em>funcionar en computadoras personales</em> de cualquier arquitectura, si bien con los años se ha adaptado a todo tipo de dispositivos y computadoras.    
                Su autoría es de <code>Linus Torvalds</code>, un ingeniero finlandés que necesitaba un sistema operativo maleable, que pudiera personalizar a su antojo y lo más barato posible, en comparación con las caras licencias de UNIX de aquel entonces.    
                Su inspiración vino por <abbr title="clon del sistema operativo Unix">MINIX</abbr>, un proyecto desarrollado por Andrew Tanenbaum en 1987 y que, aunque tuvo poco éxito, fue la primera aproximación a crear una versión reducida de UNIX para ordenadores personales.
                Linux tuvo mayor acogida que <sub>MINIX</sub>, hasta el punto de que más tarde tuvo el apoyo del Proyecto GNU de Richard Stallman, un movimiento que abogaba, y lo hace todavía en la actualidad, porque el software sea libre, es decir, cualquiera pueda editarlo y adaptarlo a sus propias necesidades, algo que con el software propietario es difícil cuando no imposible por motivos legales.
                <sup>Richard Stallman</sup> intentó su propia versión de UNIX, pero no llegó a buen puerto y prefirió unirse al proyecto Linux con lo que ahora conocemos como GNU/Linux o Linux para abreviar.
                Es curioso que UNIX, un sistema operativo que nació como software propietario, cerrado, fuera el origen de una filosofía totalmente opuesta, el software libre. Gracias a ello, puedes encontrar Linux en decenas de versiones con distintas características según tus necesidades: Ubuntu, Debian, OpenSUSE, Fedora, etc.</p><br>
            </div>    
        </div>        
        <footer>
		    <?=pie()?>
	    </footer>
    </body>
</html>