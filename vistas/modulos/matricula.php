 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar matricula
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Gestionar Matricula</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalMatricula" onclick="$('#accion').val('NuevoMatricula');$('#titleMatricula').html('Agregar Matricula');">
         Agregar Matricula
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Grado</th>
           <th>Seccion</th>
           <th>Alumno</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $matricula = ControladorMatricula::ctrMostrarMatricula($item, $valor);
        $c=0;
       foreach ($matricula as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["grado"].'</td>
                  <td>'.$value["seccion"].'</td>
                  <td>'.$value["alumno"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarMatricula" idMatricula="'.$value["id_matricula"].'" data-toggle="modal" data-target="#modalMatricula"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarMatricula" idMatricula="'.$value["id_matricula"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
        }


        ?> 

        </tbody>

       </table>


        </div>
    
      </div>


    </section>

  </div>
<!--=====================================
MODAL AGREGAR MATRICULA
======================================-->

<div id="modalMatricula" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoMatricula" />
        <input type="hidden" id="idMatricula" name="idMatricula" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleMatricula">Agregar Matricula</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              <div class="input-group"> 
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idGrado" id="idGrado" onchange="generarSeccion(this.value,0);">
                  <option value="">Selecciona Grado</option>
                  <?php $grado = ControladorGrado::ctrMostrarGrado(null, null);
                  foreach ($grado as $key => $value){
                    echo '<option value="'.$value["id_grado"].'">'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

          '      <select class="form-control input-lg" name="idSeccion" id="idSeccion" onchange="generarProfesorMatricula(this.value,0);">
                            <option value="0">Selecciona Seccion</option>
                          </select>'

              </div>

            </div>

            <div class="form-group" style="display:none;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idCurso" id="idCurso">
                  <option value="0">Selecciona Curso</option>
                  <?php $curso = ControladorCurso::ctrMostrarCurso(null, null);
                  foreach ($curso as $key => $value){
                    echo '<option value="'.$value["id_curso"].'">'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group" style="display:none;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idProfesor" id="idProfesor">
                  <option value="0">Selecciona Docente</option>
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idAlumno" id="idAlumno">
                  <option value="">Selecciona Estudiante</option>
                  <?php $alumno = ControladorAlumno::ctrMostrarAlumno(null, null);
                  foreach ($alumno as $key => $value){
                    echo '<option value="'.$value["id_alumno"].'">'.$value["nombres_completos"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>
            
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Matricula</button>

        </div>

        <?php

          $contMatricula = new ControladorMatricula();
          $contMatricula -> ctrCrearMatricula();
          $contMatricula -> ctrEditarMatricula();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarMatricula = new ControladorMatricula();
          $borrarMatricula -> ctrBorrarMatricula();

        ?>
