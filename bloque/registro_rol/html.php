<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                       				   #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
?><?php
/***************************************************************************
* @name          bloque.php 
* @author        Paulo Cesar Coronado
* @revision      Última revisión 28/07/2016
*****************************************************************************
* @subpackage   registro_rol
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  
*
******************************************************************************/
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
	$cadena_sql="SELECT ";
	$cadena_sql.="COUNT";
	$cadena_sql.="(";
	$cadena_sql.="id_subsistema";
	$cadena_sql.=") ";
	$cadena_sql.="FROM ";
	$cadena_sql.=$configuracion["prefijo"]."subsistema ";
	$cadena_sql.="WHERE ";
	$cadena_sql.="tipo=1 ";	
	
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos==0)
	{
		exit;
	}
	else
	{
		$total_registro=$registro[0][0];
		unset($registro);
		
		if($total_registro==0)
		{
			sin_registro($configuracion);	
		
		}
		else
		{
			if(isset($_REQUEST["hoja"]))
			{
				$hoja=$_REQUEST["hoja"];
			}
			else
			{
				$hoja=1;
			}
			
			$hojas=(floor($campos/$configuracion["registro"])+1);
			
			if($hoja>$hojas)
			{
				$hoja=$hojas;
			}
			else
			{
				if($hoja<1)
				{
					$hoja=1;
				}
			}
			$cadena_hoja="SELECT ";
			$cadena_hoja.="`id_subsistema`, ";
			$cadena_hoja.="`nombre`, ";
			$cadena_hoja.="`etiqueta`, ";
			$cadena_hoja.="`id_pagina`, ";
			$cadena_hoja.="`observacion`, ";
			$cadena_hoja.="`tipo` ";
			$cadena_hoja.="FROM ";
			$cadena_hoja.=$configuracion["prefijo"]."subsistema "; 
			$cadena_hoja.="WHERE ";
			$cadena_hoja.="tipo=1 ";
			$cadena_hoja.="LIMIT ".(($hoja-1)*$configuracion['registro']).",".$configuracion['registro'];
			
			$campos=$acceso_db->registro_db($cadena_hoja,0);
			$registro=$acceso_db->obtener_registro_db();	
			
			if($campos>0)
			{
				con_registro($configuracion,$registro,$campos,$tema);
				if($campos>$configuracion['registro'])
				{
					navegacion($configuracion,$hoja,$total_registro,$tema);				
				}
			}
			else
			{
				sin_registro($configuracion);			
			}
		}	
	}
}



/****************************************************************
*  			Funciones				*
****************************************************************/

function sin_registro($configuracion)
{
?><table style="text-align: left;" border="0"  cellpadding="5" cellspacing="0" class="bloquelateral" width="50%">
	<tr>
		<td >
			<table cellpadding="10" cellspacing="0" align="center">
				<tr class="bloquecentralcuerpo">
					<td valign="middle" align="right" width="10%">
						<img src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"]?>/importante.png" border="0" />
					</td>
					<td align="left">
						<b>No hay roles de usuario registrados.</b>
					</td>
				</tr>
			</table> 
		</td>
	</tr>  
</table><?php
}


