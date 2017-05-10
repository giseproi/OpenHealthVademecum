<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2017                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
html.php 

Paulo Cesar Coronado
Copyright (C) 2010-2017

Última revisión 6 de Marzo de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario de registro de entidades
* @usage        Toda pagina tiene un id_pagina que es propagado por cualquier metodo GET, POST.
*******************************************************************************/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");

$estilo=$this->estilo;

$formulario="registro_sede";
$verificar="control_vacio(".$formulario.",'nombre')";
$verificar.="&& control_vacio(".$formulario.",'etiqueta')";
$verificar.="&& control_vacio(".$formulario.",'direccion')";
$verificar.="&& control_vacio(".$formulario.",'telefono')";
$verificar.="&& longitud_cadena(".$formulario.",'nombre',3)";

$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();

if (is_resource($enlace))
{
	if(isset($_REQUEST['opcion']))
	{
		$accion=$_REQUEST['opcion'];
		
		if($accion=="mostrar")
		{
			
			if(isset($_REQUEST['registro']))
			{
				mostrar_registro($configuracion,$tema,$_REQUEST['registro'], $acceso_db, $formulario);
			}
		}
		else
		{
			
			if($accion=="nuevo")
			{
				nuevo_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab, $estilo);
			
			}
			else
			{
				if($accion=="editar")
				{
					editar_registro($configuracion,$tema,$_REQUEST['registro'], $acceso_db, $formulario);
				
				}
				else
				{
					if($accion=="corregir")
					{
						corregir_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
					
					}
				}		
			}
			
		
		}
	}
	else
	{
		$accion="nuevo";
		nuevo_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
	}
}
/****************************************************************************************
*				Funciones						*
****************************************************************************************/

function nuevo_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$estilo)
{

	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$cripto=new encriptar();
	$datos="";
	$contador=0;
?><form enctype='multipart/form-data' method="post" action="index.php" name="<?php echo $formulario?>">
<table width="100%" cellpadding="12" cellspacing="0"  align="center">
	<tbody>
		<tr>
			<td align="center" valign="middle">
				<table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
					<tr>
					<td>
					<table align='center' width='100%' cellpadding='7' cellspacing='1'>
						<tr class="bloquecentralencabezado">
							<td colspan="2" rowspan="1">::.. Registro para Nuevas Sedes</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Nombre de la Sede:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<textarea name='nombre' cols='35' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Nombre Corto:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='etiqueta' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>						
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Tel&eacute;fono Principal (PBX):
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='telefono' size='35' maxlength='50' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Correo Electr&oacute;nico:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='correo' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td bgcolor='<?php echo $tema->celda ?>'>
								Tipo de Sede:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'><?php
							include_once($configuracion["raiz_documento"].$configuracion["clases"]."/html.class.php");
							$html=new html();
							
							$busqueda="SELECT ";
							$busqueda.="valor, ";
							$busqueda.="etiqueta ";
							$busqueda.="FROM ";
							$busqueda.=$configuracion["prefijo"]."variable ";
							$busqueda.="WHERE ";
							$busqueda.="tipo=0 ";
							$busqueda.="ORDER BY ";
							$busqueda.="valor ";
							
							$mi_cuadro=$html->cuadro_lista($busqueda,'tipo',$configuracion,-1,0,0);
							echo $mi_cuadro;	
							?></td>
						</tr>					
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								Breve descripci&oacute;n de la Sede:
							</td>
						</tr>
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='descripcion' name='descripcion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('descripcion', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Direcci&oacute;n Principal:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='direccion' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Ubicaci&oacute;n </span>(Por favor coloque un marcador sobre la sede):
							</td>
						</tr>
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<div id="map" style="width: 100%; height: 300px"></div>
							</td>
						</tr>
						<tr align="center" class="bloquecentralcuerpo">
							<td align="center"><?php
							$datos.="&action=registro_sede";						
							$datos.="&registro_padre=".$_REQUEST["registro_padre"];
							$datos=$cripto->codificar($datos,$configuracion);	
							?>	<input type='hidden' name='formulario' value="<?php echo $datos ?>">
								<input type='hidden' id="longitud" name='longitud'>
								<input type='hidden' id="latitud" name='latitud' >
								<input type='hidden' id="categoria" name='categoria' value="entidad">								
								<input value="Enviar" name="aceptar" tabindex='<?php echo $tab++ ?>' type="button" onclick="if(<?php echo $verificar; ?>){syncTextarea();document.forms['<?php echo $formulario?>'].submit()}else{false}"><br>								
							</td>
							<td align="center">
								<input name='cancelar' value='Cancelar' type='submit'><br>
							</td>
						</tr>
					</table>
					</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</form>
<?php
}


