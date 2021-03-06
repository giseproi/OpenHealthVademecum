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
* @subpackage   admin_usuario
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Bloque principal para la administración de usuarios
*
******************************************************************************/
?><?php
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
	
	$cadena_sql=cadena_busqueda($configuracion);
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
?><table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="100%">
	<tr>
		<td >
			<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/importante.png" border="0" />
					</td>
					<td align="left">
						<b>No existen usuarios que cumplan con los criterios de b&uacute;squeda.</b>
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
?><form method="post" action="index.php" name="activar_usuario">
<table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1 px" class="bloquelateral">
					<tr align="center" class="bloquecentralencabezado">
						<td >Usuario</td>
						<?php //<td>Correo</td> ?>
						<td>Tipo</td>
						<td>Estado</td>
						<td colspan="2">Opciones</td>
					</tr>
						<?php
	for($contador=0;$contador<$campos;$contador++)
	{
								?>
					<?php/*Campo oculto con el id_usuario para poder realizar la actualización de la información*/?>							
					<tr class="bloquecentralcuerpo" onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor="<?php echo $tema->celda ?>"><?php echo $registro[$contador][0]." ". $registro[$contador][1] ?>
						<input type="hidden" name= "usuario<?php echo $contador ?>" value="<?phpecho $registro[$contador][3] ?>">
						<input type="hidden" name= "subsistema<?php echo $contador ?>" value="<?phpecho $registro[$contador][5] ?>">
						<input type="hidden" name= "hoja" value="<?phpecho $_REQUEST["hoja"] ?>">
						<input type="hidden" name= "accion" value="<?phpecho $_REQUEST["accion"] ?>">
						<?php/*Campos ocultos para dar continuidad al formulario actual*/?>
						<input type="hidden" name= "nombre<?php echo $contador ?>" value="<?phpecho $registro[$contador][6] ?>">
						</td>
						<?php /*<td class="celdatabla"><?php echo $registro[$contador][2] ?></td>*/?>
						<td align="center" bgcolor="<?php echo $tema->celda ?>"><?php echo $registro[$contador][7] ?></td>
						<td align="center" bgcolor="<?php echo $tema->celda ?>"><?php 
		if($registro[$contador][6]==0)
		{
			echo '<input name=tipo'.$contador.' value="'.$registro[$contador][5].'" type="checkbox">';
			echo '<input type="hidden" name= "estado'.$contador.'" value="0">';
		}
		else
		{
			echo '<input name=tipo'.$contador.' value="'.$registro[$contador][5].'" type="checkbox" checked="checked" >';
			echo '<input type="hidden" name= "estado'.$contador.'" value="1">';
		}
									
							?></td>
						<td align="center" bgcolor="<?php echo $tema->celda ?>">
						<a href="<?php
									$variable="pagina=registro_admin_usuario";
									$variable.="&opcion=editar";
									$variable.="&id_usuario=".$registro[$contador][3];
									$variable.="&hoja=".$_REQUEST["hoja"];
									$variable.="&accion=".$_REQUEST["accion"];
									$variable.="&mostrar=".$_REQUEST["mostrar"];
									$variable=$cripto->codificar_url($variable,$configuracion);
									echo $indice.$variable;	
						?>"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar.png" alt="Editar Usuario" title="Editar Usuario" border="0" /></a>
						</td>
						<td align="center" bgcolor="<?php echo $tema->celda ?>">
						<a href="<?php
									$variable="pagina=borrar_usuario";
									$variable.="&opcion=usuario";
									$variable.="&id_usuario=".$registro[$contador][3];
									$variable.="&subsistema=".$registro[$contador][5];
									$variable.="&hoja=".$_REQUEST["hoja"];
									$variable.="&accion=".$_REQUEST["accion"];
									$variable.="&mostrar=".$_REQUEST["mostrar"];
									$variable=$cripto->codificar_url($variable,$configuracion);
									echo $indice.$variable;	
						?>"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_borrar.png" alt="Borrar usuario del sistema" title="Borrar usuario del sistema" border="0" /></A>
						</td>	
					</tr><?php
	}
	?>				<tr>
					<td style="text-align: center;" colspan="6" rowspan="1">
					<input type="hidden" name="action" value="admin_usuario">
					<input value="aceptar" name="aceptar" type="submit"> </td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
				
				
				<br>
