<?php	
	/*
		Perfiles
			A - administrador - puede ingresar cargo y personas
			E - empleado - puede ingresar cargo
		
		Funcion que verifica que la función/pagina requerida sea valida para el perfil logueado 
		1 - personas
		2 - cargo
		3 - consultas 
	*/
	
	function perfil_valido($opcion) {
		global $perfil;
		switch($opcion){
			case 1: 
				$valido=($perfil=="A")? true:false;
				break;
			case 2: 
				$valido=($perfil=="A" || $perfil=="E")? true:false;
				break;	
			case 3: 
				$valido=true;
				break;
			default:
				$valido=false;
		}
		return $valido;
	}
	
	# Genera titulo
	function generar_tit(&$tit) {
		$tit = '<a href="index.php" title="Historia de los Sistemas operativos">
					<img src="images/HTML5_logo.jpg" alt="Historia de los Sistemas operativos" style="margin-right:2em;">
				</a>
				<h1 class="titppal1">Historia de los Sistemas operativos</h1>';
	}

	#genera barra superior
	function generar_barra() {
	global $user;
		if ($user=="") {
			$links = "<a href='login.php' title='iniciar session'>Iniciar sesión</a>";
		} else {
			$links = "<span> {$_SESSION['nombre']} </span> &nbsp;".
					 "<a href='cerrar_session.php' title='cerrar sessión'>| Cerrar sesión</a>";
		}	 
		$barra_sup ="<div id='barra_superior'>$links</div> ";			
		return  $barra_sup;
	}
	
	# Genera el menu principal y selecciona el item indicado
	# Menu: 1- Sistemas operativos, 2- Tipos, 3- Consultas
	function generar_menu(&$menu_ppal,$sel) {
	global $menu1, $perfil;
		$menu="";
		$clase1 = ($sel==1)? "menuactual":"";
		if ($perfil=="A") {
			$menu.= " <li class='color1' >".
					"	<a href='sistop.php' title='Administración de sistemas operativos' class='$clase1'>".  
					"		 Sistemas operativos". 
					"   </a>".
					"</li>";
		}

		$clase1 = ($sel==2)? "menuactual":"";
		if ($perfil=="A" || $perfil=="E") {
			$menu.= " <li class='color1' >".
					"	<a href='tipo.php' title='Administración de tipos' class='$clase1'>".  
					"		 Tipos ". 
					"  	</a>".
					"</li>";
		}	

		$clase1 = ($sel==3)? "menuactual":"";	
		$menu.= " <li class='color1' >".
				"	<a href='sistop_cons.php' title='Consulta Sistemas operativos' class='$clase1'>".  
				"		 Consultas ". 
				"  	</a>".
				"</li>";

		$menu_ppal = "<ul id='menuppal'>$menu</ul>";  
	}

	function generar_breadcrumbs(&$camino_nav,$op,$text) {	
		switch ($op) {
			case 0 : $menutit=""; $menuhref=""; break;
			case 1 : $menutit="Consulta Sistemas operativos"; $menuhref="sistOp_cons.php"; break;
			case 2 : $menutit="ABM"; $menuhref="sistOp_cons.php"; break;; 
		}

		$camino="";
		if ($op<> 0) 
			$camino= "<li><a href='$menuhref' title='ir a $menutit'>$menutit</a></li>";
		
		$camino_nav =<<<EOT
			<ul id="camino">
				<li id="primero"><a href="index.php" title="ir a la página de inicio">Sistemas operativos</a></li>
				$camino
				<li aria-current="page">$text</li>
			</ul>	
	EOT;	
	}
?>