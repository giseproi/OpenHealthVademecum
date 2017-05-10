<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
index.php 

Copyright (C) 2010-2016

Última revisión 11 de septiembre de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	
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
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");


//Rescatar los componentes
if(isset($_REQUEST["id_elemento"]))
{
	
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	?><table width="100%" align="center" border="0" cellpadding="7" cellspacing="0" >
		<tbody>
			<tr>
				<td >
					<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%">
						<tr class="centralcuerpo">
							<td>
							<b>:..</b> Componente
							</td>
						</tr>
						<tr class="bloquelateralcuerpo">
							<td>
							<img width="100" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar_componente_off.png" alt="Editar Componente Organizativo" title="Editar Componente Organizativo" border="0" usemap="#editar_componente" id="editar_componente" />
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
	<map name="editar_componente">
	<area shape="rect" coords="0,0,100,31" href="<?php		
								$variable="pagina=componente_entidad";
								$variable.="&opcion=editar";
								if(isset($_REQUEST["id_elemento"]))
								{
								$variable.="&id_elemento=".$_REQUEST["id_elemento"];
								}
								$variable=$cripto->codificar_url($variable,$configuracion);
								echo $indice.$variable;		
								?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('editar_componente','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar_componente_on.png')"/>
	</map><?php
}
else
{
	$cadena=htmlentities("Imposible determinar el componente.");
	alerta::sin_registro($configuracion,$cadena);	
}

//***************************************************************************
//                         Funciones  
//***************************************************************************
