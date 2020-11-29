<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloCalificacion 
{
	
	/*=============================================
	MOSTRAR CALIFICACION
	=============================================*/

	static public function mdlMostrarCalificacion($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by letra asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by letra asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE CALIFICACION
	=============================================*/

	static public function mdlIngresarCalificacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(letra,valor_minimo,valor_maximo,estado) VALUES (:letra,:valor_minimo,:valor_maximo,1)");

		$stmt->bindParam(":letra", $datos["letra"], PDO::PARAM_STR);
		$stmt->bindParam(":valor_minimo", $datos["valor_minimo"], PDO::PARAM_STR);
		$stmt->bindParam(":valor_maximo", $datos["valor_maximo"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR CALIFICACION
	=============================================*/

	static public function mdlEditarCalificacion($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET letra = :letra, valor_minimo = :valor_minimo, valor_maximo = :valor_maximo WHERE id_calificacion = :id_calificacion");

		$stmt -> bindParam(":letra", $datos["letra"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor_minimo", $datos["valor_minimo"], PDO::PARAM_STR);
		$stmt -> bindParam(":valor_maximo", $datos["valor_maximo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_calificacion", $datos["id_calificacion"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR CALIFICACION
	=============================================*/

	static public function mdlBorrarCalificacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_calificacion = :id");

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