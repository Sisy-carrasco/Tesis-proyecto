<?php
session_start();
include_once "../controladores/lectura.controlador.php";
include_once "../controladores/tema.controlador.php";
include_once "../controladores/sesion.controlador.php";
require_once "../modelos/lectura.modelo.php";
require_once "../modelos/tema.modelo.php";
require_once "../modelos/sesion.modelo.php";

class AjaxLectura{

	/*=============================================
	EDITAR LECTURA
	=============================================*/	

	public $idLectura;

 public function ajaxEditarLectura(){

		$item = "id_lectura";
		$valor = $this->idLectura;

		$respuesta = ControladorLectura::ctrMostrarLectura($item, $valor);

		echo json_encode($respuesta);

 }

	 public $idUnidad;
	 
 public function ajaxListaUnidad(){
		$item = "id_usuario";
		$valor = $_SESSION["id"];

		$tema = ControladorTema::ctrMostrarTema($item,$valor);
		$rs = "<option value=''>Seleccione Tema</option>";
		print_r($tema);
		foreach($tema as $k=>$v){print_r($v);
			if($v["id_unidad"]==$this->idUnidad){
				$rs.="<option value='".$v["id_tema"]."'>".$v["descripcion"]."</option>";
			}
		}
		echo $rs;
 }



 	public $idSesion;

	public function ajaxListaTema(){
		$item = null;
		$valor = null;

		$tema = ControladorTema::ctrMostrarTema1($item,$valor);
		$rs = "<option value='0'>Seleccione Tema</option>";
		foreach ($tema as $key => $value) {
			if($this->idSesion==$value["id_sesion"]){
				$rs.="<option value='".$value["id_tema"]."'>".$value["descripcion"]."</option>";
			}
		}

		echo $rs;
	}


}


/*=============================================
EDITAR LECTURA
=============================================*/
if(isset($_POST["idLectura"])){

	$editar = new AjaxLectura();
	$editar -> idLectura = $_POST["idLectura"];
	$editar -> ajaxEditarLectura();

}

if(isset($_POST["idUnidad"])){
	$editar = new AjaxLectura();
	$editar -> idUnidad = $_POST["idUnidad"];
	$editar -> ajaxListaUnidad();
}

if(isset($_POST["idTemaa"])){
	$editar = new AjaxLectura();
	$editar -> idTemaa = $_POST["idTemaa"];
	$editar -> ajaxListaTema();
}

if(isset($_POST["idSesion"])){
	$editar = new AjaxLectura();
	$editar -> idSesion = $_POST["idSesion"];
	$editar -> ajaxListaTema();
}