</form><?php
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


function cadena_busqueda($configuracion)
{
	$cadena_sql="SELECT ";
	$cadena_sql.="".$configuracion["prefijo"]."registrado.nombre,";
	$cadena_sql.="".$configuracion["prefijo"]."registrado.apellido,";
	$cadena_sql.="".$configuracion["prefijo"]."registrado.correo,";	
	$cadena_sql.="".$configuracion["prefijo"]."registrado.id_usuario,";
	$cadena_sql.="".$configuracion["prefijo"]."registrado.usuario, ";
	$cadena_sql.="".$configuracion["prefijo"]."registrado_subsistema.id_subsistema,";
	$cadena_sql.="".$configuracion["prefijo"]."registrado_subsistema.estado,";
	$cadena_sql.="".$configuracion["prefijo"]."subsistema.etiqueta ";
	$cadena_sql.="FROM ";
	$cadena_sql.=$configuracion["prefijo"]."registrado, "; 
	$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema, "; 	
	$cadena_sql.=$configuracion["prefijo"]."subsistema "; 	
	
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
			//Todos los usuarios
			case '1':
				
				$cadena_sql.="WHERE ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.estado<2 ";
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
				$cadena_sql.="ORDER BY estado, id_subsistema,".$configuracion["prefijo"]."registrado.nombre";				
				break;
				
			//Activos	
			case '2':
				$cadena_sql.="WHERE ".$configuracion["prefijo"]."registrado_subsistema.estado=1 ";
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
				$cadena_sql.="ORDER BY estado,  id_subsistema,".$configuracion["prefijo"]."registrado.nombre";
				break;
			
			//Inactivos		
			case '3':	
				$cadena_sql.="WHERE ".$configuracion["prefijo"]."registrado_subsistema.estado=0 ";
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
				$cadena_sql.="ORDER BY estado,  id_subsistema,".$configuracion["prefijo"]."registrado.nombre";
				break;
			
			
			//Filtrado
			case '4':
				
				if(isset($_REQUEST['busqueda']))
				{
					$buscar=explode(" ",$_REQUEST['busqueda']);
				}	
				
				$buscar_nombre='';
				$buscar_apellido='';
				$buscar_correo='';
				
				while (list ($clave, $val) = each ($buscar)) {
					$buscar_nombre.="".$configuracion["prefijo"]."registrado.nombre like '%".$val."%' OR ";
					$buscar_apellido.="".$configuracion["prefijo"]."registrado.apellido like '%".$val."%' OR ";
					$buscar_correo.="".$configuracion["prefijo"]."registrado.correo like '%".$val."%' OR ";
				}
				
				$buscar_todo=$buscar_nombre.$buscar_apellido.substr($buscar_correo,0,(strlen($buscar_correo)-3));
				$buscar_todo=$buscar_todo." AND (".$configuracion["prefijo"]."registrado_subsistema.estado<2) "; 
				//echo $buscar_todo;
								
				$cadena_sql.="WHERE ";
				$cadena_sql.="(".$buscar_todo.")";
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
				$cadena_sql.="ORDER BY estado,  id_subsistema,".$configuracion["prefijo"]."registrado.nombre";
				//echo $cadena_sql;
				break;	
				
						
			
			default:
				$cadena_sql.="WHERE ".$configuracion["prefijo"]."registrado_subsistema.estado<2 ";
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
				$cadena_sql.="AND ";
				$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
				$cadena_sql.="ORDER BY estado,  id_subsistema,".$configuracion["prefijo"]."registrado.nombre";
				break;
					
			
		}
	}
	else
	{
		$cadena_sql.="WHERE ".$configuracion["prefijo"]."registrado_subsistema.estado<2 ";
		$cadena_sql.="AND ";
		$cadena_sql.=$configuracion["prefijo"]."registrado.id_usuario=".$configuracion["prefijo"]."registrado_subsistema.id_usuario ";  
		$cadena_sql.="AND ";
		$cadena_sql.=$configuracion["prefijo"]."registrado_subsistema.id_subsistema=".$configuracion["prefijo"]."subsistema.id_subsistema ";  
		
		$cadena_sql.="ORDER BY estado, id_subsistema,".$configuracion["prefijo"]."registrado.nombre";
		
	}
	//echo $cadena_sql;
	return $cadena_sql;
}
?>