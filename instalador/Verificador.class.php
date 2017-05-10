<?php
/**
 * Open Health Vademecum
 * Copyright (C)
 * UNIVERSIDAD DISTRITAL Francisco José de Caldas
 * Grupo de Investigación GITEM 
 */
class Verificador {
	
	var $mensaje=array();
	//Código de error: 0:Sin error, 1:Error Grave, 2:Advertencia
	var $error=array();
	
	function verificar(){
		$this->verificarPHP();
		$this->verificarMySQL();
		$this->verificarGD();
		$this->verificarModoSeguro();
	}
	
	function setRespuesta($mensaje, $error, $indice){		
		$this->mensaje[$indice]=$mensaje;
		$this->error[$indice]=$error;		
	}
	
	function verificarPHP() {
		if (substr ( phpversion (), 0, 3 ) > (4.2)) {			
			$this->setRespuesta('OK: Versión actual de PHP: ' . phpversion () . '.', 0, 0);
		} else {
			$this->setRespuesta('Error: Versión actual de PHP: ' . phpversion () . '.', 1, 0);
		}
	}
	function verificarMySQL() {
		if (extension_loaded ( "mysql" )) {
			$this->setRespuesta('OK: Soporte MySQL ', 0, 1);
		} else {
			$this->setRespuesta('Error: Soporte MySQL ', 0, 1);
		}
	}
	function verificarGD() {
		if (extension_loaded ( "gd" )) {
			$this->setRespuesta('OK: Soporte GD ', 0, 2);
		} else {
			$this->setRespuesta('Advertencia: No existe soporte para imagenes - biblioteca GD.<br>El aplicativo no podrá generar gráficos.', 2, 2);
		}
	}
	function verificarModoSeguro() {
		if (! getenv ( "safe_mode" )) {
			$this->setRespuesta('OK: Soporte para carga de archivo con SAFE_MODE=off', 0, 3);
		} else {
			$this->setRespuesta('Advertencia: El servidor está en modo seguro.<br>El manejo de archivos estará deshabilitado.', 2, 3);			
		}
	}

}