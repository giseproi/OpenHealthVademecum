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
						<b>:..</b>  M&aacute;s Informaci&oacute;n
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_sede_off.jpg" alt="Sedes de la Entidad de Salud" title="Sedes de la Entidad de Salud" border="0" usemap="#sede_entidad" border="0" id="sede_entidad" />
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_personal_off.jpg" alt="Profesionales adscritos a la Entidad de Salud" title="Profesionales adscritos a la Entidad de Salud" border="0" usemap="#personal_entidad" border="0" id="personal_entidad" />
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_servicio_off.png" alt="Servicios prestados por la Entidad de Salud" title="Servicios prestados por la Entidad de Salud" border="0" usemap="#servicio_entidad" border="0" id="servicio_entidad" />
						</td>
					</tr>	
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_estructura_off.png" alt="Estructura Organizacional de la Entidad de Salud" title="Estructura Organizacional de la Entidad de Salud" border="0" usemap="#estructura_entidad" border="0" id="estructura_entidad" />
						</td>
					</tr>					
					<tr>
						<td>
						<br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<map name="admin_reg_entidad">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=registro_entidad";
							$variable.="&opcion=nuevo";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_reg_entidad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_reg_entidad_on.jpg')"/>
</map>
<map name="sede_entidad">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=sede_entidad";
							$variable.="&opcion=lista";
							$variable.="&accion=1";
							$variable.="&registro_padre=".$_REQUEST["registro"];
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('sede_entidad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_sede_on.jpg')"/>
</map>
<map name="personal_entidad">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=personal_entidad";
							$variable.="&opcion=nuevo";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('personal_entidad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_personal_on.jpg')"/>
</map>
<map name="servicio_entidad">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=servicio_entidad";
							$variable.="&opcion=lista";
							$variable.="&registro=".$_REQUEST["registro"];
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('servicio_entidad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_servicio_on.png')"/>
</map>
<map name="estructura_entidad">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=estructura_entidad";
							$variable.="&opcion=lista";
							$variable.="&registro=".$_REQUEST["registro"];
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('estructura_entidad','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_estructura_on.png')"/>
</map>