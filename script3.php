<!DOCTYPE html>
<html lang="es">
    <?php
        require_once 'inc/conn.php';  #crea la conexión a la BD
        require_once('inc/session.php');
        include("encabezado.php"); 
        include("pie.php"); 
        generar_tit($titulo);
        generar_menu($menu_ppal,0);
        generar_breadcrumbs($camino_nav,0,"Apple"); 
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
            function addTable() {
                var myTableDiv = document.getElementById("Kernel")
                var table = document.createElement('TABLE')
                var tableBody = document.createElement('TBODY')

                table.border = '1'
                table.appendChild(tableBody);

                var heading = new Array();
                heading[0] = "Sistema operativo"
                heading[1] = "Kernel"

                var stock = new Array()
                stock[0] = new Array("UNIX", "Monolítico")
                stock[1] = new Array("BSD", "Monolítico")
                stock[2] = new Array("MINIX", "Micronucleo")
                stock[3] = new Array("GNU", "Micronucleo")
                stock[4] = new Array("Linux", "Monolítico")

                // Columnas de la tabla
                var tr = document.createElement('TR');
                tableBody.appendChild(tr);
                for (i = 0; i < heading.length; i++) {
                    var th = document.createElement('TH')
                    th.width = '100';
                    th.appendChild(document.createTextNode(heading[i]));
                    tr.appendChild(th);
                }

                // Filas de la tabla
                for (i = 0; i < stock.length; i++) {
                    var tr = document.createElement('TR');
                    for (j = 0; j < stock[i].length; j++) {
                        var td = document.createElement('TD')
                        td.appendChild(document.createTextNode(stock[i][j]));
                        tr.appendChild(td)
                    }
                    tableBody.appendChild(tr);
                }  
                myTableDiv.appendChild(table)
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
        <div id="Kernel" style="border: 3px solid black; padding-left:1%; padding-right:1%;">
            <h2>Sistemas operativos y la arquitectura de sus Kernel's</h2>
            <input type="button" id="create" value="Click Aquí" onclick="Javascript:addTable()">
        </div><br>
        <div style="border: 2px dotted blue; padding-left:1%; padding-right:1%;">
            <h3>Apple y su relación con UNIX</h3>
            <p>Antes hemos hablado de Microsoft y UNIX, una relación extraña, ya que Windows es de los pocos sistemas operativos no basados directamente en UNIX.
            Apple también apostó por UNIX y ha seguido haciéndolo hasta hoy, aunque no siempre fue así. No fue hasta 2001 que Apple lanzó Mac OS X, basado en UNIX. Su sistema operativo anterior, primero conocido como System y luego Mac OS, estaba escrito desde cero.
            Como he comentado antes, el software que controla tu Mac hoy sí se basa en UNIX, más concretamente en su escisión BSD. Y para ser más concretos, lo que ahora es macOS, antes OS X y antes macOS X, tiene partes de NeXTSTEP, el sistema operativo en el que trabajó Steve Jobs, también basado en UNIX, cuando fue despedido de Apple en los años 80.
            Hay que recordar, por otro lado, que tanto UNIX como BSD, Xenix, MINIX o el núcleo Linux, eran sistemas operativos en modo texto. Sus sucesores sí tendrán entorno gráfico (Linux en la actualidad cuenta con un escritorio gráfico en su mayoría de versiones). <span style="color:#ce148c;font-weight:bold;">NeXTSTEP también tenía su propio entorno gráfico, como el macOS clásico (1984).</span></p>
        </div><br>
        <div style="border: 3px solid black; padding-left:1%; padding-right:1%;"><br>
            <strong>Desde UNIX (ol: Ordered List)</strong>
            <ol style="padding-left:1.5%">
                <li>UNIX</li>
                <li>BSD</li>
                <li>MINIX</li>
                <li>GNU</li>
                <li>Linux</li>
            </ol><br>
            <strong>Desde BSD (ul: Unordered List)</strong>
            <ul>
                <li>macOS</li>
                <li>FreeBSD</li>
                <li>NetBSD</li>
                <li>OpenBSD</li>
            </ul>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <strong id="definitionList">Hijos de UNIX (dl: Definition List)</strong>
            <dl>
                <dt>
                    <dd>macOS</dd>
                    <dd>iPadOS</dd>
                    <dd>iOS</dd>
                    <dd>Android</dd>
                </dd>
            </dl><br>
        </div>
        </div>
        <footer>
		    <?=pie()?>
	    </footer>
    </body>
</html>