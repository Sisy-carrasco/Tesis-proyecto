<?php 
/**
 * 
 */
class ControladorExamen 
{

		/* Registro de Examen */

	static public function ctrCrearExamen(){

		if($_POST["accion"]=="NuevoExamen"){

			$tabla = "examen";

			$datos = array("nombre"=>$_POST["nombre"],"id_curso" => $_POST["idCurso"],"id_lectura"=>$_POST["idLectura"],"fecha_inicio"=>$_POST["fecha_inicio"],"fecha_fin"=>$_POST["fecha_fin"],"tiempo"=>$_POST["tiempo"],"id_seccion"=>$_POST["idSeccion"]);

			$respuesta = ModeloExamen::mdlIngresarExamen($tabla, $datos);
		
			if($respuesta == "ok"){

				$tabla = "examen";

				$resp = ModeloExamen::MdlMostrarExamen($tabla, "nombre", $_POST["nombre"]);

				$id_examen = $resp["id_examen"];
				

				$tabla = "examen_critico";

				$datos = array("id_examen"=>$id_examen,"id_nivel_critico"=>$_POST["idNivelCritico"],"id_sesion"=>$_POST["idSesionCritico"]);

				$respuesta = ModeloExamenCritico::mdlIngresarExamenCritico($tabla, $datos);

				$resp = ModeloExamenCritico::MdlMostrarExamenCritico($tabla, "id_examen", $id_examen);
				
				$id_examen_critico = $resp["id_examen_critico"];
				

				$list = explode(",",$_POST["txtListaCritico"]);
				for($x=0;$x<count($list);$x++){
					$tabla = "preguntas_criticas";

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_critico"=>$id_examen_critico,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]]);
					
					$respuesta = ModeloPreguntasCriticas::mdlIngresarPreguntasCriticas($tabla, $datos);

					$resp = ModeloPreguntasCriticas::mdlMostrarPreguntasCriticas($tabla, "nombre", $_POST["txtNombre".$list[$x]]);
					
					$id_pregunta = $resp["id_preguntas_criticas"];
					

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$datos = array("id_preguntas_criticas"=>$id_pregunta,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]]);

						$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$datos = array("id_preguntas_criticas"=>$id_pregunta,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"");

							$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}

				$tabla = "examen_inferencial";

				$datos = array("id_examen"=>$id_examen,"id_nivel_inferencial"=>$_POST["idNivelInferencial"],"id_sesion"=>$_POST["idSesionInferencial"]);

				$respuesta = ModeloExamenInferencial::mdlIngresarExamenInferencial($tabla, $datos);

				$resp = ModeloExamenInferencial::MdlMostrarExamenInferencial($tabla, "id_examen", $id_examen);
				
				$id_examen_inferencial = $resp["id_examen_inferencial"];
				

				$list = explode(",",$_POST["txtListaInferencial"]);
				for($x=0;$x<count($list);$x++){
					$tabla = "preguntas_inferenciales";

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_inferencial"=>$id_examen_inferencial,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]]);
					
					$respuesta = ModeloPreguntasInferenciales::mdlIngresarPreguntasInferenciales($tabla, $datos);

					$resp = ModeloPreguntasInferenciales::mdlMostrarPreguntasInferenciales($tabla, "nombre", $_POST["txtNombre".$list[$x]]);
					
					$id_pregunta = $resp["id_preguntas_inferenciales"];
					

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$id_pregunta,"id_preguntas_literales"=>0,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]]);

						$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$id_pregunta,"id_preguntas_literales"=>0,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"");

							$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}

				$tabla = "examen_literal";

				$datos = array("id_examen"=>$id_examen,"id_nivel_literal"=>$_POST["idNivelLiteral"],"id_sesion"=>$_POST["idSesionLiteral"]);

				$respuesta = ModeloExamenLiteral::mdlIngresarExamenLiteral($tabla, $datos);

				$resp = ModeloExamenLiteral::MdlMostrarExamenLiteral($tabla, "id_examen", $id_examen);
				
				$id_examen_literal = $resp["id_examen_literal"];

				$list = explode(",",$_POST["txtListaLiteral"]);
				for($x=0;$x<count($list);$x++){
					$tabla = "preguntas_literales";

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_literal"=>$id_examen_literal,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]]);
					
					$respuesta = ModeloPreguntasLiterales::mdlIngresarPreguntasLiterales($tabla, $datos);

					$resp = ModeloPreguntasLiterales::mdlMostrarPreguntasLiterales($tabla, "nombre", $_POST["txtNombre".$list[$x]]);
				
					$id_pregunta = $resp["id_preguntas_literales"];

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$id_pregunta,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]]);

						$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$id_pregunta,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"");

							$respuesta = ModeloPreguntaOpcion::mdlIngresarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}

				//die();

				echo '<script>

				swal({

					type: "success",
					title: "¡El examen ha sido guardado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "examen";

					}

				});

				</script>';


			}	


		}


	}

		

	/*=============================================
	MOSTRAR EXAMEN
	=============================================*/

	static public function ctrMostrarExamen($item, $valor){

		$tabla = "examen";

		$respuesta = ModeloExamen::MdlMostrarExamen($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarExamen2($item, $valor){

		$tabla = "examen";

		$respuesta = ModeloExamen::MdlMostrarExamen($tabla, null, null);

		foreach($respuesta as $k=>$v){
			if($v["id_examen"]==$valor){
				require_once "../modelos/examen_critico.modelo.php";
				require_once "../modelos/examen_inferencial.modelo.php";
				require_once "../modelos/examen_literal.modelo.php";
				$examencritico = ModeloExamenCritico::MdlMostrarExamenCritico("examen_critico","id_examen",$valor);
				$exameninferencial = ModeloExamenInferencial::MdlMostrarExamenInferencial("examen_inferencial","id_examen",$valor);
				$examenliteral = ModeloExamenLiteral::MdlMostrarExamenLiteral("examen_literal","id_examen",$valor);
				$res = array("id_examen"=>$valor,"nombre"=>$v["nombre"],"fecha_inicio"=>substr(str_replace(" ","T",$v["fecha_inicio"]),0,16),"fecha_fin"=>substr(str_replace(" ","T",$v["fecha_fin"]),0,16),"tiempo"=>$v["tiempo"],
							"id_unidad"=>$v["id_unidad"],"id_seccion"=>$v["id_seccion"],"id_grado"=>$v["id_grado"],"id_curso"=>$v["id_curso"],"id_tema"=>$v["id_tema"],"id_lectura"=>$v["id_lectura"],
							"id_nivel_critico"=>$examencritico["id_nivel_critico"],"id_sesion_critico"=>$examencritico["id_sesion"],
							"id_nivel_inferencial"=>$exameninferencial["id_nivel_inferencial"],"id_sesion_inferencial"=>$exameninferencial["id_sesion"],
							"id_nivel_literal"=>$examenliteral["id_nivel_literal"],"id_sesion_literal"=>$examenliteral["id_sesion"]);
			}
		}

		return $res;
	}

	static public function ctrMostrarExamenAlumno($idusuarioalumno){

		$tabla = "examen";

		$respuesta = ModeloExamen::MdlMostrarExamenAlumno($idusuarioalumno);

		return $respuesta;
	}

	static public function ctrMostrarExamenCriticoAlumno($idexamen,$limit="3"){

		$respuesta = ModeloExamen::MdlMostrarExamenCriticoAlumno($idexamen,$limit);

		return $respuesta;
	}

	static public function ctrMostrarExamenInferencialAlumno($idexamen,$limit="3"){

		$respuesta = ModeloExamen::MdlMostrarExamenInferencialAlumno($idexamen,$limit);

		return $respuesta;
	}

	static public function ctrMostrarExamenLiteralAlumno($idexamen,$limit="3"){

		$respuesta = ModeloExamen::MdlMostrarExamenLiteralAlumno($idexamen,$limit);

		return $respuesta;
	}

	static public function ctrMostrarExamenCriticoRespuestaAlumno($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenCriticoRespuestaAlumno($idexamen);

		return $respuesta;
	}

	static public function ctrMostrarExamenInferencialRespuestaAlumno($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenInferencialRespuestaAlumno($idexamen);

		return $respuesta;
	}

	static public function ctrMostrarExamenLiteralRespuestaAlumno($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenLiteralRespuestaAlumno($idexamen);

		return $respuesta;
	}

	static public function ctrMostrarExamenCritico($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenCritico($idexamen);

		return $respuesta;
	}

	static public function ctrMostrarExamenInferencial($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenInferencial($idexamen);

		return $respuesta;
	}

	static public function ctrMostrarExamenLiteral($idexamen){

		$respuesta = ModeloExamen::MdlMostrarExamenLiteral($idexamen);

		return $respuesta;
	}
		/*============================================================
		=            Editar examen         =
		============================================================*/
	static public function ctrEditarExamen(){

		if($_POST["accion"]=="EditarExamen"){

			$id_examen=$_POST["idExamen"];
			$tabla = "examen";
			$datos = array("nombre"=>$_POST["nombre"],"id_curso" => $_POST["idCurso"],"id_lectura"=>$_POST["idLectura"],"fecha_inicio"=>$_POST["fecha_inicio"],"fecha_fin"=>$_POST["fecha_fin"],"tiempo"=>$_POST["tiempo"],"id_seccion"=>$_POST["idSeccion"],"id_examen"=>$_POST["idExamen"]);

			$respuesta = ModeloExamen::mdlEditarExamen($tabla, $datos);

			if($respuesta == "ok"){				

				$tabla = "examen_critico";

				$datos = array("id_examen"=>$id_examen,"id_nivel_critico"=>$_POST["idNivelCritico"],"id_sesion"=>$_POST["idSesionCritico"]);

				$respuesta = ModeloExamenCritico::mdlEditarExamenCritico($tabla, $datos);

				$resp = ModeloExamenCritico::MdlMostrarExamenCritico($tabla, "id_examen", $id_examen);
				
				$id_examen_critico = $resp["id_examen_critico"];//print_r($respuesta);exit();
				

				$list = explode(",",$_POST["txtListaCritico"]);
				for($x=0;$x<count($list);$x++){

					$tabla = "preguntas_criticas";
					
					$id_pregunta = $_POST["txtIdPregunta".$list[$x]];

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_critico"=>$id_examen_critico,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]],"id_preguntas_criticas"=>$id_pregunta);
					
					$respuesta = ModeloPreguntasCriticas::mdlEditarPreguntasCriticas($tabla, $datos);

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$id_pregunta_opcion = $_POST["txtIdOpcion".$list[$x]];

						$datos = array("id_preguntas_criticas"=>$id_pregunta,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]],"id_pregunta_opcion"=>$id_pregunta_opcion);

						$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$id_pregunta_opcion = $_POST["txtIdOpcion".$list2[$z]];

							$datos = array("id_preguntas_criticas"=>$id_pregunta,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"","id_pregunta_opcion"=>$id_pregunta_opcion);

							$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}

				$tabla = "examen_inferencial";

				$datos = array("id_examen"=>$id_examen,"id_nivel_inferencial"=>$_POST["idNivelInferencial"],"id_sesion"=>$_POST["idSesionInferencial"]);

				$respuesta = ModeloExamenInferencial::mdlEditarExamenInferencial($tabla, $datos);//print_r($respuesta);exit();

				$resp = ModeloExamenInferencial::MdlMostrarExamenInferencial($tabla, "id_examen", $id_examen);
				
				$id_examen_inferencial = $resp["id_examen_inferencial"];
				

				$list = explode(",",$_POST["txtListaInferencial"]);
				for($x=0;$x<count($list);$x++){
					$tabla = "preguntas_inferenciales";

					$id_pregunta = $_POST["txtIdPregunta".$list[$x]];

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_inferencial"=>$id_examen_inferencial,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]],"id_preguntas_inferenciales"=>$id_pregunta);
					
					$respuesta = ModeloPreguntasInferenciales::mdlEditarPreguntasInferenciales($tabla, $datos);

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$id_pregunta_opcion = $_POST["txtIdOpcion".$list[$x]];

						$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$id_pregunta,"id_preguntas_literales"=>0,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]],"id_pregunta_opcion"=>$id_pregunta_opcion);

						$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$id_pregunta_opcion = $_POST["txtIdOpcion".$list2[$z]];

							$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$id_pregunta,"id_preguntas_literales"=>0,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"","id_pregunta_opcion"=>$id_pregunta_opcion);

							$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}

				$tabla = "examen_literal";

				$datos = array("id_examen"=>$id_examen,"id_nivel_literal"=>$_POST["idNivelLiteral"],"id_sesion"=>$_POST["idSesionLiteral"]);

				$respuesta = ModeloExamenLiteral::mdlEditarExamenLiteral($tabla, $datos);

				$resp = ModeloExamenLiteral::MdlMostrarExamenLiteral($tabla, "id_examen", $id_examen);
				
				$id_examen_literal = $resp["id_examen_literal"];

				$list = explode(",",$_POST["txtListaLiteral"]);
				for($x=0;$x<count($list);$x++){
					$tabla = "preguntas_literales";

					$id_pregunta = $_POST["txtIdPregunta".$list[$x]];

					$datos = array("id_tipo_pregunta"=>$_POST["cboTipoPregunta".$list[$x]],"id_examen_literal"=>$id_examen_literal,"nombre"=>$_POST["txtNombre".$list[$x]],"descripcion"=>$_POST["txtDescripcion".$list[$x]],"puntaje"=>$_POST["txtPuntaje".$list[$x]],"id_preguntas_literales"=>$id_pregunta);
					
					$respuesta = ModeloPreguntasLiterales::mdlEditarPreguntasLiterales($tabla, $datos);
				
					$id_pregunta = $_POST["txtIdPregunta".$list[$x]];

					if($_POST["cboTipoPregunta".$list[$x]]=="3"){//RESPUESTA LIBRE

						$tabla = "pregunta_opcion";

						$id_pregunta_opcion = $_POST["txtIdOpcion".$list[$x]];

						$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$id_pregunta,"descripcion"=>"","indicador_correcto"=>'SI',"retroalimentacion"=>"","palabras_clave"=>$_POST["txtLibre".$list[$x]],"id_pregunta_opcion"=>$id_pregunta_opcion);

						$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

					}else{

						$tabla = "pregunta_opcion";

						$list2 = explode(",",$_POST["txtListaOpcion".$list[$x]]);

						for($z=0;$z<count($list2);$z++){

							if($_POST["txtOpcionCorrecto".$list[$x]]==$list2[$z]){
								$correcto = "SI";
							}else{
								$correcto = "NO";
							}

							$id_pregunta_opcion = $_POST["txtIdOpcion".$list2[$z]];

							$datos = array("id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$id_pregunta,"descripcion"=>$_POST["txtOpcion".$list2[$z]],"indicador_correcto"=>$correcto,"retroalimentacion"=>"","palabras_clave"=>"","id_pregunta_opcion"=>$id_pregunta_opcion);

							$respuesta = ModeloPreguntaOpcion::mdlEditarPreguntaOpcion($tabla, $datos);

						}
					}
	
				}


				echo'<script>

				swal({
						type: "success",
						title: "El examen ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "examen";

								}
							})

				</script>';

			}

		}

	}




	/*=============================================
	BORRAR EXAMEN
	=============================================*/

	static public function ctrBorrarExamen(){

		if(isset($_GET["idExamen"])){

			$tabla ="examen";
			$datos = $_GET["idExamen"];

			$respuesta = ModeloExamen::mdlBorrarExamen($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La examen ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "examen";

								}
							})

				</script>';

			}		

		}

	}

	static public function ctrResolverExamenCritico(){

		if($_POST["accion"]=="ResolverCritico"){

			$idexamen = $_POST["idExamen"];
			$curso = ControladorExamen::ctrMostrarExamenCriticoAlumno($idexamen,100);
			$tiempo = strtotime('now') - $_SESSION["inicial"];

			foreach($curso as $k=>$v){
				if(isset($_POST["txtRespuesta".$v["id_pregunta"]]) || isset($_POST["txtOpcionPregunta".$v["id_pregunta"]])){
					if($v["id_tipo_pregunta"]=="3"){
						$tabla = "respuesta";
						$busqueda = ControladorExamen::strpos_array(strtoupper(trim($_POST["txtRespuesta".$v["id_pregunta"]])),explode( ",",strtoupper(str_replace("\n",",",$v["palabras_claves"])) ));
						if(trim($busqueda)!="" && $busqueda>=0){
							$puntaje=$v["puntaje"];
						}else{
							$puntaje=0;
						}
						
						$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>$v["id_pregunta"],"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"opcion"=>$_POST["txtRespuesta".$v["id_pregunta"]],"id_pregunta_opcion"=>0,"puntaje"=>$puntaje,"tiempo"=>$tiempo);
						$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);
					}else{
						if($_POST["txtOpcionPregunta".$v["id_pregunta"]]==$v["id_pregunta_opcion"]){
							$tabla = "respuesta";
							if(trim($v["indicador_correcto"])=="SI"){
								$puntaje=$v["puntaje"];
							}else{
								$puntaje=0;
							}
							$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>$v["id_pregunta"],"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>0,"opcion"=>"","id_pregunta_opcion"=>$v["id_pregunta_opcion"],"puntaje"=>$puntaje,"tiempo"=>$tiempo);
							$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);
						}
					}
				}
			}

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "El examen critico ha sido registrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "examenalumno";

								}
							})

				</script>';

			}

		}

	}

	static public function ctrResolverExamenInferencial(){

		if($_POST["accion"]=="ResolverInferencial"){

			$idexamen = $_POST["idExamen"];
			$curso = ControladorExamen::ctrMostrarExamenInferencialAlumno($idexamen,100);

			$tiempo = strtotime('now') - $_SESSION["inicial"];

			foreach($curso as $k=>$v){
				if(isset($_POST["txtRespuesta".$v["id_pregunta"]]) || isset($_POST["txtOpcionPregunta".$v["id_pregunta"]])){
					if($v["id_tipo_pregunta"]=="3"){
						$tabla = "respuesta";
						$busqueda = ControladorExamen::strpos_array(strtoupper(trim($_POST["txtRespuesta".$v["id_pregunta"]])),explode( ",",strtoupper(str_replace("\n",",",$v["palabras_claves"])) ));
						if(trim($busqueda)!="" && $busqueda>=0){
							$puntaje=$v["puntaje"];
						}else{
							$puntaje=0;
						}
						
						$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$v["id_pregunta"],"id_preguntas_literales"=>0,"opcion"=>$_POST["txtRespuesta".$v["id_pregunta"]],"id_pregunta_opcion"=>0,"puntaje"=>$puntaje,"tiempo"=>$tiempo);
						$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);
					}else{
						if($_POST["txtOpcionPregunta".$v["id_pregunta"]]==$v["id_pregunta_opcion"]){
							$tabla = "respuesta";
							if(trim($v["indicador_correcto"])=="SI"){
								$puntaje=$v["puntaje"];
							}else{
								$puntaje=0;
							}
							$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>$v["id_pregunta"],"id_preguntas_literales"=>0,"opcion"=>"","id_pregunta_opcion"=>$v["id_pregunta_opcion"],"puntaje"=>$puntaje);
							$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);
						}
					}
				}
			}

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "El examen inferencial ha sido registrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "examenalumno";

								}
							})

				</script>';

			}

		}

	}

	static public function ctrResolverExamenLiteral(){

		if($_POST["accion"]=="ResolverLiteral"){

			$idexamen = $_POST["idExamen"];
			$curso = ControladorExamen::ctrMostrarExamenLiteralAlumno($idexamen,"100");

			$tiempo = strtotime('now') - $_SESSION["inicial"];

			foreach($curso as $k=>$v){
				if(isset($_POST["txtRespuesta".$v["id_pregunta"]]) || isset($_POST["txtOpcionPregunta".$v["id_pregunta"]])){
					if($v["id_tipo_pregunta"]=="3"){
						$tabla = "respuesta";
						//if(strpos(strtoupper(str_replace("\n",",",$v["palabras_claves"])),strtoupper(trim($_POST["txtRespuesta".$v["id_pregunta"]])))===false){
						$busqueda = ControladorExamen::strpos_array(strtoupper(trim($_POST["txtRespuesta".$v["id_pregunta"]])),explode( ",",strtoupper(str_replace("\n",",",trim($v["palabras_claves"]))) ));
						//print_r($v);
						if(strlen(trim($busqueda))>0 && $busqueda>=0){
							$puntaje=$v["puntaje"];
						}else{
							$puntaje=0;
						}
						$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$v["id_pregunta"],"opcion"=>$_POST["txtRespuesta".$v["id_pregunta"]],"id_pregunta_opcion"=>0,"puntaje"=>$puntaje,"tiempo"=>$tiempo);
						$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);//echo $respuesta;
					}else{
						if($_POST["txtOpcionPregunta".$v["id_pregunta"]]==$v["id_pregunta_opcion"]){
							$tabla = "respuesta";
							if(trim($v["indicador_correcto"])=="SI"){
								$puntaje=$v["puntaje"];
							}else{
								$puntaje=0;
							}
							$datos = array("id_detalle_matricula"=>$v["id_detalle_matricula"],"id_preguntas_criticas"=>0,"id_preguntas_inferenciales"=>0,"id_preguntas_literales"=>$v["id_pregunta"],"opcion"=>"","id_pregunta_opcion"=>$v["id_pregunta_opcion"],"puntaje"=>$puntaje,"tiempo"=>$tiempo);
							$respuesta = ModeloRespuesta::mdlIngresarRespuesta($tabla, $datos);//echo $respuesta;
						}
					}
				}
			}

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "El examen literal ha sido registrado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "examenalumno";

								}
							})

				</script>';

			}

		}

	}

	public function strpos_array($haystack, $needles) {
		if ( is_array($needles) ) {
			foreach ($needles as $str) {
				if ( is_array($str) ) {
					$pos = strpos_array($haystack, $str);
				} else {
					$pos = strpos($haystack, trim($str));
				}
				if ($pos !== FALSE) {
					return $pos;
				}
			}
		} else {
			return strpos($haystack, $needles);
		}
	}

	static public function ctrReiniciarExamen(){

		if($_POST["accion"]=="ReiniciarExamen"){

			$idexamen = $_POST["idExamen"];
			$tabla = $_POST["tabla"];
			$respuesta = ModeloRespuesta::mdlReiniciarRespuesta($idexamen,$tabla);
			
			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "El examen '.$tabla.' ha sido reiniciado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "'.($_POST["modo"]=="Alumno"?'examenalumno':'examenresueltoalumno').'";

								}
							})

				</script>';

			}

		}

	}








}