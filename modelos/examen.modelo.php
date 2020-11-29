<?php


require_once "conexion.php";

/**
 * 
 */
class ModeloExamen 
{
	
	/*=============================================
	MOSTRAR EXAMEN
	=============================================*/

	static public function mdlMostrarExamen($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,g.id_grado,
			u.id_unidad,t.id_tema,l.id_lectura,u.id_profesor
			FROM $tabla 
			inner join curso c on c.id_curso=examen.id_curso
			inner join grado g on g.id_grado=c.id_grado
			inner join seccion se on se.id_seccion=examen.id_seccion
			inner join lectura l on l.id_lectura=examen.id_lectura
			inner join tema t on t.id_tema=l.id_tema
			inner join unidad u on u.id_unidad=t.id_unidad
			inner join sesion s on s.id_sesion=l.id_sesion
			WHERE $tabla.$item = :$item and $tabla.estado=1 order by $tabla.nombre asc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,g.id_grado,
			u.id_unidad,t.id_tema,l.id_lectura,u.id_profesor,p.id_usuario
			FROM $tabla 
			inner join curso c on c.id_curso=examen.id_curso
			inner join grado g on g.id_grado=c.id_grado
			inner join seccion se on se.id_seccion=examen.id_seccion
			inner join lectura l on l.id_lectura=examen.id_lectura
			inner join tema t on t.id_tema=l.id_tema
			inner join unidad u on u.id_unidad=t.id_unidad
			inner join sesion s on s.id_sesion=l.id_sesion
			inner join profesor p on p.id_profesor=s.id_profesor
			where $tabla.estado=1 order by $tabla.nombre asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenAlumno($idusuarioalumno){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		(select count(*) from respuesta where id_preguntas_criticas>0 and estado=1 and id_preguntas_criticas in (select id_preguntas_criticas from preguntas_criticas where id_examen_critico in (select id_examen_critico from examen_critico where id_examen=examen.id_examen))) as criticas,
		(select count(*) from respuesta where id_preguntas_inferenciales>0 and estado=1 and id_preguntas_inferenciales in (select id_preguntas_inferenciales from preguntas_inferenciales where id_examen_inferencial in (select id_examen_inferencial from examen_inferencial where id_examen=examen.id_examen))) as inferenciales,
		(select count(*) from respuesta where id_preguntas_literales>0 and estado=1 and id_preguntas_literales in (select id_preguntas_literales from preguntas_literales where id_examen_literal in (select id_examen_literal from examen_literal where id_examen=examen.id_examen))) as literales,
		(select sum(puntaje) from respuesta where estado=1 and id_preguntas_literales>0 and id_preguntas_literales in (select id_preguntas_literales from preguntas_literales where id_examen_literal in (select id_examen_literal from examen_literal where id_examen=examen.id_examen))) as puntajeliteral,
		(select sum(puntaje) from preguntas_literales where id_preguntas_literales in (select id_preguntas_literales from respuesta where estado=1 and id_preguntas_literales=preguntas_literales.id_preguntas_literales) and id_examen_literal in (select id_examen_literal from examen_literal where id_examen=examen.id_examen)) as totalliteral,
		(select sum(puntaje) from respuesta where estado=1 and id_preguntas_inferenciales in (select id_preguntas_inferenciales from preguntas_inferenciales where id_examen_inferencial in (select id_examen_inferencial from examen_inferencial where id_examen=examen.id_examen))) as puntajeinferencial,
		(select sum(puntaje) from preguntas_inferenciales where id_preguntas_inferenciales in (select id_preguntas_inferenciales from respuesta where estado=1 and id_preguntas_inferenciales=preguntas_inferenciales.id_preguntas_inferenciales) and id_examen_inferencial in (select id_examen_inferencial from examen_inferencial where id_examen=examen.id_examen)) as totalinferencial,
		(select sum(puntaje) from respuesta where estado=1 and id_preguntas_criticas in (select id_preguntas_criticas from preguntas_criticas where id_examen_critico in (select id_examen_critico from examen_critico where id_examen=examen.id_examen))) as puntajecritico,
		(select sum(puntaje) from preguntas_criticas where id_preguntas_criticas in (select id_preguntas_criticas from respuesta where estado=1 and id_preguntas_criticas=preguntas_criticas.id_preguntas_criticas) and id_examen_critico in (select id_examen_critico from examen_critico where id_examen=examen.id_examen)) as totalcritico,
		a.nombres_completos as alumno,p.id_usuario,
		(select tiempo from respuesta where id_preguntas_criticas>0 and estado=1 and id_preguntas_criticas in (select id_preguntas_criticas from preguntas_criticas where id_examen_critico in (select id_examen_critico from examen_critico where id_examen=examen.id_examen)) limit 1) as fecha_criticas,
		(select tiempo from respuesta where id_preguntas_inferenciales>0 and estado=1 and id_preguntas_inferenciales in (select id_preguntas_inferenciales from preguntas_inferenciales where id_examen_inferencial in (select id_examen_inferencial from examen_inferencial where id_examen=examen.id_examen)) limit 1) as fecha_inferenciales,
		(select tiempo from respuesta where id_preguntas_literales>0 and estado=1 and id_preguntas_literales in (select id_preguntas_literales from preguntas_literales where id_examen_literal in (select id_examen_literal from examen_literal where id_examen=examen.id_examen)) limit 1) as fecha_literales
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join sesion s on s.id_sesion=l.id_sesion
		inner join matricula m on m.id_seccion=se.id_seccion
		inner join alumno a on a.id_alumno=m.id_alumno
		inner join profesor p on p.id_profesor=s.id_profesor
		where examen.estado=1 ".($idusuarioalumno>0?("and a.id_usuario=$idusuarioalumno"):'')." order by examen.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenCriticoAlumno($idexamen,$limit="3"){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_criticas as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_critico ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join (select * from preguntas_criticas where id_examen_critico in (select id_examen_critico from examen_critico where id_examen=$idexamen) order by random() asc limit $limit) pc on pc.id_examen_critico=ec.id_examen_critico
		inner join pregunta_opcion po on po.id_preguntas_criticas=pc.id_preguntas_criticas
		where examen.estado=1 and examen.id_examen=$idexamen 
		order by examen.nombre asc,pc.descripcion asc,random() asc,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenInferencialAlumno($idexamen,$limit="3"){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_inferenciales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_inferencial ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join (select * from preguntas_inferenciales where id_examen_inferencial in (select id_examen_inferencial from examen_inferencial where id_examen=$idexamen) order by random() asc limit $limit) pc on pc.id_examen_inferencial=ec.id_examen_inferencial
		inner join pregunta_opcion po on po.id_preguntas_inferenciales=pc.id_preguntas_inferenciales
		where examen.estado=1 and examen.id_examen=$idexamen 
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenLiteralAlumno($idexamen,$limit="3"){
		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_literales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_literal ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join (select * from preguntas_literales where id_examen_literal in (select id_examen_literal from examen_literal where id_examen=$idexamen) order by random() asc limit $limit) pc on pc.id_examen_literal=ec.id_examen_literal
		inner join pregunta_opcion po on po.id_preguntas_literales=pc.id_preguntas_literales
		where examen.estado=1 and examen.id_examen=$idexamen
		order by examen.nombre asc,pc.descripcion asc,pc.nombre asc");

		$stmt -> execute();
		
		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenCriticoRespuestaAlumno($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_criticas as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves,re.id_preguntas_criticas as idrespuesta,re.opcion as opcionrespuesta,re.puntaje as puntajeobtenido,
		re.id_pregunta_opcion as id_pregunta_respuesta
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_critico ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join preguntas_criticas pc on pc.id_examen_critico=ec.id_examen_critico
		inner join pregunta_opcion po on po.id_preguntas_criticas=pc.id_preguntas_criticas
		inner join respuesta re on re.id_preguntas_criticas=pc.id_preguntas_criticas
		where examen.estado=1 and examen.id_examen=$idexamen and re.estado=1
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenInferencialRespuestaAlumno($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_inferenciales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves,re.id_preguntas_inferenciales as idrespuesta,re.opcion as opcionrespuesta,re.puntaje as puntajeobtenido,
		re.id_pregunta_opcion as id_pregunta_respuesta
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_inferencial ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join preguntas_inferenciales pc on pc.id_examen_inferencial=ec.id_examen_inferencial
		inner join pregunta_opcion po on po.id_preguntas_inferenciales=pc.id_preguntas_inferenciales
		inner join respuesta re on re.id_preguntas_inferenciales=pc.id_preguntas_inferenciales
		where examen.estado=1 and examen.id_examen=$idexamen and re.estado=1
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenLiteralRespuestaAlumno($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_literales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves,re.id_preguntas_literales as idrespuesta,re.opcion as opcionrespuesta,re.puntaje as puntajeobtenido,
		re.id_pregunta_opcion as id_pregunta_respuesta,(select count(*) from respuesta where id_preguntas_literales=pc.id_preguntas_literales and estado=0) as eliminado
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join examen_literal ec on ec.id_examen=examen.id_examen
		inner join sesion s on s.id_sesion=ec.id_sesion
		inner join preguntas_literales pc on pc.id_examen_literal=ec.id_examen_literal
		inner join pregunta_opcion po on po.id_preguntas_literales=pc.id_preguntas_literales
		inner join respuesta re on re.id_preguntas_literales=pc.id_preguntas_literales
		where examen.estado=1 and examen.id_examen=$idexamen and re.estado=1
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenCritico($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_criticas as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join sesion s on s.id_sesion=l.id_sesion
		inner join examen_critico ec on ec.id_examen=examen.id_examen
		inner join preguntas_criticas pc on pc.id_examen_critico=ec.id_examen_critico
		inner join pregunta_opcion po on po.id_preguntas_criticas=pc.id_preguntas_criticas
		where examen.estado=1 and examen.id_examen=$idexamen 
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenLiteral($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_literales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join sesion s on s.id_sesion=l.id_sesion
		inner join examen_literal ec on ec.id_examen=examen.id_examen
		inner join preguntas_literales pc on pc.id_examen_literal=ec.id_examen_literal
		inner join pregunta_opcion po on po.id_preguntas_literales=pc.id_preguntas_literales
		where examen.estado=1 and examen.id_examen=$idexamen 
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarExamenInferencial($idexamen){

		$stmt = Conexion::conectar()->prepare("SELECT examen.*,c.nombre as curso,l.descripcion as lectura,t.descripcion as tema,u.descripcion as unidad,s.descripcion as sesion,se.nombre as seccion,g.nombre as grado,
		pc.puntaje,pc.nombre as pregunta, pc.descripcion as pregunta_descripcion,po.descripcion as opcion,po.indicador_correcto,l.archivo,po.id_pregunta_opcion,
		pc.id_preguntas_inferenciales as id_pregunta,pc.id_tipo_pregunta,po.palabras_claves
		FROM examen 
		inner join curso c on c.id_curso=examen.id_curso
		inner join grado g on g.id_grado=c.id_grado
		inner join seccion se on se.id_seccion=examen.id_seccion
		inner join lectura l on l.id_lectura=examen.id_lectura
		inner join tema t on t.id_tema=l.id_tema
		inner join unidad u on u.id_unidad=t.id_unidad
		inner join sesion s on s.id_sesion=l.id_sesion
		inner join examen_inferencial ec on ec.id_examen=examen.id_examen
		inner join preguntas_inferenciales pc on pc.id_examen_inferencial=ec.id_examen_inferencial
		inner join pregunta_opcion po on po.id_preguntas_inferenciales=pc.id_preguntas_inferenciales
		where examen.estado=1 and examen.id_examen=$idexamen 
		order by examen.nombre,pc.descripcion,pc.nombre asc");

		$stmt -> execute();

		return $stmt -> fetchAll();
		
		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	REGISTRO DE EXAMEN
	=============================================*/

	static public function mdlIngresarExamen($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,id_curso,id_lectura,fecha_inicio,fecha_fin,tiempo,id_seccion,estado) VALUES (:nombre,:id_curso,:id_lectura,:fecha_inicio,:fecha_fin,:tiempo,:id_seccion,1)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_curso", $datos["id_curso"], PDO::PARAM_STR);
		$stmt->bindParam(":id_lectura", $datos["id_lectura"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
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
	EDITAR EXAMEN
	=============================================*/

	static public function mdlEditarExamen($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre,id_curso=:id_curso,id_lectura=:id_lectura,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,tiempo=:tiempo,id_seccion=:id_seccion WHERE id_examen = :id_examen");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_curso", $datos["id_curso"], PDO::PARAM_STR);
		$stmt->bindParam(":id_lectura", $datos["id_lectura"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":tiempo", $datos["tiempo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_seccion", $datos["id_seccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_examen", $datos["id_examen"], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR EXAMEN
	=============================================*/

	static public function mdlBorrarExamen($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("update $tabla set estado=0 WHERE id_examen = :id");

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