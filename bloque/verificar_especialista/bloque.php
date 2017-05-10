<?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}



$acceso_db=new dbms($configuracion);
$enlace=$acceso_db->conectar_db();
if (is_resource($enlace))
{
	
	//1. Rescatar el id de usuario
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
	
	//2. Buscar que el id_usuario se encuentre en la entidad especialista
	
	$cadena_sql="SELECT ";
	$cadena_sql.="`id_usuario` ";
	$cadena_sql.="FROM ";
	$cadena_sql.=$configuracion["prefijo"]."especialista "; 
	$cadena_sql.="WHERE ";
	$cadena_sql.="`id_usuario`=".$id_usuario." ";
	$cadena_sql.="LIMIT 1";
	
	$acceso_db->registro_db($cadena_sql,0);
	$registro=$acceso_db->obtener_registro_db();
	$campos=$acceso_db->obtener_conteo_db();
	if($campos==0)
	{
		//No existe un perfil del especilista registrado
		$pagina="registro_especialista";
		include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/enlace.inc.php");
		echo "<script>alert('Para poder acceder al sistema es necesario registrar su perfil.')</script>";
		echo "<script>location.replace('".$configuracion["host"].$configuracion["site"]."/index.php?page=".enlace($pagina)."')</script>";   
	}
	
}	






