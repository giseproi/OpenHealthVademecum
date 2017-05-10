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
?><?php
/****************************************************************************************************************
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 26 de junio de 2016
*******************************************************************************************************************
* @subpackage   admin_usuario
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Bloque principal para la administración de usuarios
*
*****************************************************************************************************************/
?><?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include ($configuracion["raiz_documento"].$configuracion["estilo"]."/".$this->estilo."/tema.php");
$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	if(isset($_GET['accion']))
	{
		$nueva_sesion=new sesiones($configuracion);
		$nueva_sesion->especificar_enlace($enlace);
		$esta_sesion=$nueva_sesion->numero_sesion();
		//Rescatar el valor de la variable usuario de la sesion
		$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"usuario");
		if($registro)
		{
			
			$el_usuario=$registro[0][0];
		}
		$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
		if($registro)
		{
			
			$id_usuario=$registro[0][0];
		}
		
		
		$variable="";
		//Envia todos los datos que vienen con GET
		reset ($_GET);
		while (list ($clave, $val) = each ($_GET)) 
		{
			
			if($clave!='page')
			{
				$variable.="&".$clave."=".$val;
				//echo $clave;
			}
		}
		
		switch($_GET['accion'])
		{	
			//Todos los usuarios
			case '1':
				$cadena_hoja="SELECT ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario,";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad, ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.observacion, ";
				$cadena_hoja.=$configuracion["prefijo"]."especialidad.nombre,  "; 
				$cadena_hoja.=$configuracion["prefijo"]."especialidad.codigo  "; 
				$cadena_hoja.="FROM ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad, "; 
				$cadena_hoja.=$configuracion["prefijo"]."especialidad "; 
				$cadena_hoja.="WHERE ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario=".$id_usuario;
				$cadena_hoja.="AND ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad=".$configuracion["prefijo"]."especialidad.id_especialidad ";
				$cadena_hoja.="ORDER BY id_usuario ";
				
				$cadena_sql=$cadena_hoja;
				$cadena_sql.="LIMIT ".($_GET["hoja"]*$configuracion['registros']).",".$configuracion['registros'];
				//echo $cadena_sql;
				break;
			
			default:
				
				$cadena_hoja="SELECT ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario,";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad, ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.observacion, ";
				$cadena_hoja.=$configuracion["prefijo"]."especialidad.nombre,  "; 
				$cadena_hoja.=$configuracion["prefijo"]."especialidad.codigo  "; 
				$cadena_hoja.="FROM ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad, "; 
				$cadena_hoja.=$configuracion["prefijo"]."especialidad "; 
				$cadena_hoja.="WHERE ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario=".$id_usuario;
				$cadena_hoja.="AND ";
				$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad=".$configuracion["prefijo"]."especialidad.id_especialidad ";
				$cadena_hoja.="ORDER BY id_usuario ";
				
				$cadena_sql=$cadena_hoja;
				$cadena_sql.="LIMIT ".($_GET["hoja"]*$configuracion['registros']).",".$configuracion['registros'];
				//echo $cadena_sql;
				break;
					
			
		}
	}
	else
	{
	
		$cadena_hoja="SELECT ";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario,";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad, ";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.observacion, ";
		$cadena_hoja.=$configuracion["prefijo"]."especialidad.nombre,  "; 
		$cadena_hoja.=$configuracion["prefijo"]."especialidad.codigo  "; 
		$cadena_hoja.="FROM ";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad, "; 
		$cadena_hoja.=$configuracion["prefijo"]."especialidad "; 
		$cadena_hoja.="WHERE ";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_usuario=".$id_usuario;
		$cadena_hoja.="AND ";
		$cadena_hoja.=$configuracion["prefijo"]."especialista_especialidad.id_especialidad=".$configuracion["prefijo"]."especialidad.id_especialidad ";
		$cadena_hoja.="ORDER BY id_usuario ";
		
		$cadena_sql=$cadena_hoja;
		$cadena_sql.="LIMIT ".($_GET["hoja"]*$configuracion['registros']).",".$configuracion['registros'];
		//echo $cadena_sql;
		
		
	}		
	//echo $cadena_sql;
	$acceso_db->registro_db($cadena_hoja,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos>0)
	{
		$hoja=ceil($campos/$configuracion['registros'])-1;
		//echo $hoja;
	}
	else
	{
		$hoja=0;
	
	}
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos==0)
	{
		?>
<table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="100%">
  <tr>
      <td >
      		<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/importante.png" border="0" />
					</td>
					<td align="left">
						<b>No hay ning&uacute;na especialidad asociada a este usuario.</b>
					</td>
				</tr>
		</table>
      
      </td>
    </tr>  
</table><?php
		
	}
	else
	{

?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1 px" class="bloquelateral">
	<tr align="center" class="bloquecentralencabezado">
		<td colspan="4">
		Especialista en:
		</td>
	</tr>
	<tr align="center" class="bloquecentralencabezado">
		<td >
		C&oacute;digo
		</td>
		<td >
		Especialidad
		</td>
		<td colspan="2">
		Opciones
		</td>
	</tr><?php
		for($contador=0;$contador<$campos;$contador++)
		{
?>	<tr class="bloquecentralcuerpo" onmouseover="setPointer(this, <?php echo $contador ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $contador ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $contador ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
		<td bgcolor="<?php echo $tema->celda ?>">
			<?php echo $registro[$contador][1] ?>
			<input type="hidden" name= "hoja" value="<?phpecho $_GET["hoja"] ?>">
			<input type="hidden" name= "accion" value="<?phpecho $_GET["accion"] ?>">
			<input type="hidden" name= "especialidad_<?php echo $contador ?>" value="<?phpecho $registro[$contador][1] ?>">
		</td>
		<td align="center" bgcolor="<?php echo $tema->celda ?>">
			<?php echo $registro[$contador][2] ?>
		</td>
		<td align="center" bgcolor="<?php echo $tema->celda ?>">
			<a href="<?php
			$opcion=$configuracion["site"].'/index.php?page='.enlace('admin_evidencias_edu');
			$opcion.=$variable; 
			$opcion.="&criterio=".$registro[$contador][0];
			echo $opcion;
?>">			Evidencias
			</a>
		</td>
		<td align="center" bgcolor="<?php echo $tema->celda ?>">
			<a href="<?php
			$opcion=$configuracion["site"].'/index.php?page='.enlace('registro_criterio_edu');
			$opcion.=$variable; 
			$opcion.="&opcion=editar";
			$opcion.="&registro=".$registro[$contador][0];
			echo $opcion;
			?>">
			<img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_editar.png" alt="Editar Usuario" title="Editar Usuario" border="0" />
			</a>
		</td>
		<td align="center" bgcolor="<?php echo $tema->celda ?>">
			<a href="<?php
				$opcion=$configuracion["site"].'/index.php?page='.enlace('borrar_criterio');
				$opcion.=$variable; 
				$opcion.="&opcion=criterio";
				$opcion.="&registro=".$registro[$contador][0];
				echo $opcion;
			?>">
			<img width="24" height="24" src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/boton_borrar.png" alt="Borrar usuario del sistema" title="Borrar usuario del sistema" border="0" />
			</a>
		</td>	
	</tr><?php}?>
</table><br>
<?php
// Botones de navegacion
?><br>
<table width="100%" cellpadding="2" cellspacing="2" class="bloquelateral">
<tr class="bloquecentralcuerpo">
	<td align="left" class="celdatabla" width="33%">
	<?php
		if($_GET["hoja"]>0)
		{
	?>
	<a title="Pasar a la p&aacute;gina No <?php echo $_GET["hoja"] ?>" href="<?php
	$variable="";
	
	//Envia todos los datos que vienen con GET
	reset ($_GET);
	while (list ($clave, $val) = each ($_GET)) {
		
		if($clave!='page' && $clave!='hoja')
		{
			$variable.="&".$clave."=".$val;
			//echo $clave;
		}
		else
		{
			if($clave=='hoja')
			{
				$variable.="&".$clave."=".($val-1);
				//echo $variable;
			}
			
		}
		
	}
	
	$opcion=$configuracion["site"].'/index.php?page='.enlace('admin_usuario');
	$opcion.=$variable;
	
	 
	 echo $opcion;
	
	
	

?>"><< Anterior</a>
	<?php	} 
	?>
	</td>
	<td align="center" class="celdatabla">
	Hoja <?php echo ($_GET["hoja"]+1) ?> de <?php echo ($hoja+1) ?>
	</td>
	<td align="right" class="celdatabla" width="33%">
	<?php
		if($_GET["hoja"]<$hoja)
		{
	?>
	<a title="Pasar a la p&aacute;gina No <?php echo $_GET["hoja"]+2 ?>" href="<?php
	$variable="";
	
	//Envia todos los datos que vienen con GET
	reset ($_GET);
	while (list ($clave, $val) = each ($_GET)) {
		
		if($clave!='page' && $clave!='hoja')
		{
			$variable.="&".$clave."=".$val;
			//echo $clave;
		}
		else
		{
			if($clave=='hoja')
			{
				$variable.="&".$clave."=".($val+1);
				//echo $variable;
			}
			
		}
		
	}
	
	$opcion=$configuracion["site"].'/index.php?page='.enlace('admin_usuario');
	$opcion.=$variable;
	
	 
	 echo $opcion;

?>">Siguiente>></a>
<?php
	}
?>
	</td>
</tr>
</table>
<?php			
  }
}
?>
