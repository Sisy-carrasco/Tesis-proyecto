<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloExamenInferencial 
{
	
	/*=============================================
	MOSTRAR ExamenInferencial
	=============================================*/

	static public function mdlMostrarExamenInferencial($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_examen_inferencial asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by id_examen_inferencial asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE ExamenInferencial
	=============================================*/

	static public function mdlIngresarExamenInferencial($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_examen,id_nivel_inferencial,id_sesion,estado) VALUES (:id_examen,:id_nivel_inferencial,:id_sesion,1)");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_inferencial", $datos["id_nivel_inferencial"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR ExamenInferencial
	=============================================*/

	static public function mdlEditarExamenInferencial($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_nivel_inferencial = :id_nivel_inferencial, id_sesion = :id_sesion WHERE id_examen = :id_examen");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_inferencial", $datos["id_nivel_inferencial"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR ExamenInferencial
	=============================================*/

	static public function mdlBorrarExamenInferencial($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_examen_inferencial = :id");

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