<?php
session_start();
include_once "../controladores/examen.controlador.php";
include_once "../controladores/seccion.controlador.php";
include_once "../controladores/curso.controlador.php";
include_once "../controladores/lectura.controlador.php";
include_once "../controladores/sesion.controlador.php";
include_once "../controladores/profesor.controlador.php";
include_once "../controladores/matricula.controlador.php";
require_once "../modelos/curso.modelo.php";
require_once "../modelos/examen.modelo.php";
require_once "../modelos/seccion.modelo.php";
require_once "../modelos/sesion.modelo.php";
require_once "../modelos/lectura.modelo.php";
require_once "../modelos/profesor.modelo.php";
require_once "../modelos/matricula.modelo.php";
require_once "../modelos/detalle_matricula.modelo.php";

class AjaxExamen{

	/*=============================================
	EDITAR EXAMEN
	=============================================*/	

	public $idExamen;

 	public function ajaxEditarExamen(){

		$item = "id_examen";
		$valor = $this->idExamen;

		$respuesta = ControladorExamen::ctrMostrarExamen2($item, $valor);

		echo json_encode($respuesta);

 	}

 	public $idGrado;

 	public function ajaxListaSeccion(){
		$item = null;
		$valor = null;

		$seccion = ControladorSeccion::ctrMostrarSeccion($item,$valor);
		$rs = "<option value='0'>Seleccione Seccion</option>";
		foreach($seccion as $k=>$v){
			if($v["id_grado"]==$this->idGrado){
				$profe = ControladorProfesor::ctrMostrarProfesor("id_usuario",$_SESSION["id"]);
				$sec = ControladorMatricula::ctrMostrarDetalleMatricula("id_profesor",$profe["id_profesor"]);
				if($sec["id_seccion"]==$v["id_seccion"]){
					$rs.="<option value='".$v["id_seccion"]."'>".$v["nombre"]."</option>";
				}
			}
		}
		echo $rs;
	}


	public $idGrado2;

	public function ajaxListaCurso(){
	   $item = "id_grado";
	   $valor = $this->idGrado2;

	   $curso = ControladorCurso::ctrMostrarCurso($item,$valor);
	   $rs = "<option value='0'>Seleccione Curso</option>";
	   if($curso!="") $rs.="<option value='".$curso["id_curso"]."'>".$curso["nombre"]."</option>";
	   echo $rs;
    }

    public $idTema;

	public function ajaxListaLectura(){
	   $item = null;
	   $valor = null;

	   $curso = ControladorLectura::ctrMostrarLectura($item,$valor);
	   $rs = "<option value='0'>Seleccione Lectura</option>";
	   foreach($curso as $k=>$v){
	   		if($v["id_tema"]==$this->idTema){
				$rs.="<option value='".$v["id_lectura"]."'>".$v["descripcion"]."</option>";
			}
		}
	   echo $rs;
	}
	
	public $idUnidad;

	public function ajaxListaSesion(){
	   $item = "id_usuario";
	   $valor = $_SESSION["id"];

	   $curso = ControladorSesion::ctrMostrarSesion($item,$valor);
	   $rs = "<option value='0'>Seleccione Sesion</option>";
	   foreach($curso as $k=>$v){
		   if($v["id_unidad"]==$this->idUnidad){
			   $rs.="<option value='".$v["id_sesion"]."'>".$v["descripcion"]."</option>";
		   }
	   }
	   echo $rs;
    }

   	public $idExamenCritico;

