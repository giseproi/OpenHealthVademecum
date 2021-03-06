<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Grupo de Investigacion en Telemedicina - GITEM                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2017                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 16 de noviembre de 2017
****************************************************************************
* @subpackage   logout
* @package	bloques
* @copyright    
* @version      0.3
* @author      	Paulo Cesar Coronado
* @link		http://gitem.udistrital.edu.co/sitem
* @description  Bloque principal para la administración de usuarios
*
****************************************************************************/

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/dbms.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/sesion.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if($enlace)
{
	$nueva_sesion=new sesiones($configuracion);
	$nueva_sesion->especificar_enlace($enlace);
	$esta_sesion=$nueva_sesion->numero_sesion();
	//Rescatar el valor de la variable usuario de la sesion
	$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"usuario");
	if($registro)
	{
		
		$el_usuario=$registro[0][0];
	}
	$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
	if($registro)
	{
		
		$usuario=$registro[0][0];
	}
	
	
	$cripto=new encriptar();
	if(!isset($_REQUEST["opcion"]))
	{	
		menu_desambiguacion($el_usuario,$configuracion,$cripto,$usuario,$acceso_db);
	}
	else
	{	
		$acceso=$_REQUEST["opcion"];
		redireccion_desambiguacion($configuracion, $acceso, $nueva_sesion, $esta_sesion,$acceso_db , $cripto);
	
	}
}




/*==================================================================
*                     Funciones
*===================================================================*/

function menu_desambiguacion($el_usuario,$configuracion,$cripto,$usuario,$acceso_db)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%"><?php
					rol($usuario,$configuracion,$acceso_db,$cripto);					
					?>
					<tr>
						<td>
						<br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table><?php
}

function rol($usuario,$configuracion,$acceso_db,$cripto)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	//Buscar los roles
	$cadena_sql=cadena_busqueda_desambiguacion($configuracion,"roles",$usuario);
	$registro=acceso_db_desambiguacion($cadena_sql,$acceso_db,"busqueda");
	if(is_array($registro))
	{
		$total_registros=count($registro);
		if($total_registros>1)
		{
?><tr class="centralcuerpo">
	<td>
	<b>::::..</b> Roles Asignados
	</td>
</tr><?php
			for($contador=0;$contador<$total_registros;$contador++)
			{
				
?><tr class="bloquelateralcuerpo texto_centrado">
	<td>
	<a href="<?php
	$variable="pagina=desambiguacion";
	$variable.="&opcion=".$registro[$contador][0];
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo $indice.$variable;	
	?>"><?phpecho $registro[$contador][1]?></a>
	</td>
</tr><?php				
			}
		}
			
	}
}

function cadena_busqueda_desambiguacion($configuracion,$tipo,$variable="")
{
	switch($tipo)
	{
		case "roles":
			$cadena_sql="SELECT ";
			$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema".".id_subsistema, "; 
			$cadena_sql.=$configuracion["prefijo"]."subsistema".".etiqueta "; 
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema, "; 
			$cadena_sql.=$configuracion["prefijo"]."subsistema "; 
			$cadena_sql.="WHERE ";
			$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema".".id_usuario=".$variable." "; 
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema".".id_subsistema=";
			$cadena_sql.=$configuracion["prefijo"]."subsistema".".id_subsistema ";			
			break;	
			
		case "subsistema":
			$cadena_sql="SELECT ";
			$cadena_sql.=$configuracion["prefijo"]."subsistema.id_pagina, ";
			$cadena_sql.=$configuracion["prefijo"]."pagina.nombre ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."subsistema, ";
			$cadena_sql.=$configuracion["prefijo"]."pagina ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_subsistema=".$variable." ";
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."subsistema.id_pagina=".$configuracion["prefijo"]."pagina.id_pagina ";			
			$cadena_sql.="LIMIT 1";
		
		default:
			break;
	}
	//echo $cadena_sql;
	return $cadena_sql;



}

function acceso_db_desambiguacion($cadena_sql,$acceso_db,$tipo)
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


function redireccion_desambiguacion($configuracion, $acceso, $nueva_sesion, $esta_sesion,$acceso_db, $cripto)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$resultado = $nueva_sesion->borrar_valor_sesion($configuracion,"acceso",$esta_sesion);
	$resultado = $nueva_sesion->guardar_valor_sesion($configuracion,"acceso",$acceso,$esta_sesion);
	
	$cadena_sql=cadena_busqueda_desambiguacion($configuracion,"subsistema",$acceso);
	//echo $cadena_sql;exit;
	$campos=$acceso_db->registro_db($cadena_sql,0);
	if($campos>0)
	{
		$registro=$acceso_db->obtener_registro_db();
		$variable="pagina=".$registro[0][1];	
	}
	else
	{
		echo "No se logr&oacute; rescatar una secci&oacute;n v&aacute;lida";
	}
	
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo "<script>location.replace('".$indice.$variable."')</script>";

}