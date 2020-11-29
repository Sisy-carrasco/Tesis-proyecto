<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloUnidad 
{
	
	/*=============================================
	MOSTRAR UNIDAD
	=============================================*/

	static public function mdlMostrarUnidad($tabla, $item, $valor){

		if($item != null){

			if($item=="id_unidad"){
			
				$stmt = Conexion::conectar()->prepare("SELECT *,(select id_tema from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as id_tema,(select descripcion from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as tema 
				FROM $tabla 
				inner join profesor p on p.id_profesor=unidad.id_profesor
				WHERE $item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();
			
			}else{

				$stmt = Conexion::conectar()->prepare("SELECT *,c.nombre as capacidades,b.nombre as bimestre,(select id_tema from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as id_tema,(select descripcion from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as tema 
				FROM $tabla 
				inner join profesor p on p.id_profesor=unidad.id_profesor
				inner join bimestre b on b.idbimestre=unidad.id_bimestre
				inner join capacidades c on c.idcapacidades=unidad.id_capacidades
				WHERE $item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();
			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,c.nombre as capacidades,b.nombre as bimestre,(select id_tema from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as id_tema,(select descripcion from tema where id_unidad=unidad.id_unidad and estado=1 LIMIT 1) as tema 
			FROM $tabla
			inner join profesor p on p.id_profesor=unidad.id_profesor
			inner join bimestre b on b.idbimestre=unidad.id_bimestre
			inner join capacidades c on c.idcapacidades=unidad.id_capacidades
			where $tabla.estado=1 order by $tabla.descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;

	}

	
	static public function mdlMostrarUnidad2($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT *,(select id_tema from tema where id_unidad=unidad.id_unidad and estado=0 LIMIT 1) as id_tema,(select descripcion from tema where id_unidad=unidad.id_unidad and estado=0 LIMIT 1) as tema 
		FROM $tabla
		where $tabla.estado=1 ");

		$stmt -> execute();

		return $stmt -> fetchAll();

	}

	static public function MdlMostrarGeneral($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *
		FROM $tabla
		order by $tabla.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();

	}

/*=============================================
	REGISTRO DE UNIDAD
	=============================================*/

	static public function mdlIngresarUnidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,competencias,id_capacidades,duracion,id_bimestre,id_profesor,estado) VALUES (:descripcion,:competencias,:capacidades,:duracion,:semestre,:id_profesor,1)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":competencias", $datos["competencias"], PDO::PARAM_STR);
		$stmt->bindParam(":capacidades", $datos["capacidades"], PDO::PARAM_STR);
		$stmt->bindParam(":duracion", $datos["duracion"], PDO::PARAM_STR);
		$stmt->bindParam(":semestre", $datos["semestre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	

	static public function mdlActualizarUnidad($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	EDITAR UNIDAD
	=============================================*/

	static public function mdlEditarUnidad($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion,competencias = :competencias,id_capacidades = :capacidades,duracion=:duracion, id_bimestre = :semestre,id_profesor=:id_profesor WHERE id_unidad = :id_unidad");

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":competencias", $datos["competencias"], PDO::PARAM_STR);
		$stmt -> bindParam(":capacidades", $datos["capacidades"], PDO::PARAM_STR);
		$stmt -> bindParam(":duracion", $datos["duracion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":semestre", $datos["semestre"], PDO::PARAM_STR);
		
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR UNIDAD
	=============================================*/

	static public function mdlBorrarUnidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_unidad = :id");

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