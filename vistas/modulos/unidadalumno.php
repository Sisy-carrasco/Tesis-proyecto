 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar contenido del curso
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Unidad</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Descripcion</th>
           <th>Competencias</th>
           <th>Capacidades</th>
           <th>Semestre</th>
           <th>Numero</th>
           <th>Duracion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $alumno = ControladorAlumno::ctrMostrarAlumno("id_usuario",$_SESSION["id"]);

        $matricula = ControladorMatricula::ctrMostrarMatricula("id_alumno",$alumno["id_alumno"]);

        $detalle = ControladorMatricula::ctrMostrarDetalleMatricula("id_seccion",$matricula["id_seccion"]);

        $unidad = ControladorUnidad::ctrMostrarUnidad(null,null);
        $c=0;
       foreach ($unidad as $key => $value){
        if($detalle["id_profesor"]==$value["id_profesor"]){ 
          $c=$c+1;
          // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.str_replace("\n","<br />",$value["competencias"]).'</td>
                  <td>'.str_replace("\n","<br />",$value["capacidades"]).'</td>
                  <td>'.$value["semestre"].'</td>
                  <td>'.$value["numero"].'</td>
                  <td>'.$value["duracion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-info btnMostrarUnidad" idUnidad="'.$value["id_unidad"].'" data-toggle="modal" data-target="#modalUnidad"><i class="fa fa-eye"></i></button>
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
MODAL AGREGAR UNIDAD
======================================-->

<div id="modalUnidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoUnidad" />
        <input type="hidden" id="idUnidad" name="idUnidad" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleUnidad">Agregar Unidad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="descripcion" id="descripcion" placeholder="Ingresar descripcion unidad" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <textarea class="form-control input-lg" name="competencias" id="competencias" placeholder="Ingresar competencias" required></textarea>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <textarea class="form-control input-lg" name="capacidades" id="capacidades" placeholder="Ingresar capacidades" required></textarea>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="semestre" id="semestre" placeholder="Ingresar semestre" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="number" class="form-control input-lg" name="numero" id="numero" placeholder="Ingresar numero" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                
                <input type="hidden" name="idTema" id="idTema" value="0" />
                <input type="text" class="form-control input-lg" name="tema" id="tema" placeholder="Ingresar tema" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="duracion" id="duracion" placeholder="Ingresar duracion" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

        </form>

    </div>

  </div>

</div>