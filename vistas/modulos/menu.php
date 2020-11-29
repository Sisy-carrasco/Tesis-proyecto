<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">
			<?php if($_SESSION["perfil"]=="Administrador"){ ?>
			<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-crop"></i>
					
					<span>Mantenimientos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<!--li>

						<a href="grado">
							
							<i class="fa fa-circle-o"></i>
							<span>Grado</span>

						</a>

					</li>

					<li>

						<a href="seccion">
							
							<i class="fa fa-circle-o"></i>
							<span>Seccion</span>

						</a>

					</li>

					<li>

						<a href="tipopregunta">
							
							<i class="fa fa-circle-o"></i>
							<span>Tipo de Pregunta</span>

						</a>

					</li-->

					<!--li>
						<a href="calificacion">

							<i class="fa fa-circle-o"></i>
							<span>Calificaciones</span>

						</a>

					</li-->

					<li>

						<a href="usuarios">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrador</span>

						</a>

					</li>

					<li>

						<a href="profesor">
							
							<i class="fa fa-circle-o"></i>
							<span>Docente</span>

						</a>

					</li>

					<li>

						<a href="alumno">
							
							<i class="fa fa-circle-o"></i>
							<span>Estudiante</span>

						</a>

					</li>

				</ul>

			</li>

			<!--li class="treeview">

				<a href="#">

					<i class="fa fa-file"></i>
					
					<span>Cursos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="curso">

							<i class="fa fa-circle-o"></i>
							<span>Cursos</span>

						</a>

					</li>

				</ul>

			</li-->

			<!--li class="treeview">

				<a href="#">

					<i class="fa fa-file"></i>
					
					<span>Niveles</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="nivelliteral">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Literal</span>

						</a>

						</li>

						<li>

						<a href="nivelinferencial">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Inferencial</span>

						</a>

						</li>

						<li>

						<a href="nivelcritico">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Crítico</span>

						</a>

					</li>

				</ul>

			</il-->

			<li>

				<a href="matricula">

					<i class="fa fa-file"></i>
					<span>Gestionar Matricula</span>

				</a>

			</li>

			<li>

				<a href="asignacionmatricula">

					<i class="fa fa-file"></i>
					<span>Asignar Docente</span>

				</a>

			</li>

			<li>
				<a href="Reportes">

					<i class="fa fa-users"></i>
					<span>Reportes</span>

				</a>

			</li>

			<? }elseif($_SESSION["perfil"]=="Profesor"){?>

			<!--li class="treeview">

				<a href="#">

					<i class="fa fa-crop"></i>
					
					<span>Mantenimientos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="grado">
							
							<i class="fa fa-circle-o"></i>
							<span>Grado</span>

						</a>

					</li>

					<li>

						<a href="seccion">
							
							<i class="fa fa-circle-o"></i>
							<span>Seccion</span>

						</a>

					</li>

					<li>

						<a href="tipopregunta">
							
							<i class="fa fa-circle-o"></i>
							<span>Tipo de Pregunta</span>

						</a>

					</li-->

					<!--li>
						<a href="calificacion">

							<i class="fa fa-circle-o"></i>
							<span>Calificaciones</span>

						</a>

					</li>

				</ul>

			</li-->

			<li class="treeview">

				<a href="#">

					<i class="fa fa-file"></i>
					
					<span>Cursos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="unidad">
							
							<i class="fa fa-circle-o"></i>
							<span>Unidad</span>

						</a>

					</li>
					<!-- 
					<li>

						<a href="tema">
							
							<i class="fa fa-circle-o"></i>
							<span>Tema</span>

						</a>

					</li>
 -->
					<!-- <li>

						<a href="sesion">
							
							<i class="fa fa-circle-o"></i>
							<span>Sesion</span>

						</a>

					</li> -->

					<li>

						<a href="lectura">
							
							<i class="fa fa-circle-o"></i>
							<span>Lectura</span>

						</a>

					</li>

					<li>

						<a href="examen">

							<i class="fa fa-circle-o"></i>
							<span>Examenes</span>

						</a>

					</li>

				</ul>

			</li>

			<!--li class="treeview">

				<a href="#">

					<i class="fa fa-file"></i>
					
					<span>Niveles</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="nivelliteral">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Literal</span>

						</a>

						</li>

						<li>

						<a href="nivelinferencial">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Inferencial</span>

						</a>

						</li>

						<li>

						<a href="nivelcritico">
							
							<i class="fa fa-circle-o"></i>
							<span>Nivel Crítico</span>

						</a>

					</li>

				</ul>
				
			</il-->

			<li>
				<a href="examenresueltoalumno">

					<i class="fa fa-users"></i>
					<span>Reporte de Notas</span>

				</a>

			</li>

			<? }elseif($_SESSION["perfil"]=="Alumno"){?>

				<li class="treeview">

					<a href="#">

						<i class="fa fa-file"></i>
						
						<span>Cursos</span>
						
						<span class="pull-right-container">
						
							<i class="fa fa-angle-left pull-right"></i>

						</span>

					</a>

					<ul class="treeview-menu">

						<li>

							<a href="unidadalumno">
								
								<i class="fa fa-circle-o"></i>
								<span>Unidades</span>

							</a>

						</li>

						<li>

							<a href="sesionalumno">
								
								<i class="fa fa-circle-o"></i>
								<span>Sesiones</span>

							</a>

						</li>

						<li>

							<a href="lecturaalumno">
								
								<i class="fa fa-circle-o"></i>
								<span>Lecturas</span>

							</a>

						</li>

						<li>

							<a href="matriculaalumno">
								
								<i class="fa fa-circle-o"></i>
								<span>Matricula</span>

							</a>

						</li>

						<li>

							<a href="examenalumno">

								<i class="fa fa-circle-o"></i>
								<span>Examenes</span>

							</a>

						</li>

					</ul>

				</li>

			<? }?>
		</ul>
		

	 </section>

</aside>