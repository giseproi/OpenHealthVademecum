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

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
//Se incluye para manejar los mensajes de error
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/navegacion.class.php");

//Pagina a donde direcciona el menu
$pagina="sede_entidad";

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
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
	
	//Rescatar las sedes que pèrtenecen a la entidad
	$cadena_sql=cadena_busqueda_sede($configuracion,$usuario,"completa");
	$cadena_hoja=$cadena_sql;
	
	//Si no se viene de una hoja anterior
	if(!isset($_REQUEST["hoja"]))
	{
		$_REQUEST["hoja"]=1;
	}
	$cadena_hoja.=" LIMIT ".(($_REQUEST["hoja"]-1)*$configuracion['registro']).",".$configuracion['registro'];	
	//echo $cadena_hoja;
	
	//Rescatar todos las sedes
		
	$registro=ejecutar_admin_sede($cadena_sql,$acceso_db);	
	if(is_array($registro))
	{	
		$campos=count($registro);
		$hojas=ceil($campos/$configuracion['registro']);	
	}
	else
	{
		$hojas=1;
	
	}
	
	//Rescatar una hoja específica
	$registro=ejecutar_admin_sede($cadena_sql,$acceso_db);	
	if(!is_array($registro))
	{	
		
		$cadena="En la actualidad esta entidad no tiene registrada ninguna sede";
		$cadena=htmlentities($cadena, ENT_COMPAT, "UTF-8");
		alerta::sin_registro($configuracion,$cadena);	
	}
	else
	{
		$campos=count($registro);
		if(isset($_REQUEST["opcion"]))
		{
			if($_REQUEST["opcion"]=="lista")
			{
				$variable["pagina"]="sede_entidad";
				$variable["opcion"]=$_REQUEST["opcion"];
				$variable["registro_padre"]=$_REQUEST["registro_padre"];
				
				$menu=new navegacion();
				if($hojas>1)
				{
				$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$pagina,$variable);
				}
				con_registro_sede($configuracion,$registro,$campos,$tema,$acceso_db);
				$menu->menu_navegacion($configuracion,$_REQUEST["hoja"],$hojas,$pagina);
			}
			else
			{
				estadistica($configuracion,$registro);
			}
		}
	}
}



/****************************************************************
*  			Funciones				*
****************************************************************/



function con_registro_sede($configuracion,$registro,$campos,$tema,$acceso_db)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$cripto=new encriptar();
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	//Rescatar el nombre de la entidad
	$cadena_sql=cadena_busqueda_sede($configuracion,"","nombre_padre");
	$este_registro=ejecutar_admin_sede($cadena_sql,$acceso_db);	
	if(is_array($este_registro))
	{
		$nombre_entidad=$este_registro[0][0];
	}
	else
	{
		$nombre_entidad="";
	}	
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					<tr class="centralcuerpo">
						<td>
						.::: Sedes de <?php echo $nombre_entidad?>
						</td>
					</tr>
					<?php
	for($contador=0;$contador<$campos;$contador++)
	{			?>	<tr class="bloquecentralcuerpo" >
						<td>
							<table width="100%" class="bloquecentralcuerpo" cellpadding="0" cellspacing="0">
								<tr>
									<td>
									<a href="<?php
									$variable="pagina=registro_sede";
									$variable.="&opcion=mostrar";
									$variable.="&googlemaps=true";
									$variable.="&registro=".$registro[$contador][0];
									$variable.="&registro_padre=".$registro[$contador][1];
									$variable=$cripto->codificar_url($variable,$configuracion);
									echo $indice.$variable;	
						                        ?>"><b><?php echo $registro[$contador][4] ?></b></a>	
									</td>
									<td align="center" width="5%"><?php
									if($_REQUEST["accion"]==1)
									{
									?><a href="<?php
									$variable="pagina=registro_sede";
									$variable.="&opcion=editar";
									$variable.="&id_sede=".$registro[$contador][0];
									$variable=$cripto->codificar_url($variable,$configuracion);
									echo $indice.$variable;	
									?>"><img width="24" heigth="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/editar.png"?>" alt="Editar esta medicamento" title="Editar esta medicamento" border="0" />	
									<?php
									}
									?></td>
								</tr>
								<tr>
									<td>
									<span class="texto_negrita">Direcci&oacute;n: </span><?php echo $registro[$contador][9] ?>
									</td>
									<td align="center" width="5%" ><?php
									if($_REQUEST["accion"]==1)
									{
									?><a href="<?php
									$variable="pagina=borrar_registro";
									$variable.="&opcion=entidad";
									$variable.="&registro=".$registro[$contador][0];
									$redireccion="";		
									reset ($_REQUEST);
									while (list ($clave, $val) = each ($_REQUEST)) 
									{
										$redireccion.="&".$clave."=".$val;
										
									}
									
									$variable.="&redireccion=".$cripto->codificar_url($redireccion,$configuracion);
									
									$variable=$cripto->codificar_url($variable,$configuracion);
									
									echo $indice.$variable;	
									?>"><img width="24" heigth="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/boton_borrar.png"?>" alt="Borrar esta medicamento" title="Borrar esta medicamento" border="0" /></a>	
									<?php
									}
									?></td>
								</tr>
								<tr>
									<td colspan="2">
									<span class="texto_negrita">Tel&eacute;fono: </span><?php echo $registro[$contador][10] ?>	
									</td>
								</tr>
								<tr>
									<td colspan="2">
									<hr class="hr_subtitulo">	
									</td>
								</tr>
							</table>
						</td>
					</tr><?php
	}
	?>			</table>
			</td>
		</tr>
	</tbody>
