<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloProfesor 
{
	
	/*=============================================
	MOSTRAR PROFESOR
	=============================================*/

	static public function mdlMostrarProfesor($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.*
			FROM $tabla 
			WHERE $tabla.$item = :$item and $tabla.estado=1 order by $tabla.nombres_completos asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.* 
			FROM $tabla 
			where $tabla.estado=1 order by $tabla.nombres_completos asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE PROFESOR
	=============================================*/

	static public function mdlIngresarProfesor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres_completos,direccion,fecha_nacimiento,especialidad,cedula_profesional,foto,dni,id_usuario,telefono,estado) VALUES (:nombres_completos,:direccion,:fecha_nacimiento,:especialidad,:cedula_profesional,:foto,:dni,:id_usuario,:telefono,1)");

		$stmt->bindParam(":nombres_completos", $datos["nombres_completos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad", $datos["especialidad"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula_profesional", $datos["cedula_profesional"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR PROFESOR
	=============================================*/

	static public function mdlEditarProfesor($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres_completos = :nombres_completos, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, especialidad = :especialidad, cedula_profesional = :cedula_profesional, foto = :foto, dni= :dni, id_usuario= :id_usuario, telefono = :telefono WHERE id_profesor = :id_profesor");

		$stmt->bindParam(":nombres_completos", $datos["nombres_completos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":especialidad", $datos["especialidad"], PDO::PARAM_STR);
		$stmt->bindParam(":cedula_profesional", $datos["cedula_profesional"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PROFESOR
	=============================================*/

	static public function mdlBorrarProfesor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_profesor = :id");

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