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
* @description  Formualrio para el registro de usuarios
* @usage        
*******************************************************************************/ 
if(!isset($GLOBALS["autorizado"]))
{
	include("../index.php");
	exit;		
}

if(!isset($_REQUEST['action']))
{
	include_once("html.php");	

}
else
{
	include_once("action.php");	
}

?>
