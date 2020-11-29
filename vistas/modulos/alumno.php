 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Estudiante
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Administrar Estudiante</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAlumno" onclick="$('#accion').val('NuevoAlumno');$('#titleAlumno').html('Agregar Estudiante');$('.usuario').css('display','');">
         Agregar Estudiante
      </button>

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombres Completos</th>
           <th>DNI</th>
           <th>Direccion</th>
           <th>Fecha Nac.</th>
           <th>Sexo</th>
           <th>Foto</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $alumno = ControladorAlumno::ctrMostrarAlumno($item, $valor);
        $c=0;
        foreach ($alumno as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["nombres_completos"].'</td>
                  <td>'.$value["dni"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["fecha_nacimiento"].'</td>
                  <td>'.($value["sexo"]=="1"?"Masculino":"Femenino").'</td>';
                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="60px"></td>';

                  }       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarAlumno" idAlumno="'.$value["id_alumno"].'" data-toggle="modal" data-target="#modalAlumno"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarAlumno" idAlumno="'.$value["id_alumno"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR ALUMNO
======================================-->

<div id="modalAlumno" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoAlumno" />
        <input type="hidden" id="idAlumno" name="idAlumno" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleAlumno">Agregar Estudiante</h4>

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

                <input type="text" class="form-control input-lg" name="nombres" id="nombres" placeholder="Ingrese Nombres" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="apellidos" id="apellidos" placeholder="Ingrese Apellidos" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="dni" id="dni" placeholder="Ingresar DNI" required maxlength="8">

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="direccion" id="direccion" placeholder="Ingresar direccion" required>

              </div>

            </div>

            <div class="form-group">

              <label for="fecha_nacimiento">Fecha Nacimiento:</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="date" class="form-control input-lg" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingresar Fecha Nac." required onblur="validarFechaAlumno(this.value);">

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select id="sexo" name="sexo" class="form-control input-lg">
                  <option value="1">Masculino</option>
                  <option value="2">Femenino</option>
                </select>

              </div>

            </div>

            <div class="form-group usuario">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="usuario" id="usuario" placeholder="Ingresar Usuario" required>

              </div>

            </div>

            <div class="form-group usuario">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Ingresar contraseña" required>

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

          <button type="submit" class="btn btn-primary">Guardar Estudiante</button>

        </div>

        <?php

          $contAlumno = new ControladorAlumno();
          $contAlumno -> ctrCrearAlumno();
          $contAlumno -> ctrEditarAlumno();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarAlumno = new ControladorAlumno();
          $borrarAlumno -> ctrBorrarAlumno();

        ?>
