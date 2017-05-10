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
  
html.php 


Última revisión 6 de Marzo de 2016

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario de registro de especialidades
* @usage        Toda pagina tiene un id_pagina que es propagado por cualquier metodo GET, POST.
*******************************************************************************/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
$el_estilo=$this->estilo;

$formulario="registro_especialidad";
$verificar="control_vacio(".$formulario.",'codigo')";

if(isset($_REQUEST['opcion']))
{
	$accion=$_REQUEST['opcion'];
	
	if($accion=="mostrar")
	{
		
		if(isset($_REQUEST['id_especialidad']))
		{
			mostrar_registro_especialidad($configuracion,$tema,$_REQUEST['id_especialidad']);
		}
	}
	else
	{
		
		if($accion=="nuevo")
		{
			nuevo_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$el_estilo);
		
		}
		else
		{
			if($accion=="editar")
			{
				editar_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$el_estilo);
			
			}
			else
			{
				if($accion=="corregir")
				{
					corregir_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
				
				}
			}		
		}
		
	
	}
}
else
{
	$accion="nuevo";
	nuevo_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
}

/****************************************************************************************
*				Funciones						*
****************************************************************************************/

function nuevo_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$estilo)
{

	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$cripto=new encriptar();
	$datos="";
	$contador=0;
?><form enctype='multipart/form-data' method="post" action="index.php" name="<?php echo $formulario?>" onsubmit="return(<?php echo $verificar ?>)?submit():false;">
<table width="100%" cellpadding="12" cellspacing="0"  align="center">
	<tbody>
		<tr>
			<td align="center" valign="middle">
				<table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
					<tr>
					<td>
					<table align='center' width='100%' cellpadding='7' cellspacing='1'>
						<tr class="bloquecentralencabezado">
							<td colspan="2" rowspan="1">::.. Registro para Nueva Especialidad</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<span onmouseover="<?php 
								$texto_ayuda="<b>C&oacute;digo &Uacute;nico de Identificaci&oacute;n</b><br>";
								$texto_ayuda.="De la especialidad seg&uacute;n normatividad colombiana.";											
								echo "this.T_WIDTH=200;return escape('".$texto_ayuda."')" ?>">
								C&oacute;digo:</span>
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='codigo' size='30' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								Denominaci&oacute;n:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='denominacion' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Etimolog&iacute;a:</span>
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id= 'etimologia' name='etimologia' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('etimologia', 'bold italic underline | left center right | number bullet |');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Definici&oacute;n:</span>
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='definicion' name='definicion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('definicion', 'bold italic underline | left center right | number bullet |');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Descripci&oacute;n:</span>
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
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								Al especialista se denomina:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='especialista' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Perfil del Especilista:</span>
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='perfil' name='perfil' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('perfil', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								Imagen Descriptiva:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='file' name='imagen' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>		
						<tr align="center" class="bloquecentralcuerpo">
							<td align="center"><?php
							$datos.="&action=registro_especialidad";						
							$datos=$cripto->codificar($datos,$configuracion);	
							?>	<input type='hidden' name='formulario' value="<?php echo $datos ?>">
								<input value="Enviar" name="aceptar" tabindex='<?php echo $tab++ ?>' type="submit"><br>								
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


function editar_registro_especialidad($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$estilo)
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
		$cadena_sql.="`id_especialidad`, ";
		$cadena_sql.="`id_usuario`, ";
		$cadena_sql.="`codigo`, ";
		$cadena_sql.="`denominacion`, ";
		$cadena_sql.="`etimologia`, ";
		$cadena_sql.="`definicion`, ";
		$cadena_sql.="`descripcion`, ";
		$cadena_sql.="`especialista`, ";
		$cadena_sql.="`perfil`, ";
		$cadena_sql.="`fecha`, ";
		$cadena_sql.="`imagen` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."especialidad "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_especialidad`=".$_REQUEST["id_especialidad"]." ";
		$cadena_sql.="LIMIT 1 ";
		
		$acceso_db->registro_db($cadena_sql,0);
		$registro=$acceso_db->obtener_registro_db();
		$campos=$acceso_db->obtener_conteo_db();
		if($campos>0)
		{
			include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
			$cripto=new encriptar();
			$datos="";
			$contador=0;
?><form enctype='multipart/form-data' method="post" action="index.php" name="<?php echo $formulario?>" onsubmit="return(<?php echo $verificar ?>)?submit():false;">
<table width="100%" cellpadding="12" cellspacing="0"  align="center">
	<tbody>
		<tr>
			<td align="center" valign="middle">
				<table class='bloquelateral' align='center' width='100%' cellpadding='0' cellspacing='0'>
					<tr>
						<td>
							<table align='center' width='100%' cellpadding='7' cellspacing='1'>
								<tr class="bloquecentralencabezado">
									<td colspan="2" rowspan="1">::.. Formulario para editar la Especialidad</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										C&oacute;digo de la Especialidad:
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='codigo' size='30' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo $registro[0][2]?>">
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										Denominaci&oacute;n:
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='denominacion' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo $registro[0][3]?>">
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Etimolog&iacute;a:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id= 'etimologia' name='etimologia' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][4]?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('etimologia', 'bold italic underline | left center right | number bullet |');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Definici&oacute;n:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='definicion' name='definicion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][5]?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('definicion', 'bold italic underline | left center right | number bullet |');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Descripci&oacute;n:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='descripcion' name='descripcion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][6]?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('descripcion', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>	
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										Al especialista se denomina:
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='especialista' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo $registro[0][7]?>">
									</td>
								</tr>								
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Perfil del Especilista:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='perfil' name='perfil' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][8]?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('perfil', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'><?php
										if($registro[0][10]!="N/D")
										{
									?>	<img width="100" height="120" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/".$registro[0][10] ?>" alt="Especialidad" title="Especialidad" border="0" />
									<?php      }
										else
										{
									?>	<img width="100" height="120" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/sin_imagen.jpg" ?>" alt="Especialidad" title="Especialidad" border="0" />
									<?php	}
								?>	</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<b>Cambiar Fotograf&iacute;a:</b><br>
										<input type='hidden' name='imagen_anterior' value='<?php echo $registro[0][10] ?>'>
										<input type='file' name='imagen' tabindex='<?php echo $tab++ ?>'>
									</td>
								</tr>
								<tr align="center" class="bloquecentralcuerpo">
									<td align="center"><?php
									$datos.="&action=registro_especialidad";						
									$datos=$cripto->codificar($datos,$configuracion);	
									?>	<input type='hidden' name='formulario' value="<?php echo $datos ?>">
										<input type='hidden' name='id_especialidad' value="<?php echo $registro[0][0] ?>">
										<input value="Enviar" name="aceptar" tabindex='<?php echo $tab++ ?>' type="submit"><br>								
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
	<tbody>
</table>
</form><?php
		
		}
	
	
	}
}


