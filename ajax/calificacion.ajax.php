<?php
include_once "../controladores/calificacion.controlador.php";
require_once "../modelos/calificacion.modelo.php";

class AjaxCalificacion{

	/*=============================================
	EDITAR CALIFICACION
	=============================================*/	

	public $idCalificacion;

 public function ajaxEditarCalificacion(){

		$item = "id_calificacion";
		$valor = $this->idCalificacion;

		$respuesta = ControladorCalificacion::ctrMostrarCalificacion($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR CALIFICACION
=============================================*/
if(isset($_POST["idCalificacion"])){

	$editar = new AjaxCalificacion();
	$editar -> idCalificacion = $_POST["idCalificacion"];
	$editar -> ajaxEditarCalificacion();

}