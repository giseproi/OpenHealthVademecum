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
* @description  Formulario de registro de medicamentoes
* @usage        Toda pagina tiene un id_pagina que es propagado por cualquier metodo GET, POST.
*******************************************************************************/

if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
$el_estilo=$this->estilo;

$formulario="registro_componente";
$verificar="control_vacio(".$formulario.",'codigo')";

if(isset($_REQUEST['opcion']))
{
	$accion=$_REQUEST['opcion'];
	
	if($accion=="mostrar")
	{
		
		if(isset($_REQUEST['id_elemento']))
		{
			mostrar_registro_componente($configuracion,$tema,$_REQUEST['id_elemento']);
		}
	}
	else
	{
		
		if($accion=="nuevo")
		{
			nuevo_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$el_estilo);
		
		}
		else
		{
			if($accion=="editar")
			{
				editar_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$el_estilo);
			
			}
			else
			{
				if($accion=="corregir")
				{
					corregir_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
				
				}
			}		
		}
		
	
	}
}
else
{
	$accion="nuevo";
	nuevo_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab);
}

/****************************************************************************************
*				Funciones						*
****************************************************************************************/
/*
function nuevo_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$estilo)
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
							<td colspan="2" rowspan="1">::.. Registro para Nuevo Medicamento</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<a href="http://es.wikipedia.org/wiki/código_ATC" target="_new">C&oacute;digo ATC</a>:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='atc' size='30' maxlength='255' tabindex='<?php echo $tab++ ?>' >
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
							<td bgcolor='<?php echo $tema->celda ?>'>
								Grupo Terape&uacute;tico:
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='grupo' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td bgcolor='<?php echo $tema->celda ?>'>
								Principio Activo :
							</td>
							<td bgcolor='<?php echo $tema->celda ?>'>
								<input type='text' name='principio' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' >
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Indicaci&oacute;n Terape&uacute;tica:</span>
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='indicacion' name='indicacion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('indicacion', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Contraindicaciones:</span>
							</td>
						</tr>		
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='contraindicacion' name='contraindicacion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('contraindicacion', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita"><a href="http://www.wordreference.com/definicion/concomitancia" target="_new">Concomitancia</a>:</span>
							</td>
						</tr>	
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='concomitancia' name='concomitancia' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('concomitancia', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Reacciones Adversas:</span>
							</td>
						</tr>	
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='reaccion' name='reaccion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('reaccion', 'bold italic underline | left center right | number bullet | wikilink');
								</script>
							</td>
						</tr>
						<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
							<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
								<span class="texto_negrita">Precauciones:</span>
							</td>
						</tr>	
						<tr class='bloquecentralcuerpo'>
							<td colspan="2" align="center">
								<textarea id='precaucion' name='precaucion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ></textarea>
								<script type="text/javascript">
									mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
									archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
									editor_html('precaucion', 'bold italic underline | left center right | number bullet | wikilink');
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
							$datos.="&action=registro_componente";						
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
}*/


function editar_registro_componente($configuracion,$tema,$accion,$formulario,$verificar,$fila,$tab,$estilo)
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
		$cadena_sql.="`id_c_organizacion`, ";
		$cadena_sql.="`id_usuario`, ";
		$cadena_sql.="`fecha`, ";
		$cadena_sql.="`nombre`, ";
		$cadena_sql.="`etiqueta`, ";
		$cadena_sql.="`web`, ";
		$cadena_sql.="`correo`, ";
		$cadena_sql.="`mision`, ";
		$cadena_sql.="`vision`, ";
		$cadena_sql.="`descripcion`, ";
		$cadena_sql.="`comentario` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."c_organizacion "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_c_organizacion`=".$_REQUEST["id_elemento"]." ";
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
									<td colspan="2" rowspan="1">::.. Registro para Componentes</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
								<td bgcolor='<?php echo $tema->celda ?>'>
									Nombre:
								</td>
								<td bgcolor='<?php echo $tema->celda ?>'>
									<input type='text' name='nombre' size='30' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo htmlentities($registro[0][3], ENT_COMPAT, "ISO-8859-1")?>">
								</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										Etiqueta:
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='etiqueta' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo htmlentities($registro[0][4], ENT_COMPAT, "ISO-8859-1")?>" >
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										Web:
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='web' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo htmlentities($registro[0][5], ENT_COMPAT, "ISO-8859-1")?>">
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td bgcolor='<?php echo $tema->celda ?>'>
										Correo Electr&oacute;nico :
									</td>
									<td bgcolor='<?php echo $tema->celda ?>'>
										<input type='text' name='correo' size='35' maxlength='255' tabindex='<?php echo $tab++ ?>' value="<?php echo htmlentities($registro[0][6], ENT_COMPAT, "ISO-8859-1") ?>">
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Descripci&oacute;n:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='descripcion' name='descripcion' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo htmlentities($registro[0][9], ENT_COMPAT, "ISO-8859-1")?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('descripcion', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Misi&oacute;n:</span>
									</td>
								</tr>		
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='mision' name='mision' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo htmlentities($registro[0][6], ENT_COMPAT, "ISO-8859-1") ?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('mision', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Visi&oacute;n</a>:</span>
									</td>
								</tr>	
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='vision' name='vision' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo htmlentities($registro[0][7], ENT_COMPAT, "ISO-8859-1") ?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('vision', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>
								<tr class='bloquecentralcuerpo' <?php echo efecto_fila($contador++,$tema); ?>>
									<td colspan="2" bgcolor='<?php echo $tema->celda ?>'>
										<span class="texto_negrita">Comentarios:</span>
									</td>
								</tr>	
								<tr class='bloquecentralcuerpo'>
									<td colspan="2" align="center">
										<textarea id='comentario' name='comentario' cols='50' rows='2' tabindex='<?php echo $tab++ ?>' ><?php echo $registro[0][8]?></textarea>
										<script type="text/javascript">
											mis_botones='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/';
											archivo_css='<?php echo $configuracion["host"].$configuracion["site"].$configuracion["estilo"]."/".$estilo."/estilo.php" ?>';
											editor_html('comentario', 'bold italic underline | left center right | number bullet | wikilink');
										</script>
									</td>
								</tr>
								<tr align="center" class="bloquecentralcuerpo">
									<td align="center"><?php
									$datos.="&action=registro_componente";
									$datos.="&id_elemento=".$registro[0][0];
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
	<tbody>
</table>
</form><?php
		
		}
	
	
	}
}