function con_registro($configuracion,$registro,$campos,$tema)
{
	$fila=0;
	$formulario="seleccionar_modelo";
?><script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script>
<form method="post" action="index.php" name="<?phpecho $formulario?>">
	<table width="100%" border="0" cellpadding="12" cellspacing="0" >
		<tr class='bloquecentralcuerpo'>
			<td>
				<table width="50%" border="0" cellpadding="5 px" cellspacing="1 px" class="bloquelateral">
					<tr class='bloquecentralcuerpo'>
						<td colspan="3">
							Por favor seleccione el rol o roles en los que desea registrarse:<hr>
						</td>
					</tr>
					<tr align="center" class="bloquecentralencabezado">
						<td >
							C&oacute;digo
						</td>
						<td>
							Nombre del Rol
						</td>
						<td>
							Selecci&oacute;n
						</td>
					</tr>
						<?php
				for($contador=0;$contador<$campos;$contador++)
				{
			?>		<tr class='bloquecentralcuerpo' onmouseover="setPointer(this, <?php echo $fila ?>, 'over', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmouseout="setPointer(this, <?php echo $fila ?>, 'out', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');" onmousedown="setPointer(this, <?php echo $fila++ ?>, 'click', '<?php echo $tema->celda ?>', '<?php echo $tema->apuntado ?>', '<?php echo $tema->seleccionado ?>');">
						<td bgcolor="<?php echo $tema->celda ?>">
							<?php echo $registro[$contador][0] ?>
						</td>
						<td bgcolor="<?php echo $tema->celda ?>">
							<input type="hidden" name="nombre_rol_<?php echo $contador ?>" value="<?phpecho $registro[$contador][2] ?>">
							<?php echo "<b>".$registro[$contador][2]."</b><br>".$registro[$contador][1] ?>
						</td>
						<td bgcolor="<?php echo $tema->celda ?>">
							<input name="rol_<?php echo $contador ?>"  value="<?php echo $registro[$contador][0]; ?>" type="checkbox" >
						</td>	
					</tr><?php
				}
			?>	<tr align="center" class="bloquecentralcuerpo">
						<td colspan="3" align="center">
						<input value="enviar" name="aceptar" type="button" onclick="cerrar_emergente(<?php echo $formulario?>)"><br>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
	</table>		
</form><?php
}

function navegacion($configuracion,$hoja,$total,$tema)
{
	$hojas=(floor($total/$configuracion["registro"])+1);

?><br>
<table width="50%" cellpadding="2" cellspacing="2" class="bloquelateral" >
<tr class="bloquecentralcuerpo">
	<td align="left" class="celdatabla" width="33%">
	<?php
		if($hoja>1)
		{
	?>
	<a title="Pasar a la p&aacute;gina No <?php echo ($hoja+1) ?>" href="<?php
	
	$variable="page=".enlace("seleccion_modelo");	
	reset ($_REQUEST);
	while (list ($clave, $val) = each ($_REQUEST)) 
	{
		
		if($clave!='page' && $clave!='hoja')
		{
			$variable.="&".$clave."=".$val;
			//echo $clave;
		}		
	}
	
	$variable.="&hoja=".($hoja-1);
	
	$variable=$configuracion["site"]."/index.php?".$variable;
	echo $variable;
	
	unset($clave);
	unset($val);
	unset($variable);
	
	

?>"><< Anterior</a>
	<?php	} 
	?>
	</td>
	<td align="center" class="celdatabla">
	<script src="<?php echo $configuracion["host"].$configuracion["site"].$configuracion["javascript"]  ?>/funciones.js" type="text/javascript" language="javascript"></script><?php
	
		$formulario="navegar";
		//Validacion de controles
		$validar="control_vacio(".$formulario.",'hoja')";
		$validar.="&&verificar_rango(".$formulario.",'hoja',1,".$hojas.")";
	
	?><form method="GET" name="navegar" onsubmit="return(<?php echo $validar; ?>)"><?php
	$variable="";
	
	//Envia todos los datos que vienen con GET
	reset ($_REQUEST);
	
	while (list ($clave, $val) = each ($_REQUEST)) 
	{
		
		if($clave!='hoja' && $clave!='aceptar')
		{
			$variable.="<input type='hidden' name='".$clave."' value='".$val."'>\n";
			//echo $clave;
		}
	}
	echo $variable;
	echo "Hoja  <input type='text' name='hoja' size='2' maxlength='4' value='".$hoja."'> de ".$hojas;	
	$inferior=(($configuracion["registro"]*($hoja-1))+1);
	$superior=(($configuracion["registro"]*($hoja-1))+25);
	if($superior>$total)
	{
		$superior=$total;
	}
	echo "<br>Registros: ".$inferior." - ".$superior." de ".$total;
	unset($inferior);
	unset($superior);
	?>	 
	</form>
	</td>
	<td align="right" class="celdatabla" width="33%">
	<?php
		if(($hoja+1)<$hojas)
		{
	?>
	<a title="Pasar a la p&aacute;gina No <?php echo ($hoja+1) ?>" href="<?php
	$variable="page=".enlace("seleccion_modelo");	
	reset ($_REQUEST);
	while (list ($clave, $val) = each ($_REQUEST)) 
	{
		
		if($clave!='page' && $clave!='hoja')
		{
			$variable.="&".$clave."=".$val;
			//echo $clave;
		}		
	}
	
	$variable.="&hoja=".($hoja+1);
	
	$variable=$configuracion["site"]."/index.php?".$variable;
	echo $variable;
	
	unset($clave);
	unset($val);
	unset($variable);

?>">Siguiente>></a>
<?php
	}
?>
	</td>
</tr>
</table><?php
}

?>
