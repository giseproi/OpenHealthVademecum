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
* @description  Menu principal del bloque entidades de salud
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
						<b>:..</b>  Registro Entidades
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
							<img width="84" height="31" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_reg_entidad_off.jpg" alt="Administraci&oacute;n de Entidades de Salud" title="Administraci&oacute;n de Entidades de Salud" border="0" usemap="#admin_reg_entidad" border="0" id="admin_reg_entidad" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2" width="100%">
					<tr class="centralcuerpo">
						<td>
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/buscar.png" alt="Buscar Entidades de Salud" title="Buscar Entidades de Salud" border="0" border="0" />  Buscar entidad
						</td>
					</tr>
					<tr>
						<td>
							<form action="index.php" method="GET">
							<table>
							<tr>	
								<td WIDTH=100% class="bloquelateralcuerpo">
									<input type="hidden" name="redireccion" value="<?php
										$variable="pagina=administrar_entidad";
										$variable.="&accion=2";
										$variable.="&hoja=1";
										$variable.="&mostrar=lista";
										$variable=$cripto->codificar($variable,$configuracion);										
										echo $variable;
									?>"><input type="text" name="busqueda" size=15> 
								</td>
							</tr>
							<tr>
								<td width=100% class="bloquelateralcuerpo">
									<INPUT type="radio" checked name="opcion" value="0"> Buscar Nombre.
								</td>
							</tr>
							<tr>
								<td width=100% class="bloquelateralcuerpo">
									<INPUT type="radio" name="opcion" value="1"> Buscar NIT.
								</td>
							</tr>
							<tr>
								<td width=100% class="bloquelateralcuerpo">
									<INPUT type="radio" name="opcion" value="2"> Buscar Todo.
								</td>
							</tr>
							<tr>
								<td width=100% class="bloquelateralcuerpo" align="center">
									<input value="Buscar" name="aceptar" type="submit">
								</td>
							</tr>
							</table>
							</form>
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