	public function ajaxListaExamenCritico(){
	   	$valor = $this->idExamenCritico;

		$_SESSION["inicial"]=strtotime("now");
	   	$curso = ControladorExamen::ctrMostrarExamenCriticoAlumno($valor);//print_r($curso);
	   	$detalle="<table class='table table-bordered table-striped dt-responsive tablas'>
					<thead>
						<tr>
							<th>#</th>
							<th>Puntaje</th>
							<th>Descripcion</th>
							<th>Pregunta</th>
							<th>Opciones/Respuesta</th>
						</tr>
					</thead>
					<tbody>";
		$pregunta = "";$c=0;
	    foreach($curso as $k=>$v){
			$nombre = $v["nombre"];
			$fechainicio = $v["fecha_inicio"];
			$fechafin = $v["fecha_fin"];
			$archivo = $v["archivo"];
			$lectura = $v["lectura"];
			$idexamen = $v["id_examen"];
			$sesion = $v["sesion"];
			if($v["pregunta"]!=$pregunta){$c=$c+1;
				if($pregunta!=""){
					$detalle.="</td></tr>";
				}
				$pregunta = $v["pregunta"];
				$detalle.="<tr>";
				$detalle.="<td><input type='hidden' name='txtOpcionPregunta".$v["id_pregunta"]."' id='txtOpcionPregunta".$v["id_pregunta"]."' value='' />".$c."</td>";
				$detalle.="<td>".$v["puntaje"]."</td>";
				$detalle.="<td>".$v["pregunta_descripcion"]."</td>";
				$detalle.="<td>".$v["pregunta"]."</td>";
				$detalle.="<td>";
			}
			if($v["id_tipo_pregunta"]=="3"){
				$detalle.="<textarea id='txtRespuesta".$v["id_pregunta"]."' name='txtRespuesta".$v["id_pregunta"]."' class='form-control input-lg'></textarea>";
			}else{
				$detalle.="<input type='radio' name='rdOpcion".$v["id_pregunta"]."' onclick=\"$('#txtOpcionPregunta".$v["id_pregunta"]."').val('".$v["id_pregunta_opcion"]."')\" /> ".$v["opcion"]."<br />";
			}
		}
		$detalle.="</table>";   
	   	echo json_encode(array("id_examen"=>$idexamen,"nombre"=>$nombre,"sesion"=>$sesion,"fecha_inicio"=>$fechainicio,"fecha_fin"=>$fechafin,"lectura"=>$lectura,"archivo"=>$archivo,"detalle"=>$detalle));
	}
	
	public $idExamenInferencial;

	public function ajaxListaExamenInferencial(){
	   	$valor = $this->idExamenInferencial;

		$_SESSION["inicial"]=strtotime("now");
	   	$curso = ControladorExamen::ctrMostrarExamenInferencialAlumno($valor);//print_r($curso);
	   	$detalle="<table class='table table-bordered table-striped dt-responsive tablas'>
					<thead>
						<tr>
							<th>#</th>
							<th>Puntaje</th>
							<th>Pregunta</th>
							<th>Descripcion</th>
							<th>Opciones/Respuesta</th>
						</tr>
					</thead>
					<tbody>";
		$pregunta = "";$c=0;
	    foreach($curso as $k=>$v){
			$nombre = $v["nombre"];
			$fechainicio = $v["fecha_inicio"];
			$fechafin = $v["fecha_fin"];
			$archivo = $v["archivo"];
			$lectura = $v["lectura"];
			$idexamen = $v["id_examen"];
			$sesion = $v["sesion"];
			if($v["pregunta"]!=$pregunta){$c=$c+1;
				if($pregunta!=""){
					$detalle.="</td></tr>";
				}
				$pregunta = $v["pregunta"];
				$detalle.="<tr>";
				$detalle.="<td><input type='hidden' name='txtOpcionPregunta".$v["id_pregunta"]."' id='txtOpcionPregunta".$v["id_pregunta"]."' value='' />".$c."</td>";
				$detalle.="<td>".$v["puntaje"]."</td>";
				$detalle.="<td>".$v["pregunta_descripcion"]."</td>";
				$detalle.="<td>".$v["pregunta"]."</td>";
				$detalle.="<td>";
			}
			if($v["id_tipo_pregunta"]=="3"){
				$detalle.="<textarea id='txtRespuesta".$v["id_pregunta"]."' name='txtRespuesta".$v["id_pregunta"]."' class='form-control input-lg'></textarea>";
			}else{
				$detalle.="<input type='radio' name='rdOpcion".$v["id_pregunta"]."' onclick=\"$('#txtOpcionPregunta".$v["id_pregunta"]."').val('".$v["id_pregunta_opcion"]."')\" /> ".$v["opcion"]."<br />";
			}
		}
		$detalle.="</table>";   
	   	echo json_encode(array("id_examen"=>$idexamen,"nombre"=>$nombre,"sesion"=>$sesion,"fecha_inicio"=>$fechainicio,"fecha_fin"=>$fechafin,"lectura"=>$lectura,"archivo"=>$archivo,"detalle"=>$detalle));
	}
	
	public $idExamenLiteral;

