var tabla;
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}
//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#idcategoria_gastos").val("");
}
//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}
//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/categoriagastos.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/categoriagastos.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }
	});
	limpiar();
}
function mostrar(idcategoria_gastos)
{
	$.post("../ajax/categoriagastos.php?op=mostrar",{idcategoria_gastos : idcategoria_gastos}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
 		$("#idcategoria_gastos").val(data.idcategoria_gastos);

 	})
}

//Función para desactivar registros
function desactivar(idcategoria_gastos)
{
	bootbox.confirm("¿Está Seguro de desactivar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/categoriagastos.php?op=desactivar", {idcategoria_gastos : idcategoria_gastos}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idcategoria_gastos)
{
	bootbox.confirm("¿Está Seguro de activar la Categoría?", function(result){
		if(result)
        {
        	$.post("../ajax/categoriagastos.php?op=activar", {idcategoria_gastos : idcategoria_gastos}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();