<?php
include_once "../controladores/sesion.controlador.php";
require_once "../modelos/sesion.modelo.php";

class AjaxSesion{

	/*=============================================
	EDITAR SESION
	=============================================*/	

	public $idSesion;

 public function ajaxEditarSesion(){

		$item = "id_sesion";
		$valor = $this->idSesion;

		$respuesta = ControladorSesion::ctrMostrarSesion($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR SESION
=============================================*/
if(isset($_POST["idSesion"])){

	$editar = new AjaxSesion();
	$editar -> idSesion = $_POST["idSesion"];
	$editar -> ajaxEditarSesion();

}