	public function ajaxListaExamenLiteral(){
		$valor = $this->idExamenLiteral;
		
		$_SESSION["inicial"]=strtotime("now");

	   	$curso = ControladorExamen::ctrMostrarExamenLiteralAlumno($valor);//print_r($curso);
	   	$detalle="<table class='table table-bordered table-striped dt-responsive tablas'>
					<thead>
						<tr>
							<th>#</th>
							<th>Puntaje</th>
							<th>Pregunta</th>
							<th>Descripcion</th>
							<th>Opciones/Respuesta</th>
						</tr>
					</thead>
					<tbody>";
		$pregunta = "";$c=0;
	    foreach($curso as $k=>$v){
			$nombre = $v["nombre"];
			$fechainicio = $v["fecha_inicio"];
			$fechafin = $v["fecha_fin"];
			$archivo = $v["archivo"];
			$lectura = $v["lectura"];
			$idexamen = $v["id_examen"];
			$sesion = $v["sesion"];
			if($v["pregunta"]!=$pregunta){$c=$c+1;
				if($pregunta!=""){
					$detalle.="</td></tr>";
				}
				$pregunta = $v["pregunta"];
				$detalle.="<tr>";
				$detalle.="<td><input type='hidden' name='txtOpcionPregunta".$v["id_pregunta"]."' id='txtOpcionPregunta".$v["id_pregunta"]."' value='' />".$c."</td>";
				$detalle.="<td>".$v["puntaje"]."</td>";
				$detalle.="<td>".$v["pregunta_descripcion"]."</td>";
				$detalle.="<td>".$v["pregunta"]."</td>";
				$detalle.="<td>";
			}
			if($v["id_tipo_pregunta"]=="3"){
				$detalle.="<textarea id='txtRespuesta".$v["id_pregunta"]."' name='txtRespuesta".$v["id_pregunta"]."' class='form-control input-lg'></textarea>";
			}else{
				$detalle.="<input type='radio' name='rdOpcion".$v["id_pregunta"]."' onclick=\"$('#txtOpcionPregunta".$v["id_pregunta"]."').val('".$v["id_pregunta_opcion"]."')\" /> ".$v["opcion"]."<br />";
			}
		}
		$detalle.="</table>";   
	   	echo json_encode(array("id_examen"=>$idexamen,"nombre"=>$nombre,"sesion"=>$sesion,"fecha_inicio"=>$fechainicio,"fecha_fin"=>$fechafin,"lectura"=>$lectura,"archivo"=>$archivo,"detalle"=>$detalle));
	}

	public $tabla;
	
