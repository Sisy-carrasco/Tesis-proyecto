<?php 
/**
 * 
 */
class ControladorMatricula 
{

		/* Registro de Matricula */

	static public function ctrCrearMatricula(){

		if($_POST["accion"]=="NuevoMatricula"){

			$matricula = ControladorMatricula::ctrMostrarMatricula("id_alumno", $_POST["idAlumno"]);//print_r($matricula);exit();

			if(isset($matricula["id_alumno"])){

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El alumno ya esta matriculado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "matricula";

							}
						})

				  </script>';
				
				exit();

			}

			$ruta="";

			$tabla = "matricula";

			$datos = array("id_alumno" => $_POST["idAlumno"],"id_seccion"=>$_POST["idSeccion"],"id_curso"=>$_POST["idCurso"],"id_profesor"=>$_POST["idProfesor"]);

			$respuesta = ModeloMatricula::mdlIngresarMatricula($tabla, $datos);
		
			if($respuesta == "ok"){

				

				echo '<script>

				swal({

					type: "success",
					title: "¡La matricula ha sido guardado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "matricula";

					}

				});

				</script>';


			}	


		}


	}

	static public function ctrCrearDetalleMatricula(){

		if($_POST["accion"]=="NuevoAsignacionMatricula"){

			$matricula = ControladorMatricula::ctrMostrarDetalleMatricula("id_seccion", $_POST["idSeccion"]);//print_r($matricula);exit();

			if(isset($matricula["id_profesor"])){

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La seccion ya tiene asignado un docente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "asignacionmatricula";

							}
						})

				  </script>';
				
				exit();

			}

			$ruta="";

			$tabla = "detalle_matricula";

			$datos = array("id_seccion"=>$_POST["idSeccion"],"id_curso"=>0,"id_profesor"=>$_POST["idProfesor"]);

			$respuesta = ModeloDetalleMatricula::mdlIngresarDetalleMatricula($tabla, $datos);//die();
		
			if($respuesta == "ok"){

				

				echo '<script>

				swal({

					type: "success",
					title: "¡La asignacion docente ha sido guardado correctamente!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "asignacionmatricula";

					}

				});

				</script>';


			}	


		}


	}	

	/*=============================================
	MOSTRAR MATRICULA
	=============================================*/

	static public function ctrMostrarMatricula($item, $valor){

		$tabla = "matricula";

		$respuesta = ModeloMatricula::MdlMostrarMatricula($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarDetalleMatricula($item, $valor){

		$tabla = "detalle_matricula";

		$respuesta = ModeloDetalleMatricula::MdlMostrarDetalleMatricula($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar matricula         =
		============================================================*/
	static public function ctrEditarMatricula(){

		if($_POST["accion"]=="EditarMatricula"){


			$tabla = "matricula";
			$datos = array("id_alumno" => $_POST["idAlumno"],"id_seccion"=>$_POST["idSeccion"],"id_curso"=>$_POST["idCurso"],"id_profesor"=>$_POST["idProfesor"],"id_matricula" => $_POST["idMatricula"]);

			$respuesta = ModeloMatricula::mdlEditarMatricula($tabla, $datos);//print_r($respuesta);die();

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La matricula ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "matricula";

								}
							})

				</script>';

			}

		}

	}

	static public function ctrEditarDetalleMatricula(){

		if($_POST["accion"]=="EditarDetalleMatricula"){


			$tabla = "detalle_matricula";
			$datos = array("id_seccion"=>$_POST["idSeccion"],"id_curso"=>0,"id_profesor"=>$_POST["idProfesor"],"id_detalle_matricula" => $_POST["idDetalleMatricula"]);

			$respuesta = ModeloDetalleMatricula::mdlEditarDetalleMatricula($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
						type: "success",
						title: "La asignacion docente ha sido editado correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
								if (result.value) {

								window.location = "asignacionmatricula";

								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	BORRAR MATRICULA
	=============================================*/

	static public function ctrBorrarMatricula(){

		if(isset($_GET["idMatricula"])){

			$tabla ="matricula";
			$datos = $_GET["idMatricula"];

			$respuesta = ModeloMatricula::mdlBorrarMatricula($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La matricula ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "matricula";

								}
							})

				</script>';

			}		

		}

	}

	static public function ctrBorrarDetalleMatricula(){

		if(isset($_GET["idDetalleMatricula"])){

			$tabla ="detalle_matricula";
			$datos = $_GET["idDetalleMatricula"];

			$respuesta = ModeloDetalleMatricula::mdlBorrarDetalleMatricula($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La asignacion matricula ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "asignacionmatricula";

								}
							})

				</script>';

			}		

		}

	}












}