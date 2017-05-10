<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                        #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@udistrital.edu.co                                                   #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
?><?php
/****************************************************************************************************************
  
html.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

*******************************************************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario de registro de egresados
* @usage        Toda pagina tiene un id_pagina que es propagado por cualquier metodo GET, POST.
*****************************************************************************************************************/
?><?php
//Verificar si se tiene un numero de usuario por el metodo GET:
//Puede manejarse cuatro tipos de acceso a este bloque:
// 1. Acceso para edición por parte del administrador
// 2. Acceso para registro de usuarios nuevos
// 3. Acceso para registro de usuarios nuevos por parte del administrador
// 4. Acceso para edición por parte de los usuarios

//Con el parametro opcion se determina la accion a tomar


include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");


if(isset($_GET['opcion']))
{
	$accion=desenlace($_GET['opcion']);
}
else
{
	$accion="nuevo";
}



if($accion=="editar")
{
	editar_registro($configuracion,$tema);
}
else
{
	//Si se esta mostrando
	if($accion=="mostrar")
	{
		mostrar_registro($configuracion,$tema);
	
	}
	else
	{
		if($accion=="nuevo")
		{
			nuevo_registro($configuracion,$tema);
		
		}
	}

}


function editar_registro($configuracion,$tema)
{
	$tab=1;
	$contador=0;
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


function mostrar_registro($configuracion,$tema)
{
	$tab=1;
	$contador=0;
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
		$cadena_sql.="`imagen`, ";
		$cadena_sql.="`experiencia`, ";
		$cadena_sql.="`asistencial`, ";
		$cadena_sql.="`administrativo`, ";
		$cadena_sql.="`docente`, ";
		$cadena_sql.="`investigativo`, ";
		$cadena_sql.="`habilidades` ";
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
		
		
			$cadena_sql="SELECT ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`nombre`, ";
			$cadena_sql.="`apellido`, ";
			$cadena_sql.="`correo` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."registrado "; 
			$cadena_sql.="WHERE ";
			$cadena_sql.="`id_usuario`=".$id_usuario." ";
			$cadena_sql.="LIMIT 1 ";
			
			$acceso_db->registro_db($cadena_sql,0);
			$registro_usuario=$acceso_db->obtener_registro_db();
			$campos_usuario=$acceso_db->obtener_conteo_db();
			if($campos_usuario>0)
			{
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td>
<table align='center' width='100%' cellpadding='7' cellspacing='1'>	
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td align='center'><?php
			if($registro[0][2]!="N/D")
			{
		?>	<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/".$registro[0][2] ?>" alt="Especialista" title="Especialista" border="0" />
		<?php      }
			else
			{
		?>	<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/sin_imagen.jpg" ?>" alt="Especialista" title="Especialista" border="0" />
		<?php	}
	?>	</td>
		<td bgcolor='<?php echo $tema->celda ?>' valign='bottom'>
			<b><?php echo $registro_usuario[0][1]." ".$registro_usuario[0][2] ?></b><br>
			<a href='mailto:<?php echo $registro_usuario[0][3] ?>'><?php echo $registro_usuario[0][3] ?></a><br>
			<b>Registro M&eacute;dico:</b><br>
			<?php echo $registro[0][1] ?>
		</td>
	</tr>	
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Experiencia Profesional:</b><br>		
			<?php echo $registro[0][3] ?>
		</td>
	</tr>
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Experiencia Asistencial:</b><br>
			<?php echo $registro[0][4] ?>
		</td>
	</tr>
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Experiencia Administrativa:</b><br>
			<?php echo $registro[0][5] ?>
		</td>
	</tr>
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Experiencia Docente:</b><br>
			<?php echo $registro[0][6] ?>
		</td>
	</tr>
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Experiencia Investigativa:</b><br>
			<?php echo $registro[0][7] ?>
		</td>
	</tr>
	<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor='<?php echo $tema->celda ?>' colspan='2'>
			<b>Habilidades:</b><br>
			<?php echo $registro[0][8] ?>
		</td>
	</tr>
</table>
</td>
</tr>
</table>
<form enctype='multipart/form-data' method='POST' action='index.php' name='registro_especialista'>
<table align='center' width='50%'>
<tr align='center'>
	<td>
		<input type='hidden' name='action' value='registro_especialista'>
		<input name='cancelar' value='Aceptar' type='submit'><br>
	</td>
</tr>
</table>		
</form>

<?php			}
			else
			{
				echo "Existe una incompatibilidad en el registro. Por favor consulte con el administrador del sistema.";
			}
		}
	}	
}


function nuevo_registro($configuracion,$tema)
{
$tab=1;
$contador=0;
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<form enctype='multipart/form-data' method='POST' action='index.php' name='registro_especialista' onsubmit="return (  control_vacio(this,'registro') && control_vacio(this,'experiencia') && control_vacio(this,'asistencial') && control_vacio(this,'administrativo') && control_vacio(this,'docente') && control_vacio(this,'investigativo'))">
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
							<input type='text' name='registro' size='15' maxlength='50' tabindex='<?php echo $tab++ ?>' >
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Fotograf&iacute;a Reciente:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<input type='file' name='imagen' tabindex='<?php echo $tab++ ?>' >
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Experiencia Profesional:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='experiencia' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Perfil Asistencial:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='asistencial' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' >N/D</textarea>
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Perfil Administrativo:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='administrativo' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' >N/D</textarea>
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Perfil Docente:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='docente' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' >N/D</textarea>
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Perfil Investigativo:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='investigativo' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' >N/D</textarea>
						</td>
					</tr>
					<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor='<?php echo $tema->celda ?>'>
							<b>Habilidades:</b>
						</td>
						<td bgcolor='<?php echo $tema->celda ?>'>
							<textarea name='habilidades' cols='40' rows='2' tabindex='<?php echo $tab++ ?>' >N/D</textarea>
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
</form>
<?php



}



?>
