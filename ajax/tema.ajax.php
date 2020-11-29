<?php
include_once "../controladores/tema.controlador.php";
require_once "../modelos/tema.modelo.php";

class AjaxTema{

	/*=============================================
	EDITAR TEMA
	=============================================*/	

	public $idTema;

 public function ajaxEditarTema(){

		$item = "id_tema";
		$valor = $this->idTema;

		$respuesta = ControladorTema::ctrMostrarTema($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR TEMA
=============================================*/
if(isset($_POST["idTema"])){

	$editar = new AjaxTema();
	$editar -> idTema = $_POST["idTema"];
	$editar -> ajaxEditarTema();

}