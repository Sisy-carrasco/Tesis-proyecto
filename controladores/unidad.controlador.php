<?php 
/**
 * 
 */
class ControladorUnidad 
{

		/* Registro de Unidad */

	static public function ctrCrearUnidad(){

		if($_POST["accion"]=="NuevoUnidad"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$resp = ModeloProfesor::MdlMostrarProfesor("profesor", "id_usuario", $_SESSION["id"]);
				
				$id_profesor = $resp["id_profesor"];

				$tabla = "unidad";

				$datos = array("descripcion" => $_POST["descripcion"],"competencias"=>$_POST["competencias"],"capacidades"=>$_POST["capacidades"],"numero"=>$_POST["numero"],"duracion"=>$_POST["duracion"],"semestre"=>$_POST["semestre"],"id_profesor"=>$id_profesor);

				$respuesta = ModeloUnidad::mdlIngresarUnidad($tabla, $datos);
			
				if($respuesta == "ok"){

					$tabla = "unidad";

					$resp = ModeloUnidad::MdlMostrarUnidad($tabla, "descripcion", $_POST["descripcion"]);
					foreach ($resp as $key => $value){
						$id_unidad = $value["id_unidad"];
					}

					$tabla = "tema";

					$datos = array("nombre" => $_POST["tema"],"id_unidad" => $id_unidad);

					$respuesta = ModeloTema::mdlIngresarTema($tabla, $datos);

					echo '<script>

					swal({

						type: "success",
						title: "¡La Unidad ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "unidad";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡La Unidad no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "unidad";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR UNIDAD
	=============================================*/

	static public function ctrMostrarUnidad($item, $valor){

		$tabla = "unidad";

		$respuesta = ModeloUnidad::MdlMostrarUnidad($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarUnidad2($item, $valor){

		$tabla = "unidad";

		$respuesta = ModeloUnidad::MdlMostrarUnidad2($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarCapacidades($item, $valor){

		$tabla = "capacidades";

		$respuesta = ModeloUnidad::MdlMostrarGeneral($tabla);

		return $respuesta;
	}

	static public function ctrMostrarBimestre($item, $valor){

		$tabla = "bimestre";

		$respuesta = ModeloUnidad::MdlMostrarGeneral($tabla);

		return $respuesta;
	}
		/*============================================================
		=            Editar unidad          =
		============================================================*/
	static public function ctrEditarUnidad(){

		if($_POST["accion"]=="EditarUnidad"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$resp = ModeloProfesor::MdlMostrarProfesor("profesor", "id_usuario", $_SESSION["id"]);
				
				$id_profesor = $resp["id_profesor"];

				$tabla = "unidad";
				$datos = array("descripcion" => $_POST["descripcion"],"competencias"=>$_POST["competencias"],"capacidades"=>$_POST["capacidades"],"numero"=>$_POST["numero"],"duracion"=>$_POST["duracion"],"semestre"=>$_POST["semestre"],"id_profesor"=>$id_profesor,"id_unidad" => $_POST["idUnidad"]);

				$respuesta = ModeloUnidad::mdlEditarUnidad($tabla, $datos);

				if($respuesta == "ok"){

					$tabla = "tema";
					$datos = array("nombre" => $_POST["tema"],"id_unidad" => $_POST["idUnidad"],"id_tema" => $_POST["idTema"]);

					$respuesta = ModeloTema::mdlEditarTema($tabla, $datos);

					echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidad";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La descripcion no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "unidad";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR UNIDAD
	=============================================*/

	static public function ctrBorrarUnidad(){

		if(isset($_GET["idUnidad"])){

			$tabla ="unidad";
			$datos = $_GET["idUnidad"];

			$respuesta = ModeloUnidad::mdlBorrarUnidad($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Unidad ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "unidad";

								}
							})

				</script>';

			}		

		}

	}












}