<?php
include_once "../controladores/alumno.controlador.php";
require_once "../modelos/alumno.modelo.php";

class AjaxAlumno{

	/*=============================================
	EDITAR ALUMNO
	=============================================*/	

	public $idAlumno;

 public function ajaxEditarAlumno(){

		$item = "id_alumno";
		$valor = $this->idAlumno;

		$respuesta = ControladorAlumno::ctrMostrarAlumno($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR ALUMNO
=============================================*/
if(isset($_POST["idAlumno"])){

	$editar = new AjaxAlumno();
	$editar -> idAlumno = $_POST["idAlumno"];
	$editar -> ajaxEditarAlumno();

}