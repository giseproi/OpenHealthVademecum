<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
html.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

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
?><?php

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");

$formulario="registro_entidad";
$verificar="control_vacio(".$formulario.",'nombre')";
$verificar.="&& control_vacio(".$formulario.",'etiqueta')";
$verificar.="&& control_vacio(".$formulario.",'direccion')";
$verificar.="&& control_vacio(".$formulario.",'telefono')";
$verificar.="&& longitud_cadena(".$formulario.",'nombre',3)";

if(isset($_REQUEST['opcion']))
{
	$accion=$_REQUEST['opcion'];
	
	if($accion=="mostrar")
	{
		
		if(isset($_REQUEST['registro']))
		{
			mostrar_registro($configuracion,$tema,$_REQUEST['registro']);
		}
	}
	else
	{
		
		if($accion=="nuevo")
		{
			nuevo_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
		
		}
		else
		{
			if($accion=="editar")
			{
				editar_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
			
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

/****************************************************************************************
*				Funciones						*
****************************************************************************************/

function nuevo_registro($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab)
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
							<td colspan="2" rowspan="1">::.. Registro para Nuevas Entidades</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Nombre de la Entidad:
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
								Logos&iacute;mbolo:<br>(80 X 80 px)
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='file' name='logosimbolo' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>						
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								NIT:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='nit' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Fecha de Fundaci&oacute;n:<br>dd/mm/aaaa
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='fundacion' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
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
							<td bgcolor='<?php echo $tema->celda ?>'>
								Tel&eacute;fono Principal (PBX):
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='telefono' size='35' maxlength='50' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td align="left" bgcolor='<?php echo $tema->celda ?>'>
								Misi&oacute;n:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<textarea name='mision' cols='35' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td align="left" bgcolor='<?php echo $tema->celda ?>'>
								Visi&oacute;n:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<textarea name='vision' cols='35' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
							</td>
						</tr>						
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td align="left" bgcolor='<?php echo $tema->celda ?>'>
								Breve descripci&oacute;n de la Entidad:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<textarea name='descripcion' cols='35' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
							<td bgcolor='<?php echo $tema->celda ?>'>
								Comentarios:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<textarea name='comentario' cols='35' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
							</td>
						</tr>
						<tr align="center" class="bloquecentralcuerpo">
							<td align="center"><?php
							$datos.="&action=registro_entidad";						
							$datos=$cripto->codificar($datos,$configuracion);	
							?>	<input type='hidden' name='formulario' value="<?php echo $datos ?>">
								<input value="Enviar" name="aceptar" tabindex='<?php echo $tab++ ?>' type="button" onclick="return(<?php echo $verificar; ?>)?document.forms['<?php echo $formulario?>'].submit():false"><br>								
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







function editar_registro($configuracion,$tema)
{
	$acceso_db=new dbms($configuracion);
	$enlace=$acceso_db->conectar_db();
	if (is_resource($enlace))
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
		
		
		$cadena_sql="SELECT ";
		$cadena_sql.="`id_usuario`, ";
		$cadena_sql.="`registro`, ";
		$cadena_sql.="`experiencia`, ";
		$cadena_sql.="`asistencial`, ";
		$cadena_sql.="`administrativo`, ";
		$cadena_sql.="`docente`, ";
		$cadena_sql.="`investigativo`, ";
		$cadena_sql.="`habilidades`, ";
		$cadena_sql.="`imagen` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."especialista "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_usuario`=".$id_usuario." ";
		$cadena_sql.="LIMIT 1 ";
		
		$acceso_db->registro_db($cadena_sql,0);
		$registro=$acceso_db->obtener_registro_db();
		$campos=$acceso_db->obtener_conteo_db();
		if($campos>0)
		{
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<form enctype='multipart/form-data' method='POST' action='index.php' name='registro_especialista'>
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
									<input type='hidden' name='action' value='registro_especialista'>
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
}


function mostrar_registro($configuracion,$tema,$id_entidad)
{
	$acceso_db=new dbms($configuracion);
	$enlace=$acceso_db->conectar_db();
	if (is_resource($enlace))
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
		$cadena_sql.="`mision`, ";
		$cadena_sql.="`vision`, ";
		$cadena_sql.="`descripcion`, ";
		$cadena_sql.="`comentario` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."entidad "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_entidad`=".$id_entidad." ";
		$cadena_sql.="LIMIT 1 ";
		
		$campos=$acceso_db->registro_db($cadena_sql,0);
		$registro=$acceso_db->obtener_registro_db();		
		if($campos>0)
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
						<h3><?php echo strtoupper($registro[0][3]) ?></h3>
					</td>
					<td align="center">
						<img width="80" src="<?php echo $configuracion["host"].$configuracion["site"]."/fotografia/".$registro[0][5] ?>" alt="Logo Entidad" title="Logo Entidad" border="0" />
					</td>							
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][14] ?>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Misi&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][12] ?>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Visi&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][13] ?>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Datos B&aacute;sicos<hr class="hr_subtitulo" />
					</td>
				</tr>				
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<table class='tabla_basico'>
							<tr class='bloquecentralcuerpo' >
								<td  class="texto_negrita">
									Nombre Corto
								</td>
								<td>
									<?php echo $registro[0][4] ?>
								</td>
							</tr>
							<tr class='bloquecentralcuerpo'>
								<td class="texto_negrita">
									NIT
								</td>
								<td>
									<?php echo $registro[0][6] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Fecha de Fundaci&oacute;n
								</td>
								<td>
									<?php echo $registro[0][7] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Direcci&oacute;n
								</td>
								<td>
									<?php echo $registro[0][8] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Tel&eacute;fono
								</td>
								<td>
									<?php echo $registro[0][9] ?>
								</td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									P&aacute;gina Web
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
									<?php echo $registro[0][11] ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Comentarios<hr class="hr_subtitulo" />
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

<?php		}
		else
		{
			echo "Existe una incompatibilidad en el registro. Por favor consulte con el administrador del sistema.";
		}
	}
}
?>
