<?php
/**
 * Open Health Vademecum
 * Copyright (C)
 * UNIVERSIDAD DISTRITAL Francisco José de Caldas
 * Grupo de Investigación GITEM
 * 
 * Este programa es software libre: puede redistribuirlo y/o modificarlo bajo
 * los términos de la Licencia General Pública de GNU publicada por la Free
 * Software Foundation, ya sea la versión 3 de la Licencia, o (a su elección)
 * cualquier versión posterior.
 * 
 * Este programa se distribuye con la esperanza de que sea útil pero SIN 
 * NINGUNA GARANTÍA. Incluso sin garantía implícita de COMERCIALIZACIÓN o 
 * ADECUACIÓN PARA UN PROPÓSITO PARTICULAR.  
 * 
 * Usted ha debido de recibir una copia de la Licencia GPL junto con este 
 * programa. Si no es así, por favor consulte: <http://www.gnu.org/licenses/>. 
 */

/**
* @name         index.php 
* @author       Paulo Cesar Coronado
* @description  Pagina principal del aplicativo
*/

require_once('clase/config.class.php');

$esta_configuracion=new config();
$configuracion=$esta_configuracion->variable(); 

if(!isset($configuracion["instalado"]))
{
	include 'instalador/Instalador.class.php';
	$instalador=new Instalador();
	$instalador->instalar();
	
}else{
	include_once($configuracion["raiz_documento"].$configuracion["clases"]."/pagina.class.php");	
	$la_pagina=new pagina($configuracion);
}

?>