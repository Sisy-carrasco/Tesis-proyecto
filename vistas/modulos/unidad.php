 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mostrar unidades
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Unidad</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

     <!--  <button class="btn btn-primary" data-toggle="modal" data-target="#modalUnidad" onclick="$('#accion').val('NuevoUnidad');$('#titleUnidad').html('Agregar Unidad');">
          Unidades
      </button> -->

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
           <th>Semestre</th>
           <th>Duracion</th>
           <th>Estado</th>
          <th>Ultimo login</th>


         </tr> 

        </thead>

        <tbody>





        
        <?php

        $item = null;
        $valor = null;

        $unidad = ControladorSesion::ctrMostrarSesion($item, $valor);
        $c=0;
       foreach ($unidad as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["unidad"].'</td>
                  <td>'.$value["descripcion"].'</td>
                  <td>'.$value["competencias"].'</td>
                  <td>'.$value["capacidades"].'</td>
                  <td>'.$value["bimestre"].'</td>
                  <td>'.$value["duracion"].'</td>';  
                   if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUnidad="'.$value["id"].'" estadoUnidad="0">Activado</button></td>';

                  }else{
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUnidad="'.$value["id"].'" estadoUnidad="1">Desactivado</button></td>';

                  }
                  echo '<td>'.$value["ultimo_login"].'</td>         
                  <td>

                    
                  
                   

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

          <h4 class="modal-title" id="titleUnidad">Iniciar Unidad</h4>

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

                <!-- <select class="form-control input-lg" name="descripcion" id="descripcion"> -->
                   <select class="form-control input-lg" name="idUnidad" id="idUnidad" onchange="generarSesion(this.value,0);">
                <option value="">Seleccione Unidad</option>
                  <?php 

                  $unidad = ControladorSesion::ctrMostrarSesion2(null,null);
                  foreach($unidad as $key=>$value){
                    echo "<option value='".$value["id_unidad"]."'>".$value["descripcion"]."</option>";
                  }
                  ?>
                </select>

              </div>

            </div>
              <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
      

                <select class="form-control input-lg" name="idSesion" id="idSesion">
                  <option value="0">Selecciona Sesion</option>
                </select>

          

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                
                <input type="hidden" name="idTema" id="idTema" value="0" />
                <select class="form-control input-lg" name="tema" id="tema">
                  <option value="">Seleccione Tema</option>
                  <?php
                  $rs = ControladorTema::ctrMostrarTema(null,null);

                  foreach ($rs as $key => $value) {
                      echo "<option value='".$value["idSesion"]."'>".$value["descripcion"]."</option>";
                  }
                   ?>
               
                
                
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg" name="competencias" id="competencias">
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
                  $rs = ControladorSesion::ctrMostrarCapacidades(null,null);
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

                <select class="form-control input-lg" name="semestre" id="semestre">
                  <option value="">Seleccione Bimestre</option>
                  <?php
                  $rs = ControladorUnidad::ctrMostrarBimestre(null,null);
                  foreach($rs as $k=>$v){
                    echo "<option value='".$v["idbimestre"]."'>".$v["nombre"]."</option>";
                  }
                  ?>
                </select>

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

          <button type="submit" class="btn btn-primary">Guardar Unidad</button>

        </div>

        <?php

          $contUnidad = new ControladorSesion();
          $contUnidad -> ctrCrearSesion();
          //$contUnidad -> ctrEditarUnidad();

          //$contSesion = new ControladorSesion();
         // $contSesion -> ctrCrearSesion();
          //$contSesion -> ctrEditarSesion();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarUnidad = new ControladorSesion();
          $borrarUnidad -> ctrBorrarSesion();

           //$borrarSesion = new ControladorSesion();
         // $borrarSesion -> ctrBorrarSesion();


        ?>
