<?php 
require_once "./Layout/parte_superior.php";
?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    <!--Formulario para subir imágenes-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Subir Imagen</h2>
                <form id="uploadImageForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="vehicle_id">ID del Vehículo:</label>
                        <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="43456830">
                    </div>
                    <div class="form-group">
                        <label for="image">Seleccionar Imagen:</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" >
                    </div>
                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
                </form>
            </div>
        </div>
    </div>

    <!--Botones para controlar la visualización y actualización de las imágenes-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12"> 
                <button id="btnMostrarEndpoint" class="btn btn-info">Mostrar Imágenes desde Samsara</button> 
            </div>
        </div>
    </div>

    <!--Tabla para mostrar imágenes-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Imágenes</h2>
                <div class="table-responsive">        
                    <table id="tablaImagenes" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID Imagen</th>
                                <th>ID Vehículo</th>
                                <th>Imagen</th>
                                <th>Fecha de Subida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se llenarán los datos traídos desde la BD o el endpoint -->
                        </tbody>        
                    </table>                    
                </div>
            </div>
        </div>  
    </div>

</div>
<!--FIN del cont principal-->

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function(){
    // Función para subir la imagen
    $(document).ready(function(){
    // Función para subir la imagen
    $('#s').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'upload_image_to_samsara.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
                var data = JSON.parse(response);
                if(data.success){
                    Swal.fire('Éxito', 'Imagen subida exitosamente.', 'success');
                    location.reload();
                } else {
                    Swal.fire('Error', 'Error al subir la imagen: ' + data.error, 'error');
                }
            },
            error: function(){
                Swal.fire('Error', 'Error en la solicitud.', 'error');
            }
        });
    });
});
$('#uploadImageForm').submit(function(event){
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: 'upload_image_to_samsara.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.message,
                });
                // Actualiza la tabla de imágenes o realiza alguna acción adicional aquí
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error,
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al realizar la solicitud.',
            });
        }
    });
});



 
    // Función para mostrar las imágenes desde el endpoint de Samsara
    $('#btnMostrarEndpoint').click(function(){
        var startTime = '2019-06-13T19:08:25Z'; // Reemplaza con tu valor de tiempo inicial
        var endTime = '2025-06-21T19:08:25Z';  // Tiempo actual en formato ISO
        $.ajax({
            url: 'get_documents_from_samsara.php?startTime=' + startTime + '&endTime=' + endTime,
            type: 'GET',
            success: function(response){
                console.log('Datos desde Samsara:', response); // Imprimir la respuesta completa en la consola
                try {
                    var data = JSON.parse(response);
                    console.log('Datos parseados:', data); // Imprimir los datos parseados
                    if(data.data && data.data.length){
                        var tabla = $('#tablaImagenes tbody');
                        tabla.empty();
                        data.data.forEach(doc => {
                            var imgSrc = (doc.fields[0] && doc.fields[0].value) ? doc.fields[0].value.url : 'default_image_path'; // Ajustar si es necesario
                            var fila = `<tr>
                                            <td>${doc.id}</td>
                                            <td>${doc.driver ? doc.driver.id : 'N/A'}</td>
                                            <td><img src="${imgSrc}" width="100"></td>
                                            <td>${new Date(doc.createdAtTime).toLocaleString()}</td>
                                        </tr>`;
                            tabla.append(fila);
                        });
                    } else {
                        console.error('Error al obtener documentos de Samsara:', data); // Imprimir el error en la consola
                        alert('Error al obtener documentos de Samsara.');
                    }
                } catch (e) {
                    console.error('Error al parsear JSON:', e); // Imprimir el error de parsing en la consola
                    alert('Error al parsear la respuesta.');
                }
            },
            error: function(xhr, status, error){
                console.error('Error en la solicitud:', error); // Imprimir el error de la solicitud en la consola
                alert('Error en la solicitud.');
            }
        });
    });

    // Función para actualizar la BD con las imágenes desde el endpoint de Samsara
 
});
    // Función para actualizar automáticamente cada cierto tiempo (por ejemplo, cada 5 minutos)
    setInterval(function(){
        $('#btnMostrarEndpoint').click();
    }, 100000); // 300000 ms = 5 minutos
 
</script>

<?php require_once 'C:\XAMPP\htdocs\Aplicacion\Layout\parte_inferior.php'?>
