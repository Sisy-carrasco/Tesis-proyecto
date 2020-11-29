<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloExamenCritico 
{
	
	/*=============================================
	MOSTRAR ExamenCritico
	=============================================*/

	static public function mdlMostrarExamenCritico($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1 order by id_examen_critico asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where estado=1 order by id_examen_critico asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE ExamenCritico
	=============================================*/

	static public function mdlIngresarExamenCritico($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_examen,id_nivel_critico,id_sesion,estado) VALUES (:id_examen,:id_nivel_critico,:id_sesion,1)");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_critico", $datos["id_nivel_critico"], PDO::PARAM_STR);
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
	EDITAR ExamenCritico
	=============================================*/

	static public function mdlEditarExamenCritico($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_nivel_critico = :id_nivel_critico, id_sesion=:id_sesion WHERE id_examen = :id_examen");

		$stmt->bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_nivel_critico", $datos["id_nivel_critico"], PDO::PARAM_STR);
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
	BORRAR ExamenCritico
	=============================================*/

	static public function mdlBorrarExamenCritico($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_examen_critico = :id");

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