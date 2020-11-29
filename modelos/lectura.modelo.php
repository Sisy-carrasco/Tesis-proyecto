<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloLectura 
{
	
	/*=============================================
	MOSTRAR LECTURA
	=============================================*/

	static public function mdlMostrarLectura($tabla, $item, $valor){

		if($item != null){

			if($item=="id_usuario"){

				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,t.descripcion as tema,u.id_unidad,
				u.descripcion as unidad,(select descripcion from sesion where id_sesion=lectura.id_sesion) as sesion,p.id_profesor
				FROM $tabla 
				inner join tema t on t.id_tema=lectura.id_tema
				inner join unidad u on u.id_unidad=t.id_unidad
				inner join profesor p on p.id_profesor=u.id_profesor
				WHERE $item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT *,t.descripcion as tema,u.id_unidad as id_unidad,
				u.descripcion  as unidad,(select descripcion from sesion where id_sesion=lectura.id_sesion) as sesion,p.id_profesor
				FROM $tabla 
				inner join tema t on t.id_tema=lectura.id_tema
				inner join unidad u on u.id_unidad=t.id_unidad
				inner join profesor p on p.id_profesor=u.id_profesor
				WHERE $tabla.$item = :$item and $tabla.estado=1 order by $tabla.descripcion asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,t.descripcion as tema,u.id_unidad as id_unidad,
			u.descripcion as unidad,(select descripcion from sesion where id_sesion=lectura.id_sesion) as sesion,p.id_profesor
			 FROM $tabla 
			 inner join tema t on t.id_tema=lectura.id_tema
			 inner join unidad u on u.id_unidad=t.id_unidad
			 inner join profesor p on p.id_profesor=u.id_profesor
			 where $tabla.estado=1 order by $tabla.descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE LECTURA
	=============================================*/

	static public function mdlIngresarLectura($tabla, $datos){

		// $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,archivo,id_tema,id_sesion,estado) VALUES (:nombre,:archivo,:id_tema,:id_sesion,1)");
         $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,archivo,id_tema,id_sesion,activo) VALUES (:descripcion,:archivo,:id_tema,:id_sesion,1)");

		$stmt->bindParam(":descripcion", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		// $stmt->bindParam(":id_tema", $datos["id_tema"], PDO::PARAM_STR);
		// $stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
         $stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tema", $datos["id_tema"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

/*=============================================
	EDITAR LECTURA
	=============================================*/

	static public function mdlEditarLectura($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :nombre, archivo = :archivo, id_tema = :id_tema, id_sesion = :id_sesion WHERE id_lectura = :id_lectura");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":archivo", $datos["archivo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_tema", $datos["id_tema"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_lectura", $datos["id_lectura"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR LECTURA
	=============================================*/

	static public function mdlBorrarLectura($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_lectura = :id");

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