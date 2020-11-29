 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Calificacion
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Calificacion</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalCalificacion" onclick="$('#accion').val('NuevoCalificacion');$('#titleCalificacion').html('Agregar Calificacion');">
         Agregar Calificacion
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Letra</th>
           <th>Valor Minimo</th>
           <th>Valor Maximo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $calificacion = ControladorCalificacion::ctrMostrarCalificacion($item, $valor);
        $c=0;
       foreach ($calificacion as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["letra"].'</td>
                  <td>'.$value["valor_minimo"].'</td>
                  <td>'.$value["valor_maximo"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarCalificacion" idCalificacion="'.$value["id_calificacion"].'" data-toggle="modal" data-target="#modalCalificacion"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarCalificacion" idCalificacion="'.$value["id_calificacion"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR CALIFICACION
======================================-->

<div id="modalCalificacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoCalificacion" />
        <input type="hidden" id="idCalificacion" name="idCalificacion" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleCalificacion">Agregar Calificacion</h4>

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

                <input type="text" class="form-control input-lg" name="letra" id="letra" placeholder="Ingresar letra" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="number" class="form-control input-lg" name="valorMinimo" id="valorMinimo" placeholder="Ingresar valor minimo" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="number" class="form-control input-lg" name="valorMaximo" id="valorMaximo" placeholder="Ingresar valor maximo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Calificacion</button>

        </div>

        <?php

          $contCalificacion = new ControladorCalificacion();
          $contCalificacion -> ctrCrearCalificacion();
          $contCalificacion -> ctrEditarCalificacion();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarCalificacion = new ControladorCalificacion();
          $borrarCalificacion -> ctrBorrarCalificacion();

        ?>
