 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Sesiones
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Sesiones</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalSesion" onclick="$('#accion').val('NuevoSesion');$('#titleSesion').html('Agregar Sesion');">
         Agregar Sesion
      </button>

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
           <th>Duracion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "id_usuario";
        $valor = $_SESSION["id"];

        $sesion = ControladorSesion::ctrMostrarSesion($item, $valor);
        $c=0;
       foreach ($sesion as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["unidad"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.str_replace("\n","<br />",$value["competencias"]).'</td>
                  <td>'.str_replace("\n","<br />",$value["capacidades"]).'</td>
                  <td>'.$value["intervalo_puntaje_capacidades"].'</td>
                  <td>'.$value["duracion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarSesion" idSesion="'.$value["id_sesion"].'" data-toggle="modal" data-target="#modalSesion"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarSesion" idSesion="'.$value["id_sesion"].'"><i class="fa fa-times"></i></button>

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
                  <?php $tema = ControladorUnidad::ctrMostrarUnidad("id_usuario", $_SESSION["id"]);
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

                <select class="form-control input-lg" name="descripcion" id="descripcion">
                  <option value="">Selecciona Sesion</option>
                  <?php $tema = ControladorSesion::ctrMostrarSesion2(null, null);
                  foreach ($tema as $key => $value){
                    echo '<option value="'.$value["descripcion"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select name="competencias" id="competencias" class="form-control input-lg">
                  <option value="">Seleccione Competencia</option>
                  <option value="Lee diversos tipos de textos escritos en su lengua materna">Lee diversos tipos de textos escritos en su lengua materna</option>
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg" name="capacidades" id="capacidades">
                  <option value="">Seleccione Capacidad</option>
                  <?php
                  $rs = ControladorUnidad::ctrMostrarCapacidades(null,null);
                  foreach($rs as $k=>$v){
                    echo "<option value='".$v["idcapacidades"]."'>".$v["nombre"]."</option>";
                  }
                  ?>
                
                </select>

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

          <button type="submit" class="btn btn-primary">Guardar Sesion</button>

        </div>

        <?php

          $contSesion = new ControladorSesion();
          $contSesion -> ctrCrearSesion();
          $contSesion -> ctrEditarSesion();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarSesion = new ControladorSesion();
          $borrarSesion -> ctrBorrarSesion();

        ?>
