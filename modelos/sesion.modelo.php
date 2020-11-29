<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloSesion 
{
	
	/*=============================================
	MOSTRAR SESION
	=============================================*/

	static public function mdlMostrarSesion($tabla, $item, $valor){

		if($item != null){

			if($item=="id_sesion"){

				$stmt = Conexion::conectar()->prepare("SELECT *,c.nombre as capacidades,(select descripcion from unidad where id_unidad=sesion.id_unidad) as unidad 
				FROM $tabla 
				inner join profesor p on p.id_profesor=sesion.id_profesor
				inner join capacidades c on c.idcapacidades=sesion.id_capacidades
				WHERE 
				$item = :$item and $tabla.estado=1 order by descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT *,c.nombre as capacidades,(select descripcion from unidad where id_unidad=sesion.id_unidad) as unidad 
				FROM $tabla 
				inner join profesor p on p.id_profesor=sesion.id_profesor
				inner join capacidades c on c.idcapacidades=sesion.id_capacidades
				WHERE 
				$item = :$item and $tabla.estado=1 order by descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,c.nombre as capacidades,(select descripcion from unidad where id_unidad=sesion.id_unidad) as unidad 
			FROM $tabla 
			inner join capacidades c on c.idcapacidades=sesion.id_capacidades
			where estado=1 order by descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

          static public function mdlMostrarSesion3($tabla, $item, $valor){

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
	// static public function mdlMostrarSesion2($tabla, $item, $valor){
	// 	$stmt = Conexion::conectar()->prepare("SELECT *
	// 	FROM $tabla
	// 	where $tabla.estado=1 and id_sesion<9 order by $tabla.descripcion asc");

	// 	$stmt -> execute();

	// 	return $stmt -> fetchAll();

	// }
	static public function mdlMostrarSesion2($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT *
		FROM $tabla
		where $tabla.estado=1 ");

		$stmt -> execute();

		return $stmt -> fetchAll();

	}

/*=============================================
	REGISTRO DE SESION
	=============================================*/

	static public function mdlIngresarSesion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_unidad,descripcion,competencias,id_capacidades,intervalo_puntaje_capacidades,duracion,id_profesor,estado) VALUES (:id_unidad,:descripcion,:competencias,:capacidades,:intervalo_puntaje_capacidades,:duracion,:id_profesor,1)");

		$stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":competencias", $datos["competencias"], PDO::PARAM_STR);
		$stmt->bindParam(":capacidades", $datos["capacidades"], PDO::PARAM_STR);
		$stmt->bindParam(":intervalo_puntaje_capacidades", $datos["intervalo_puntaje_capacidades"], PDO::PARAM_STR);
		$stmt->bindParam(":duracion", $datos["duracion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR SESION
	=============================================*/

	static public function mdlEditarSesion($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_unidad=:id_unidad,descripcion = :descripcion, competencias = :competencias, id_capacidades = :capacidades, intervalo_puntaje_capacidades = :intervalo_puntaje_capacidades, duracion = :duracion, id_profesor = :id_profesor WHERE id_sesion = :id_sesion");

		$stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":competencias", $datos["competencias"], PDO::PARAM_STR);
		$stmt->bindParam(":capacidades", $datos["capacidades"], PDO::PARAM_STR);
		$stmt->bindParam(":intervalo_puntaje_capacidades", $datos["intervalo_puntaje_capacidades"], PDO::PARAM_STR);
		$stmt->bindParam(":duracion", $datos["duracion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR SESION
	=============================================*/

	static public function mdlBorrarSesion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_sesion = :id");

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