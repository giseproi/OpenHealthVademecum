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
  
html.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

****************************************************************************
* @subpackage   
* @package	formulario
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		http://gitem.udistrital.edu.co
* 
*
* Codigo HTML del formulario de autenticacion de usuarios
*
*****************************************************************************/
	$formulario="autenticacion";
	$validar="control_vacio(".$formulario.",'usuario')";
	$validar.="&&control_vacio(".$formulario.",'clave')";

?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/md5.js" type="text/javascript" language="javascript"></script>
<form method="post" action="index.php" name="<?phpecho $formulario?>">
<table width="100%" align="center" border="0" cellpadding="10" cellspacing="0" >
	<tbody>
		<tr>
			<td >
				<table align="center" border="0" cellpadding="5" cellspacing="0" class="bloquelateral_2">
					<tr class="centralcuerpo">
						<td colspan="2">
						<b>::::..</b>  Ingresar
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
						Usuario:
						</td>
						<td>
						<input maxlength="50" size="12" tabindex="<?php echo $tab++ ?>" name="usuario" class="cuadro_plano">
						</td>
					</tr>
					<tr class="bloquelateralcuerpo">
						<td>
						Clave:
						</td>
						<td>
						<input maxlength="50" size="12" tabindex="<?php echo $tab++ ?>" name="clave" type="password" class="cuadro_plano">
						</td>
					</tr>
					<tr align="center">
						<td colspan="2" rowspan="1">
						<input type="hidden" name="action" value="login">
						<input name="aceptar" value="Aceptar" type="button" onclick="if(<?phpecho $formulario?>.clave.value!=''){<?phpecho $formulario?>.clave.value = hex_md5(<?phpecho $formulario?>.clave.value)};return(<?php echo $validar; ?>)? document.forms['<?php echo $formulario?>'].submit():false"><br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</form>