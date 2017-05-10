<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    GRUPO DE INVESTIGACION EN TELEMEDICINA                                #
#    Directora General:                                                    #
#    Dra LILIA EDITH APARICIO P.                                           #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2017                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo LICENCIA.txt que viene con la distribucion  #
############################################################################
*/
/****************************************************************************
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 26 de junio de 2016
*****************************************************************************
* @subpackage   admin_entidad
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Bloque principal para la administración de usuarios
*
******************************************************************************/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");


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
	
	$cadena_sql=cadena_busqueda($configuracion,$usuario);
	$cadena_hoja=$cadena_sql;
	
	if(!isset($_REQUEST["hoja"]))
	{
		$_REQUEST["hoja"]=1;
	}
	$cadena_hoja.=" LIMIT ".(($_REQUEST["hoja"]-1)*$configuracion['registro']).",".$configuracion['registro'];	
	//echo $cadena_hoja;
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();	
	if($campos>0)
	{
		$hoja=ceil($campos/$configuracion['registro']);	
	}
	else
	{
		$hoja=1;
	
	}
	
	$acceso_db->registro_db($cadena_hoja,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos==0)
	{
		sin_registro($configuracion);	
	}
	else
	{
		if(isset($_REQUEST["mostrar"]))
		{
			if($_REQUEST["mostrar"]=="lista")
			{
				navegacion($configuracion,$hoja);
				con_registro($configuracion,$registro,$campos,$tema);
				navegacion($configuracion,$hoja);
			}
			else
			{
				estadistica($configuracion,$registro);
			}
		}		
		else
		{
			estadistica($configuracion,$campos);	
		}
	}
}



/****************************************************************
*  			Funciones				*
****************************************************************/

function sin_registro($configuracion)
{
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tr>
		<td >
			<table style="text-align: left;" border="0"  cellpadding="5px" cellspacing="0" class="bloquelateral" width="100%">
				<tr>
					<td >
						<table cellpadding="10" cellspacing="0" align="center">
							<tr class="bloquecentralcuerpo">
								<td valign="middle" align="right" width="10%">
									<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/importante.png" border="0" />
								</td>
								<td align="left">
									<b>No existen entidades registradas que cumplan con los criterios de b&uacute;squeda.</b>
								</td>
							</tr>
						</table> 
					</td>
				</tr>  
			</table>
		</td>
	</tr>  
</table><?php
}


