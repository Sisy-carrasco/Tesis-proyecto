 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Seccion
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Seccion</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalSeccion" onclick="$('#accion').val('NuevoSeccion');$('#titleSeccion').html('Agregar Seccion');">
         Agregar Seccion
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Grado</th>
           <th>Nombre</th>
           <th>Descripcion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $seccion = ControladorSeccion::ctrMostrarSeccion($item, $valor);
        $c=0;
       foreach ($seccion as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["grado"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["descripcion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarSeccion" idSeccion="'.$value["id_seccion"].'" data-toggle="modal" data-target="#modalSeccion"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarSeccion" idSeccion="'.$value["id_seccion"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR SECCION
======================================-->

<div id="modalSeccion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoSeccion" />
        <input type="hidden" id="idSeccion" name="idSeccion" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleSeccion">Agregar Seccion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idGrado" id="idGrado">
                  <option value="">Seleccion Grado</option>
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
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre seccion" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="descripcion" id="descripcion" placeholder="Ingresar descripcion" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Seccion</button>

        </div>

        <?php

          $contSeccion = new ControladorSeccion();
          $contSeccion -> ctrCrearSeccion();
          $contSeccion -> ctrEditarSeccion();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarSeccion = new ControladorSeccion();
          $borrarSeccion -> ctrBorrarSeccion();

        ?>
