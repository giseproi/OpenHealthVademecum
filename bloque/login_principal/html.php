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
	$formulario="autenticacion";
	$validar="control_vacio(".$formulario.",'usuario')";
	$validar.="&& control_vacio(".$formulario.",'clave')";
	
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/md5.js" type="text/javascript" language="javascript"></script>
<form method="post" action="index.php" name="<?phpecho $formulario?>">
<table cellpadding=0 border=0 cellspacing=0 align="center" class="tabla_general">
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-0.jpg" width="102" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-1.jpg" width="99" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-2.jpg" width="121" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-3.jpg" width="87" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-4.jpg" width="100" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-5.jpg" width="55" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-6.jpg" width="46" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-7.jpg" width="64" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-8.jpg" width="97" height="12"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-0-9.jpg" width="29" height="12"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-0.jpg" width="102" height="18"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-1.jpg" width="99" height="18"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-2.jpg" width="121" height="18"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-3.jpg" width="87" height="18" border="0" usemap="#registro" id="enlace_1"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-4.jpg" width="100" height="18" border="0" usemap="#tour" id="enlace_2"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-5.jpg" width="55" height="18" border="0" usemap="#creditos" id="enlace_3"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-6.jpg" width="46" height="18" border="0" usemap="#gitem" id="enlace_4"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-7.jpg" width="64" height="18" ></td>
		<td rowspan=2 class="login_celda1">
			<table align="center" border="0" cellpadding="0" cellspacing="4">
				<tr>
					<td><?php $tab=1;?>
					<input  class="cuadro_login" maxlength="30" size="10" tabindex="<?php echo $tab++;?>" name="usuario" >
					</td>
				</tr>
				<tr>
					<td>
					<input class="cuadro_login" maxlength="60" size="10" tabindex="<?phpecho $tab++;?>	" name="clave" type="password" onkeyup="if(enter(event)){<?phpecho $formulario?>.clave.value = hex_md5(<?phpecho $formulario?>.clave.value);return(<?php echo $validar; ?>)? document.forms['<?php echo $formulario?>'].submit():false}">
					<input type="hidden" name="action" value="login_principal">
					</td>
				</tr>
			</table>
		</td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-1-9.jpg" width="29" height="18"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-0.jpg" width="102" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-1.jpg" width="99" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-2.jpg" width="121" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-3.jpg" width="87" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-4.jpg" width="100" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-5.jpg" width="55" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-6.jpg" width="46" height="42"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-7.jpg" width="64" height="42"></td>

		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-2-9.jpg" width="29" height="42"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-0.jpg" width="102" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-1.jpg" width="99" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-2.jpg" width="121" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-3.jpg" width="87" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-4.jpg" width="100" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-5.jpg" width="55" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-6.jpg" width="46" height="26"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-7.jpg" width="64" height="26"></td>
		<td><img alt="Ingresar" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-8.jpg" width="97" height="26" border="0" usemap="#ingresar" id="boton_1"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-3-9.jpg" width="29" height="26"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-0.jpg" width="102" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-1.jpg" width="99" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-2.jpg" width="121" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-3.jpg" width="87" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-4.jpg" width="100" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-5.jpg" width="55" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-6.jpg" width="46" height="101"></td>
		<?php
		if(isset($_REQUEST["no_usuario"]))
		{		
		?><td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-7.jpg" width="64" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-8A.jpg" width="97" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-9.jpg" width="29" height="101"></td><?php
		}
		else
		{
			if(isset($_REQUEST["registro_exito"]))
			{
		?><td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-7B.jpg" width="64" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-8B.jpg" width="97" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-9B.jpg" width="29" height="101"></td><?php
			}
			else
			{
		?><td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-7.jpg" width="64" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-8.jpg" width="97" height="101"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-4-9.jpg" width="29" height="101"></td><?php	
			}
		}
		?>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-0.jpg" width="102" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-1.jpg" width="99" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-2.jpg" width="121" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-3.jpg" width="87" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-4.jpg" width="100" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-5.jpg" width="55" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-6.jpg" width="46" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-7.jpg" width="64" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-8.jpg" width="97" height="113"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-5-9.jpg" width="29" height="113"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-0.jpg" width="102" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-1.jpg" width="99" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-2.jpg" width="121" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-3.jpg" width="87" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-4.jpg" width="100" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-5.jpg" width="55" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-6.jpg" width="46" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-7.jpg" width="64" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-8.jpg" width="97" height="118"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-6-9.jpg" width="29" height="118"></td>
	</tr>
	<tr>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-0.jpg" width="102" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-1.jpg" width="99" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-2.jpg" width="121" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-3.jpg" width="87" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-4.jpg" width="100" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-5.jpg" width="55" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-6.jpg" width="46" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-7.jpg" width="64" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-8.jpg" width="97" height="170"></td>
		<td><img alt=" " src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/sitem-7-9.jpg" width="29" height="170"></td>
	</tr>
	<tr>
		<td colspan="10">
		<table width="100%" cellpadding="10" >
			<tr>
			<td>
				<table border="0" cellpadding="7" cellspacing="0" align="center" width="100%" >				
				<tr class="centralencabezado">	
					<td>
						Copyright (c) 2010 - 2017 - UNIVERSIDAD DISTRITAL Francisco Jos&eacute; de Caldas - Grupo de Investigaci&oacute;n en Telemedicina
					</td>
				</tr>
				</table>
				<table border="0" cellpadding="12" cellspacing="0" align="center" width="100%" class="bloquelateral">				
				<tr class="bloquecentralcuerpo">	
					<td>
					<b>Informaci&oacute;n de Contacto</b><br>
					Cr 7 No 40 - 53<br>
					Universidad Distrital Francisco Jos&eacute; de Caldas<br>
					Maestr&iacute;a en Ciencias de la Informaci&oacute;n y las Comunicaciones<br>	
					Edificio Sabio Caldas<br>
					Cuarto Piso<br>			
					Bogot&aacute; - Colombia<br>
					Correo Electr&oacute;nico: <a href="mailto:Sistema de Infromacion para Proyectos de Telemedicina&#060;medicina@udistrital.edu.co&#062;;?subject=SITEM"> &lt;medicina at udistrital.edu.co&gt;</a><br>
					</td>
				</tr>
				<tr>
					<td class="bloquecentralcuerpo" align="center">
					<b>CREDITOS</b>
					</td> 
				</tr>
				<tr class="bloquecentralcuerpo">
					<td>
					<b>Directora de Proyecto</b><br>
					<b>Dra Lilia Edith Aparicio Pico</b><br>Directora General Grupo de Investigaci&oacute;n en Telemedicina - GITEM
					</td>
				</tr>				
				<tr class="bloquecentralcuerpo">	
					<td>
					  <p><b>Desarrollo:</b><br>
					    <b>SITEM - KM Versi&oacute;n alpha</b><br>
					Paulo Cesar Coronado <a href="mailto:Paulo Cesar Coronado &#060;paulo_cesar@etb.net.com&#062;;?subject=Sistema de Informacion para Proyectos de Telemedicina"> &lt;paulo_cesar at etb.net.co&gt;</a><br>
					<br>
					<b>SITEM Versi&oacute;n 3.0</b><br>
					Martha Bel&eacute;n Hernandez Alba<br>
					Jorge Andres Chinome<br>
					Freddy Clavijo<br>
					Carlos Euclides Martinez<br>
					Armando Mateus Rojas<br>
					Alexander Urquijo Timar&aacute;n<p>
					<p><br>
				        <br>	
				        <b>SITEM Versi&oacute;n 2.0</b><br>
					    Milton Javier Parra<br>
					    Luis Alejandro Camacho<br>
					    Luis Fernando Torres<br>
			            </p></td>
				</tr>			
				<tr class="bloquecentralcuerpo">
					<td>
					<b>SITEM Versi&oacute;n 1.0</b><br>
					Paulo Cesar Coronado <a href="mailto:Paulo Cesar Coronado &#060;paulo_cesar@etb.net.com&#062;;?subject=Sistema de Informacion para Proyectos de Telemedicina"> &lt;paulo_cesar at etb.net.co&gt;</a><br>
					Fabian Leonardo Galindo
					</td>
				</tr>				
				<tr class="bloquecentralcuerpo">	
					<td>
					<br>
					</td>
				</tr>				
				</table>
			</td>
			</tr>
		</table>
		</td>
	</tr>	
