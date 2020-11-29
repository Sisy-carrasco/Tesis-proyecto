<?php
include_once "../controladores/nivelinferencial.controlador.php";
require_once "../modelos/nivelinferencial.modelo.php";

class AjaxNivelinferencial{

	/*=============================================
	EDITAR NIVELinferencial
	=============================================*/	

	public $idNivelinferencial;

 public function ajaxEditarNivelinferencial(){

		$item = "id_nivel_inferencial";
		$valor = $this->idNivelinferencial;

		$respuesta = ControladorNivelinferencial::ctrMostrarNivelinferencial($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR NIVELinferencial
=============================================*/
if(isset($_POST["idNivelinferencial"])){

	$editar = new AjaxNivelinferencial();
	$editar -> idNivelinferencial = $_POST["idNivelinferencial"];
	$editar -> ajaxEditarNivelinferencial();

}