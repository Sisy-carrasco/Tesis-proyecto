<?php
include_once "../controladores/nivelliteral.controlador.php";
require_once "../modelos/nivelliteral.modelo.php";

class AjaxNivelliteral{

	/*=============================================
	EDITAR NIVELliteral
	=============================================*/	

	public $idNivelliteral;

 public function ajaxEditarNivelliteral(){

		$item = "id_nivel_literal";
		$valor = $this->idNivelliteral;

		$respuesta = ControladorNivelliteral::ctrMostrarNivelliteral($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR NIVELliteral
=============================================*/
if(isset($_POST["idNivelliteral"])){

	$editar = new AjaxNivelliteral();
	$editar -> idNivelliteral = $_POST["idNivelliteral"];
	$editar -> ajaxEditarNivelliteral();

}