</table>
</form>
<br>
<map name="ingresar">
<area shape="rect" coords="0,0,97,26"  onclick="<?phpecho $formulario?>.clave.value = hex_md5(<?phpecho $formulario?>.clave.value);return(<?php echo $validar; ?>)? document.forms['<?php echo $formulario?>'].submit():false" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('boton_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/boton-1.jpg')"/>
</map>
<map name="registro"><?php
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();
	$variable="pagina=registro_usuario";
	$variable.="&&opcion=nuevo";
	$variable=$cripto->codificar_url($variable,$configuracion);
?><area shape="rect" coords="0,0,87,18" href="<?php echo $indice.$variable ?>" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('enlace_1','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/enlace-1.jpg')" />
</map>
<map name="tour">
<area shape="rect" coords="0,0,100,18" href="/tour/index.php" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('enlace_2','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/enlace-2.jpg')"/>
</map>
<map name="creditos">
<area shape="rect" coords="0,0,55,18" href="index.php" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('enlace_3','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/enlace-3.jpg')"/>
</map>
<map name="gitem">
<area shape="rect" coords="0,0,46,18" href="http://gitem.udistrital.edu.co" onmouseout="imagenOriginal()" onmouseover="cambiarImagen('enlace_4','<?php echo $configuracion["host"].$configuracion["site"].$configuracion["bloques"]."/login_principal/" ?>imagen/enlace-4.jpg')"/>
</map>