</table><?php
}

function estadistica($configuracion,$contador)
{?><table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="100%">
	<tr>
		<td >
			<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/info.png" border="0" />
					</td>
					<td align="left">
						Actualmente hay <b><?php echo $contador ?> usuarios</b> registrados.
					</td>
				</tr>
				<tr class="bloquecentralcuerpo">
					<td align="right" colspan="2" >
						<a href="<?php
						echo $configuracion["site"].'/index.php?page='.enlace('admin_dir_dedicacion').'&registro='.$_REQUEST['registro'].'&accion=1&hoja=0&opcion='.enlace("mostrar").'&admin='.enlace("lista"); 
						
						?>">Ver m&aacute;s informaci&oacute;n >></a>
					</td>
				</tr>
			</table> 
		</td>
	</tr>  
</table>
<?php}


function cadena_busqueda_sede($configuracion,$valor,$opcion="")
{
	
	switch($opcion)
	{
		case "completa":	
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
			$cadena_sql.="`tipo`, ";
			$cadena_sql.="`latitud`, ";
			$cadena_sql.="`longitud` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."entidad ";  
			
			
			if(isset($_REQUEST["accion"]))
			{
				
				$variable="";
				
				reset ($_REQUEST);
				while (list ($clave, $val) = each ($_REQUEST)) 
				{
					
					if($clave!='pagina')
					{
						$variable.="&".$clave."=".$val;
						//echo $clave;
					}
				}		
				
				switch($_REQUEST["accion"])
				{	
					//Todas las sedes de la entidad
					//Tipo: 0: entidad 1: Sede 2: Dependencia (Componentes de una sede)
					case '1':				
						$cadena_sql.="WHERE ";
						$cadena_sql.="id_padre=".$_REQUEST["registro_padre"]." ";
						$cadena_sql.="AND ";
						$cadena_sql.="tipo=1 ";
						$cadena_sql.="ORDER BY id_entidad ";				
						break;
						
					//Todas los servicios que cumplan con el criterio de busqueda
					case '2':
						$cadena_sql.="WHERE ";
						if(isset($_REQUEST["opcion"]))
						{
							switch ($_REQUEST["opcion"])
							{
								//Por denominacion, descripcion o etimologia
								case 0:
									$cadena_sql.="denominacion like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="definicion like '%".$_REQUEST["busqueda"]."%' ";			
									$cadena_sql.="OR ";
									$cadena_sql.="etimologia like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="descripcion like '%".$_REQUEST["busqueda"]."%' ";						
									break;
								//Por Codigo
								case 1:
									$cadena_sql.="codigo like '%".$_REQUEST["busqueda"]."%' ";
									break;
								//Por Todos los campos	
								case 2:
									$cadena_sql.="denominacion like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="definicion like '%".$_REQUEST["busqueda"]."%' ";			
									$cadena_sql.="OR ";
									$cadena_sql.="etimologia like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="descripcion like '%".$_REQUEST["busqueda"]."%' ";						
									$cadena_sql.="OR ";
									$cadena_sql.="codigo like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="especialista like '%".$_REQUEST["busqueda"]."%' ";
									$cadena_sql.="OR ";
									$cadena_sql.="perfil like '%".$_REQUEST["busqueda"]."%' ";
									
									break;
							}
						}
						$cadena_sql.="ORDER BY id_entidad ";				
						
						break;
						
								
					
					
					default:
						$cadena_sql.="ORDER BY id_entidad ";				
						break;
							
					
				}
			}
			else
			{
				$cadena_sql.="ORDER BY id_entidad ";				
				
			}
			break;
			
		case	"nombre_padre":
			$cadena_sql="SELECT ";
			$cadena_sql.="`etiqueta` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."entidad ";  
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_entidad=".$_REQUEST["registro_padre"]." ";
			$cadena_sql.="LIMIT 1";			
			break;
		
		default:
			break;
	}
	//echo $cadena_sql;
	return $cadena_sql;
}

function ejecutar_admin_sede($cadena_sql,$acceso_db)
{
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	return $registro;
}
?>
