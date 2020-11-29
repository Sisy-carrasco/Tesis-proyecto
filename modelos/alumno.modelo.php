<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloAlumno 
{
	
	/*=============================================
	MOSTRAR ALUMNO
	=============================================*/

	static public function mdlMostrarAlumno($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by nombres_completos asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by nombres_completos asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE ALUMNO
	=============================================*/

	static public function mdlIngresarAlumno($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombres_completos,direccion,fecha_nacimiento,sexo,foto,dni,id_usuario,estado) VALUES (:nombres_completos,:direccion,:fecha_nacimiento,:sexo,:foto,:dni,:id_usuario,1)");

		$stmt->bindParam(":nombres_completos", $datos["nombres_completos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR ALUMNO
	=============================================*/

	static public function mdlEditarAlumno($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres_completos = :nombres_completos, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, sexo = :sexo, foto = :foto, dni= :dni WHERE id_alumno = :id_alumno");

		$stmt->bindParam(":nombres_completos", $datos["nombres_completos"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_alumno", $datos["id_alumno"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR ALUMNO
	=============================================*/

	static public function mdlBorrarAlumno($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_alumno = :id");

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