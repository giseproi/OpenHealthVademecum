<?php
/*
############################################################################
#    UNIVERSIDAD DISTRITAL Francisco Jose de Caldas                        #
#    Desarrollo Por:                                                       #
#    Paulo Cesar Coronado 2012 - 2016                                      #
#    paulo_cesar@udistrital.edu.co                                                #
#    Copyright: Vea el archivo EULA.txt que viene con la distribucion      #
############################################################################
*/
?><?php
/*************************************************************************************************************
  
bloque.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

***************************************************************************************************************
* @subpackage   registro_seleccionar_modelo
* @package	bloques
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		N/D
* @description  Formulario para la seleccion de modelos dentro de la ponderacion
* @usage        
************************************************************************************************************/ 
?><?php
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}
if(!isset($_POST['action']))
{
	include_once("html.php");	

}
else
{
	include_once("action.php");	
}

?>