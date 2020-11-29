<?php 

/**
 * 
 */
class ControladorUsuarios 
{
	
	 static public function ctrIngresoUsuario(){
		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingUsuario'])&&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])){
	
				$encriptar=crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla="usuarios";

				$item="usuario";
				$valor=$_POST["ingUsuario"];
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor);
				
				if($respuesta["usuario"]==$_POST["ingUsuario"] && $respuesta["password"]==$encriptar && $respuesta["perfil"]==$_POST["perfil"]){

					if($respuesta["estado"]==1){

						$_SESSION["iniciarSesion"]="ok";
						$_SESSION["id"]=$respuesta["id"];
						$_SESSION["nombre"]=$respuesta["nombre"];
						$_SESSION["usuario"]=$respuesta["usuario"];
						$_SESSION["foto"]=$respuesta["foto"];
						$_SESSION["perfil"]=$respuesta["perfil"];
					
						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Lima');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							echo '<script>

								window.location = "inicio";

							</script>';

						}
					
				}else{
					echo '<br> <div class="alert alert-danger">El usuario aún no está activado</div>';
				}


				}else
				{
					echo '<br> <div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}

			}

		}
	}



		/* Registro de usuario */

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){

				/*=============================================
				=            Validar imagen           =
				=============================================*/
				

				$ruta="";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){
					var_dump($_FILES["nuevaFoto"]["tmp_name"]); // verificar si el archivo temporal esta enviaando

					//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"])); para tomar medidas 



				//list permite crear un nuevo array con los indices que yo le asigne
				list($ancho,$alto)=getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				$nuevoAncho=500;
				$nuevoAlto=500;
				/* Creamos el directorio donde vamos a guardar la foto del usuario */
				$directorio="vistas/img/usuarios/".$_POST["nuevoUsuario"];
				//crear directorio
				mkdir($directorio,0755);

				/*========================
				=          Guardamos la imagen en el directorio=
				========================*/
				if($_FILES["nuevaFoto"]["type"]=="image/jpeg"){
					/*============================================================
					=            Guardamos la imagen en el directorio          =
					============================================================*/

					$aleatorio=mt_rand(100,999);
					$ruta="vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
					//creamos el nuevo archivo
					$origen=imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
					//manteine el color, pero cambia el tamaño de la imagen
					$destino=imagecreatetruecolor($nuevoAncho,$nuevoAlto);
					//copia y adapta las propiedades
			//-->imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
			
					//copia y adapta las propiedades
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho,$alto);

					//guarda la foto en la ruta que estamos asignando

					imagejpeg($destino,$ruta);
				}

				if($_FILES["nuevaFoto"]["type"]=="image/png"){
					/*============================================================
					=            Guardamos la imagen en el directorio          =
					============================================================*/

					$aleatorio=mt_rand(100,999);
					$ruta="vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
					//creamos el nuevo archivo
					$origen=imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
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
				$nombres = trim($_POST["nuevoApellido"]." ".$_POST["nuevoNombre"]);
				$encriptar=crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("nombre" => $nombres,
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil"=>$_POST["nuevoPerfil"],
					       	   "foto"=>$ruta);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
			
				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm:false

					}).then((result)=>{

						if(result.value){

							window.location = "usuarios";

						}

					});
				</script>';

			}


		}


	}

		

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}
		/*============================================================
		=            Editar usuario          =
		============================================================*/
	static public function ctrEditarUsuario(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

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

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "usuarios";

				if($_POST["editarPassword"] != ""){

					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					}else{

						echo'<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

					}

				}else{

					$encriptar = $_POST["passwordActual"];

				}

				$nombres = trim($_POST["editarApellido"]." ".$_POST["editarNombre"]);

				$datos = array("nombre" => $nombres,
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $encriptar,
							   "perfil" => $_POST["editarPerfil"],
							   "foto" => $ruta);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "usuarios";

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

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}




	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabla ="usuarios";
			$datos = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);

			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}


/*============================================================
		=            Cantidad de técnicos         =
		============================================================*/
		static public function ctrCantidadUsuariosActivos(){

				$tabla="usuarios";
				$respuesta = ModeloUsuarios::MdlCantidadUsuariosActivos($tabla);

				return $respuesta;
			}













}