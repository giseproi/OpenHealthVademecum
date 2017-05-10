<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    GRUPO DE INVESTIGACION EN TELEMEDICINA                                #
#    Directora General:                                                    #
#    Dra LILIA EDITH APARICIO P.                                           #
#    Copyright: Vea el archivo LICENCIA.txt que viene con la distribucion  #
############################################################################
*/
/***************************************************************************
  
index.php 

Paulo Cesar Coronado
Copyright (C) 2010-2017

Última revisión 23 de noviembre de 2017

****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario para el registro de usuarios
* @usage        
****************************************************************************/ 
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

include_once($configuracion["raiz_documento"].$configuracion["clases"]."/alerta.class.php");
include_once($configuracion["raiz_documento"].$configuracion["clases"]."/db.class.php");


//Rescatar los componentes
if(isset($_REQUEST["id_entidad"]))
{
	$id_componente=$_REQUEST["id_entidad"];
}
else
{
	$cadena=htmlentities("En la actualidad no se encuentra registrado ninguna estructura jerárqica para su organización");
	alerta::sin_registro($configuracion,$cadena);	
}

$fila=0;
$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();

if (is_resource($enlace))
{
	$sesion=new sesiones($configuracion);
	$sesion->especificar_enlace($enlace);

	
	
	//Rescatar todos los componentes del modelo.
	$cadena_sql=cadena_busqueda_estructura($configuracion, "nivel", $id_componente);
	$registro=db::acceso($cadena_sql,$acceso_db,"busqueda");
		
	if(is_array($registro))
	{
		if($registro[0][0]!=NULL)
		{
			con_registro_estructura($configuracion,$acceso_db,$sesion, $registro[0][0], $id_componente);
		}
		else
		{
			$cadena="En la actualidad no se encuentra registrada ninguna estructura jerárquica para su organización";
			$cadena=htmlentities($cadena, ENT_COMPAT, "UTF-8");
			alerta::sin_registro($configuracion,$cadena);	
		}
	}

}
	
function rescatar_hijos($id_componente, $nivel,$padre,$total,$acceso_db,$sesion,$configuracion)
{
	$valor[0]=$id_componente;
	$valor[1]=$nivel;
	$valor[2]=$padre;
	
	$cadena_sql=cadena_busqueda_estructura($configuracion, "hijos", $valor);
	$registro=db::acceso($cadena_sql,$acceso_db,"busqueda");
	
	if(is_array($registro))
	{
		return $registro[0][0];
	
	}
	
	return 0;
	
}
	