	public function ajaxListaExamenDetalle(){
		$valor = $this->idExamen;
		$tabla = $this->tabla;

		if($tabla=="Critico"){
			$curso = ControladorExamen::ctrMostrarExamenCritico($valor);
		}elseif($tabla=="Inferencial"){
			$curso = ControladorExamen::ctrMostrarExamenInferencial($valor);//print_r($curso);
		}else{
			$curso = ControladorExamen::ctrMostrarExamenLiteral($valor);//print_r($curso);
		}
		//print_r($curso);
		$pregunta = "";$c=0;$detalle="";$lista="";$lista1="";
	    foreach($curso as $k=>$v){
			$nombre = $v["nombre"];
			$fechainicio = $v["fecha_inicio"];
			$fechafin = $v["fecha_fin"];
			$archivo = $v["archivo"];
			$lectura = $v["lectura"];
			$idexamen = $v["id_examen"];
			if($v["pregunta"]!=$pregunta){$c=$c+1;
				if($pregunta!=""){
					$detalle.="</thead>".
						"</table>".
						"<input type='hidden' id='txtListaOpcion".$id."' name='txtListaOpcion".$id."' value='".substr($lista,0,strlen($lista)-1)."' />".
						"<input type='hidden' id='txtOpcionCorrecto".$id."' name='txtOpcionCorrecto".$id."' value='".$correcto."' />".
					"</td>".
					"<td><input type='number' id='txtPuntaje".$id."' name='txtPuntaje".$id."' value='".$puntaje."' class='form-control input-lg' style='width: 100px !important;' /></td>".						
					"</tr>";
					$lista="";
				}
				$id = $tabla.round(rand()*100000,0);
				$lista1.=$id.",";
				$detalle.="<tr id='tr".$id."'><td><input type='hidden' id='txtIdPregunta".$id."' name='txtIdPregunta".$id."' value='".$v["id_pregunta"]."' /><select onchange=\"mostrarOpcion(this.value,'".$id."');\" id='cboTipoPregunta".$id."' name='cboTipoPregunta".$id."' class='form-control input-lg'><option value='3' ".($v["id_tipo_pregunta"]=="3"?"selected":"").">Respuesta Libre</option><option value='2' ".($v["id_tipo_pregunta"]=="2"?"selected":"").">Opcion</option></select></td>".
				"<td><textarea id='txtNombre".$id."' name='txtNombre".$id."' class='form-control input-lg'>".$v["pregunta"]."</textarea></td>".
				"<td><textarea id='txtDescripcion".$id."' name='txtDescripcion".$id."' class='form-control input-lg'>".$v["pregunta_descripcion"]."</textarea></td>".
				"<td><textarea id='txtLibre".$id."' name='txtLibre".$id."' class='form-control input-lg' ".($v["id_tipo_pregunta"]=="3"?"":"style='display:none'").">".$v["palabras_claves"]."</textarea>".
				($v["id_tipo_pregunta"]=="3"?("<input type='hidden' id='txtIdOpcion".$id."' name='txtIdOpcion".$id."' value='".$v["id_pregunta_opcion"]."'/>"):'').
					"<table class='table table-bordered table-striped' id='tbOpcion".$id."' style='".($v["id_tipo_pregunta"]=="3"?"display:none":"").";'>".
					"<thead>".
					"<tr><th class='text-center'>Opcion</th><th class='text-center'>Correcto</th><th><button type='button' class='btn btn-xs btn-info' onclick=\"agregarOpcion('".$id."')\"><i class='fa fa-plus'></i></button></th></tr>";
				$pregunta = $v["pregunta"];
				$puntaje=$v["puntaje"];
			}
			$id2="tbOpcion".$tabla.round(rand()*10000,0);
			if($v["id_tipo_pregunta"]!="3"){
				$lista.=$id2.",";
				$detalle.="<tr id='tr".$id2."'>".
						"<td><input type='hidden' id='txtIdOpcion".$id2."' name='txtIdOpcion".$id2."' value='".$v["id_pregunta_opcion"]."'/><textarea id='txtOpcion".$id2."' name='txtOpcion".$id2."' class='form-control input-lg'>".$v["opcion"]."</textarea></td>".
						"<td class='text-center'><input type='radio' name='rdOpcion".$id2."' onclick=\"$('#txtOpcionCorrecto".$id."').val('".$id2."')\" ".($v["indicador_correcto"]=="SI"?"checked":"")." /></td>".
					"<tr>";
				if($v["indicador_correcto"]=="SI"){
					$correcto = $id2;
				}
			}else{
				$lista.=$id2.",";
			}
		}
		$detalle.="</thead>".
				"</table>".
				"<input type='hidden' id='txtListaOpcion".$id."' name='txtListaOpcion".$id."' value='".substr($lista,0,strlen($lista)-1)."' />".
				"<input type='hidden' id='txtOpcionCorrecto".$id."' name='txtOpcionCorrecto".$id."' value='".$correcto."' />".
			"</td>".
			"<td><input type='number' id='txtPuntaje".$id."' name='txtPuntaje".$id."' value='".$puntaje."' class='form-control input-lg' style='width: 100px !important;' /></td>".						
		"</tr><input type='hidden' id='txtListaId".$tabla."' value='".substr($lista1,0,strlen($lista1)-1)."' />";
		echo $detalle;
	}

	public $idExamenRespuesta;

