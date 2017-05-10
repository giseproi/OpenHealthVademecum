<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2017                                      #
#    paulo_cesar@etb.net.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
/***************************************************************************
  
index.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 29 de Marzo de 2017

*****************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario para el registro de un archivo de bloques
* @usage        
*******************************************************************************/ 

$numero_columnas=4;
$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	$nueva_sesion=new sesiones($configuracion);
	$nueva_sesion->especificar_enlace($enlace);
	$esta_sesion=$nueva_sesion->numero_sesion();
	//Rescatar el valor de la variable usuario de la sesion
	$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
	if($registro)
	{
		
		$id_usuario=$registro[0][0];
		unset($registro);
	}
	
	@set_time_limit (0);
	//Cargar el informe en el servidor
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/subir_archivo.class.php");
	
	$subir = new subir_archivo();
		
	$subir->directorio_carga= $configuracion['raiz_documento']."/documento/";
	
	
	$subir->nombre_campo="archivo";
	$subir->tipos_permitidos= array("xls");
		
	// Maximo tamanno permitido
	//$subir->tamanno_maximo=5000000;
		
	$subir->especial= "[[:space:]]|[\"\*\\\'\%\$\&\@\<\>]";
			
	$subir->unico=TRUE;
	$subir->permisos=0777;
	$error_carga=$subir->cargar();
	
	$matriz=$subir->log["resultado"];
	
	if(isset($subir->log["resultado"]))
	{
		
		while (list($key, $val) = each($matriz) )
		{
			if($val == "ERROR")
			{
				echo "Imposible cargar el archivo en estos momentos.";
				$error_carga=TRUE;		
			}
		}
	}
	
	if($error_carga==FALSE)
	{
		
		$nombre_archivo=$subir->log["mi_archivo"][0];
		//$nombre_archivo=$_REQUEST["archivo"];
		require_once ($configuracion["raiz_documento"].$configuracion["clases"]."/lector_estructura.class.php");
		
		
		// ExcelFile($filename, $encoding);
		$data=new Spreadsheet_Excel_Reader();
		$data->read($configuracion['raiz_documento']."/documento/".$nombre_archivo,$configuracion);
		$data->setOutputEncoding('CP1251');
		$filas=$data->sheets[0]['numRows'];
		$columnas=$data->sheets[0]['numCols'];
		
		//Verificar la integridad de los datos
		$error=lector_estructura::verificar_datos_estructura($filas, $columnas, $data, $_REQUEST["id_entidad"]);
		
		if($columnas==$numero_columnas && $error==false)
		{
			//Eliminar estructura anterior
			$valor[0]=0;
			$valor[1]=$_REQUEST["id_entidad"];
			$error=lector_estructura::guardar_estructura($filas, $columnas, $data, $valor, 0, $acceso_db, $enlace, $id_usuario, $configuracion);
			
			
			/*$data = new lector_estructura();
			$data->tabla("jerarquia",$configuracion);
			$data->read($configuracion['raiz_documento']."/documento/".$nombre_archivo,$configuracion);
			
			
			redireccionar_lote_estructura($configuracion, "exito");*/
			redireccionar_lote_estructura($configuracion, "exito");
		}
		else
		{
			
			?><script>
				alert("El nùmero de columnas de la página no corresponde con lo esperado.");
			</script>
			<?php	
		}
		
		
		//error_reporting(E_ALL ^ E_NOTICE);
		
		
	}
	else
	{
		redireccionar_lote_estructura($configuracion, "error");
	}
	
	//print_r($data);
	//print_r($data->formatRecords);
	

}
//*****************************************************************************
//                        Funciones
//*****************************************************************************



 



function redireccionar_lote_estructura($configuracion, $tipo)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/encriptar.class.php");	
	$cripto=new encriptar();
	switch($tipo)
	{
	
		case "error":
			//Ingresar una variable de sesion
			
			$pagina="mensaje_general";
			$variables="&registro=".$_REQUEST["registro"];
			$variables.="&etiqueta=1";
			
			$regresar=$configuracion["host"].$configuracion["site"]."/index.php?page=".enlace("registro_lote_info_anual").$variables;
					
			$nueva_sesion=new sesiones($configuracion);
			$nueva_sesion->especificar_enlace($acceso_db->obtener_enlace());
			$esta_sesion=$nueva_sesion->numero_sesion();
			$resultado = $nueva_sesion->borrar_valor_sesion($configuracion,"mensaje_general",$esta_sesion);
			$resultado = $nueva_sesion->guardar_valor_sesion($configuracion,"mensaje_general",$regresar,$esta_sesion);		
			break;
		
		case "exito":
			$variables="pagina=estructura_entidad";
			$variables.="&id_entidad=".$_REQUEST["id_entidad"];
			$variables.="&mostrar=lista";
		
		
		
			break;
		
	}
	$indice=$configuracion["host"].$configuracion["site"]."/index.php?";
	$variables=$cripto->codificar_url($variables,$configuracion);
	
	echo "<script>location.replace('".$indice.$variables."')</script>";

}

		
?>
