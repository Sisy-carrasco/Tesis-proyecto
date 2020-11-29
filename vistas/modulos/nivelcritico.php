 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Nivel Critico
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">AdministrarNivel Critico</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalNivelcritico" onclick="$('#accion').val('NuevoNivelcritico');$('#titleNivelcritico').html('Agregar Nivel Critico');">
         Agregar Nivel Critico
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

        $tipo = ControladorNivelcritico::ctrMostrarNivelcritico($item, $valor);
        $c=0;
       foreach ($tipo as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["descripcion"].'</td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarNivelcritico" idNivelcritico="'.$value["id_nivel_critico"].'" data-toggle="modal" data-target="#modalNivelcritico"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarNivelcritico" idNivelcritico="'.$value["id_nivel_critico"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR Nivelcritico
======================================-->

<div id="modalNivelcritico" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoNivelcritico" />
        <input type="hidden" id="idNivelcritico" name="idNivelcritico" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleNivelcritico">Agregar Tipo de Pregunta</h4>

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

          <button type="submit" class="btn btn-primary">Guardar Nivel Critico</button>

        </div>

        <?php

          $contNivelcritico = new ControladorNivelcritico();
          $contNivelcritico -> ctrCrearNivelcritico();
          $contNivelcritico -> ctrEditarNivelcritico();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarNivelcritico = new ControladorNivelcritico();
          $borrarNivelcritico -> ctrBorrarNivelcritico();

        ?>