function editar_registro($configuracion,$tema,$id_entidad,$acceso_db,$formulario)
{
	
	$nueva_sesion=new sesiones($configuracion);
	$nueva_sesion->especificar_enlace($enlace);
	$esta_sesion=$nueva_sesion->numero_sesion();
	//Rescatar el valor de la variable usuario de la sesion
	$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
	if($registro)
	{
		
		$id_usuario=$registro[0][0];
	}
	
	$variable["id_entidad"]=$id_entidad;
	$cadena_sql=cadena_sql_sede($configuracion,"select",$variable);
	$registro=ejecutar_busqueda_sede($cadena_sql,$acceso_db);	
	if(is_array($registro))
	{		
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<form enctype='multipart/form-data' method='POST' action='index.php' name='<?php echo $formulario?>'>
<table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<table align='center' width='100%' cellpadding='7' cellspacing='1'>
				<tr class="bloquecentralencabezado">
					<td colspan="2" rowspan="1" align="center">Registro de Especialistas</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Registro M&eacute;dico:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<input type='hidden' name='id_usuario' value='<?php echo $registro[0][0] ?>'>
						<input type='text' name='registro' value='<?php echo $registro[0][1] ?>' size='40' maxlength='50' tabindex='<?php echo $tab++ ?>' >
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'><?php
						if($registro[0][8]!="N/D")
						{
					?>	<img width="100" height="120" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/".$registro[0][8] ?>" alt="Especialista" title="Especialista" border="0" />
					<?php      }
						else
						{
					?>	<img width="100" height="120" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/sin_imagen.jpg" ?>" alt="Especialista" title="Especialista" border="0" />
					<?php	}
				?>	</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Cambiar Fotograf&iacute;a:</b><br>
						<input type='hidden' name='imagen_anterior' value='<?php echo $registro[0][8] ?>'>
						<input type='file' name='imagen' tabindex='<?php echo $tab++ ?>' >
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Experiencia Profesional:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='experiencia' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][2] ?></textarea>
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Experiencia Asistencial:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='asistencial' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][3] ?></textarea>
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Experiencia Administrativo:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='administrativo' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][4] ?></textarea>
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Experiencia Docente:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='docente' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][5] ?></textarea>
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Experiencia Investigativa:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='investigativo' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][6] ?></textarea>
					</td>
				</tr>
				<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
					<td bgcolor='<?php echo $tema->celda ?>'>
						<b>Habilidades:</b>
					</td>
					<td bgcolor='<?php echo $tema->celda ?>'>
						<textarea name='habilidades' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][7] ?></textarea>
					</td>
				</tr>
				<tr align='center'>
					<td colspan='2'>
						<table align='center' width='50%'>
							<tr align='center'>
								<td>
									<input type='hidden' name='action' value='<?php echo $formulario?>'>
									<input name='aceptar' value='Aceptar' type='submit'>
								</td>
								<td>
									<input name='cancelar' value='Cancelar' type='submit'>
								</td>
							</tr>
						</table>	
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form><?php
		
	}	
}


function mostrar_registro($configuracion,$tema,$id_entidad, $acceso_db, $formulario)
{
	
	
	$variable["id_entidad"]=$id_entidad;
	$cadena_sql=cadena_sql_sede($configuracion,"select",$variable);
	$registro=ejecutar_busqueda_sede($cadena_sql,$acceso_db);
	
	if(is_array($registro))
	{			
?><table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
	<tr>
		<td>
			<table class='bloquecentralcuerpo' align='center' width='100%' cellpadding='7' cellspacing='1'>
				<tr>
					<td align="center" colspan="2">
					<br>
					</td>							
				</tr>
				<tr>
					<td class="encabezado_registro">
						<h3><?php echo strtoupper($registro[0][4]) ?></h3>
					</td>	
				</tr>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Datos B&aacute;sicos<hr class="hr_subtitulo" />
					</td>
				</tr>				
				<tr class='bloquecentralcuerpo'>
					<td>
						<table class='tabla_basico'>
							<tr class='bloquecentralcuerpo' >
								<td  class="texto_negrita">
									Nombre Corto
								</td>
								<td>
									<?php echo $registro[0][4] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Direcci&oacute;n
								</td>
								<td>
									<?php echo $registro[0][9] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Tel&eacute;fono
								</td>
								<td>
									<?php echo $registro[0][10] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Correo Electr&oacute;nico
								</td>
								<td>
									<?php echo $registro[0][12] ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td>
						Ubicaci&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2" align="center">
						<div id="map" style="width: 100%; height: 300px"></div>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td>
						Descripci&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo $registro[0][15] ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<form enctype='multipart/form-data' method='POST' action='index.php' name='<?php echo $formulario ?>'>
	<input type='hidden' name='marcador' id='marcador' value='<?php 
	include_once("clase/encriptar.class.php");
	$cripto=new encriptar();
	$indice="index.php?";
	$variable="pagina=marcador";
	$variable.="&no_pagina=true";
	$variable.="&opcion=mostrar";
	$variable.="&tipo=sede";
	$variable.="&registro=".$id_entidad;
	$variable=$cripto->codificar_url($variable,$configuracion);
	echo $indice.$variable; ?>'>
</form>
<?php		}
		else
		{
			echo "Existe una incompatibilidad en el registro. Por favor consulte con el administrador del sistema.";
		}
	
}

function cadena_sql_sede($configuracion,$tipo,$variable="")
{
	
	switch($tipo)
	{
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
			$cadena_sql.="`tipo`, ";
			$cadena_sql.="`latitud`, ";
			$cadena_sql.="`longitud` ";
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

function ejecutar_busqueda_sede($cadena_sql,$acceso_db)
{
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	return $registro;
}

?>