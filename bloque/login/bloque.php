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
?>
<?php
/****************************************************************************************************************
  
001.php 

Paulo Cesar Coronado
Copyright (C) 2010-2016

Última revisión 6 de Marzo de 2016

*******************************************************************************************************************
* @subpackage   
* @package	formulario
* @copyright    
* @version      0.2
* @author      	Paulo Cesar Coronado
* @link		http://gitem.udistrital.edu.co
* 
*
* Formulario de autenticacion de usuarios
*
*****************************************************************************************************************/
?><?php
/**
@TO DO: La posibilidad de definir la presentación del formulario (fondos, bordes) por medio de hojas
de estilo y/o estilos inline


*/

if(!isset($_POST['action']))
{
	//echo 'HTML';
	include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/login/html.php");	

}else
{
	//echo 'ACTION';
	include_once($configuracion["raiz_documento"].$configuracion["bloques"]."/login/action.php");	
}


?>
