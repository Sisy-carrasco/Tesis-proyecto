 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestionar Profesor
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Gestionar Profesor</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">
      <?php
      $profesor = ControladorProfesor::ctrMostrarProfesor(null, null);
      $zz=0;
      foreach($profesor as $x=>$y){
        $zz=$zz+1;
      }
      if($zz<3){
      ?>
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalProfesor" onclick="$('#accion').val('NuevoProfesor');$('#titleProfesor').html('Agregar Docente');$('.usuario').css('display','');">
         Agregar Docente
      </button>
      <?php
      }
      ?>
       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombres Completos</th>
           <th>Telefono</th>
           <th>DNI</th>
           <th>Direccion</th>
           <th>Fecha Nac.</th>
           <th>Especialidad</th>
           <th>Cedula Profesional</th>
           <th>Foto</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $profesor = ControladorProfesor::ctrMostrarProfesor($item, $valor);
        $c=0;
        foreach ($profesor as $key => $value){$c=$c+1;
        // var_dump($usuarios);
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["nombres_completos"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["dni"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["fecha_nacimiento"].'</td>
                  <td>'.$value["especialidad"].'</td>
                  <td>'.$value["cedula_profesional"].'</td>';
                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="60px"></td>';

                  }       
                  echo '<td>

                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarProfesor" idProfesor="'.$value["id_profesor"].'" data-toggle="modal" data-target="#modalProfesor"><i class="fa fa-pencil"></i></button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEliminarProfesor" idProfesor="'.$value["id_profesor"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR PROFESOR
======================================-->

<div id="modalProfesor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="NuevoProfesor" />
        <input type="hidden" id="idProfesor" name="idProfesor" value="0" />
        <input type="hidden" id="idUsuario" name="idUsuario" value="0" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleProfesor">Agregar Profesor</h4>

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

                <input type="text" class="form-control input-lg" name="telefono" id="telefono" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="dni" id="dni" placeholder="Ingresar DNI" required maxlength="8" onblur="if(this.value.length<8){alert('DNI no tiene los digitos correctos');}">

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

                <input type="date" class="form-control input-lg" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingresar Fecha Nac." required onblur="validarFechaProfesor(this.value);">

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg" name="especialidad" id="especialidad">
                <option value="">Seleccione Especialidad</option>
                <option value="Educación primaria">Educación primaria</option>
                </select>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="cedula_profesional" id="cedula_profesional" placeholder="Ingresar Cedula Profesional" required maxlength="8" onblur="if(this.value.length<8){alert('Cedula no tiene los digitos correctos');}">

              </div>

            </div>

            <div class="form-group" style="display:none;">
              
              <div class="input-group"> 

                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idGrado" id="idGrado" onchange="generarSeccionProfesor(this.value,0);">
                  <option value="">Selecciona Grado</option>
                  <?php $grado = ControladorGrado::ctrMostrarGrado(null, null);
                  foreach ($grado as $key => $value){
                    echo '<option value="'.$value["id_grado"].'">'.$value["nombre"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group" style="display:none;">
              
              <div class="input-group"> 

                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idSeccion" id="idSeccion">
                  <option value="0">Selecciona Seccion</option>
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

          <button type="submit" class="btn btn-primary">Guardar Profesor</button>

        </div>

        <?php

          $contProfesor = new ControladorProfesor();
          $contProfesor -> ctrCrearProfesor();
          $contProfesor -> ctrEditarProfesor();

        ?>

        </form>

    </div>

  </div>

</div>
        <?php

          $borrarProfesor = new ControladorProfesor();
          $borrarProfesor -> ctrBorrarProfesor();

        ?>