	public function ajaxListaExamenRespuesta(){
		$valor = $this->idExamenRespuesta;
		$tabla = $this->tabla;

		if($tabla=="Literal"){
			$curso = ControladorExamen::ctrMostrarExamenLiteralRespuestaAlumno($valor);//print_r($curso);
		}elseif($tabla=="Critico"){
			$curso = ControladorExamen::ctrMostrarExamenCriticoRespuestaAlumno($valor);//print_r($curso);
		}else{
			$curso = ControladorExamen::ctrMostrarExamenInferencialRespuestaAlumno($valor);//print_r($curso);
		}
		$detalle="<table class='table table-bordered table-striped dt-responsive tablas'>
				 <thead>
					 <tr>
						 <th>#</th>
						 <th>Puntaje</th>
						 <th>Pregunta</th>
						 <th>Descripcion</th>
						 <th>Opciones/Respuesta</th>
						 <th>Correcto</th>
						 <th>Puntaje Obtenido</th>
					 </tr>
				 </thead>
				 <tbody>";
	 $pregunta = "";$c=0;$total=0;$totalobtenido=0;
	 foreach($curso as $k=>$v){//print_r($v);
		if($c<4){
		 $nombre = $v["nombre"];
		 $fechainicio = $v["fecha_inicio"];
		 $fechafin = $v["fecha_fin"];
		 $archivo = $v["archivo"];
		 $lectura = $v["lectura"];
		 $idexamen = $v["id_examen"];
		 $sesion = $v["sesion"];
		 $eliminado = $v["eliminado"];
		 if($v["pregunta"]!=$pregunta){$c=$c+1;
			 if($pregunta!=""){
				 $detalle.="<td>".($puntaje>0?"SI":"NO")."</td><td>".$puntaje."</td></tr>";
			 }
			 $pregunta = $v["pregunta"];
			 $detalle.="<tr>";
			 $detalle.="<td><input type='hidden' name='txtOpcionPregunta".$v["id_pregunta"]."' id='txtOpcionPregunta".$v["id_pregunta"]."' value='' />".$c."</td>";
			 $detalle.="<td>".$v["puntaje"]."</td>";
			 $detalle.="<td>".$v["pregunta_descripcion"]."</td>";
			 $detalle.="<td>".$v["pregunta"]."</td>";
			 $detalle.="<td>";
			 $puntaje = $v["puntajeobtenido"];
			 $total = $total + $v["puntaje"];
			 $totalobtenido = $totalobtenido + $v["puntajeobtenido"];
		 }
		 if($v["id_tipo_pregunta"]=="3"){
			 $detalle.="<textarea id='txtRespuesta".$v["id_pregunta"]."' name='txtRespuesta".$v["id_pregunta"]."' readonly='' class='form-control input-lg'>".$v["opcionrespuesta"]."</textarea>";
		 }else{
			 $detalle.="<input type='radio' name='rdOpcion".$v["id_pregunta"]."' ".($v["id_pregunta_respuesta"]==$v["id_pregunta_opcion"]?"checked":"")."/><label style='".(($v["id_pregunta_respuesta"]==$v["id_pregunta_opcion"] && $puntaje>0)?"color:green":($v["id_pregunta_respuesta"]==$v["id_pregunta_opcion"]?"color:red":""))."'> ".$v["opcion"]."</label><br />";
		 }
		}
	 }
	 $detalle.="<td>".($puntaje>0?"SI":"NO")."</td><td>".$puntaje."</td></td></tr>";
	 $detalle.="<tr><td></td><td>$total</td><td><td colspan='2'></td></td><td>Total</td><td>$totalobtenido</td></tr></table>";   
	 echo json_encode(array("id_examen"=>$idexamen,"nombre"=>$nombre,"sesion"=>$sesion,"eliminado"=>$eliminado,"fecha_inicio"=>$fechainicio,"fecha_fin"=>$fechafin,"lectura"=>$lectura,"archivo"=>$archivo,"detalle"=>$detalle));
 }

}

/*=============================================
EDITAR EXAMEN
=============================================*/
if(isset($_POST["idExamen"])){

	$editar = new AjaxExamen();
	$editar -> idExamen = $_POST["idExamen"];
	$editar -> ajaxEditarExamen();

}

if(isset($_POST["idGrado"])){
	$editar = new AjaxExamen();
	$editar -> idGrado = $_POST["idGrado"];
	$editar -> ajaxListaSeccion();
}

if(isset($_POST["idGrado2"])){
	$editar = new AjaxExamen();
	$editar -> idGrado2 = $_POST["idGrado2"];
	$editar -> ajaxListaCurso();
}

if(isset($_POST["idTema"])){
	$editar = new AjaxExamen();
	$editar -> idTema = $_POST["idTema"];
	$editar -> ajaxListaLectura();
}

if(isset($_POST["idUnidad"])){
	$editar = new AjaxExamen();
	$editar -> idUnidad = $_POST["idUnidad"];
	$editar -> ajaxListaSesion();
}

if(isset($_POST["idExamenCritico"])){
	$editar = new AjaxExamen();
	$editar -> idExamenCritico = $_POST["idExamenCritico"];
	$editar -> ajaxListaExamenCritico();
}

if(isset($_POST["idExamenInferencial"])){
	$editar = new AjaxExamen();
	$editar -> idExamenInferencial = $_POST["idExamenInferencial"];
	$editar -> ajaxListaExamenInferencial();
}

if(isset($_POST["idExamenLiteral"])){
	$editar = new AjaxExamen();
	$editar -> idExamenLiteral = $_POST["idExamenLiteral"];
	$editar -> ajaxListaExamenLiteral();
}

if(isset($_POST["idExamenDetalle"]) && isset($_POST["tabla"])){
	$editar = new AjaxExamen();
	$editar -> idExamen = $_POST["idExamenDetalle"];
	$editar -> tabla = $_POST["tabla"];
	$editar -> ajaxListaExamenDetalle();
}

if(isset($_POST["idExamenRespuesta"])){
	$editar = new AjaxExamen();
	$editar -> idExamenRespuesta = $_POST["idExamenRespuesta"];
	$editar -> tabla = $_POST["tabla"];
	$editar -> ajaxListaExamenRespuesta();
}

