<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloDetalleMatricula 
{
	
	/*=============================================
	MOSTRAR MATRICULA
	=============================================*/

	static public function mdlMostrarDetalleMatricula($tabla, $item, $valor){

		if($item != null){
			
			if($item=="a.id_usuario"){
				
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,a.nombres_completos as alumno,(select nombre from seccion where id_seccion=matricula.id_seccion) as seccion, 
				s.id_grado,p.nombres_completos as profesor,c.nombre as curso,ca.letra as calificacion,g.nombre as grado,dm.id_profesor
				FROM matricula
				inner join alumno a on a.id_alumno=matricula.id_alumno
				inner join seccion s on s.id_seccion=matricula.id_seccion			
				inner join grado g on g.id_grado=s.id_grado
				inner join detalle_matricula dm on dm.id_matricula=matricula.id_matricula
				inner join profesor p on p.id_profesor=dm.id_profesor
				left join curso c on c.id_curso=dm.id_curso
				left join calificacion ca on ca.id_calificacion=dm.id_calificacion
				WHERE $item = $valor and matricula.activo=1 order by matricula.id_matricula asc");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,s.nombre as seccion, 
				s.id_grado,p.nombres_completos as profesor,c.nombre as curso,ca.letra as calificacion,g.nombre as grado
				FROM $tabla
				inner join seccion s on s.id_seccion=detalle_matricula.id_seccion			
				inner join grado g on g.id_grado=s.id_grado
				inner join profesor p on p.id_profesor=detalle_matricula.id_profesor
				left join curso c on c.id_curso=detalle_matricula.id_curso
				left join calificacion ca on ca.id_calificacion=detalle_matricula.id_calificacion
				WHERE $tabla.$item = :$item and $tabla.estado=1 order by $tabla.id_detalle_matricula asc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,s.nombre as seccion,
			s.id_grado,p.nombres_completos as profesor,c.nombre as curso,ca.letra as calificacion,g.nombre as grado
			FROM $tabla
			inner join seccion s on s.id_seccion=detalle_matricula.id_seccion			
			inner join grado g on g.id_grado=s.id_grado
			inner join profesor p on p.id_profesor=detalle_matricula.id_profesor
			left join curso c on c.id_curso=detalle_matricula.id_curso
			left join calificacion ca on ca.id_calificacion=detalle_matricula.id_calificacion
			where $tabla.estado=1 order by $tabla.id_detalle_matricula asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE MATRICULA
	=============================================*/

	static public function mdlIngresarDetalleMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO detalle_matricula(id_profesor,id_curso,id_seccion,id_calificacion,id_matricula,estado) VALUES (:id_profesor,:id_curso,:id_seccion,0,0,1)");

		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		$stmt->bindParam(":id_curso", $datos["id_curso"], PDO::PARAM_STR);
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

	static public function mdlEditarDetalleMatricula($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE detalle_matricula SET id_profesor=:id_profesor,id_seccion=:id_seccion WHERE id_detalle_matricula = :id_detalle_matricula");

		$stmt->bindParam(":id_profesor", $datos["id_profesor"], PDO::PARAM_STR);
		$stmt->bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_detalle_matricula", $datos["id_detalle_matricula"], PDO::PARAM_STR);
		$stmt->execute();
		
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

	static public function mdlBorrarDetalleMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_detalle_matricula = :id");

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