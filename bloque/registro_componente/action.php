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

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	if(isset($_REQUEST['id_elemento']))
	{
		$variable['id_elemento']=$_REQUEST['id_elemento'];
		$cadena_sql=cadena_sql_elemento($configuracion,"select",$variable);
		$registro=acceso_db_elemento($cadena_sql,$acceso_db,"busqueda");
		if(is_array($registro))
		{
			unset ($registro);
			unset($variables);
			$usuario=sesion_elemento($configuracion,$acceso_db,"id_usuario");
			if(is_array($usuario))
			{
				$variables["id_usuario"]=$usuario[0][0];				
				$cadena_sql=cadena_sql_elemento($configuracion,"update",$variables);
				$resultado=acceso_db_elemento($cadena_sql,$acceso_db,"");
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
	if($resultado)
	{
		unset ($registro);
		$opciones="pagina=componente_entidad";
		$opciones.="&opcion=mostrar";
		$opciones.="&id_elemento=".$_REQUEST["id_elemento"];
		$opciones.="&id_entidad=".$_REQUEST["id_entidad"];
		enrutar_elemento($configuracion,$opciones);	
	}
	else
	{
		unset ($registro);
		echo $cadena_sql;exit;
		$opciones="pagina=error_ingresar_datos";
		enrutar_elemento($configuracion,$opciones);
	}
}

//===========================================================================
//                         FUNCIONES
//===========================================================================



function acceso_db_elemento($cadena_sql,$acceso_db,$tipo)
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


function enrutar_elemento($configuracion,$variable)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo "<script>location.replace('".$indice.$variable."')</script>";
	
}

function cadena_sql_elemento($configuracion,$tipo,$variable="")
{
	
	switch($tipo)
	{
		case "update":
			$cadena_sql="UPDATE ";
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion ";
			$cadena_sql.="SET "; 
			$cadena_sql.="`id_c_organizacion`='".$_REQUEST['id_elemento']."', ";
			$cadena_sql.="`nombre`='".$_REQUEST['nombre']."', ";
			$cadena_sql.="`etiqueta`='".$_REQUEST['etiqueta']."', ";
			$cadena_sql.="`web`='".$_REQUEST['web']."', ";
			$cadena_sql.="`correo`='".$_REQUEST['correo']."', ";
			$cadena_sql.="`mision`='".$_REQUEST['mision']."', ";
			$cadena_sql.="`vision`='".$_REQUEST['vision']."', ";
			$cadena_sql.="`descripcion`='".$_REQUEST['descripcion']."', ";
			$cadena_sql.="`comentario`='".$_REQUEST['comentario']."', ";
			$cadena_sql.="`fecha`='".time()."', ";
			$cadena_sql.="`id_usuario`='".$variable['id_usuario']."' ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="`id_c_organizacion`='".$_REQUEST['id_elemento']."' ";
			break;
		
		case "select":
			$cadena_sql="SELECT ";
			$cadena_sql.="`id_c_organizacion` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_c_organizacion=".$_REQUEST['id_elemento']." ";
			$cadena_sql.="LIMIT 1 ";
			break;
		
		
		default:
			break;
	}

	return $cadena_sql;

}

function sesion_elemento($configuracion,$acceso_db,$variable)
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
