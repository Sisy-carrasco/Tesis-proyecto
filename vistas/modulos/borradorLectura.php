<div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idUnidad" id="idUnidad" onchange="generarTema(this.value,'');">
                  <option value="">Seleccion Unidad</option>
                  <?php $unidad = ControladorUnidad::ctrMostrarUnidad("id_usuario", $_SESSION["id"]);
                  foreach ($unidad as $key => $value){
                    echo '<option value="'.$value["id_unidad"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="idSesion" id="idSesion">
                  <option value="">Seleccion Sesion</option>
                  <?php $sesion = ControladorSesion::ctrMostrarSesion("id_usuario", $_SESSION["id"]);
                  foreach ($sesion as $key => $value){
                    echo '<option value="'.$value["id_sesion"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>

              </div>

            </div>

              <select class="form-control input-lg" name="idTema" id="idTema">
                  <option value="">Seleccione Tema</option>
                </select>

                 <select class="form-control input-lg" name="idTema" id="idTema">
                  <option value="">Selecciona Tema</option>
                  <?php $seccion = ControladorTema::ctrMostrarTema("id_usuario", $_SESSION["id"]);
                  foreach ($seccion as $key => $value){
                    echo '<option value="'.$value["id_tema"].'">'.$value["descripcion"].'</option>';
                  }
                  ?>
                </select>


                <div class="btn-group">
                      <button class="btn btn-warning btnEditarUnidad" idUnidad="'.$value["id_unidad"].'" data-toggle="modal" data-target="#modalUnidad"><i class="fa fa-pencil"></i></button>
                    </div>


                      <div class="btn-group">
                      <button class="btn btn-danger btnEliminarUnidad" idUnidad="'.$value["id_unidad"].'"><i class="fa fa-times"></i></button>

                    </div>