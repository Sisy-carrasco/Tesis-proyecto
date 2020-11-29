<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloRespuesta 
{
	
	/*=============================================
	MOSTRAR RESPUESTA
	=============================================*/

	static public function mdlMostrarLectura($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *,(select descripcion from tema where id_tema=lectura.id_tema) as tema,(select id_unidad from tema where id_tema=lectura.id_tema) as id_unidad,
			(select descripcion from unidad where id_unidad=(select id_unidad from tema where id_tema=lectura.id_tema)) as unidad,(select descripcion from sesion where id_sesion=lectura.id_sesion) as sesion
			FROM $tabla WHERE $item = :$item and estado=1 order by descripcion asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *,(select descripcion from tema where id_tema=lectura.id_tema) as tema,(select id_unidad from tema where id_tema=lectura.id_tema) as id_unidad,
			(select descripcion from unidad where id_unidad=(select id_unidad from tema where id_tema=lectura.id_tema)) as unidad,(select descripcion from sesion where id_sesion=lectura.id_sesion) as sesion
			 FROM $tabla where estado=1 order by descripcion asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE RESPUESTA
	=============================================*/

	static public function mdlIngresarRespuesta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_detalle_matricula,id_preguntas_criticas,id_preguntas_inferenciales,id_preguntas_literales,id_pregunta_opcion,opcion,puntaje,tiempo,estado) VALUES (:id_detalle_matricula,:id_preguntas_criticas,:id_preguntas_inferenciales,:id_preguntas_literales,:id_pregunta_opcion,:opcion,:puntaje,:tiempo,1)");

		$stmt->bindParam(":id_detalle_matricula", $datos["id_detalle_matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_criticas", $datos["id_preguntas_criticas"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_inferenciales", $datos["id_preguntas_inferenciales"], PDO::PARAM_STR);
		$stmt->bindParam(":id_preguntas_literales", $datos["id_preguntas_literales"], PDO::PARAM_STR);
		$stmt->bindParam(":id_pregunta_opcion", $datos["id_pregunta_opcion"], PDO::PARAM_STR);
		$stmt->bindParam(":opcion", $datos["opcion"], PDO::PARAM_STR);
		$stmt->bindParam(":puntaje", $datos["puntaje"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		
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

	static public function mdlReiniciarRespuesta($idexamen, $tabla){

		if($tabla=="Critico"){
			$tabla1="criticas";
		}elseif($tabla=="Inferencial"){
			$tabla1="inferenciales";
		}else{
			$tabla1="literales";
		}

		//$stmt = Conexion::conectar()->prepare("delete from respuesta where id_preguntas_$tabla1 in (select id_preguntas_$tabla1 from preguntas_$tabla1 where id_examen_$tabla in(select id_examen_$tabla from examen_$tabla where id_examen=$idexamen))");
		$stmt = Conexion::conectar()->prepare("update respuesta set estado=0 where id_preguntas_$tabla1 in (select id_preguntas_$tabla1 from preguntas_$tabla1 where id_examen_$tabla in(select id_examen_$tabla from examen_$tabla where id_examen=$idexamen))");


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}
	
}