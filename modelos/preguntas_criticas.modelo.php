<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloPreguntasCriticas 
{
	
	/*=============================================
	MOSTRAR PreguntasCriticas
	=============================================*/

	static public function mdlMostrarPreguntasCriticas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_preguntas_criticas desc,nombre asc");

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
	REGISTRO DE PreguntasCriticas
	=============================================*/

	static public function mdlIngresarPreguntasCriticas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_pregunta,id_examen_critico,nombre,descripcion,puntaje,estado) VALUES (:id_tipo_pregunta,:id_examen_critico,:nombre,:descripcion,:puntaje,1)");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_critico", $datos["id_examen_critico"], PDO::PARAM_STR);
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
	EDITAR PreguntasCriticas
	=============================================*/

	static public function mdlEditarPreguntasCriticas($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_pregunta=:id_tipo_pregunta,id_examen_critico=:id_examen_critico,nombre=:nombre,descripcion=:descripcion,puntaje=:puntaje WHERE id_preguntas_criticas = :id_preguntas_criticas");

		$stmt->bindParam(":id_tipo_pregunta", $datos["id_tipo_pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_examen_critico", $datos["id_examen_critico"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntaje", $datos["puntaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_preguntas_criticas", $datos["id_preguntas_criticas"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PreguntasCriticas
	=============================================*/

	static public function mdlBorrarPreguntasCriticas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_preguntas_criticas = :id");

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