<?php
include_once "../controladores/grado.controlador.php";
require_once "../modelos/grado.modelo.php";

class AjaxGrado{

	/*=============================================
	EDITAR GRADO
	=============================================*/	

	public $idGrado;

 public function ajaxEditarGrado(){

		$item = "id_grado";
		$valor = $this->idGrado;

		$respuesta = ControladorGrado::ctrMostrarGrado($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR GRADO
=============================================*/
if(isset($_POST["idGrado"])){

	$editar = new AjaxGrado();
	$editar -> idGrado = $_POST["idGrado"];
	$editar -> ajaxEditarGrado();

}