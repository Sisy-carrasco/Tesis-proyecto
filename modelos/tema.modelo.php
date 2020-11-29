<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloTema 
{
	
	/*=============================================
	MOSTRAR TEMA
	=============================================*/

	static public function mdlMostrarTema($tabla, $item, $valor){

		if($item != null){

			if($item!="id_usuario"){

				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,s.descripcion as sesion 
				FROM $tabla 
				inner join sesion s on s.id_sesion=tema.id_sesion
				inner join profesor p on p.id_profesor=s.id_profesor
				WHERE $item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();
			
			}else{

				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,s.descripcion as sesion 
				FROM $tabla 
				inner join sesion s on s.id_sesion=tema.id_sesion
				inner join profesor p on p.id_profesor=s.id_profesor
				WHERE $item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");
				
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();
				
			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,(select descripcion from sesion where id_sesion=tema.id_sesion) as sesion FROM $tabla where estado=1 order by descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	static public function mdlMostrarTema1($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,(select descripcion from sesion where id_sesion=tema.id_sesion) as sesion FROM $tabla WHERE $item = :$item and estado=1 order by nombre asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,(select sesion.descripcion from sesion where sesion.id_sesion=tema.id_sesion) as sesion FROM $tabla where estado=1 order by descripcion asc");
			
			$stmt -> execute();
			
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


/*=============================================
	REGISTRO DE TEMA
	=============================================*/

	static public function mdlIngresarTema($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,id_sesion,estado) VALUES (:descripcion,:id_sesion,1)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
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
	EDITAR TEMA
	=============================================*/

	static public function mdlEditarTema($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :nombre, id_unidad = :id_unidad WHERE id_tema = :id_tema");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_tema", $datos["id_tema"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR TEMA
	=============================================*/

	static public function mdlBorrarTema($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_tema = :id");

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