function rescatar_componente($id_componente, $nivel,$padre,$total,$acceso_db,$sesion,$configuracion)
{
	
	include ($configuracion["raiz_documento"].$configuracion["estilo"]."/basico/tema.php");
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$cripto=new encriptar();	
	$valor[0]=$nivel;
	$valor[1]=$padre;
	$valor[2]=$id_componente;//Entidad
	$valor[3]=0;// Estructura organizacional
	
	$cadena_sql=cadena_busqueda_estructura($configuracion, "componente", $valor);
	
	unset ($registro_componente);
	//echo $registro_componente;
	$registro_componente=db::acceso($cadena_sql,$acceso_db,"busqueda");
	if(is_array($registro_componente))
	{
		$campos=count($registro_componente);
		
		//if($campos>0)
		//{
			for($a=0;$a<$campos;$a++)
			{
				//Determinar los hijos del componente
				$hijos=rescatar_hijos($_REQUEST["id_entidad"],($nivel+1),$registro_componente[$a][0],$total,$acceso_db,$sesion,$configuracion);
				
				
				//Armar el codigo del componente
				$color_celda="#".dechex(208-(10*$nivel)).dechex(220-(4*$nivel)).dechex(255);
				if($sesion->rescatar_valor_sesion($configuracion,"componente_".$registro_componente[$a][0]."_".$nivel) )
				{
					
					echo "<tr class='bloquecentralmostrar'>\n";
					echo "<td bgcolor='".$color_celda."' class='bloquecentralcuerpo' >\n";
					
					
					for($i=0; $i<$nivel;$i++)
					{
						echo  ($i==0? "|--":"---");
					}
					echo "<a name=".$registro_componente[$a][0]." href='";
					//Boton de expansion del nodo
					$variable="pagina=".$_REQUEST["pagina"];
					$variable.="&id_nodo=".$registro_componente[$a][0];
					$variable.="&nivel=".$nivel;
					$variable.="&mas=0";
					$variable.="&mostrar=0";
					$variable.="&id_entidad=".$_REQUEST["id_entidad"];
							
					$variable=$cripto->codificar_url($variable,$configuracion);
					echo $indice.$variable;	
					echo "#".$registro_componente[$a][0]."'><img width='12' height='12' src='";
					echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"];
					echo "/menos.png' alt='Ver componentes' title='Ver componentes' border='0' /></a>";
					
					echo " <span class='texto_negrita'>".htmlentities($registro_componente[$a][3], ENT_COMPAT, "ISO-8859-1")."</span>";
					echo "</td>\n";
					
					echo "<td width='5%' bgcolor='".$color_celda."' class='bloquecentralcuerpo centrar'>\n";
					if($nivel>0)
					{
						echo "<a href='";
						$variable="pagina=componente_entidad";
						$variable.="&id_elemento=".$registro_componente[$a][2];
						$variable.="&opcion=mostrar";
						$variable.="&id_entidad=".$_REQUEST["id_entidad"];
								
						$variable=$cripto->codificar_url($variable,$configuracion);
						echo $indice.$variable;	
						
						echo "'>Informaci&oacute;n</a>";
					}
					echo "</td>\n";		
					echo "</tr>\n";
					
					echo "<tr class='bloquecentralcuerpo'>\n";
					echo "<td colspan='2'>\n";
					echo $registro_componente[$a][5];
					echo "</td>\n";
					echo "</tr>\n";
					unset($_REQUEST["mas"]);
					
					//Llama recursivamente el metodo para determinar cada rama
					rescatar_componente($_REQUEST["id_entidad"],($nivel+1),$registro_componente[$a][0],$total,$acceso_db,$sesion,$configuracion);		
				}
				else
				{
					
					echo "<tr class='bloquecentralmostrar'>\n";
					echo "<td bgcolor='".$tema->celda."' class='bloquecentralcuerpo'>\n";
					for($i=0; $i<$nivel;$i++)
					{
						echo  ($i==0? "|--":"---");
					}
					if($hijos>0)
					{
						
						
						echo " <a name=".$registro_componente[$a][0]." href='";
						//Boton de expansion del nodo
						$variable="pagina=".$_REQUEST["pagina"];
						$variable.="&id_nodo=".$registro_componente[$a][0];
						$variable.="&nivel=".$nivel;
						$variable.="&mas=1";
						$variable.="&mostrar=1";
						$variable.="&id_entidad=".$_REQUEST["id_entidad"];
								
						$variable=$cripto->codificar_url($variable,$configuracion);
						echo $indice.$variable;	
						echo "#".$registro_componente[$a][0]."'><img width='12' height='12' src='";
						echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"];
						echo "/mas.png' alt='Ver componentes' title='Ver componentes' border='0'/>";
						echo "</a>";
						echo "(".$hijos.")";
						
					}
					else
					{
						echo " <img width='12' height='12' src='";
						echo $configuracion["host"].$configuracion["site"].$configuracion["grafico"];
						echo "/nodo.png'/>";
					
					}
					
					echo " <span class='texto_negrita'>".htmlentities($registro_componente[$a][3], ENT_COMPAT, "ISO-8859-1")."</span>";
					
					echo "</td>\n";
					
					echo "<td width='5%' bgcolor='".$tema->celda."'  class='bloquecentralcuerpo centrar'>\n";
					if($nivel>0)
					{
						echo "<a href='";
						$variable="pagina=componente_entidad";
						$variable.="&id_elemento=".$registro_componente[$a][2];
						$variable.="&opcion=mostrar";
						$variable.="&id_entidad=".$_REQUEST["id_entidad"];
								
						$variable=$cripto->codificar_url($variable,$configuracion);
						echo $indice.$variable;	
						
						echo "'>Informaci&oacute;n</a>";
					}
					else
					{
						echo "Entidad";
					
					}	
					echo "</td>\n";					
					echo "</tr>\n";
					
					echo "<tr class='bloquecentralcuerpo'>\n";
					echo "<td colspan='2'>\n";
					echo $registro_componente[$a][5];
					echo "</td>\n";
					echo "</tr>\n";
				}
				
				
	
			}
		//}
		
	}
	else
	{
		return FALSE;
	}
	return TRUE;
}





	
function cadena_busqueda_estructura($configuracion, $tipo, $valor)
{
	switch($tipo)
	{
		case "nivel":
			$cadena_sql="SELECT ";
			$cadena_sql.="MAX(nivel) ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_componente=".$valor." ";
			break;
		
		case "hijos":
			$cadena_sql="SELECT ";
			$cadena_sql.="COUNT(id_nodo) ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_componente=".$valor[0]." ";
			$cadena_sql.="AND ";
			$cadena_sql.="nivel=".$valor[1]." ";
			$cadena_sql.="AND ";
			$cadena_sql.="id_padre=".$valor[2]." ";
			break;
		
		case "componente":
			$cadena_sql="SELECT ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."`id_nodo`, ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."`nivel`, ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."`id_elemento`, ";			
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion"."."."`nombre`, ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."`id_componente`, ";
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion"."."."`descripcion` ";
			$cadena_sql.="FROM ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia, "; 
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion "; 
			$cadena_sql.="WHERE ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."nivel=".$valor[0]." ";
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."id_padre=".$valor[1]." ";
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."id_componente=".$valor[2]." ";
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."tipo_jerarquia=".$valor[3]." ";
			$cadena_sql.="AND ";
			$cadena_sql.=$configuracion["prefijo"]."jerarquia"."."."id_elemento=";
			$cadena_sql.=$configuracion["prefijo"]."c_organizacion"."."."id_c_organizacion";
			break;
		
		default:
		break;	
	
	}
	
	
	//echo $cadena_sql."<br>";
	return $cadena_sql;


}


function con_registro_estructura($configuracion,$acceso_db,$sesion,$total, $id_componente)
{
		$mi_sesion=$sesion->numero_sesion();
?><table class='tabla_organizacion'>
	<tr>
		<td>
<table class='bloquelateral' border='0' cellpadding='4' cellspacing='1'>
	<tbody><?php
	if(isset($_REQUEST["id_nodo"]))
	{
		if(isset($_REQUEST["mas"]))
		{
			if($_REQUEST["mas"]==1)
			{
				$sesion->guardar_valor_sesion($configuracion,"componente_".$_REQUEST["id_nodo"]."_".$_REQUEST["nivel"],1,$mi_sesion);											
			}
			else
			{
				$sesion->borrar_valor_sesion($configuracion,"componente_".$_REQUEST["id_nodo"]."_".$_REQUEST["nivel"],$mi_sesion);				
			}
		}
	}
	$padre=0;
	$nivel=0;
	rescatar_componente($id_componente,$nivel,$padre,$total,$acceso_db,$sesion,$configuracion);
?>	</tbody>
</table>
		</td>
	</tr>
</table>
	<?php
}
	
?> 
