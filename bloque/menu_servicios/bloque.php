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
  
index.php 

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
* @description  Menu principal del bloque entidades de salud
* @usage        
*****************************************************************************/
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}


include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");

$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
$cripto=new encriptar();
?><table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%">
					<tr class="centralcuerpo">
						<td>
						<b>:..</b> Servicios M&eacute;dicos
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="100" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_servicios_off.jpg" alt="Administraci&oacute;n de Especilidades M&eacute;dicas" title="Administraci&oacute;n de Especialidades M&eacute;dicas" border="0" usemap="#admin_servicios" border="0" id="admin_servicios" />
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="110" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_procedimiento_off.jpg" alt="Administraci&oacute;n de Procedimientos M&eacute;dicos" title="Administraci&oacute;n de Procedimientos M&eacute;dicos" border="0" usemap="#admin_procedimiento" border="0" id="admin_procedimiento" />
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="110" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_medicamento_off.jpg" alt="Administraci&oacute;n de Informaci&oacute;n sobre Medicamentos" title="Administraci&oacute;n de Informaci&oacute;n sobre Medicamentos" border="0" usemap="#admin_medicamento" border="0" id="admin_medicamento" />
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="110" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_enfermedad_off.jpg" alt="Administraci&oacute;n de Informaci&oacute;n sobre enfermedades" title="Administraci&oacute;n de Informaci&oacute;n sobre enfermedades" border="0" usemap="#admin_enfermedad" border="0" id="admin_enfermedad" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<map name="admin_servicios">
<area shape="rect" coords="0,0,100,31" href="<?php		
							$variable="pagina=administrar_especialidad";
							$variable.="&accion=1";
							$variable.="&hoja=1";
							$variable.="&mostrar=lista";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_servicios','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_servicios_on.jpg')"/>
</map>
<map name="admin_procedimiento">
<area shape="rect" coords="0,0,110,31" href="<?php		
							$variable="pagina=administrar_procedimiento";
							$variable.="&accion=1";
							$variable.="&hoja=1";
							$variable.="&mostrar=lista";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_procedimiento','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_procedimiento_on.jpg')"/>
</map>
<map name="admin_medicamento">
<area shape="rect" coords="0,0,110,31" href="<?php		
							$variable="pagina=administrar_medicamento";
							$variable.="&accion=1";
							$variable.="&hoja=1";
							$variable.="&mostrar=lista";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_medicamento','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_medicamento_on.jpg')"/>
</map>
<map name="admin_enfermedad">
<area shape="rect" coords="0,0,110,31" href="<?php		
							$variable="pagina=administrar_enfermedad";
							$variable.="&accion=1";
							$variable.="&hoja=1";
							$variable.="&mostrar=lista";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_enfermedad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_enfermedad_on.jpg')"/>
</map>