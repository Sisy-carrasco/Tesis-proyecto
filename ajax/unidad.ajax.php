<?php
include_once "../controladores/unidad.controlador.php";
require_once "../modelos/unidad.modelo.php";

class AjaxUnidad{

	/*=============================================
	EDITAR UNIDAD
	=============================================*/	

	public $idUnidad;

	public function ajaxListaSesion(){
		$item = null;
		$valor = null;

		$seccion = ControladorSesion::ctrMostrarSesion($item,$valor);
		$rs = "<option value='0'>Seleccione Sesion</option>";
		foreach($seccion as $k=>$v){
			if($this->idUnidad==$v["id_unidad"]){
				$rs.="<option value='".$v["id_sesion"]."'>".$v["descripcion"]."</option>";
			}
		}
		echo $rs;
	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarUnidad;
	public $activarId;


	 public function ajaxActivarUnidad(){

		$tabla = "unidad";

		$item1 = "estado";
		$valor1 = $this->activarUnidad;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloUnidad::mdlActualizarUnidad($tabla, $item1, $valor1, $item2, $valor2);

	}


// 	public $idSesion;
// public function ajaxListaTema(){
// 		$seccion = ControladorTema::ctrMostrarTema(null,null);
// 		$rs = "<option value='0'>Selecciona Tema</option>";

// 		foreach ($seccion as $key => $value) {
// 				if($value["id_sesion"]==$this->idSesion){
// 				$rs.="<option value='".$value["id_tema"]."'>".$value["descripcion"]."</option>";
// 			}
// 		}

// 		echo $rs;
// 	}

// }
 public function ajaxEditarUnidad(){

		$item = "id_unidad";
		$valor = $this->idUnidad;

		$respuesta = ControladorUnidad::ctrMostrarUnidad($item, $valor);

		echo json_encode($respuesta);

 }

}

/*=============================================
EDITAR UNIDAD
=============================================*/
// if(isset($_POST["idUnidad"])){

// 	$editar = new AjaxUnidad();
// 	$editar -> idUnidad = $_POST["idUnidad"];
// 	$editar -> ajaxEditarUnidad();

// }

if(isset($_POST["idUnidad"])){
	$editar = new AjaxUnidad();
	$editar -> idUnidad = $_POST["idUnidad"];
	$editar -> ajaxListaSesion();
}

if(isset($_POST["activarUnidad"])){

	$activarUnidad = new AjaxUnidad();
	$activarUnidad -> activarUnidad = $_POST["activarUnidad"];
	$activarUnidad -> activarId = $_POST["activarId"];
	$activarUnidad -> ajaxActivarUnidad();

}