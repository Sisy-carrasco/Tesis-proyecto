<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloPreguntasInferenciales 
{
	
	/*=============================================
	MOSTRAR PreguntasInferenciales
	=============================================*/

	static public function mdlMostrarPreguntasInferenciales($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_preguntas_inferenciales desc,nombre asc");

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
	REGISTRO DE PreguntasInferenciales
	=============================================*/

	static public function mdlIngresarPreguntasInferenciales($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_pregunta,id_examen_inferencial,nombre,descripcion,puntaje,estado) VALUES (:id_tipo_pregunta,:id_examen_inferencial,:nombre,:descripcion,:puntaje,1)");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_inferencial", $datos["id_examen_inferencial"], PDO::PARAM_STR);
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
	EDITAR PreguntasInferenciales
	=============================================*/

	static public function mdlEditarPreguntasInferenciales($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_pregunta=:id_tipo_pregunta,id_examen_inferencial=:id_examen_inferencial,nombre=:nombre,descripcion=:descripcion,puntaje=:puntaje WHERE id_preguntas_inferenciales = :id_preguntas_inferenciales");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_inferencial", $datos["id_examen_inferencial"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntaje", $datos["puntaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_preguntas_inferenciales", $datos["id_preguntas_inferenciales"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PreguntasInferenciales
	=============================================*/

	static public function mdlBorrarPreguntasInferenciales($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_preguntas_inferenciales = :id");

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