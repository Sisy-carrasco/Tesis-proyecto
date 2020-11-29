 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reporte de Notas
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
       
        <li class="active">Reporte de Notas</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        

      <div class="box-header with-border">

       </div>

        <div class="box-body">
        
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th class="text-center">Alumno</th>
           <th class="text-center">Grado</th>
           <th class="text-center">Seccion</th>
           <th class="text-center">Curso</th>
           <th class="text-center">Unidad</th>
           <th class="text-center">Tema</th>
           <th class="text-center">Lectura</th>
           <th class="text-center">Nombre</th>
           <th class="text-center">Fecha Inicio</th>
           <th class="text-center">Fecha Fin</th>
           <th class="text-center">Tiempo(min)</th>
           <th class="text-center">Calificativo</th>
           <th class="text-center">Nivel Critico</th>
           <th class="text-center">Nivel Inferencial</th>
           <th class="text-center">Nivel Literal</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $examen = ControladorExamen::ctrMostrarExamenAlumno(0);
        $c=0;
       foreach ($examen as $key => $value){
         if($value["id_usuario"]==$_SESSION["id"]){
          $tiempo='';
          if($value["fecha_literales"]!=""){
            $tiempo = $tiempo + $value["fecha_literales"]/ (60);
          }
          if($value["fecha_inferenciales"]!=""){
            $tiempo = $tiempo + $value["fecha_inferenciales"]/ (60);
          }
          if($value["fecha_criticas"]!=""){
            $tiempo = $tiempo + $value["fecha_criticas"]/ (60);
          }
          $c=$c+1;
          echo ' <tr>
                  <td>'.$c.'</td>
                  <td>'.$value["alumno"].'</td>
                  <td>'.$value["grado"].'</td>
                  <td>'.$value["seccion"].'</td>
                  <td>'.$value["curso"].'</td>
                  <td>'.$value["unidad"].'</td>
                  <td>'.$value["tema"].'</td>
                  <td>'.$value["lectura"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["fecha_inicio"].'</td>
                  <td>'.$value["fecha_fin"].'</td>
                  <td>'.$tiempo.'</td>
                  <td>'.($value["puntajeliteral"]>0?($value["puntajeliteral"]+$value["puntajeinferencial"]+$value["puntajecritico"]):'-').'</td>'; 
                   
                  if($value["literales"]=="0"){
                    echo '<td> <div class="btn-group">
                      <button class="btn btn-info" type="button"><i class="fa fa-check"></i>Sin Resolver Literal</button>
                      </div>
                    </td>';
                  }else{
                    $color = ($value["puntajeliteral"]/$value["totalliteral"])*100>60?'success':'danger';
                    echo '<td><button class="btn btn-warning" type="button" onclick="verExamen(\'Literal\','.$value["id_examen"].');" data-toggle="modal" data-target="#modalExamen">Finalizado</button><hr />
                        <button class="btn btn-'.$color.'" type="button">Puntaje: '.$value["puntajeliteral"].'/'.$value["totalliteral"].'</button></td>';
                  }

                  if($value["literales"]>0 && $value["inferenciales"]=="0" && ($value["puntajeliteral"]/$value["totalliteral"])*100>60){
                    echo '<td>
                      <div class="btn-group">
                        <button class="btn btn-info" type="button"><i class="fa fa-check"></i>Sin Resolver Inferencial</button>
                      </div>
                      </td>';
                  }elseif($value["inferenciales"]=="0"){
                    echo '<td><button class="btn btn-danger" type="button">No Disponible</button></td>';
                  }else{
                    $color = ($value["puntajeinferencial"]/$value["totalinferencial"])*100>60?'success':'danger';
                    echo '<td><button class="btn btn-warning" type="button" onclick="verExamen(\'Inferencial\','.$value["id_examen"].');" data-toggle="modal" data-target="#modalExamen">Finalizado</button><hr />
                    <button class="btn btn-'.$color.'" type="button">Puntaje: '.$value["puntajeinferencial"].'/'.$value["totalinferencial"].'</button></td>';
                  }

                  if($value["inferenciales"]>0 && $value["criticas"]=="0" && ($value["puntajeinferencial"]/$value["totalinferencial"])*100>60){
                    echo '<td>
                      <div class="btn-group">
                        <button class="btn btn-info"><i class="fa fa-check"></i>Sin Resolver Critico</button>
                      </div>
                      </td>';
                  }elseif($value["criticas"]=="0"){
                    echo '<td><button class="btn btn-danger" type="button">No Disponible</button></td>';
                  }else{
                    $color = ($value["puntajecritico"]/$value["totalcritico"])*100>60?'success':'danger';
                    echo '<td><button class="btn btn-warning" type="button" onclick="verExamen(\'Critico\','.$value["id_examen"].');" data-toggle="modal" data-target="#modalExamen">Finalizado</button><hr />
                    <button class="btn btn-'.$color.'" type="button">Puntaje: '.$value["puntajecritico"].'/'.$value["totalcritico"].'</button></td>';
                  }

                echo '</tr>';
         }
        }


        ?> 

        </tbody>

       </table>


        </div>
    
      </div>


    </section>

  </div>
<!--=====================================
MODAL AGREGAR EXAMEN
======================================-->

<div id="modalExamen" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:80%;">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <input type="hidden" id="accion" name="accion" value="ReiniciarExamen" />
        <input type="hidden" id="idExamen" name="idExamen" value="0" />
        <input type="hidden" id="tabla" name="tabla" value="" />

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="titleExamen"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

              <div class="col-md-6">

                <div class="form-group">

                  <label for="fecha_inicio">Examen:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control input-lg" name="nombre" id="nombre" placeholder="Ingresar nombre examen" readonly="">

                  </div>

                </div>
              
              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="fecha_inicio">Fecha Inicio:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="text" class="form-control input-lg" name="fecha_inicio" id="fecha_inicio" placeholder="Ingresar fecha inicio" required readonly="">

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="fecha_fin">Fecha Fin:</label>
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                    <input type="text" class="form-control input-lg" name="fecha_fin" id="fecha_fin" placeholder="Ingresar fecha fin" required readonly="">

                  </div>

                </div>

              </div>

            </div>

            <div class="row">

              <div class="col-md-6"> 

                <div class="form-group">

                  <label for="lectura">Lectura:</label>  
                  
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                    <input type="text" class="form-control input-lg" name="lectura" id="lectura" value="" readonly="">

                  </div>

                </div>

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label for="fecha_fin">Archivo:</label>
                  
                  <div class="input-group">

                    <button id="btnLectura" onclick="" type="button"><i class="fa fa-file"></i></button>

                  </div>

                </div>

              </div>

            </div>
            
            <hr />
            
            <div class="row"> 

              <div class="col-md-12">

                <div class="form-group" id="divDetalle">

                  
                </div>

              </div>   

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="btnReiniciarExamen">Reiniciar Examen</button>

        </div>

        <?php

          $contExamen = new ControladorExamen();
          $contExamen -> ctrReiniciarExamen();

        ?>

        </form>

    </div>

  </div>

</div>