$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button name ='accion' value ='editar'class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Tarea");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
    
 

});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    titulo = fila.find('td:eq(1)').text();
    descripcion = fila.find('td:eq(2)').text(); 
    fecha = fila.find('td:eq(3)').text(); 
    
    $("#id").val(id);
    $("#titulo").val(titulo);
    $("#fecha").val(fecha);
    $("#descripcion").val(descripcion);  
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tarea");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    

    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});


function guardarRegistro() {
    var nombre = document.getElementById("titulo").value; 
    if (accionActual === "insertar") {
      // Llamar al método de inserción en PHP y enviar los valores
      
    var respuesta = confirm("¿Está seguro de nuevo el registro: "+titulo+"?");
    
      insertarRegistro(nombre, fecha);
    } else if (accionActual === "editar") {
      // Llamar al método de edición en PHP y enviar los valores junto con el ID del registro
 
      var respuesta = confirm("¿Está seguro de nuevo el registro: "+titulo+"?");
    }
    
    // Cerrar el modal
    document.getElementById("modalCRUD").style.display = "none";
  }
    //escuchar el guardar y mandarlarlo al crud como si fuera por form
    $("#formPersonas").submit(function(e){
        e.preventDefault();    
        id = $.trim($("#id").val());
        descripcion = $.trim($("#descripcion").val()); 
        fecha = $.trim($("#fecha").val()); 
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion,id:id,titulo:titulo, descripcion:descripcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                titulo = data[0].titulo;
                descripcion = data[0].descripcion;
                if(opcion == 1){tablaPersonas.row.add([id,titulo,descripcion]).draw();}
                else{tablaPersonas.row(fila).data([id,titulo,descripcion]).draw();}            
            }        
        });
        $("#formPersonas").modal("hide");    
        
    });  
        //escuchar el guardar y mandarlarlo al crud como si fuera por form
        $("#formPersonasInsertar").submit(function(e){
            e.preventDefault();     
            descripcion = $.trim($("#descripcionInsertar").val()); 
            titulo = $.trim($("#tituloInsertar").val()); 
            fecha = $.trim($("#fechaInsertar").val()); 
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion,id:id,titulo:titulo, descripcion:descripcion},
                success: function(data){  
                    console.log(data);
                    id = data[0].id;            
                    titulo = data[0].titulo;
                    descripcion = data[0].descripcion;
                    if(opcion == 1){tablaPersonas.row.add([id,titulo,descripcion,fecha]).draw();}
                    else{tablaPersonas.row(fila).data([id,titulo,descripcion,fecha]).draw();}            
                }        
            });
            $("#formPersonas").modal("hide");    
            
        });  
});