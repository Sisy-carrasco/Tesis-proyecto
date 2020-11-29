var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})


    //Cargamos los items al select categoria
    $.post("../ajax/gasto.php?op=selectCategoriagastos", function(r){
                $("#idcategoria_gastos").html(r);
                $('#idcategoria_gastos').selectpicker('refresh');

	});
}



//Función limpiar
function limpiar()
{
	$("#idgasto").val("");	
	$("#descripcion").val("");
	$("#precio_gasto").val("");
	//$('#fecha').val(today);
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
					url: '../ajax/gasto.php?op=listar',
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
		url: "../ajax/gasto.php?op=guardaryeditar",
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

function mostrar(idgasto)
{
	$.post("../ajax/gasto.php?op=mostrar",{idgasto : idgasto}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

	$("#idcategoria_gastos").val(data.idcategoria_gastos);
	$("#idcategoria_gastos").selectpicker('refresh');
	$("#descripcion").val(data.descripcion);
	$("#precio_gasto").val(data.precio_gasto);
	$("#fecha").val(data.fecha)
	$("#idgasto").val(data.idgasto);
	
 	})
}

//Función para desactivar registros
function desactivar(idgasto)
{
	bootbox.confirm("¿Está Seguro de desactivar el gasto?", function(result){
		if(result)
        {
        	$.post("../ajax/gasto.php?op=desactivar", {idgasto : idgasto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idgasto)
{
	bootbox.confirm("¿Está Seguro de activar el gasto?", function(result){
		if(result)
        {
        	$.post("../ajax/gasto.php?op=activar", {idgasto : idgasto}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();