<?php
/**
 * Open Health Vademecum
 * Copyright (C)
 * UNIVERSIDAD DISTRITAL Francisco José de Caldas
 * Grupo de Investigación GITEM
 * 
 * Usted ha debido de recibir una copia de la Licencia GPL junto con este 
 * programa. Si no es así, por favor consulte: <http://www.gnu.org/licenses/>. 
 */
$tab=0;	

$controles = array("Datos de Configuración",
		array(
		array('titulo', 'text', 'Nombre del Sitio','OpenHealthVademecum'),
		array('raiz_documento', 'text', 'Directorio Raíz',$_SERVER["DOCUMENT_ROOT"]),
		array('host', 'text', 'Dirección (URL) raíz del servidor:<br>(Ej: http://mi_servidor)',$_SERVER["HTTP_HOST"]),
		array('site', 'text', 'Carpeta del sitio:<br>(Ej: /mi_sitio)','')
			),
		"Datos para la Administración",
		array(
				array('administrador', 'text', 'Correo Electrónico del Administrador',''),
				array('clave', 'password', 'Clave de Administrador','')				
		),
		"Configuración de la Base de Datos",
		array(
				array('db_sys', 'text', 'Sistema de Base de Datos',''),
				array('db_dns', 'text', 'DNS del servidor de base de datos','localhost'),
				array('db_port', 'text', 'Puerto','3306'),
				array('db_name', 'text', 'Nombre de la base de datos',''),
				array('db_user', 'text', 'Usuario de la base de datos',''),
				array('db_password', 'text', 'Clave de Acceso',''),
				array('prefijo', 'text', 'Prefijo para las tablas en la base de datos','ohv'),
				array('registro', 'text', 'Número predeterminado de registros en las búsquedas','25')
		),
		"Sesiones",
		array(
				array('expiracion', 'text', 'Tiempo de expiración de las sesiones:<br>(En segundos)',60*24),
				array('wikipedia', 'text', 'Enlace a Wikipedia','http://es.wikipedia.org/wiki/'),
				array('enlace', 'text', 'Nombre de la variable POST','')
		),
		"Ubicación de Carpetas dentro del Sitio Web",
		array(
				array('grafico', 'text', 'Carpeta de Gráficos','/grafico'),
				array('bloques', 'text', 'Bloques(Módulos)','/bloque'),
				array('javascript', 'text', 'Funciones Javascript',''),
				array('documento', 'text', 'Documentos<br>(Con permisos de lectura y escritura)',''),
				array('estilo', 'text', 'Estilo','/estilo'),
				array('clases', 'text', 'Clases','/clase'),
				array('configuracion', 'text', 'Configuración','/configuracion')
				
				
				
		)
		);
?>
<div id="formulario" class="hidden">
	<form>
	<?php 	
	foreach ($controles as $seccion) {

		if(is_array($seccion)){
			foreach($seccion as $control){
		
	?><div class="form-group row">
		  <label for="<?php echo $control[0]?>" class="col-md-4 col-xs-8 col-form-label"><?php echo $control[2]?></label>
		  <div class="col-md-8 col-xs-10">
		    <input class="form-control" type="<?php echo $control[1]?>" value="<?php echo $control[3]?>" id="<?php echo $control[0]?>">
		  </div>
	 </div>
	<?php	
			}
		}else{?>
		<div class="encabezadoSeccion"><strong><?php echo $seccion?></strong></div>		
		<?php }
	}
	?>		
	</form>
</div>			