<?php
include_once "../controladores/tipopregunta.controlador.php";
require_once "../modelos/tipopregunta.modelo.php";

class AjaxTipopregunta{

	/*=============================================
	EDITAR TIPOPREGUNTA
	=============================================*/	

	public $idTipopregunta;

 public function ajaxEditarTipopregunta(){

		$item = "id_tipo_pregunta";
		$valor = $this->idTipopregunta;

		$respuesta = ControladorTipopregunta::ctrMostrarTipopregunta($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR TIPOPREGUNTA
=============================================*/
if(isset($_POST["idTipopregunta"])){

	$editar = new AjaxTipopregunta();
	$editar -> idTipopregunta = $_POST["idTipopregunta"];
	$editar -> ajaxEditarTipopregunta();

}