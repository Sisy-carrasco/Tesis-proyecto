 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar exámenes
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Examen</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalExamen" onclick="$('#accion').val('NuevoExamen');$('#titleExamen').html('Agregar Examen');">
         Agregar Examen
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Grado</th>
           <th>Seccion</th>
           <th>Curso</th>
           <th>Unidad</th>
           <th>Tema</th>
           <th>Lectura</th>
           <th>Nombre</th>
           <th>Fecha Inicio</th>
           <th>Fecha Fin</th>
           <th>Tiempo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $examen = ControladorExamen::ctrMostrarExamen($item, $valor);
        $c=0;
       foreach ($examen as $key => $value){
         if($value["id_usuario"]==$_SESSION["id"]){
            $c=$c+1;
            echo ' <tr>
                    <td>'.$c.'</td>
                    <td>'.$value["grado"].'</td>
                    <td>'.$value["seccion"].'</td>
                    <td>'.$value["curso"].'</td>
                    <td>'.$value["unidad"].'</td>
                    <td>'.$value["tema"].'</td>
                    <td>'.$value["lectura"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["fecha_inicio"].'</td>
                    <td>'.$value["fecha_fin"].'</td>
                    <td>'.substr($value["tiempo"],0,5).'</td>';       
                    echo '<td>

                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarExamen" idExamen="'.$value["id_examen"].'" data-toggle="modal" data-target="#modalExamen"><i class="fa fa-pencil"></i></button>
                      </div>
                      <div class="btn-group">
                        <button class="btn btn-danger btnEliminarExamen" idExamen="'.$value["id_examen"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
         }
        }


        ?> 

        </tbody>

       </table>


        </div>
    
      </div>


    </section>

  </div>
<!--=====================================
MODAL AGREGAR EXAMEN
======================================-->

