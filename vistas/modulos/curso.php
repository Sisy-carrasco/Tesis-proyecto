 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Curso
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Curso</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalCurso" onclick="$('#accion').val('NuevoCurso');$('#titleCurso').html('Agregar Curso');">
         Agregar Curso
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Grado</th>
           <th>Nombre</th>
           <!--th>Descripcion</th-->
           <th>Foto</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $curso = ControladorCurso::ctrMostrarCurso($item, $valor);
        $c=0;
       foreach ($curso as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["grado"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <!--td>'.$value["descripcion"].'</td-->';  
                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="60px"></td>';

                  }          
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarCurso" idCurso="'.$value["id_curso"].'" data-toggle="modal" data-target="#modalCurso"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarCurso" idCurso="'.$value["id_curso"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR Curso
======================================-->

<div id="modalCurso" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoCurso" />
        <input type="hidden" id="idCurso" name="idCurso" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleCurso">Agregar Curso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idGrado" id="idGrado">
                  <option value="">Seleccionar Grado</option>
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

                <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <div class="form-group" style="display:none">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <textarea class="form-control input-lg" name="descripcion" id="descripcion" placeholder="Ingresar descripcion" required></textarea>

              </div>

            </div>

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="fot" name="foto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Curso</button>

        </div>

        <?php

          $contCurso = new ControladorCurso();
          $contCurso -> ctrCrearCurso();
          $contCurso -> ctrEditarCurso();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarCurso = new ControladorCurso();
          $borrarCurso -> ctrBorrarCurso();

        ?>
