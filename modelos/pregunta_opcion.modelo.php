<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloPreguntaOpcion 
{
	
	/*=============================================
	MOSTRAR PreguntaOpcion
	=============================================*/

	static public function mdlMostrarPreguntaOpcion($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by nombre asc");

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
	REGISTRO DE PreguntaOpcion
	=============================================*/

	static public function mdlIngresarPreguntaOpcion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_preguntas_criticas,id_preguntas_inferenciales,id_preguntas_literales,descripcion,indicador_correcto,retroalimentacion,palabras_claves,estado) VALUES (:id_preguntas_criticas,:id_preguntas_inferenciales,:id_preguntas_literales,:descripcion,:indicador_correcto,:retroalimentacion,:palabras_claves,1)");

		$stmt->bindParam(":id_preguntas_criticas", $datos["id_preguntas_criticas"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_inferenciales", $datos["id_preguntas_inferenciales"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_literales", $datos["id_preguntas_literales"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":indicador_correcto", $datos["indicador_correcto"], PDO::PARAM_STR);
		$stmt->bindParam(":retroalimentacion", $datos["retroalimentacion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabras_claves", $datos["palabras_clave"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR PreguntaOpcion
	=============================================*/

	static public function mdlEditarPreguntaOpcion($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_preguntas_criticas=:id_preguntas_criticas,id_preguntas_inferenciales=:id_preguntas_inferenciales,id_preguntas_literales=:id_preguntas_literales,descripcion=:descripcion,indicador_correcto=:indicador_correcto,retroalimentacion=:retroalimentacion,palabras_claves=:palabras_claves WHERE id_pregunta_opcion = :id_pregunta_opcion");

		$stmt->bindParam(":id_preguntas_criticas", $datos["id_preguntas_criticas"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_inferenciales", $datos["id_preguntas_inferenciales"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_literales", $datos["id_preguntas_literales"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":indicador_correcto", $datos["indicador_correcto"], PDO::PARAM_STR);
		$stmt->bindParam(":retroalimentacion", $datos["retroalimentacion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabras_claves", $datos["palabras_clave"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_pregunta_opcion", $datos["id_pregunta_opcion"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PreguntaOpcion
	=============================================*/

	static public function mdlBorrarPreguntaOpcion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_pregunta_opcion = :id");

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