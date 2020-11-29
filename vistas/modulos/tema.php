 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Temas
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Temas</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <!--button class="btn btn-primary" data-toggle="modal" data-target="#modalTema" onclick="$('#accion').val('NuevoTema');$('#titleTema').html('Agregar Tema');">
         Agregar Tema
      </button-->

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Unidad</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "id_usuario";
        $valor = $_SESSION["id"];

        $tema = ControladorTema::ctrMostrarTema($item, $valor);
        $c=0;
       foreach ($tema as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.$value["unidad"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarTema" idTema="'.$value["id_tema"].'" data-toggle="modal" data-target="#modalTema"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarTema" idTema="'.$value["id_tema"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR TEMA
======================================-->

<div id="modalTema" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoTema" />
        <input type="hidden" id="idTema" name="idTema" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleTema">Agregar Tema</h4>

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

                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre del tema" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idUnidad" id="idUnidad">
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

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Tema</button>

        </div>

        <?php

          $contTema = new ControladorTema();
          $contTema -> ctrCrearTema();
          $contTema -> ctrEditarTema();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarTema = new ControladorTema();
          $borrarTema -> ctrBorrarTema();

        ?>
