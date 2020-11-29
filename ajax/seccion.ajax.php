<?php
include_once "../controladores/seccion.controlador.php";
require_once "../modelos/seccion.modelo.php";

class AjaxSeccion{

	/*=============================================
	EDITAR SECCION
	=============================================*/	

	public $idSeccion;

 public function ajaxEditarSeccion(){

		$item = "id_seccion";
		$valor = $this->idSeccion;

		$respuesta = ControladorSeccion::ctrMostrarSeccion($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR SECCION
=============================================*/
if(isset($_POST["idSeccion"])){

	$editar = new AjaxSeccion();
	$editar -> idSeccion = $_POST["idSeccion"];
	$editar -> ajaxEditarSeccion();

}