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
	
	$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"acceso");
	if($registro)
	{
		
		$acceso=$registro[0][0];
	}
	
	$cripto=new encriptar();

	if(isset($_REQUEST['accion']))
	{
	
		if($_REQUEST['accion']=="logout")
		{
			salir($configuracion, $cripto, $nueva_sesion, $usuario, $acceso_db);
		}
	}
	
	menu_logout($el_usuario,$configuracion,$cripto,$usuario,$acceso_db,$acceso);
}




/*==================================================================
*                     Funciones
*===================================================================*/

function menu_logout($el_usuario,$configuracion,$cripto,$usuario,$acceso_db,$acceso)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%">
					<tr class="centralcuerpo">
						<td>
						<b>::::..</b>  Usuario Actual
						</td>
					</tr>
					<tr class="bloquelateralcuerpo" align="center">
						<td><b><?php			 
						if(isset($el_usuario))
						{
							echo $el_usuario;
						}?></b>						
						</td>
					</tr>
					<tr class="bloquelateralcuerpo" align="center">
						<td><hr class="hr_division">
							<a href="<?php		
							$variable="pagina=logout";
							$variable.="&accion=logout";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>">Terminar sesi&oacute;n<br><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/logout.png" alt="Terminar sesi&oacute;n" title="Terminar sesi&oacute;n" border="0" /></A>
						</td>
					</tr>
					<?php
					rol($usuario,$configuracion,$acceso_db, $acceso, $cripto);					
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

function salir($configuracion, $cripto, $sesion, $usuario, $acceso_db)
{
	$sesion->terminar_sesion($configuracion,$sesion->numero_sesion());
	@$log=$acceso_db->logger($configuracion,$usuario,"Salida del sistema.");
	unset($_REQUEST['action']);		
	$pagina=$configuracion["host"].$configuracion["site"]."/index.php?";
	
	$variable="pagina=index";
	
	//Codificar las variables	
	$variable=$cripto->codificar_url($variable,$configuracion);	
	echo "<script>location.replace('".$pagina.$variable."')</script>";
	
	
}

function rol($usuario,$configuracion,$acceso_db, $acceso, $cripto)
{
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	//Buscar los roles
	$cadena_sql=cadena_busqueda_logout($configuracion,"roles",$usuario);
	$registro=acceso_db_logout($cadena_sql,$acceso_db,"busqueda");
	if(is_array($registro))
	{
		$total_registros=count($registro);
		if($total_registros>1)
		{
?><tr class="centralcuerpo">
	<td>
	<b>::::..</b>  Otros Roles
	</td>
</tr><?php
			for($contador=0;$contador<$total_registros;$contador++)
			{
				if($acceso!=$registro[$contador][0])
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
</tr><?php				}
			}
		}
			
	}
}

function cadena_busqueda_logout($configuracion,$tipo,$variable="")
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
		
		default:
			break;
	}

	return $cadena_sql;



}

function acceso_db_logout($cadena_sql,$acceso_db,$tipo)
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
