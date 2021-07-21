<!DOCTYPE html>
<html lang="es">
    <?php
        require_once 'inc/conn.php';  #crea la conexión a la BD
        require_once('inc/session.php');
        include("encabezado.php"); 
        include("pie.php"); 
        generar_tit($titulo);
        generar_menu($menu_ppal,0);
        generar_breadcrumbs($camino_nav,0,"BSD"); 
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
            let lista = new String("UNIX, BSD, MINIX, GNU, Linux");

            function mostrarDatos(){
                    if(document.formul.miSelect.selectedIndex == 0) {
                        alert(lista.toUpperCase());
                    }
                    else if(document.formul.miSelect.selectedIndex == 1){
                        alert(lista.toLowerCase());
                    }
                    else if(document.formul.miSelect.selectedIndex == 2){
                        alert('La cantidad de caracteres de la lista es: ' + lista.length);
                    }
                    else if(document.formul.miSelect.selectedIndex == 3){
                        alert("La lista con GNU reemplazado es: " + lista.replace('GNU', 'Dell'));
                    }
                    else
                        alert("El lugar de la primer M desde el principio es: " + lista.indexOf("M"));
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
        <fieldset>
            <form name="formul">UNIX, BSD, MINIX, GNU, Linux <br/>
                <select name="miSelect">
                    <option value="mayusc">Todo a mayúsculas
                    <option value="minusc">Todo a minúsculas
                    <option value="cant">La cantidad de caracteres es: 
                    <option value="reemp">Reemplazar                
                    <option value="lugar">Lugar de la primer letra M es: 
                </select><br/><br/> 
            <input type="button" value="Accionar" onclick="mostrarDatos();">
            </form>
        </fieldset>
        <div id="verdeClaro" style="background-color: lightgreen; border: 3px solid black; padding-left:1%; padding-right:1%;">
            <h3>La primera escisión de UNIX: BSD</h3>
            <img src="images/UNIX.jpg" alt="Evolución de UNIX" width="655" height="558"/>
            <p>Lo habitual es adquirir un dispositivo con un sistema operativo preinstalado y aprender cómo funciona este software. Como mucho, tenemos opciones de configuración limitadas.
            Pero en entornos concretos, como la programación, el desarrollo o la investigación, se necesita poder personalizar el sistema operativo reescribiendo parte del código y añadiendo código propio para realizar funciones específicas.                
            En 1977 vio la luz BSD (Berkeley Software Distribution), el sistema operativo de la Universidad de California en Berkeley basado en UNIX. No se creó por capricho, si no porque esa universidad necesitaba un sistema operativo maleable para investigaciones propias.                
            AT&T había permitido a Berkeley manipular UNIX durante la década de los 70, pero en un momento dado decidió retirar esa posibilidad, por lo que esa universidad decidió crear una escisión. UNIX seguía por su lado y Berkeley creó su propia versión, BSD.                
            BSD tuvo varias versiones, la última de 1995 (4.4 Release 2). ¿Y hasta qué punto es importante BSD? Pues para empezar, a partir de este sistema operativo surgieron otros muchos, cuyos proyectos siguen activos, como SunOS (luego Solaris y OpenSolaris), FreeBSD, NetBSD y Mac OS X (ahora macOS). Sí, el sistema operativo de tu Mac está basado en BSD, y a su vez, en UNIX.</p> 
        </div>
        </div>
        <footer>
		    <?=pie()?>
	    </footer>
    </body>
</html>