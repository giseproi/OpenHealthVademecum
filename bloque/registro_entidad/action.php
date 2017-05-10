<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
html.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario de registro de entidades
* @usage        
*******************************************************************************/
//======= Revisar si no hay acceso ilegal ==============
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}
//======================================================

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	if(!isset($_REQUEST['cancelar']))
	{
		$opcion="nuevo";
		$campo="logosimbolo";
		$archivo=subir_mi_archivo($opcion,$campo,$configuracion);
		if(isset($_REQUEST['id_entidad']))
		{
			
			
		}
		else
		{
			$nueva_sesion=new sesiones($configuracion);
			$nueva_sesion->especificar_enlace($enlace);
			$esta_sesion=$nueva_sesion->numero_sesion();
			//Rescatar el valor de la variable usuario de la sesion
			$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
			if($registro)
			{
				
				$id_usuario=$registro[0][0];
			}
			$cadena_sql="INSERT INTO ";
			$cadena_sql.=$configuracion["prefijo"]."entidad "; 
			$cadena_sql.="( ";
			$cadena_sql.="`id_entidad`, ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`fecha`, ";
			$cadena_sql.="`nombre`, ";
			$cadena_sql.="`etiqueta`, ";
			$cadena_sql.="`logosimbolo`, ";
			$cadena_sql.="`nit`, ";
			$cadena_sql.="`fundacion`, ";
			$cadena_sql.="`direccion`, ";
			$cadena_sql.="`telefono`, ";
			$cadena_sql.="`mision`, ";
			$cadena_sql.="`vision`, ";
			$cadena_sql.="`descripcion`, ";
			$cadena_sql.="`comentario` ";
			$cadena_sql.=") ";
			$cadena_sql.="VALUES ";
			$cadena_sql.="( ";
			$cadena_sql.="'', ";
			$cadena_sql.="'".$id_usuario."', ";
			$cadena_sql.="'".time()."', ";
			$cadena_sql.="'".$_REQUEST['nombre']."', ";
			$cadena_sql.="'".$_REQUEST['etiqueta']."', ";
			$cadena_sql.="'".$archivo."', ";
			$cadena_sql.="'".$_REQUEST['nit']."', ";
			$cadena_sql.="'".$_REQUEST['fundacion']."', ";
			$cadena_sql.="'".$_REQUEST['direccion']."', ";
			$cadena_sql.="'".$_REQUEST['telefono']."', ";
			$cadena_sql.="'".$_REQUEST['mision']."', ";
			$cadena_sql.="'".$_REQUEST['vision']."', ";
			$cadena_sql.="'".$_REQUEST['descripcion']."', ";
			$cadena_sql.="'".$_REQUEST['comentario']."' ";
			$cadena_sql.=")";
			@$resultado=$acceso_db->ejecutar_acceso_db($cadena_sql); 
			if($resultado==TRUE)
			{
				$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
				$cripto=new encriptar();
				$variable="pagina=administrar_entidad";
				$variable.="&accion=1";
				$variable.="&hoja=1";
				$variable=$cripto->codificar_url($variable,$configuracion);
				echo "<script>location.replace('".$indice.$variable."')</script>";
				exit(); 				
			}	
		
		
		}
			
	}		
}
	
function subir_mi_archivo($opcion,$campo,$configuracion)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/subir_archivo.class.php");
	
	$subir = new subir_archivo();
	$subir->directorio_carga= $configuracion['raiz_documento']."/fotografia/";
	$subir->nombre_campo=$campo;
	$subir->tipos_permitidos= array("jpg","png");
		
	// Maximo tamanno permitido
	//$subir->tamanno_maximo=5000000;
	$subir->especial= "[[:space:]]|[\"\*\\\'\%\$\&\@\<\>]";
			
	$subir->unico=TRUE;
	$subir->permisos=0444;
	$subir->cargar();
	if($subir->log["resultado"][0]=="ERROR")
	{
		echo "Imposible cargar el archivo en estos momentos.";
		exit;
	}
	
	
	if($opcion=='borrar')
	{
		$subir->eliminar_archivo($_REQUEST["imagen_anterior"]);
	}
	return $subir->log["mi_archivo"][0];
}
?>
