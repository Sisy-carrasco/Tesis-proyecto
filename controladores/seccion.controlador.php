<?php 
/**
 * 
 */
class ControladorSeccion 
{

		/* Registro de Seccion */

	static public function ctrCrearSeccion(){

		if($_POST["accion"]=="NuevoSeccion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){
				
				$ruta="";

				$tabla = "seccion";

				$datos = array("nombre" => $_POST["nombre"],
								"descripcion" => $_POST["descripcion"],
								"id_grado" => $_POST["idGrado"]);

				$respuesta = ModeloSeccion::mdlIngresarSeccion($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡La seccion ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "seccion";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡La seccion no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "seccion";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR SECCION
	=============================================*/

	static public function ctrMostrarSeccion($item, $valor){

		$tabla = "seccion";

		$respuesta = ModeloSeccion::MdlMostrarSeccion($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar seccion          =
		============================================================*/
	static public function ctrEditarSeccion(){

		if($_POST["accion"]=="EditarSeccion"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$tabla = "seccion";
				$datos = array("nombre" => $_POST["nombre"],"id_grado" => $_POST["idGrado"],"descripcion"=>$_POST["descripcion"],"id_seccion"=>$_POST["idSeccion"]);

				$respuesta = ModeloSeccion::mdlEditarSeccion($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La seccion ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "seccion";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "seccion";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR SECCION
	=============================================*/

	static public function ctrBorrarSeccion(){

		if(isset($_GET["idSeccion"])){

			$tabla ="seccion";
			$datos = $_GET["idSeccion"];

			$respuesta = ModeloSeccion::mdlBorrarSeccion($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La seccion ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "seccion";

								}
							})

				</script>';

			}		

		}

	}












}