<div id="modalExamen" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:80%;">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoMatricula" />
        <input type="hidden" id="idExamen" name="idExamen" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleExamen">Agregar Examen</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="fecha_inicio">Nombre:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre examen" required>

                  </div>

                </div>
              
              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="fecha_inicio">Fecha Inicio:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="datetime-local" class="form-control input-lg" name="fecha_inicio" id="fecha_inicio" placeholder="Ingresar fecha inicio" required>

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="fecha_fin">Fecha Fin:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="datetime-local" class="form-control input-lg" name="fecha_fin" id="fecha_fin" placeholder="Ingresar fecha fin" required>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label for="idGrado">Grado:</label>

                  <div class="input-group"> 
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idGrado" id="idGrado" onchange="generarSeccionExamen(this.value,0);generarCursoExamen(this.value,0);">
                      <option value="">Selecciona Grado</option>
                      <?php $grado = ControladorGrado::ctrMostrarGrado(null, null);
                      foreach ($grado as $key => $value){
                        echo '<option value="'.$value["id_grado"].'">'.$value["nombre"].'</option>';
                      }
                      ?>
                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">
                  
                  <label for="idSeccion">Seccion:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idSeccion" id="idSeccion">
                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">
                  
                  <label for="idCurso">Curso:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idCurso" id="idCurso">
                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="tiempo">Tiempo(hh:mm):</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o "></i></span> 

                    <input type="time" class="form-control input-lg" name="tiempo" id="tiempo" placeholder="Ingresar tiempo" required>

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label for="idUnidad">Unidad:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idUnidad" id="idUnidad" onchange="generarTema(this.value,0);generarSesionExamen(this.value,0,0,0);">
                      <option value="">Selecciona Unidad</option>
                      <?php $seccion = ControladorUnidad::ctrMostrarUnidad("id_usuario", $_SESSION["id"]);
                      foreach ($seccion as $key => $value){
                        echo '<option value="'.$value["id_unidad"].'">'.$value["descripcion"].'</option>';
                      }
                      ?>
                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label for="idTema">Tema:</label>  
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idTema" id="idTema" onchange="generarLecturaExamen(this.value,0)">
                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-4"> 

                <div class="form-group">

                  <label for="idLectura">Lectura:</label>  
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idLectura" id="idLectura">
                    </select>

                  </div>

                </div>

              </div>

            </div>
            
            <hr />

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="idNivelLiteral">Nivel Literal:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o "></i></span> 

                    <select class="form-control input-lg" name="idNivelLiteral" id="idNivelLiteral">

                      <option value="">Selecciona Nivel Literal</option>
                      <?php $nivelliteral = ControladorNivelLiteral::ctrMostrarNivelLiteral(null, null);
                      foreach ($nivelliteral as $key => $value){
                        echo '<option value="'.$value["id_nivel_literal"].'">'.$value["descripcion"].'</option>';
                      }
                      ?>

                    </select>

                  </div>

                </div>

              </div>  

              <div class="col-md-6">

                <div class="form-group">
                  
                  <label for="idSesionLiteral">Sesion:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idSesionLiteral" id="idSesionLiteral">
                    </select>

                  </div>

                </div>

              </div>    

              <div class="col-md-12">

                <div class="form-group">

                  <label for="PreguntasLiteral"><button class="btn btn-info" type="button" onclick="agregarPregunta('Literal');"><i class="fa fa-plus"></i></button> Preguntas:</label>
                  <input type="hidden" name="txtListaLiteral" id="txtListaLiteral" />
                  <table class="table table-bordered table-striped">
                  
                      <thead>
                        <tr>
                          <th class="text-center">Tipo Preg.</th>
                          <th class="text-center">Pregunta</th>
                          <th class="text-center">Descripcion</th>
                          <th class="text-center">Respuesta</th>
                          <th class="text-center">Puntaje</th>
                        </tr>
                      </thead>
                      <tbody id="tbLiteral">
                      </tbody>
                  </table>
                  
                    

                </div>

              </div>   

            </div>

            <hr />
            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="idNivelInferencial">Nivel Inferencial:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o "></i></span> 

                    <select class="form-control input-lg" name="idNivelInferencial" id="idNivelInferencial">

                      <?php $nivelinferencial = ControladorNivelInferencial::ctrMostrarNivelInferencial(null, null);
                      foreach ($nivelinferencial as $key => $value){
                        echo '<option value="'.$value["id_nivel_inferencial"].'">'.$value["descripcion"].'</option>';
                      }
                      ?>

                    </select>

                  </div>

                </div>

              </div>  

              <div class="col-md-6">

                <div class="form-group">
                  
                  <label for="idSesionInferencial">Sesion:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idSesionInferencial" id="idSesionInferencial">
                    </select>

                  </div>

                </div>

              </div>    

              <div class="col-md-12">

                <div class="form-group">

                  <label for="PreguntasInferencial"><button class="btn btn-info" type="button" onclick="agregarPregunta('Inferencial');"><i class="fa fa-plus"></i></button> Preguntas:</label>
                  <input type="hidden" name="txtListaInferencial" id="txtListaInferencial" />
                  <table class="table table-bordered table-striped">
                  
                      <thead>
                        <tr>
                          <th class="text-center">Tipo Preg.</th> 
                          <th class="text-center">Pregunta</th>
                          <th class="text-center">Descripcion</th>
                          <th class="text-center">Respuesta</th>
                          <th class="text-center">Puntaje</th>
                        </tr>
                      </thead>
                      <tbody id="tbInferencial">
                      </tbody>
                  </table>

                </div>

              </div>   

            </div>

            <hr />
            
            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="idNivelCritico">Nivel Critico:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o "></i></span> 

                    <select class="form-control input-lg" name="idNivelCritico" id="idNivelCritico">

                      <?php $nivelcritico = ControladorNivelCritico::ctrMostrarNivelCritico(null, null);
                      foreach ($nivelcritico as $key => $value){
                        echo '<option value="'.$value["id_nivel_critico"].'">'.$value["descripcion"].'</option>';
                      }
                      ?>

                    </select>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  
                  <label for="idSesionCritico">Sesion:</label>  

                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <select class="form-control input-lg" name="idSesionCritico" id="idSesionCritico">
                    </select>

                  </div>

                </div>

              </div>   

              <div class="col-md-12">

                <div class="form-group">

                  <label for="PreguntasCritico"><button class="btn btn-info" type="button" onclick="agregarPregunta('Critico');"><i class="fa fa-plus"></i></button> Preguntas:</label>
                  <input type="hidden" name="txtListaCritico" id="txtListaCritico" />
                  <table class="table table-bordered table-striped">
                  
                      <thead>
                        <tr>
                          <th class="text-center">Tipo Preg.</th>
                          <th class="text-center">Pregunta</th>
                          <th class="text-center">Descripcion</th>
                          <th class="text-center">Respuesta</th>
                          <th class="text-center">Puntaje</th>
                        </tr>
                      </thead>
                      <tbody id="tbCritico">
                      </tbody>
                  </table>
                  
                </div>

              </div>   

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Examen</button>

        </div>

        <?php

          $contExamen = new ControladorExamen();
          $contExamen -> ctrCrearExamen();
          $contExamen -> ctrEditarExamen();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarExamen = new ControladorExamen();
          $borrarExamen -> ctrBorrarExamen();

        ?>
