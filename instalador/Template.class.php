<?php
class Template {
	
	var $ruta='instalador/';
	var $rutaEstilo='plugins/';
	
	function mensaje($mensaje = '', $tipo = NULL) {
		?>
		<div class="row mensaje">
				<div class="col-xs-2 col-md-1">	
		<?php
		switch ($tipo) {
			case 0 :
				?>	<img src="<?php echo $this->ruta?>boton_verde.png" border="0" /><?php
				break;
			
			case 1 :
				?>
					<img src="<?php echo $this->ruta?>boton_rojo.png" border="0" /><?php
				break;
			
			case 2 :
				?>	
					<img src="<?php echo $this->ruta?>boton_gris.png" border="0" /><?php
				break;
		}
		?>
				</div>
				<div class="textoMensaje col-xs-16 col-md-11"><?php 
					echo $mensaje;
				?>	
				</div>			
		</div>
		<?php
	}
	
	function mensajes($tipo){
		
		if($tipo==1){
			echo '<div id="mensajes">';
		}else{
			echo '</div>';
		}
		
	}
	
	function encabezado(){?>
		<!DOCTYPE html>
		<html>
		<head>
		<!-- OpenHealtVademecum: Bootstrap Mobil First -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->rutaEstilo?>bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->ruta?>estiloInstalador.css" media="screen" />
		<script src="<?php echo $this->rutaEstilo?>bootstrap/js/jquery.js" type="text/javascript" language="javascript"></script>
		<script src="<?php echo $this->rutaEstilo?>bootstrap/js/bootstrap.min.js" type="text/javascript" language="javascript"></script>
		<script src="<?php echo $this->ruta?>funciones.js" type="text/javascript" language="javascript"></script>		
		<title>Open Health Vademecum</title>
		</head>
		<body>
		<div class="encabezado">
		<h1>Instalación de Open Health Vademecum</h1>
		<p><span id="titulo">Resultados de la verificación de requisitos del servidor:</span></p>
		</div>
		<!-- OpenHealtVademecum: Bootstrap Optimized Container -->
		<div id="contenido" class="principal container-fluid">
		<?php
	}
	
	function boton(){?>
		<div id="botonContainer" class="botonContainer">
		<button id="botonVerificador" type="button" class="btn btn-success btn-lg btn-block" >Continuar</button>
		</div>
	<?php }
	
	
	function pie(){?>		
		</div>
		<div id="pie" class="piePagina navbar navbar-default navbar-fixed-bottom">
		<h4><strong>Open Health Vademecum</strong></h4>
		<p class="pie">Universidad Distrital Francisco José de Caldas</p>
		<p class="pie">Grupo de Investigación GITEM</p>
		<p class="pie">medicina@udistrital.edu.co</p>
		<p>Este programa se distribuye con la esperanza de que sea útil pero SIN NINGUNA GARANTÍA. Incluso sin garantía implícita de 
		COMERCIALIZACIÓN o ADECUACIÓN PARA UN PROPÓSITO PARTICULAR</p>
		</div>
		</body>
		</html>
		<?php
	}
	
	function formulario(){
		include_once('html.php');
	}
}