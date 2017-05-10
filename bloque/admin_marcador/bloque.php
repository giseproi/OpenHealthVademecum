<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    GRUPO DE INVESTIGACION EN TELEMEDICINA                                #
#    Directora General:                                                    #
#    Dra LILIA EDITH APARICIO P.                                           #
#    Copyright: Vea el archivo LICENCIA.txt que viene con la distribucion  #
############################################################################
*/
/****************************************************************************
* @name          bloque.php 
* @revision      Última revisión 2 de junio de 2017
*****************************************************************************
* @subpackage   admin_sede
* @package	bloques
* @copyright    
* @version      0.3
* @link		N/D
* @description  Bloque principal para la administración de medicamentoes
*
******************************************************************************/
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	
	if(isset($_REQUEST["registro"]))
	{
		
		$el_registro=$_REQUEST["registro"];
		
		switch($_REQUEST["tipo"])
		{
			case "sede":
				$cadena_sql=cadena_admin_marcador($configuracion, "sede",$el_registro);	
				$registro=$acceso_db->ejecutar_busqueda($cadena_sql);
				if(is_array($registro))
				{
					generar_xml($registro);
				}
				break;
			
			case "entidad":
				break;
				
			default:
				break;
		
		
		}
	}
	else
	{
		//No es un registro especifico
		
	
	}

}

function generar_xml($registro)
{
	$dom = new DOMDocument("1.0");
	$nodo = $dom->createElement("markers");
	$parnodo = $dom->appendChild($nodo); 
	header("Content-type: text/xml"); 
	
	$campos=count($registro);
	
	
	for($i=0;$i<$campos;$i++)
	{  
		$nodo = $dom->createElement("marker");  
		$newnode = $parnodo->appendChild($nodo);   
		$newnode->setAttribute("name",$registro[$i][0]);
		$newnode->setAttribute("lat", $registro[$i][1]);  
		$newnode->setAttribute("lng", $registro[$i][2]);  
		$newnode->setAttribute("direccion", $registro[$i][3]);  
		$newnode->setAttribute("correo", $registro[$i][4]);  
		$newnode->setAttribute("telefono", $registro[$i][5]);  
		
	} 
	
	echo $dom->saveXML();
}

function cadena_admin_marcador($configuracion, $tipo, $variable)
{
	switch($tipo)
	{
	
		case "sede":
			$cadena_sql="SELECT ";
			$cadena_sql.="nombre, ";
			$cadena_sql.="latitud, ";
			$cadena_sql.="longitud, ";
			$cadena_sql.="direccion, ";
			$cadena_sql.="correo, ";
			$cadena_sql.="telefono ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."entidad ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_entidad=".$variable." ";
			$cadena_sql.="LIMIT 1 ";
			break;
			
		case "entidad":
			$cadena_sql="SELECT ";
			$cadena_sql.="nombre, ";
			$cadena_sql.="latitud, ";
			$cadena_sql.="longitud, ";
			$cadena_sql.="direccion, ";
			$cadena_sql.="correo, ";
			$cadena_sql.="telefono ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."entidad ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_padre=".$el_registro." ";
			$cadena_sql.="LIMIT 1 ";
			break;
		
		default:
			break;
	
	}
	
	return $cadena_sql;

}

?>
