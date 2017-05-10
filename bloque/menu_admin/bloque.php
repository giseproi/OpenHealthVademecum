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
?><?php
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
* @description  Menu principal
* @usage        
*****************************************************************************/
?><?php
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
						<b>::::..</b>  Administraci&oacute;n
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_usuario_off.jpg" alt="Administraci&oacute;n de usuarios" title="Administraci&oacute;n de Usuarios" border="0" usemap="#admin_usuario" border="0" id="admin_usuario" />
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
<map name="admin_usuario">
<area shape="rect" coords="0,0,84,31" href="<?php		
							$variable="pagina=administrar_usuario";
							$variable.="&accion=1";
							$variable.="&hoja=1";
							$variable.="&mostrar=lista";
							$variable=$cripto->codificar_url($variable,$configuracion);
							echo $indice.$variable;		
							?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('admin_usuario','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_usuario_on.jpg')"/>
</map>