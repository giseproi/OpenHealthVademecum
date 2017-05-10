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

Última revisión 2 de junio de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
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
	if(isset($_REQUEST['id_procedimiento']))
	{
		$variable['id_procedimiento']=$_REQUEST['id_procedimiento'];
		$cadena_sql=cadena_sql_procedimiento($configuracion,"select",$variable);
		$registro=acceso_db_procedimiento($cadena_sql,$acceso_db,"busqueda");
		if(is_array($registro))
		{
			unset ($registro);
			unset($variables);
			$usuario=sesion_procedimiento($configuracion,$acceso_db,"id_usuario");
			if(is_array($usuario))
			{
				$variables["id_usuario"]=$usuario[0][0];
				if(($_FILES["imagen"]["name"]!="") && (strlen($_FILES["imagen"]["name"])>4))
				{
					$subir=subir_archivo_procedimiento("borrar","imagen",$configuracion);
					$variables["imagen"]=$subir;
				}
				else
				{
					$variables["imagen"]=$_REQUEST["imagen_anterior"];
				}
				$cadena_sql=cadena_sql_procedimiento($configuracion,"update",$variables);
				$resultado=acceso_db_procedimiento($cadena_sql,$acceso_db,"");
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
		unset($variables);
		$variables["denominacion"]="'".$_REQUEST["denominacion"]."'";
		$cadena_sql=cadena_sql_procedimiento($configuracion,"select",$variables);		
		$registro=acceso_db_procedimiento($cadena_sql,$acceso_db,"busqueda",$variables);
		if(is_array($registro))
		{
			unset ($registro);
			$opciones="pagina=registro_procedimiento";
			$opciones.="&opcion=corregir";
			enrutar_procedimiento($configuracion,$opciones);	
		}
		else
		{
			unset ($registro);
			unset($variables);
			$sesion=sesion_procedimiento($configuracion,$acceso_db,"id_usuario");
			if(is_array($sesion))
			{
				$variables["id_usuario"]=$sesion[0][0];
			}
			else
			{
				$variables["id_usuario"]="0";
			}
			$variables["imagen"]=subir_archivo_procedimiento("","imagen",$configuracion);
			$cadena_sql=cadena_sql_procedimiento($configuracion,"insertar",$variables);
			$resultado=acceso_db_procedimiento($cadena_sql,$acceso_db,"");
		}
		
	}
	if($resultado)
	{
		unset ($registro);
		$opciones="pagina=administrar_procedimiento";
		$opciones.="&accion=1";
		$opciones.="&hoja=1";
		$opciones.="&mostrar=lista";
		enrutar_procedimiento($configuracion,$opciones);	
	}
	else
	{
		unset ($registro);
		echo $cadena_sql;exit;
		$opciones="pagina=error_ingresar_datos";
		enrutar_procedimiento($configuracion,$opciones);
	}
}

//===========================================================================
//                         FUNCIONES
//===========================================================================



function acceso_db_procedimiento($cadena_sql,$acceso_db,$tipo)
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


function enrutar_procedimiento($configuracion,$variable)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo "<script>location.replace('".$indice.$variable."')</script>";
	
}

function subir_archivo_procedimiento($opcion,$campo,$configuracion)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/subir_archivo.class.php");
	
	$subir = new subir_archivo();
	$subir->directorio_carga= $configuracion['raiz_documento']."/fotografia/";
	$subir->nombre_campo=$campo;
	$subir->tipos_permitidos= array("jpg","png","eps","svg");
		
	// Maximo tamanno permitido
	//$subir->tamanno_maximo=5000000;
	$subir->especial= "[[:space:]]|[\"\*\\\'\%\$\&\@\<\>]";
			
	$subir->unico=TRUE;
	$subir->permisos=0444;
	$subir->cargar();
	if($subir->log["resultado"][0]=="ERROR")
	{
		return $subir->log["mi_archivo"][0]="N/D";
	}
	
	if($opcion=='borrar')
	{
		$subir->eliminar_archivo($_REQUEST["imagen_anterior"]);
	}
	return $subir->log["mi_archivo"][0];
}		


function cadena_sql_procedimiento($configuracion,$tipo,$variable="")
{
	
	switch($tipo)
	{
		case "insertar":
			$cadena_sql="INSERT INTO ";
			$cadena_sql.=$configuracion["prefijo"]."procedimiento "; 
			$cadena_sql.="( ";
			$cadena_sql.="`id_procedimiento`, ";
			$cadena_sql.="`denominacion`, ";
			$cadena_sql.="`definicion`, ";
			$cadena_sql.="`descripcion`, ";
			$cadena_sql.="`cups`, ";
			$cadena_sql.="`indicacion`, ";
			$cadena_sql.="`tecnica`, ";
			$cadena_sql.="`expectativa`, ";
			$cadena_sql.="`imagen`, ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`fecha` ";
			$cadena_sql.=") ";
			$cadena_sql.="VALUES ";
			$cadena_sql.="( ";
			$cadena_sql.="'".$_REQUEST['id_procedimiento']."', ";
			$cadena_sql.="'".$_REQUEST['denominacion']."', ";
			$cadena_sql.="'".$_REQUEST['definicion']."', ";
			$cadena_sql.="'".$_REQUEST['descripcion']."', ";
			$cadena_sql.="'".$_REQUEST['cups']."', ";
			$cadena_sql.="'".$_REQUEST['indicacion']."', ";
			$cadena_sql.="'".$_REQUEST['tecnica']."', ";
			$cadena_sql.="'".$_REQUEST['expectativa']."', ";
			$cadena_sql.="'".$variable['imagen']."', ";
			$cadena_sql.="'".$variable['id_usuario']."', ";
			$cadena_sql.="'".time()."' ";
			$cadena_sql.=")";
			
			break;
		
		case "update":
			$cadena_sql="UPDATE ";
			$cadena_sql.=$configuracion["prefijo"]."procedimiento ";
			$cadena_sql.="SET "; 
			$cadena_sql.="`id_procedimiento`='".$_REQUEST['id_procedimiento']."', ";
			$cadena_sql.="`denominacion`='".$_REQUEST['denominacion']."', ";
			$cadena_sql.="`definicion`='".$_REQUEST['definicion']."', ";
			$cadena_sql.="`descripcion`='".$_REQUEST['descripcion']."', ";
			$cadena_sql.="`cups`='".$_REQUEST['cups']."', ";
			$cadena_sql.="`indicacion`='".$_REQUEST['indicacion']."', ";
			$cadena_sql.="`tecnica`='".$_REQUEST['tecnica']."', ";
			$cadena_sql.="`expectativa`='".$_REQUEST['expectativa']."', ";
			$cadena_sql.="`fecha`='".time()."', ";
			$cadena_sql.="`id_usuario`='".$variable['id_usuario']."', ";
			$cadena_sql.="`imagen`='".$variable["imagen"]."' ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="`id_procedimiento`='".$_REQUEST['id_procedimiento']."' ";
			break;
		
		case "select":
			$cadena_sql="SELECT ";
			$cadena_sql.="`id_procedimiento`, ";
			$cadena_sql.="`denominacion`, ";
			$cadena_sql.="`definicion`, ";
			$cadena_sql.="`descripcion`, ";
			$cadena_sql.="`cups`, ";
			$cadena_sql.="`indicacion`, ";
			$cadena_sql.="`tecnica`, ";
			$cadena_sql.="`expectativa`, ";
			$cadena_sql.="`imagen`, ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`fecha` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."procedimiento ";
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

function sesion_procedimiento($configuracion,$acceso_db,$variable)
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
