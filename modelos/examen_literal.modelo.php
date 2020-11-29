<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloExamenLiteral 
{
	
	/*=============================================
	MOSTRAR ExamenLiteral
	=============================================*/

	static public function mdlMostrarExamenLiteral($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_examen_literal asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by id_examen_literal asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE ExamenLiteral
	=============================================*/

	static public function mdlIngresarExamenLiteral($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_examen,id_nivel_literal,id_sesion,estado) VALUES (:id_examen,:id_nivel_literal,:id_sesion,1)");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_literal", $datos["id_nivel_literal"], PDO::PARAM_STR);
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
	EDITAR ExamenLiteral
	=============================================*/

	static public function mdlEditarExamenLiteral($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_examen = :id_examen, id_nivel_Literal = :id_nivel_Literal, id_sesion = :id_sesion WHERE id_examen_literal = :id_examen_literal");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_Literal", $datos["id_nivel_Literal"], PDO::PARAM_STR);
		$stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_examen_literal", $datos["id_examen_literal"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR ExamenLiteral
	=============================================*/

	static public function mdlBorrarExamenLiteral($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_examen_literal = :id");

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