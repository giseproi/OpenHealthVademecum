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
?>
<?php
/****************************************************************************************************************
  
index.php 

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
* @description  Menu principal
* @usage        
*****************************************************************************************************************/
?><?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}
include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/enlace.inc.php");
?><table width="100%" border="0" cellpadding="5" cellspacing="0" class="bloquelateral">
	<tr>
		<td class="bloquelateralencabezado">
		Perfil Especialista
		</td>
	</tr>
	<tr class="bloquelateralcuerpo">
		<td>
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('registro_especialista').'&accion=1&hoja=0&opcion='.enlace("editar"); ?>"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar.png" alt="Editar mi perfil" title="Editar mi perfil" border="0" /> Editar Perfil</a>
		</td>
	</tr>
	<tr class="bloquelateralcuerpo">
		<td>
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('registro_especialista_especialidad'); ?>"><img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/asociar_especialidad.gif" alt="Asociar una especialidad a mi perfil" title="Asociar una especialidad a mi perfil" border="0" /> Mi Especialidad</a>
		</td>
	</tr>
	<tr>
		<td>
		<br>
		</td>
	</tr>
</table>