function con_registro($configuracion,$registro,$campos,$tema)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$cripto=new encriptar();
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1px" >
					<?php
	for($contador=0;$contador<$campos;$contador++)
	{			?>	<tr class="bloquecentralcuerpo" >
						<td align="center" >
							<img width="80" src="<?php echo $configuracion["host"].$configuracion["site"]."/fotografia/".$registro[$contador][5] ?>" alt="Logo Entidad" title="Logo Entidad" border="0" />
						</td>												
						<td >
							<table width="100%" class="bloquecentralcuerpo" cellpadding="0" cellspacing="0">
								<tr>
									<td>
									<a href="<?php
									$variable="pagina=informacion_entidad";
									$variable.="&opcion=mostrar";
									$variable.="&registro=".$registro[$contador][0];
									$variable=$cripto->codificar_url($variable,$configuracion);
									echo $indice.$variable;	
						                        ?>"><b><?php echo $registro[$contador][3] ?></b></a>	
									</td>
									<td align="center" width="5%">
										<img width="24" heigth="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/editar.png"?>" alt="Editar esta Entidad" title="Editar esta Entidad" border="0" />	
									</td>
								</tr>
								<tr>
									<td>
									<?php echo $registro[$contador][8] ?>	
									</td>
									<td align="center" width="5%" >
										<img width="24" heigth="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]."/boton_borrar.png"?>" alt="Borrar esta Entidad" title="Borrar esta Entidad" border="0" />	
									</td>
								</tr>
								<tr>
									<td colspan="2">
									<b>Tel&eacute;fono:</b> <?php echo $registro[$contador][9] ?>	
									</td>
								</tr>
								<tr>
									<td colspan="2">
									<b>NIT:</b> <?php echo $registro[$contador][6] ?>	
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

function navegacion($configuracion,$hoja)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$cripto=new encriptar();
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";

?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table width="100%" cellpadding="2" cellspacing="2" class="bloquelateral">
				<tr class="bloquecentralcuerpo">
					<td align="left" class="celdatabla" width="33%">
					<?php
						if($_REQUEST["hoja"]>1)
						{
					?>
					<a title="Pasar a la p&aacute;gina No <?php echo $_REQUEST["hoja"] ?>" href="<?php
					
					$variable="pagina=admin_usuario";	
					
					reset ($_REQUEST);
					while (list ($clave, $val) = each ($_REQUEST)) {
						
						if($clave!='page' && $clave!='hoja')
						{
							$variable.="&".$clave."=".$val;
							//echo $clave;
						}
						else
						{
							if($clave=='hoja')
							{
								$variable.="&".$clave."=".($val-1);
								//echo $variable;
							}
							
						}
						
					}	
					$variable=$cripto->codificar_url($variable,$configuracion);
					echo $indice.$variable;	
					
					
					
				
				?>"><< Anterior</a>
					<?php	} 
					?>
					</td>
					<td align="center" class="celdatabla">
					Hoja <?php echo ($_REQUEST["hoja"]) ?> de <?php echo ($hoja) ?>
					</td>
					<td align="right" class="celdatabla" width="33%">
					<?php
						if($_REQUEST["hoja"]<$hoja)
						{
					?>
					<a title="Pasar a la p&aacute;gina No <?php echo $_REQUEST["hoja"]+1 ?>" href="<?php
					$variable="pagina=admin_usuario";	
					
					reset ($_REQUEST);
					while (list ($clave, $val) = each ($_REQUEST)) {
						
						if($clave!='page' && $clave!='hoja')
						{
							$variable.="&".$clave."=".$val;
							//echo $clave;
						}
						else
						{
							if($clave=='hoja')
							{
								$variable.="&".$clave."=".($val+1);
								//echo $variable;
							}
							
						}
						
					}	
					$variable=$cripto->codificar_url($variable,$configuracion);
					echo $indice.$variable;	
				
				?>">Siguiente>></a>
				<?php
					}
				?>
					</td>
				</tr>
				</table>
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


function cadena_busqueda($configuracion,$usuario)
{
	
	$cadena_sql="SELECT ";
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
	$cadena_sql.="`web`, ";
	$cadena_sql.="`correo`, ";
	$cadena_sql.="`descripcion`, ";
	$cadena_sql.="`comentario` ";
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
			//Todas las entidades que el usuario haya creado
			case '1':				
				$cadena_sql.="WHERE ";
				$cadena_sql.="id_usuario=".$usuario." ";
				$cadena_sql.="AND ";
				$cadena_sql.="tipo=0 ";
				$cadena_sql.="ORDER BY nombre ";				
				break;
				
			//Todas las entidades que cumplan con el criterio de busqueda
			case '2':
				$cadena_sql.="WHERE ";
				$cadena_sql.="( ";
				if(isset($_REQUEST["opcion"]))
				{
					switch ($_REQUEST["opcion"])
					{
						//Por nombre
						case 0:
							$cadena_sql.="nombre like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="etiqueta like '%".$_REQUEST["busqueda"]."%' ";			
							break;
						//Por NIT
						case 1:
							$cadena_sql.="nit like '%".$_REQUEST["busqueda"]."%' ";
							break;
						//Por Todos los campos	
						case 2:
							$cadena_sql.="nombre like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="etiqueta like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="nit like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="direccion like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="telefono like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="descripcion like '%".$_REQUEST["busqueda"]."%' ";
							$cadena_sql.="OR ";
							$cadena_sql.="fundacion like '%".$_REQUEST["busqueda"]."%' ";
							
							
							break;
					}
				}
				$cadena_sql.=") ";
				$cadena_sql.="AND ";
				$cadena_sql.="tipo=0 ";
				$cadena_sql.="ORDER BY nombre ";				
				
				break;
				
						
			
			default:
				$cadena_sql.="WHERE ";
				$cadena_sql.="id_usuario=".$usuario." ";
				$cadena_sql.="AND ";
				$cadena_sql.="tipo=0 ";
				$cadena_sql.="ORDER BY nombre ";				
				break;
					
			
		}
	}
	else
	{
		$cadena_sql.="WHERE ";
		$cadena_sql.="id_usuario=".$usuario." ";
		$cadena_sql.="AND ";
		$cadena_sql.="tipo=0 ";
		$cadena_sql.="ORDER BY nombre ";				
		
	}
	//echo $cadena_sql;
	return $cadena_sql;
}
?>
