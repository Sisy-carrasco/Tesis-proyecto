<?php 
/**
 * 
 */
class ControladorCurso 
{

		/* Registro de Curso */

	static public function ctrCrearCurso(){

		if($_POST["accion"]=="NuevoCurso"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

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
					$directorio="vistas/img/curso/".$_POST["usuario"];
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
						$ruta="vistas/img/curso/".$_POST["usuario"]."/".$aleatorio.".jpg";
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
						$ruta="vistas/img/curso/".$_POST["usuario"]."/".$aleatorio.".png";
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

				$tabla = "curso";

				$datos = array("nombre" => $_POST["nombre"],"descripcion"=>$_POST["descripcion"],"id_grado"=>$_POST["idGrado"],"foto"=>$ruta);

				$respuesta = ModeloCurso::mdlIngresarCurso($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El curso ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "curso";

						}

					});

					</script>';


				}	

			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El curso no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "curso";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR Curso
	=============================================*/

	static public function ctrMostrarCurso($item, $valor){

		$tabla = "curso";

		$respuesta = ModeloCurso::MdlMostrarCurso($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar curso          =
		============================================================*/
	static public function ctrEditarCurso(){

		if($_POST["accion"]=="EditarCurso"){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])){

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["foto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/curso/".$_POST["usuario"];

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

						$ruta = "vistas/img/curso/".$_POST["usuario"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/curso/".$_POST["usuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["foto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "curso";
				$datos = array("nombre" => $_POST["nombre"],"descripcion"=>$_POST["descripcion"],"id_grado"=>$_POST["idGrado"],"foto"=>$ruta,"id_curso" => $_POST["idCurso"]);

				$respuesta = ModeloCurso::mdlEditarCurso($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El curso ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "curso";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El curso no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "curso";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR Curso
	=============================================*/

	static public function ctrBorrarCurso(){

		if(isset($_GET["idCurso"])){

			$tabla ="curso";
			$datos = $_GET["idCurso"];

			$respuesta = ModeloCurso::mdlBorrarCurso($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El curso ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "curso";

								}
							})

				</script>';

			}		

		}

	}












}