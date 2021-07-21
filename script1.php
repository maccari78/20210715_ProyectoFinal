<!DOCTYPE html>
<html lang="es">
    <?php
        require_once 'inc/conn.php';  #crea la conexión a la BD
        require_once('inc/session.php');
        include("encabezado.php"); 
        include("pie.php"); 
        generar_tit($titulo);
        generar_menu($menu_ppal,0);
        generar_breadcrumbs($camino_nav,0,"UNIX"); 
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
        
        <script> 
            window.onload = function(){
                var links = document.getElementsByTagName("a");

                for(var i=0; i < links.length; i++){
                    console.log(links[i]);
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
            <div style="border: 3px solid black; padding-left:1%; padding-right:1%;">               
                <h2>Una breve historia de los sistemas operativos</h2>
            </div><br>
            <div>
                <div id="rojo" style="background-color: red; border: 3px solid black; padding-left:1%; padding-right:1%;">
                    <h3>Al principio fue UNIX</h3>
                    <div id="celeste" style="background-color: lightblue;">
                        <p>UNIX no es el primer sistema operativo de la historia pero sí es el que más influencia ha tenido en todo lo que ha venido después.
                        Nacido en 1969, UNIX fue creado por miembros de los laboratorios Bell de AT&T (como Ken Thompson, Dennis Ritchie o Rudd Canaday, entre otros). El propósito era crear un buen sistema operativo, multitarea y multiusuario, rápido y seguro.
                        En parte, UNIX (que se bautizó primero como UNICS) fue la respuesta a un proyecto fallido, MULTICS (Multiplexed Information and Computing Service) que en los años 60 intentaron crear el MIT, los laboratorios Bell de AT&T y la General Electric. A pesar de esta alianza prometedora, el resultado fue un sistema operativo caro y lento.
                        Así pues, UNIX tuvo mejor acogida, funcionando en la mayoría de computadoras de la época, grandes armatostes que normalmente eran compartidos por varios usuarios a la vez mediante terminales conectados que enviaban órdenes al computador central.
                        Hasta 7 versiones o actualizaciones tuvo UNIX en su vida útil (entre 1969 y 1980) y llegó a universidades, grandes empresas y organismos gubernamentales de Estados Unidos a través de licencias que vendía AT&T.</p>
                    </div><br>
                </div><br>              
            </div>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br> 
        </div>
        </main>       
        <footer>
		    <?=pie()?>
	    </footer>
    </body>
</html>