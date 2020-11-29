 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Lecturas
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Lecturas</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalLectura" onclick="$('#accion').val('NuevoLectura');$('#titleLectura').html('Agregar Lectura');">
         Agregar Lectura
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
          <!--  <th>Unidad</th> -->
           <th>Sesion</th>
           <th>Tema</th>
           <th>Nombre</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = "id_usuario";
        $valor = $_SESSION["id"];

        $lectura = ControladorLectura::ctrMostrarLectura($item, $valor);
        $c=0;
       foreach ($lectura as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["sesion"].'</td>
                  <td>'.$value["tema"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td><button class="btn btn-info btnArchvio" type="button" onclick="window.open(\''.$value["archivo"].'\',\'_blank\')"><i class="fa fa-file"></i></button></td>';       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarLectura" idLectura="'.$value["id_lectura"].'" data-toggle="modal" data-target="#modalLectura"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarLectura" idLectura="'.$value["id_lectura"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR LECTURA
======================================-->

<div id="modalLectura" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoLectura" />
        <input type="hidden" id="idLectura" name="idLectura" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleLectura">Agregar Lectura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

              <div class="form-group">

              <div class="input-group"> 
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idSesion" id="idSesion" onchange="generarTema(this.value,0);">
                  <option value="">Selecciona Sesion</option>
                  <?php $sesion = ControladorSesion::ctrMostrarSesion3(null, null);
                  foreach ($sesion as $key => $value){
                    echo '<option value="'.$value["id_sesion"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>
            
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idTemaa" id="idTemaa">
                  <option value="0">Selecciona Tema</option>
                </select>

              </div>

            </div>

          
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre lectura" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="hidden" id="archivoAnterior" name="archivoAnterior" value="" />
                <input type="file" class="form-control input-lg" name="archivo" id="archivo" placeholder="Seleccionar archivo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Lectura</button>

        </div>

        <?php

          $contLectura = new ControladorLectura();
          $contLectura -> ctrCrearLectura();
          $contLectura -> ctrEditarLectura();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarLectura = new ControladorLectura();
          $borrarLectura -> ctrBorrarLectura();

        ?>
