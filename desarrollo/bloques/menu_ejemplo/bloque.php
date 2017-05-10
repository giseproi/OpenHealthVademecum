<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                        				   #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@udistrital.edu.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
?><?php
/************************************************************************************************************
  
index.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

**************************************************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Menu principal subsistema comite
* @usage        
************************************************************************************************************/
?><?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}
	
include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/enlace.inc.php");

?><table width="100%" border="0" cellpadding="5" celspacing="0" class="bloquelateral">
  	<tr>
		<td width="100%" class="bloquelateralencabezado">
		Comit&eacute; Institucional
		</td>
  	</tr>
  	<tr class="bloquelateralcuerpo">
		<td width="100%">
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('comite_pregunta').'&accion=1&hoja=0'; ?>" title="Banco de preguntas"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/pregunta.png" alt="Banco de preguntas" border="0" /> Preguntas</A>
		</td>
	</tr> 
	<tr class="bloquelateralcuerpo">
		<td width="100%">
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('comite_formulario').'&accion=1&hoja=0'; ?>" title="Formularios de preguntas"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/formulario_menu.png" alt="Formularios de Preguntas" border="0" /> Formularios</A>
		</td>
	</tr>
	<tr class="bloquelateralcuerpo">
		<td width="100%">
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('comite_artefacto').'&accion=1&hoja=0'; ?>" title="Grupos de formularios"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/artefacto.png" alt="Grupos de formularios" border="0" /> Artefactos</A>
		</td>
	</tr>
	<tr class="bloquelateralcuerpo">
		<td width="100%">
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('comite_proceso').'&accion=1&hoja=0'; ?>" title="Procesos de aplicaci&oacute;n de artefactos"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/proceso.png" alt="Procesos de aplicaci&oacute;n de artefactos" border="0" /> Procesos</A>
		</td>
	</tr>
	<tr class="bloquelateralcuerpo">
		<td width="100%">
			<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('comite_esquema_ponderacion').'&accion=1&hoja=0'; ?>" title="Poderaci&oacute;n de componentes de los modelos de gesti&oacute;n o evaluaci&oacute;n"><img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/ponderacion.png" alt="Poderaci&oacute;n de componentes de los modelos de gesti&oacute;n o evaluaci&oacute;n" border="0" /> Ponderaci&oacute;n</A>
		</td>
	</tr>  	
	<tr>
		<td width="100%" align="right" class="bloquelateralayuda">
			<a href="<?phpecho $configuracion["site"].$configuracion["documento"]."/manual_comite.pdf"; ?>">Ayuda <img width="16" height="16" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/ayuda_peque.png" alt="Ayuda en l&iacute;nea" title="Ayuda en l&iacute;nea" border="0" /></a>
		</td>	
	</tr>			
</table>
