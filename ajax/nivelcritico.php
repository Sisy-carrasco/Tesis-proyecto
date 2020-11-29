<?php
include_once "../controladores/nivelcritico.controlador.php";
require_once "../modelos/nivelcritico.modelo.php";

class AjaxNivelcritico{

	/*=============================================
	EDITAR NIVELcritico
	=============================================*/	

	public $idNivelcritico;

 public function ajaxEditarNivelcritico(){

		$item = "id_nivel_critico";
		$valor = $this->idNivelcritico;

		$respuesta = ControladorNivelcritico::ctrMostrarNivelcritico($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR NIVELcritico
=============================================*/
if(isset($_POST["idNivelcritico"])){

	$editar = new AjaxNivelcritico();
	$editar -> idNivelcritico = $_POST["idNivelcritico"];
	$editar -> ajaxEditarNivelcritico();

}