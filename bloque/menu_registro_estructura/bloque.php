<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
index.php 

Copyright (C) 2010-2016

Última revisión 11 de septiembre de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	
* @link		N/D
* @description  Menu principal del bloque entidades de salud
* @usage        
*****************************************************************************/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}


include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/db.class.php");


//Rescatar los componentes
if(isset($_REQUEST["id_entidad"]))
{
	$id_componente=$_REQUEST["id_entidad"];
	$fila=0;
	$acceso_db=new dbms($configuracion);
	$enlace=$acceso_db->conectar_db();
	
	if (is_resource($enlace))
	{
		$sesion=new sesiones($configuracion);
		$sesion->especificar_enlace($enlace);
		$mi_sesion=$sesion->numero_sesion();
		
		
		//Rescatar todos los componentes del modelo.
		$cadena_sql=cadena_busqueda_menu_estructura($configuracion, "nivel", $id_componente);
		$registro=db::acceso($cadena_sql,$acceso_db,"busqueda");
			
		if(is_array($registro))
		{
			if($registro[0][0]!=NULL)
			{
				$editar=true;
			}
			else
			{
				$editar=false;
			}
		}
	
	}
	
	
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	?><table width="100%" align="center" border="0" cellpadding="7" cellspacing="0" >
		<tbody>
			<tr>
				<td >
					<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%">
						<tr class="centralcuerpo">
							<td>
							<b>:..</b> Estructura
							</td>
						</tr>
						<tr class="bloquelateralcuerpo">
							<td><?php
								if($editar==false)
								{
							?>	<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_nueva_estructura_off.png" alt="Nueva Estructura" title="Nueva Estructura Organizativa" border="0" usemap="#nueva_estructura" id="nueva_estructura" /><?php
								}
								else
								{
							?>	<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar_estructura_off.png" alt="Editar Estructura" title="Editar la Estructura Organizativa" border="0" usemap="#editar_estructura" id="editar_estructura" /><?php
								}
							?></td>
						</tr>
						<tr>
							<td>
								<br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			</tbody>
	</table>
	<map name="nueva_estructura">
	<area shape="rect" coords="0,0,100,31" href="<?php		
								$variable="pagina=registro_estructura";
								$variable.="&opcion=nuevo";
								if(isset($_REQUEST["id_entidad"]))
								{
								$variable.="&id_entidad=".$_REQUEST["id_entidad"];
								}
								$variable=$cripto->codificar_url($variable,$configuracion);
								echo $indice.$variable;		
								?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('nueva_estructura','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_nueva_estructura_on.png')"/>
	</map>
	<map name="editar_estructura">
	<area shape="rect" coords="0,0,100,31" href="<?php		
								$variable="pagina=registro_estructura";
								$variable.="&opcion=editar";
								if(isset($_REQUEST["id_entidad"]))
								{
								$variable.="&id_entidad=".$_REQUEST["id_entidad"];
								}
								$variable=$cripto->codificar_url($variable,$configuracion);
								echo $indice.$variable;		
								?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('editar_estructura','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar_estructura_on.png')"/>
	</map><?php
}
else
{
	$cadena=htmlentities("Imposible determinar la entidad.");
	alerta::sin_registro($configuracion,$cadena);	
}

//***************************************************************************
//                         Funciones  
//***************************************************************************
function cadena_busqueda_menu_estructura($configuracion, $tipo, $valor)
{
	switch($tipo)
	{
		case "nivel":
			$cadena_sql="SELECT ";
			$cadena_sql.="MAX(nivel) ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_componente=".$valor." ";
			
			
		break;
		
		default:
		break;	
	
	}
	
	return $cadena_sql;



}