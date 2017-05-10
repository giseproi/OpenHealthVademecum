<?php
/**
 * Open Health Vademecum
 * Copyright (C)
 * UNIVERSIDAD DISTRITAL Francisco José de Caldas
 * Grupo de Investigación GITEM
 **/

/**
* @name         Instalador.Class.php 
* @author       Paulo Cesar Coronado
* @description  Pagina principal del instalador
*/

require_once 'Verificador.class.php';
require_once 'Template.class.php';

class Instalador{
	
	var $verificador;
	var $template;
	function __construct(){
		$this->verificador=new Verificador();
		$this->template=new template();
		
	}
	function verificarConfiguracion(){
		
		$respuesta=true;
		$this->verificador->verificar();
		foreach ($this->verificador->mensaje as $indice=>$mensaje){
			$tipoMensaje=$this->verificador->error[$indice];
			$this->template->mensaje($mensaje);
		}
		foreach ($this->verificador->error as $indice=>$error){
			if($error==1){
				$respuesta=false;
			}
		}
		
		if($respuesta){
			$this->template->boton();
		}
		
		
		return $respuesta;
	}
	
	function instalar(){
		$this->template->encabezado();
		$this->template->mensajes(1);
		$this->verificarConfiguracion();
		$this->template->mensajes(0);
		$this->template->formulario();
		$this->template->pie();
		
	}
	
}




