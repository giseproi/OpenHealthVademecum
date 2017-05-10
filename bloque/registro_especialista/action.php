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
  
registro.action.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

*******************************************************************************************************************
* @subpackage   
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Action de registro de usuarios
* @usage        
*****************************************************************************************************************/
?><?php
$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	
	if(!isset($_POST['cancelar']))
	{
	//Si se esta editando
		
		if(isset($_POST['id_usuario']))
		{
			
			if(isset($_FILES["imagen"]["name"]))
			{
				if($_FILES["imagen"]["name"]!="")
				{
					$imagen=subir_mi_archivo("borrar","imagen",$configuracion);	
					
				}
			}
			
			
			$cadena_sql="UPDATE ".$configuracion["prefijo"]."especialista "; 
			$cadena_sql.="SET "; 
			$cadena_sql.="`id_usuario`='".$_POST['id_usuario']."', ";
			$cadena_sql.="`registro`='".$_POST['registro']."', ";
			$cadena_sql.="`experiencia`='".$_POST['experiencia']."', ";
			$cadena_sql.="`asistencial`='".$_POST['asistencial']."', ";
			$cadena_sql.="`administrativo`='".$_POST['administrativo']."', ";
			$cadena_sql.="`docente`='".$_POST['docente']."', ";
			$cadena_sql.="`investigativo`='".$_POST['investigativo']."', ";
			$cadena_sql.="`habilidades`='".$_POST['habilidades']."', ";
			$cadena_sql.="`imagen`='".$imagen."' ";
			$cadena_sql.="WHERE ";
			$cadena_sql.="id_usuario=".$_POST['id_usuario'];
			echo $cadena_sql;
			@$resultado=$acceso_db->ejecutar_acceso_db($cadena_sql);
		}
		else
		{
			$nueva_sesion=new sesiones($configuracion);
			$nueva_sesion->especificar_enlace($enlace);
			$esta_sesion=$nueva_sesion->numero_sesion();
			//Rescatar el valor de la variable usuario de la sesion
			$registro=$nueva_sesion->rescatar_valor_sesion($configuracion,"id_usuario");
			if($registro)
			{
				
				$id_usuario=$registro[0][0];
			}
			
			$imagen=subir_mi_archivo("","imagen",$configuracion);	
			
			$cadena_sql="INSERT INTO ".$configuracion["prefijo"]."especialista "; 
			$cadena_sql.="( ";
			$cadena_sql.="`id_usuario`, ";
			$cadena_sql.="`registro`, ";
			$cadena_sql.="`experiencia`, ";
			$cadena_sql.="`asistencial`, ";
			$cadena_sql.="`administrativo`, ";
			$cadena_sql.="`docente`, ";
			$cadena_sql.="`investigativo`, ";
			$cadena_sql.="`habilidades`, ";
			$cadena_sql.="`imagen` ";
			$cadena_sql.=") ";
			$cadena_sql.="VALUES ";
			$cadena_sql.="( ";
			$cadena_sql.=$id_usuario.", ";
			$cadena_sql.="'".$_POST['registro']."', ";
			$cadena_sql.="'".$_POST['experiencia']."', ";
			$cadena_sql.="'".$_POST['asistencial']."', ";
			$cadena_sql.="'".$_POST['administrativo']."', ";
			$cadena_sql.="'".$_POST['docente']."', ";
			$cadena_sql.="'".$_POST['investigativo']."', ";
			$cadena_sql.="'".$_POST['habilidades']."', ";
			$cadena_sql.="'".$imagen."' ";
			$cadena_sql.=")";
			//echo $cadena_sql;
			@$resultado=$acceso_db->ejecutar_acceso_db($cadena_sql);
		
		}
		if($resultado==FALSE)
		{
			/*TODO Mensaje de error*/
			echo "El sistema est&aacute; fuera de servicio en estos momentos. Por favor reintentelo dentro de algunos minutos.";
			exit;
		}
		
		include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/enlace.inc.php");
		$pagina="registro_especialista";
		echo "<script>location.replace('".$configuracion["host"].$configuracion["site"]."/index.php?page=".enlace($pagina)."&accion=1&hoja=0&opcion=".enlace("mostrar")."')</script>";   
		
		
	}
	else
	{
		include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/enlace.inc.php");
		$pagina="especialista";
		echo "<script>location.replace('".$configuracion["host"].$configuracion["site"]."/index.php?page=".enlace($pagina)."&accion=1&hoja=0')</script>";   
	}
}

function subir_mi_archivo($opcion,$campo,$configuracion)
{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/subir_archivo.class.php");
	
	$subir = new subir_archivo();
	$subir->directorio_carga= $configuracion['raiz_documento']."/fotografia/";
	$subir->nombre_campo=$campo;
	$subir->tipos_permitidos= array("jpg","png");
		
	// Maximo tamanno permitido
	//$subir->tamanno_maximo=5000000;
	$subir->especial= "[[:space:]]|[\"\*\\\'\%\$\&\@\<\>]";
			
	$subir->unico=TRUE;
	$subir->permisos=0444;
	$subir->cargar();
	if($subir->log["resultado"][0]=="ERROR")
	{
		echo "Imposible cargar el archivo en estos momentos.";
		exit;
	}
	
	
	if($opcion=='borrar')
	{
		$subir->eliminar_archivo($_POST["imagen_anterior"]);
	}
	return $subir->log["mi_archivo"][0];
}		


	
?>
