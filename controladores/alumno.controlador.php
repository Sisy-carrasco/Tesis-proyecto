<?php 
/**
 * 
 */
class ControladorAlumno 
{

		/* Registro de Alumno */

	static public function ctrCrearAlumno(){

		if($_POST["accion"]=="NuevoAlumno"){

			$profesor = ControladorProfesor::ctrMostrarProfesor("dni", $_POST["dni"]);

			if($profesor!=null){
				echo '<script>

					swal({

						type: "error",
						title: "¡El numero de dni ya fue registrado en un profesor!",
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then(function(result){

						if(result.value){
						
							window.location = "alumno";

						}

					});

					</script>';

				exit();
			}

			$profesor = ControladorAlumno::ctrMostrarAlumno("dni", $_POST["dni"]);

			if($profesor!=null){
				echo '<script>

					swal({

						type: "error",
						title: "¡El numero de dni ya fue registrado en otro alumno!",
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then(function(result){

						if(result.value){
						
							window.location = "alumno";

						}

					});

					</script>';

				exit();
			}

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"])){

				/*=============================================
				=            Validar imagen           =
				=============================================*/
				

				$ruta="";

				if(isset($_FILES["foto"]["tmp_name"]) && $_FILES["foto"]["tmp_name"]!=""){
					var_dump($_FILES["foto"]["tmp_name"]); // verificar si el archivo temporal esta enviaando

					//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"])); para tomar medidas 

					//list permite crear un nuevo array con los indices que yo le asigne
					list($ancho,$alto)=getimagesize($_FILES["foto"]["tmp_name"]);
					$nuevoAncho=500;
					$nuevoAlto=500;
					/* Creamos el directorio donde vamos a guardar la foto del usuario */
					$directorio="vistas/img/usuarios/".$_POST["usuario"];
					//crear directorio
					mkdir($directorio,0755);

					/*========================
					=          Guardamos la imagen en el directorio=
					========================*/
					if($_FILES["foto"]["type"]=="image/jpeg"){
						/*============================================================
						=            Guardamos la imagen en el directorio          =
						============================================================*/

						$aleatorio=mt_rand(100,999);
						$ruta="vistas/img/usuarios/".$_POST["usuario"]."/".$aleatorio.".jpg";
						//creamos el nuevo archivo
						$origen=imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);
						//manteine el color, pero cambia el tamaño de la imagen
						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						//copia y adapta las propiedades
						//-->imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
				
						//copia y adapta las propiedades
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

						//guarda la foto en la ruta que estamos asignando

						imagejpeg($destino,$ruta);
					}

					if($_FILES["foto"]["type"]=="image/png"){
						/*============================================================
						=            Guardamos la imagen en el directorio          =
						============================================================*/

						$aleatorio=mt_rand(100,999);
						$ruta="vistas/img/usuarios/".$_POST["usuario"]."/".$aleatorio.".png";
						//creamos el nuevo archivo
						$origen=imagecreatefrompng($_FILES["foto"]["tmp_name"]);
						//manteine el color, pero cambia el tamaño de la imagen
						$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						//copia y adapta las propiedades
						//-->imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
				
						//copia y adapta las propiedades
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

						//guarda la foto en la ruta que estamos asignando

						imagepng($destino,$ruta);
					}
				}

				$tabla = "usuarios";
				$encriptar=crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $nombres = trim($_POST["apellidos"]." ".$_POST["nombres"]);
				
				$datos = array("nombre" => $nombres,
					           "usuario" => $_POST["usuario"],
					           "password" => $encriptar,
					           "perfil"=>"Alumno",
					       	   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				$tabla = "usuarios";

				$resp = ModeloUsuarios::MdlMostrarUsuarios($tabla, "nombre", $nombres);
				
				$id_usuario = $resp["id"];

				$tabla = "alumno";

				$datos = array("nombres_completos" => $nombres,"dni"=>$_POST["dni"],"direccion"=>$_POST["direccion"],"fecha_nacimiento"=>$_POST["fecha_nacimiento"],
							"sexo"=>$_POST["sexo"],"foto"=>$ruta,"id_usuario"=>$id_usuario);

				$respuesta = ModeloAlumno::mdlIngresarAlumno($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El alumno ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "alumno";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡EL alumno no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "alumno";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR ALUMNO
	=============================================*/

	static public function ctrMostrarAlumno($item, $valor){

		$tabla = "alumno";

		$respuesta = ModeloAlumno::MdlMostrarAlumno($tabla, $item, $valor);

		return $respuesta;
	}
	/*============================================================
	=            Editar alumno          =
	============================================================*/
	static public function ctrEditarAlumno(){

		if($_POST["accion"]=="EditarAlumno"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombres"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["foto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["usuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["foto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["usuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["foto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["usuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["foto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "alumno";

				$nombres = trim($_POST["apellidos"]." ".$_POST["nombres"]);

				$datos = array("nombres_completos" => $nombres,"dni"=>$_POST["dni"],"direccion"=>$_POST["direccion"],"fecha_nacimiento"=>$_POST["fecha_nacimiento"],
							"sexo"=>$_POST["sexo"],"foto"=>$ruta,"id_alumno" => $_POST["idAlumno"]);

				$respuesta = ModeloAlumno::mdlEditarAlumno($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El alumno ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "alumno";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Alumno no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "alumno";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR ALUMNO
	=============================================*/

	static public function ctrBorrarAlumno(){

		if(isset($_GET["idAlumno"])){

			$tabla ="alumno";
			$datos = $_GET["idAlumno"];

			$respuesta = ModeloAlumno::mdlBorrarAlumno($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El alumno ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "alumno";

								}
							})

				</script>';

			}		

		}

	}












}