<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloSeccion 
{
	
	/*=============================================
	MOSTRAR
	=============================================*/

	static public function mdlMostrarSeccion($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,(select nombre from grado where id_grado=seccion.id_grado) as grado FROM $tabla WHERE $item = :$item and estado=1 order by nombre asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,(select grado.nombre from grado where grado.id_grado=seccion.id_grado) as grado FROM $tabla where estado=1 order by nombre asc");
			
			$stmt -> execute();
			
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE SECCION
	=============================================*/

	static public function mdlIngresarSeccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_grado,nombre,descripcion,estado) VALUES (:id_grado,:nombre,:descripcion,1)");

		$stmt->bindParam(":id_grado", $datos["id_grado"], PDO::PARAM_STR);

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR SECCION
	=============================================*/

	static public function mdlEditarSeccion($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_grado = :id_grado, descripcion = :descripcion WHERE id_seccion = :id_seccion");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_grado", $datos["id_grado"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR SECCION
	=============================================*/

	static public function mdlBorrarSeccion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_seccion = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
	
}