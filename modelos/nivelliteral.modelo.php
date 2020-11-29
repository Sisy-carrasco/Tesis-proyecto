<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloNivelliteral 
{
	
	/*=============================================
	MOSTRAR NIVELliteral
	=============================================*/

	static public function mdlMostrarNivelliteral($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by descripcion asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE NIVELliteral
	=============================================*/

	static public function mdlIngresarNivelliteral($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,estado) VALUES (:descripcion,1)");

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
	EDITAR NIVELliteral
	=============================================*/

	static public function mdlEditarNivelliteral($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_nivel_literal = :id_nivel_literal");

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_nivel_literal", $datos["id_nivel_literal"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR NIVELliteral
	=============================================*/

	static public function mdlBorrarTipopregunta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_tipo_pregunta = :id");

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