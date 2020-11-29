<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloPreguntasLiterales 
{
	
	/*=============================================
	MOSTRAR PreguntasLiterales
	=============================================*/

	static public function mdlMostrarPreguntasLiterales($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_preguntas_literales desc,nombre asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT  FROM $tabla where estado=1 order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE PreguntasLiterales
	=============================================*/

	static public function mdlIngresarPreguntasLiterales($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_pregunta,id_examen_literal,nombre,descripcion,puntaje,estado) VALUES (:id_tipo_pregunta,:id_examen_literal,:nombre,:descripcion,:puntaje,1)");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_literal", $datos["id_examen_literal"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntaje", $datos["puntaje"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR PreguntasLiterales
	=============================================*/

	static public function mdlEditarPreguntasLiterales($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_pregunta=:id_tipo_pregunta,id_examen_literal=:id_examen_literal,nombre=:nombre,descripcion=:descripcion,puntaje=:puntaje WHERE id_preguntas_literales = :id_preguntas_literales");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_literal", $datos["id_examen_literal"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntaje", $datos["puntaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_preguntas_literales", $datos["id_preguntas_literales"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PreguntasLiterales
	=============================================*/

	static public function mdlBorrarPreguntaLiterales($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_preguntas_literales = :id");

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