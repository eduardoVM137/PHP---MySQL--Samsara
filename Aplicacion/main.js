$(document).ready(function(){
    var tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button name='accion' value='editar' class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });
    var tablaimg = $("#tablaImagenes").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button name='accion' value='editar' class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });


    $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Tarea");            
        $("#modalCRUD").modal("show");        
        id = null;
        opcion = 1; // alta
    });

    var fila; // capturar la fila para editar o borrar el registro
    
    // botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        titulo = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();

        $("#id").val(id);
        $("#titulo").val(titulo);
        $("#descripcion").val(descripcion);
        opcion = 2; // editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Tarea");            
        $("#modalCRUD").modal("show");
    });

     // botón BORRAR
     $(document).on("click", ".btnBorrar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        opcion = 3; // borrar

        Swal.fire({
            title: '¿Está seguro de eliminar el registro: ' + id + '?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) { // Cambiamos isConfirmed por value para mayor compatibilidad
                console.log('Enviando solicitud de eliminación:', {opcion: opcion, id: id});
                fetch("bd/crud.php", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({opcion: opcion, id: id})
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data); // Verificar el contenido de la respuesta
                    if (data.idTarea == id) {
                        console.log('Eliminando fila de la tabla:', fila);
                        tablaPersonas.row(fila).remove().draw();
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar el registro.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error',
                        'Ocurrió un error al procesar la solicitud.',
                        'error'
                    );
                });
            } else {
                Swal.fire(
                    'Error',
                    'El Usuario Aborto la Operacion.',
                    'error'
                );
            }
        });
    });
    
    // escuchar el guardar y mandarlo al CRUD como si fuera por form
    $("#formPersonas").submit(function(e){
        e.preventDefault(); 
        var titulo = $.trim($("#titulo").val());
        var descripcion = $.trim($("#descripcion").val()); 

        fetch("bd/crud.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({opcion: opcion, id: id, titulo: titulo, descripcion: descripcion})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verificar el contenido de la respuesta
           
            $("#modalCRUD").modal("hide");
            Swal.fire(
                '¡Guardado!',
                'El registro ha sido guardado exitosamente.',
                'success'
            );
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire(
                'Error',
                'Ocurrió un error al procesar la solicitud.',
                'error'
            );
        });
    });
});
