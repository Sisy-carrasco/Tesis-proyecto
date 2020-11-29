 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sesiones
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Sesiones</li>
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
           <th>Unidad</th>
           <th>Descripcion</th>
           <th>Competencias</th>
           <th>Capacidades</th>
           <th>Intervalo Puntaje Capacidades</th>
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

        $item = null;
        $valor = null;

        $sesion = ControladorSesion::ctrMostrarSesion($item, $valor);
        $c=0;
       foreach ($sesion as $key => $value){
         if($value["id_profesor"]==$detalle["id_profesor"]){
          $c=$c+1;
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["unidad"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.str_replace("\n","<br />",$value["competencias"]).'</td>
                  <td>'.str_replace("\n","<br />",$value["capacidades"]).'</td>
                  <td>'.$value["intervalo_puntaje_capacidades"].'</td>
                  <td>'.$value["numero"].'</td>
                  <td>'.$value["duracion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-info btnMostrarSesion" idSesion="'.$value["id_sesion"].'" data-toggle="modal" data-target="#modalSesion"><i class="fa fa-eye"></i></button>
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
MODAL AGREGAR SESION
======================================-->

<div id="modalSesion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoSesion" />
        <input type="hidden" id="idSesion" name="idSesion" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleSesion">Agregar Sesion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idUnidad" id="idUnidad">
                  <option value="">Selecciona Unidad</option>
                  <?php $tema = ControladorUnidad::ctrMostrarUnidad(null, null);
                  foreach ($tema as $key => $value){
                    echo '<option value="'.$value["id_unidad"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="descripcion" id="descripcion" placeholder="Ingresar descripcion sesion" required>

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

                <textarea class="form-control input-lg" name="intervalo_puntaje_capacidades" id="intervalo_puntaje_capacidades" placeholder="Ingresar intervalo de puntaje de capacidades" required></textarea>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="number" class="form-control input-lg" name="numero" id="numero" placeholder="Ingresar numero sesion" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="duracion" id="duracion" placeholder="Ingresar duracion sesion" required>

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
