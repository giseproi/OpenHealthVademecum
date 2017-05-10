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
/***************************************************************************
  
registro.action.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 2 de junio de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Action de registro de usuarios
* @usage        
******************************************************************************/

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
	/*
	foreach ($_REQUEST as $key => $value) 
	{
	echo $key."=>".$value."<br>";
	
	}
	exit;
	*/
	if(isset($_REQUEST['registro']))
	{
		$variable['id_sede']=$_REQUEST['registro'];
		//Verificar que el registro que se esta editando en realidad exista
		$cadena_sql=cadena_sql_sede($configuracion,"select",$variable);
		$registro=acceso_db_sede($cadena_sql,$acceso_db,"busqueda");
		if(is_array($registro))
		{
			unset ($registro);
			unset($variables);
			$usuario=sesion_sede($configuracion,$acceso_db,"id_usuario");
			if(is_array($usuario))
			{
				$variables["id_usuario"]=$usuario[0][0];
				$cadena_sql=cadena_sql_sede($configuracion,"update",$variables);
				$resultado=acceso_db_sede($cadena_sql,$acceso_db,"");
			}
			else
			{
				$resultado=FALSE;			
			}
			
		}
		else
		{
			
			$resultado=FALSE;
		}		
	}
	else
	{
		//Si no existe un id registro valido entonces se trata de un registro nuevo o una correccion
		unset($variables);
		$variables["nombre"]="'".$_REQUEST["nombre"]."'";
		$variables["tipo"]="1";
		$cadena_sql=cadena_sql_sede($configuracion,"select",$variables);		
		$registro=acceso_db_sede($cadena_sql,$acceso_db,"busqueda",$variables);
		if(is_array($registro))
		{
			unset ($registro);
			$opciones="pagina=registro_sede";
			$opciones.="&opcion=corregir";
			enrutar_sede($configuracion,$opciones);	
		}
		else
		{
			unset ($registro);
			unset($variables);
			$sesion=sesion_sede($configuracion,$acceso_db,"id_usuario");
			if(is_array($sesion))
			{
				$variables["id_usuario"]=$sesion[0][0];
			}
			else
			{
				$variables["id_usuario"]="0";
			}
			$cadena_sql=cadena_sql_sede($configuracion,"insertar",$variables);
			$resultado=acceso_db_sede($cadena_sql,$acceso_db,"");
		}
		
	}
	if($resultado)
	{
		unset ($registro);
		$opciones="pagina=sede_entidad";
		$opciones.="&accion=1";
		$opciones.="&hoja=1";
		$opciones.="&mostrar=lista";
		enrutar_sede($configuracion,$opciones);	
	}
	else
	{
		unset ($registro);
		echo $cadena_sql;exit;
		$opciones="pagina=error_ingresar_datos";
		enrutar_sede($configuracion,$opciones);
	}
}

//===========================================================================
//                         FUNCIONES
//===========================================================================



function acceso_db_sede($cadena_sql,$acceso_db,$tipo)
{
	if($tipo=="busqueda")
	{
		$acceso_db->registro_db($cadena_sql,0);
		$registro=$acceso_db->obtener_registro_db();
		return $registro;
	}
	else
	{
		$resultado=$acceso_db->ejecutar_acceso_db($cadena_sql);
		return $resultado;
	}
}


function enrutar_sede($configuracion,$variable)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo "<script>location.replace('".$indice.$variable."')</script>";
	
}

function cadena_sql_sede($configuracion,$tipo,$variable="")
{
	
	switch($tipo)
	{
		case "insertar":
			$cadena_sql="INSERT INTO ";
			$cadena_sql.=$configuracion["prefijo"]."entidad "; 
			$cadena_sql.="( ";
			$cadena_sql.="`id_entidad`, ";
			$cadena_sql.="`id_padre`, ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`fecha`, ";
			$cadena_sql.="`nombre`, ";
			$cadena_sql.="`etiqueta`, ";
			$cadena_sql.="`logosimbolo`, ";
			$cadena_sql.="`nit`, ";
			$cadena_sql.="`fundacion`, ";
			$cadena_sql.="`direccion`, ";
			$cadena_sql.="`telefono`, ";
			$cadena_sql.="`web`, ";
			$cadena_sql.="`correo`, ";
			$cadena_sql.="`mision`, ";
			$cadena_sql.="`vision`, ";
			$cadena_sql.="`descripcion`, ";
			$cadena_sql.="`comentario`, ";
			$cadena_sql.="`latitud`, ";
			$cadena_sql.="`longitud`, ";
			$cadena_sql.="`tipo` ";
			$cadena_sql.=") ";
			$cadena_sql.="VALUES ";
			$cadena_sql.="( ";
			$cadena_sql.="'NULL', ";
			$cadena_sql.="'".$_REQUEST['registro_padre']."', ";
			$cadena_sql.="'".$variable['id_usuario']."', ";
			$cadena_sql.="'".time()."', ";
			$cadena_sql.="'".$_REQUEST['nombre']."', ";
			$cadena_sql.="'".$_REQUEST['etiqueta']."', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'".$_REQUEST['direccion']."', ";
			$cadena_sql.="'".$_REQUEST['telefono']."', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'".$_REQUEST['correo']."', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'', ";
			$cadena_sql.="'".$_REQUEST['descripcion']."', ";
			$cadena_sql.="'', ";

			$cadena_sql.="".$_REQUEST['latitud'].", ";
			$cadena_sql.="".$_REQUEST['longitud'].", ";
			//El tipo 0 corresponde al registro de una entidad
			//El tipo 1 corresponde al registro de una sede
			//El tipo 2 corresponde al registro de una dependencia
			$cadena_sql.="1 ";
			$cadena_sql.=")";
			break;
		
		case "update":
			
			break;
		
		case "select":
			$cadena_sql="SELECT ";
			$cadena_sql.="`id_entidad`, ";
			$cadena_sql.="`id_padre`, ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`fecha`, ";
			$cadena_sql.="`nombre`, ";
			$cadena_sql.="`etiqueta`, ";
			$cadena_sql.="`logosimbolo`, ";
			$cadena_sql.="`nit`, ";
			$cadena_sql.="`fundacion`, ";
			$cadena_sql.="`direccion`, ";
			$cadena_sql.="`telefono`, ";
			$cadena_sql.="`web`, ";
			$cadena_sql.="`correo`, ";
			$cadena_sql.="`mision`, ";
			$cadena_sql.="`vision`, ";
			$cadena_sql.="`descripcion`, ";
			$cadena_sql.="`comentario`, ";
			$cadena_sql.="`tipo` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."entidad "; 			
			$cadena_sql.="WHERE ";
			
			foreach ($variable as $key => $value) 
			{
				$cadena_sql.=$key."=".$value." ";
				$cadena_sql.="AND ";
			}
			$cadena_sql=substr($cadena_sql,0,(strlen($cadena_sql)-4));
		
		
		default:
			break;
	}

	return $cadena_sql;

}

function sesion_sede($configuracion,$acceso_db,$variable)
{
	$nueva_sesion=new sesiones($configuracion);
	$nueva_sesion->especificar_enlace($acceso_db->obtener_enlace());
	$esta_sesion=$nueva_sesion->numero_sesion();
	
	if (strlen($esta_sesion) != 32) 
	{
		return FALSE;
	
	} 
	else 
	{
		$resultado = $nueva_sesion->rescatar_valor_sesion($configuracion,$variable);
		return $resultado;
	}
	
	
}
	
?>
