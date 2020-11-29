 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Nivel literal
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">AdministrarNivel literal</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalNivelliteral" onclick="$('#accion').val('NuevoNivelliteral');$('#titleNivelliteral').html('Agregar Nivel literal');">
         Agregar Nivel literal
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Descripcion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $tipo = ControladorNivelliteral::ctrMostrarNivelliteral($item, $valor);
        $c=0;
       foreach ($tipo as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["descripcion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarNivelliteral" idNivelliteral="'.$value["id_nivel_literal"].'" data-toggle="modal" data-target="#modalNivelliteral"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarNivelliteral" idNivelliteral="'.$value["id_nivel_literal"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR Nivelliteral
======================================-->

<div id="modalNivelliteral" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoNivelliteral" />
        <input type="hidden" id="idNivelliteral" name="idNivelliteral" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleNivelliteral">Agregar Tipo de Pregunta</h4>

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

          <button type="submit" class="btn btn-primary">Guardar Nivel literal</button>

        </div>

        <?php

          $contNivelliteral = new ControladorNivelliteral();
          $contNivelliteral -> ctrCrearNivelliteral();
          $contNivelliteral -> ctrEditarNivelliteral();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarNivelliteral = new ControladorNivelliteral();
          $borrarNivelliteral -> ctrBorrarNivelliteral();

        ?>
