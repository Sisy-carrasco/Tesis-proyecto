<?php 
/**
 * 
 */
class ControladorSesion 
{

		/* Registro de Sesion */

	static public function ctrCrearSesion(){

		if($_POST["accion"]=="NuevoSesion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$ruta="";

				$resp = ModeloProfesor::MdlMostrarProfesor("profesor", "id_usuario", $_SESSION["id"]);
				
				$id_profesor = $resp["id_profesor"];

				$tabla = "sesion";

				$datos = array("descripcion" => $_POST["descripcion"],"id_unidad"=>$_POST["idUnidad"],"competencias"=>$_POST["competencias"],"capacidades"=>$_POST["capacidades"],
								"intervalo_puntaje_capacidades"=>$_POST["intervalo_puntaje_capacidades"],"numero"=>$_POST["numero"],"duracion"=>$_POST["duracion"],"id_profesor"=>$id_profesor);

				$respuesta = ModeloSesion::mdlIngresarSesion($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La sesion ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "sesion";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El lectura no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "lectura";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR SESION
	=============================================*/

	static public function ctrMostrarSesion($item, $valor){

		$tabla = "sesion";

		$respuesta = ModeloSesion::MdlMostrarSesion($tabla, $item, $valor);

		return $respuesta;
	}
	static public function ctrMostrarSesion3($item, $valor){

		$tabla = "sesion";

		$respuesta = ModeloSesion::MdlMostrarSesion3($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarSesion2($item, $valor){

		$tabla = "sesion";

		$respuesta = ModeloSesion::MdlMostrarSesion2($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar sesion          =
		============================================================*/
	static public function ctrEditarSesion(){

		if($_POST["accion"]=="EditarSesion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"])){

				$resp = ModeloProfesor::MdlMostrarProfesor("profesor", "id_usuario", $_SESSION["id"]);
				
				$id_profesor = $resp["id_profesor"];

				$tabla = "sesion";
				$datos = array("descripcion" => $_POST["descripcion"],"id_unidad"=>$_POST["idUnidad"],"competencias"=>$_POST["competencias"],"capacidades"=>$_POST["capacidades"],
				"intervalo_puntaje_capacidades"=>$_POST["intervalo_puntaje_capacidades"],"numero"=>$_POST["numero"],"duracion"=>$_POST["duracion"],"id_profesor"=>$id_profesor,"id_sesion" => $_POST["idSesion"]);

				$respuesta = ModeloSesion::mdlEditarSesion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La sesion ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sesion";

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

							window.location = "sesion";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR SESION
	=============================================*/

	static public function ctrBorrarSesion(){

		if(isset($_GET["idSesion"])){

			$tabla ="sesion";
			$datos = $_GET["idSesion"];

			$respuesta = ModeloSesion::mdlBorrarSesion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La sesion ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "sesion";

								}
							})

				</script>';

			}		

		}

	}












}