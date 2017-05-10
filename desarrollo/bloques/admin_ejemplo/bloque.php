<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                       				   #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@udistrital.edu.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
?><?php
/****************************************************************************************************************
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 28/07/2016
*******************************************************************************************************************
* @subpackage   admin_dedicacion
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Bloque para mostrar relacion de registros de dedicacion de los docentes
*
*****************************************************************************************************************/
?><?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include($configuracion["raiz_documento"].$configuracion["bloques"]."/institucional.inc.php");	
$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	if(isset($_GET['registro']))
	{
		//Rescatar datos anuales, con nombre de programa y nombre del tipo de vinculacion
		$cadena_sql="SELECT ";
		$cadena_sql.="id_dedicacion, ";
		$cadena_sql.="anno, ";
		$cadena_sql.="docencia, ";
		$cadena_sql.="investigacion, ";
		$cadena_sql.="proyeccion, ";
		$cadena_sql.="administrativa ";
		$cadena_sql.="FROM ".$configuracion["prefijo"]."profesor_info_dedicacion ";
		$cadena_sql.="WHERE ";
		$cadena_sql.="identificacion='".$_GET['registro']."' ";
		$cadena_sql.="AND ";
		$cadena_sql.="id_programa=".$id_programa." ";	
		$cadena_sql.="ORDER BY anno";
		//echo $cadena_sql;
		
	}
	else
	{
		
		echo "Imposible determinar el registro de b&uacute;squeda.";	

	}		
	//echo $cadena_sql;
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos==0)
	{
		/*No existe informacion anual del profesor en el sistema*/
		sin_registro($configuracion);	
	}
	else
	{
		if(isset($_GET["admin"]))
		{
			if(desenlace($_GET["admin"])=="lista")
			{
				con_registro($configuracion,$registro,$campos);
				navegacion();
			}
			else
			{
				estadistica($configuracion,$registro);
			}
		}		
		else
		{
			estadistica($configuracion,$campos);	
		}
	}
}



/****************************************************************
*  			Funciones				*
****************************************************************/

function sin_registro($configuracion)
{
?><table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="100%">
	<tr>
		<td >
			<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/importante.png" border="0" />
					</td>
					<td align="left">
						<b>No hay ning&uacute;na informaci&oacute;n sobre tiempo de dedicaci&oacute;n.</b>
					</td>
				</tr>
			</table> 
		</td>
	</tr>  
</table><?php
}


function con_registro($configuracion,$registro,$campos)
{
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<form method="post" action="index.php" name="activar_usuario">
	<table width="100%" border="0" align="center" cellpadding="5 px" cellspacing="1 px" class="bloquelateral">
		<tr align="center" class="mensajealertaencabezado">
			<td >
				A&ntilde;o
			</td>
			<td>
				Horas dedicaci&oacute;n
			</td>
			<td colspan="2">
				Opciones
			</td>
		</tr>
			<?php
	for($contador=0;$contador<$campos;$contador++)
	{
?>		<tr class="bloquecentralcuerpo" onmouseover="setPointer(this, 0, 'over', '#DDDDDD', '#CCFFCC', '#FFCC99');" onmouseout="setPointer(this, 0, 'out', '#DDDDDD', '#CCFFCC', '#FFCC99');" onmousedown="setPointer(this, 0, 'click', '#DDDDDD', '#CCFFCC', '#FFCC99');">
			<td align="center" class="celdatabla">
				<input type="hidden" name= "registro" value="<?phpecho $_GET["registro"] ?>">
				<?php echo $registro[$contador][1] ?>
			</td>
			<td align="center" class="celdatabla">
				<?php echo $registro[$contador][2]+$registro[$contador][3]+$registro[$contador][4]+$registro[$contador][5] ?>
			</td>
			<td align="center" class="celdatabla"><?php//TODO: IMPLEMENTAR LA FUNCIONALIDAD DE EDICION?>
				<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('agregar_tiempo_dedicacion').'&id_dedicacion='.$registro[$contador][0].'&registro='.$_GET['registro']; ?>">Editar</a>
			</td>
			<td align="center" class="celdatabla"><?php//TODO: Implementar la funcionalidad de Borrar?>
				<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('borrar_dedicacion').'&opcion=info_dedicacion&id_dedicacion='.$registro[$contador][0].'&anno='.$registro[$contador][1].'&registro='.$_GET['registro']; ?>">Borrar</A>
			</td>	
		</tr><?php
	}
?>	</table>
	<br>
</form><?php
}

function navegacion($configuracion,$hoja)
{?><br>
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
</table><?php
}
function estadistica($configuracion,$contador)
{?><table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="100%">
	<tr>
		<td >
			<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/info.png" border="0" />
					</td>
					<td align="left">
						Actualmente hay <b><?php echo $contador ?> registros</b> con informaci&oacute;n sobre tiempo de dedicaci&oacute;n.
					</td>
				</tr>
				<tr class="bloquecentralcuerpo">
					<td align="right" colspan="2" >
						<a href="<?phpecho $configuracion["site"].'/index.php?page='.enlace('admin_dir_dedicacion').'&registro='.$_GET['registro'].'&accion=1&hoja=0&opcion='.enlace("mostrar").'&admin='.enlace("lista"); ?>">Ver m&aacute;s informaci&oacute;n >></a>
					</td>
				</tr>
			</table> 
		</td>
	</tr>  
</table>
<?php}
?>
