<?php
include_once "../controladores/curso.controlador.php";
require_once "../modelos/curso.modelo.php";

class AjaxCurso{

	/*=============================================
	EDITAR CURSO
	=============================================*/	

	public $idCurso;

 public function ajaxEditarCurso(){

		$item = "id_curso";
		$valor = $this->idCurso;

		$respuesta = ControladorCurso::ctrMostrarCurso($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR CURSO
=============================================*/
if(isset($_POST["idCurso"])){

	$editar = new AjaxCurso();
	$editar -> idCurso = $_POST["idCurso"];
	$editar -> ajaxEditarCurso();

}