function mostrar_registro_especialidad($configuracion,$tema,$id_entidad)
{
	$acceso_db=new dbms($configuracion);
	$enlace=$acceso_db->conectar_db();
	if (is_resource($enlace))
	{
		$cadena_sql="SELECT ";
		$cadena_sql.="`id_especialidad`, ";
		$cadena_sql.="`id_usuario`, ";
		$cadena_sql.="`codigo`, ";
		$cadena_sql.="`denominacion`, ";
		$cadena_sql.="`etimologia`, ";
		$cadena_sql.="`definicion`, ";
		$cadena_sql.="`descripcion`, ";
		$cadena_sql.="`especialista`, ";
		$cadena_sql.="`perfil`, ";
		$cadena_sql.="`fecha`, ";
		$cadena_sql.="`imagen` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."especialidad "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_especialidad`=".$id_entidad." ";
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
				<tr class='bloquecentralcuerpo'>
					<td>
						<span onmouseover="<?php 
						$texto_ayuda="<b>C&oacute;digo &Uacute;nico de Identificaci&oacute;n</b><br>";
						$texto_ayuda.="De la especialidad seg&uacute;n normatividad colombiana.";											
						echo "this.T_WIDTH=200;return escape('".$texto_ayuda."')" ?>">
						C&oacute;digo:<?php echo $registro[0][2] ?></span><br>
						<span class="encabezado_registro"><?php echo strtoupper($registro[0][3]) ?></span>
					</td>					
					<td><?php
						if($registro[0][10]!="N/D")
						{
					?>	<img width="100" height="100" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/".$registro[0][10] ?>" alt="Especialidad" title="Especialidad" border="0" />
					<?php      }
						else
						{
					?>	<img width="100" height="100" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["fotografia"]."/sin_imagen.jpg" ?>" alt="Especialidad" title="Especialidad" border="0" />
					<?php	}
				?>	</td>
				</tr><?php
				if(strlen($registro[0][5])>3)
				{			
			?>	<tr class='texto_subtitulo'>
					<td colspan="2">
						Definici&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][5] ?>
					</td>
				</tr><?php
			}
			if(strlen($registro[0][6])>3)
			{			
			?>	<tr class='texto_subtitulo'>
					<td colspan="2">
						Descripci&oacute;n<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][6] ?>
					</td>
				</tr><?php
			}
			if(strlen($registro[0][4])>3)
			{			
			?>
				<tr class='texto_subtitulo'>
					<td colspan="2">
						Etimolog&iacute;a<hr class="hr_subtitulo" />
					</td>
				</tr>
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo $registro[0][4] ?>
					</td>
				</tr><?php
			}		
			?>	<tr class='texto_subtitulo'>
					<td colspan="2">
						Especialista<hr class="hr_subtitulo" />
					</td>
				</tr>				
				<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<table class='tabla_basico'>
							<tr class='bloquecentralcuerpo' >
								<td class="texto_subtitulo"><?php
							if(strlen($registro[0][7])>3)
							{			
								echo $registro[0][7];
							}
							else
							{
								echo "No especificado";
							
							}
						?>		<br></td>
							</tr>
							<tr>
								<td  class="texto_negrita">
									Perfil 
								</td>
							</tr>
							<tr>	
								<td><?php
							if(strlen($registro[0][8])>3)
							{			
								echo $registro[0][8];
							}
							else
							{
								echo "No especificado";
							
							} 
							?>	</td>
							</tr>
						</table>
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

function efecto_fila($contador,$tema)
{
	
	$cadena_efecto="onmouseover=\"";
	$cadena_efecto.="setPointer(this, ".$contador.", 'over', '".$tema->celda."', '".$tema->apuntado."', '".$tema->seleccionado."');\"";
	$cadena_efecto.="onmouseout=\"";
	$cadena_efecto.="setPointer(this, ".$contador.", 'out', '".$tema->celda."', '".$tema->apuntado."', '".$tema->seleccionado."');\"";
	$cadena_efecto.="onmousedown=\"";
	$cadena_efecto.="setPointer(this, ".$contador.", 'click', '".$tema->celda."', '".$tema->apuntado."', '".$tema->seleccionado."');\"";
	return $cadena_efecto;
}
?>
