<?php
include_once "../controladores/profesor.controlador.php";
require_once "../modelos/profesor.modelo.php";

class AjaxProfesor{

	/*=============================================
	EDITAR PROFESOR
	=============================================*/	

	public $idProfesor;

 public function ajaxEditarProfesor(){

		$item = "id_profesor";
		$valor = $this->idProfesor;

		$respuesta = ControladorProfesor::ctrMostrarProfesor($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR PROFESOR
=============================================*/
if(isset($_POST["idProfesor"])){

	$editar = new AjaxProfesor();
	$editar -> idProfesor = $_POST["idProfesor"];
	$editar -> ajaxEditarProfesor();

}