<?php
include_once "../controladores/matricula.controlador.php";
include_once "../controladores/seccion.controlador.php";
include_once "../controladores/profesor.controlador.php";
require_once "../modelos/detalle_matricula.modelo.php";
require_once "../modelos/matricula.modelo.php";
require_once "../modelos/seccion.modelo.php";
require_once "../modelos/profesor.modelo.php";

class AjaxMatricula{

	/*=============================================
	EDITAR MATRICULA
	=============================================*/	

	public $idMatricula;

 	public function ajaxEditarMatricula(){

		$item = "id_matricula";
		$valor = $this->idMatricula;

		$respuesta = ControladorMatricula::ctrMostrarMatricula($item, $valor);

		echo json_encode($respuesta);

	 }
	 
	public $idDetalleMatricula;

 	public function ajaxEditarDetalleMatricula(){

		$item = "id_detalle_matricula";
		$valor = $this->idDetalleMatricula;

		$respuesta = ControladorMatricula::ctrMostrarDetalleMatricula($item, $valor);

		echo json_encode($respuesta);

 	}

 	public $idGrado;

	public function ajaxListaSeccion(){
		$item = null;
		$valor = null;

		$seccion = ControladorSeccion::ctrMostrarSeccion($item,$valor);
		$rs = "<option value='0'>Seleccione Seccion</option>";
		foreach($seccion as $k=>$v){
			if($this->idGrado==$v["id_grado"]){
				$rs.="<option value='".$v["id_seccion"]."'>".$v["nombre"]."</option>";
			}
		}
		echo $rs;
	}

	public $idSeccion;

	public function ajaxListaProfesor(){
		$seccion = ControladorProfesor::ctrMostrarProfesor(null,null);
		$rs = "<option value='0'>Selecciona Docente</option>";
		foreach($seccion as $k=>$v){
			if($v["id_seccion"]==$this->idSeccion){
				$rs.="<option value='".$v["id_profesor"]."'>".$v["nombres_completos"]."</option>";
			}
		}
		echo $rs;
	}

}


/*=============================================
EDITAR MATRICULA
=============================================*/
if(isset($_POST["idMatricula"])){

	$editar = new AjaxMatricula();
	$editar -> idMatricula = $_POST["idMatricula"];
	$editar -> ajaxEditarMatricula();

}

if(isset($_POST["idDetalleMatricula"])){

	$editar = new AjaxMatricula();
	$editar -> idDetalleMatricula = $_POST["idDetalleMatricula"];
	$editar -> ajaxEditarDetalleMatricula();

}


if(isset($_POST["idGrado"])){
	$editar = new AjaxMatricula();
	$editar -> idGrado = $_POST["idGrado"];
	$editar -> ajaxListaSeccion();
}

if(isset($_POST["idSeccion"])){
	$editar = new AjaxMatricula();
	$editar -> idSeccion = $_POST["idSeccion"];
	$editar -> ajaxListaProfesor();
}