function mostrar_registro_componente($configuracion,$tema,$id_componente)
{
	$acceso_db=new dbms($configuracion);
	$enlace=$acceso_db->conectar_db();
	if (is_resource($enlace))
	{
		$cadena_sql="SELECT ";
		$cadena_sql.="`id_c_organizacion`, ";
		$cadena_sql.="`id_usuario`, ";
		$cadena_sql.="`fecha`, ";
		$cadena_sql.="`nombre`, ";
		$cadena_sql.="`etiqueta`, ";
		$cadena_sql.="`web`, ";
		$cadena_sql.="`correo`, ";
		$cadena_sql.="`mision`, ";
		$cadena_sql.="`vision`, ";
		$cadena_sql.="`descripcion`, ";
		$cadena_sql.="`comentario` ";
		$cadena_sql.="FROM ";
		$cadena_sql.=$configuracion["prefijo"]."c_organizacion "; 
		$cadena_sql.="WHERE ";
		$cadena_sql.="`id_c_organizacion`=".$id_componente." ";
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
				<?php
				if(strlen($registro[0][3])>3)
				{			
			?>	<tr class='texto_titulo'>
					<td colspan="2">
						<?php echo htmlentities($registro[0][3], ENT_COMPAT, "ISO-8859-1") ?><hr class="hr_subtitulo" />
					</td>
				</tr><?php
				}
			
				if(strlen($registro[0][9])>3)
				{			
			?>	<tr class='bloquecentralcuerpo'>
					<td colspan="2">
						<?php echo htmlentities($registro[0][9], ENT_COMPAT, "ISO-8859-1")  ?>
					</td>
				</tr><?php
				}
			?>
			<tr class='texto_subtitulo'>
					<td colspan="2">
						Datos de Contacto<hr class="hr_subtitulo" />
					</td>
			</tr>				
			<tr class='bloquecentralcuerpo'>
				<td colspan="2">
					<table class='tabla_basico'>
						<tr class='bloquecentralcuerpo' >
							<td> P&aacute;gina Web: <?php
						if(strlen($registro[0][5])>3)
						{			
							echo htmlentities($registro[0][5], ENT_COMPAT, "ISO-8859-1") ;
						}
						else
						{
							echo "No especificada";
						
						}
					?>		<br></td>
						</tr>
						<tr class='bloquecentralcuerpo' >
							<td> Correo Electr&oacute;nico: <?php
						if(strlen($registro[0][6])>3)
						{			
							echo htmlentities($registro[0][6], ENT_COMPAT, "ISO-8859-1") ;
						}
						else
						{
							echo "No especificado";
						
						}
					?>		<br></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class='texto_subtitulo'>
					<td colspan="2">
						Misi&oacute;n<hr class="hr_subtitulo" />
					</td>
			</tr>
			<tr class='bloquecentralcuerpo'>
				<td colspan="2">
					<table class='tabla_alerta'>
						<tr class='bloquecentralcuerpo' >
							<td><?php
						if(strlen($registro[0][7])>3)
						{			
							echo htmlentities($registro[0][7], ENT_COMPAT, "ISO-8859-1") ;
						}
						else
						{
							echo "La unidad organizacional no ha declarado una misi&oacute;n.";
						
						}
					?>		<br></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class='texto_subtitulo'>
					<td colspan="2">
						Visi&oacute;n<hr class="hr_subtitulo" />
					</td>
			</tr>
			<tr class='bloquecentralcuerpo'>
				<td colspan="2">
					<table class='tabla_alerta'>
						<tr class='bloquecentralcuerpo' >
							<td><?php
						if(strlen($registro[0][8])>3)
						{			
							echo htmlentities($registro[0][8], ENT_COMPAT, "ISO-8859-1") ;
						}
						else
						{
							echo "La unidad organizacional no ha declarado una misi&oacute;n.";
						
						}
					?>		<br></td>
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
