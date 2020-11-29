<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloMatricula 
{
	
	/*=============================================
	MOSTRAR MATRICULA
	=============================================*/

	static public function mdlMostrarMatricula($tabla, $item, $valor){

		if($item != null){
			
			if($item=="a.id_usuario"){
				
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,a.nombres_completos as alumno,s.nombre as seccion, 
				s.id_grado,g.nombre as grado
				FROM matricula
				inner join alumno a on a.id_alumno=matricula.id_alumno
				inner join seccion s on s.id_seccion=matricula.id_seccion			
				inner join grado g on g.id_grado=s.id_grado
				WHERE $item = $valor and matricula.activo=1 order by matricula.id_matricula asc");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT *,a.nombres_completos as alumno,s.nombre as seccion,
				s.id_grado,g.nombre as grado
				FROM $tabla 
				inner join alumno a on a.id_alumno=matricula.id_alumno
				inner join seccion s on s.id_seccion=matricula.id_seccion			
				inner join grado g on g.id_grado=s.id_grado
				WHERE $tabla.$item = :$item and $tabla.activo=1 order by $tabla.id_matricula asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,a.nombres_completos as alumno,s.nombre as seccion,
			s.id_grado,g.nombre as grado
			FROM $tabla 
			inner join alumno a on a.id_alumno=matricula.id_alumno
			inner join seccion s on s.id_seccion=matricula.id_seccion			
			inner join grado g on g.id_grado=s.id_grado
			where $tabla.activo=1 order by $tabla.id_matricula asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE MATRICULA
	=============================================*/

	static public function mdlIngresarMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_alumno,id_seccion,activo) VALUES (:id_alumno,:id_seccion,1)");

		$stmt->bindParam(":id_alumno", $datos["id_alumno"], PDO::PARAM_STR);
		$stmt->bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR MATRICULA
	=============================================*/

	static public function mdlEditarMatricula($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_alumno=:id_alumno,id_seccion=:id_seccion WHERE id_matricula = :id_matricula");

		$stmt->bindParam(":id_alumno", $datos["id_alumno"], PDO::PARAM_STR);
		$stmt->bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR MATRICULA
	=============================================*/

	static public function mdlBorrarMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set activo=0 WHERE id_matricula = :id");

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