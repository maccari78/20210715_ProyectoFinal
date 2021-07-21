<!DOCTYPE html>
<html lang="es">
    <?php
        require_once 'inc/conn.php';  #crea la conexión a la BD
        require_once('inc/session.php');
        include("encabezado.php"); 
        include("pie.php"); 
        generar_tit($titulo);
        generar_menu($menu_ppal,0);
        generar_breadcrumbs($camino_nav,0,"Microsoft"); 
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
            <div style="border: 2px dotted blue;">
                <h3>La relación de Microsoft con UNIX</h3>
                <p>La Universidad de California en Berkeley no fue la única en crear una versión alternativa de UNIX. IBM, por ejemplo, tuvo su AIX (Advanced Interactive Executive), cuya última actualización se lanzó en 2011.
                Y, curiosamente, Microsoft también trabajó con UNIX, a pesar de ser más conocidos por DOS y Windows.
                Xenix es como se llamaba la versión UNIX de Microsoft, pensada para microcomputadoras, equipos más pequeños que las grandes máquinas de aquel entonces.<br>
                <span style="color: darkblue;"> Lanzado en 1980, tuvo actualizaciones en forma de nuevas versiones hasta 1989.</span> Si no os suena el so de Xenix es básicamente porque Microsoft no vendía este sistema operativo directamente al usuario, si no a fabricantes de computadoras, como IBM, Intel, etc. que adaptaban Xenix a sus computadoras (cada una con su propia arquitectura, incompatibles entre sí).
                Posteriormente trabajó también con DOS, en concreto vendiendo su propia versión MS-DOS. Y más adelante apostó por Windows. Ninguno de estos sistemas operativos tienen origen en UNIX, si bien con el tiempo han incorporado sus características: cuentas de usuario, multitarea, gestión de permisistOp en archivos y carpetas, etc. </p>                                    
            </div><br>
        </div>
        <footer>
		    <?=pie()?>
	    </footer>
    </body>
</html>