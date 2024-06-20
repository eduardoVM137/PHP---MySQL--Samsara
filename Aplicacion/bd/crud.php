<?php
include_once 'C:\\XAMPP\\htdocs\\Aplicacion\\Controlador\\NTarea.php';

$Tareas = new NTarea();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

$opcion = isset($request['opcion']) ? $request['opcion'] : '';
$Id = isset($request['id']) ? $request['id'] : '';
$Titulo = isset($request['titulo']) ? $request['titulo'] : '';
$Descripcion = isset($request['descripcion']) ? $request['descripcion'] : '';

$response = array();

switch ($opcion) {
    case 1: // alta
        $Tareas->Insertar($Titulo, $Descripcion);
        // No tenemos un método para obtener el último ID insertado, así que devolvemos los datos insertados
        $response = array('Titulo' => $Titulo, 'Descripcion' => $Descripcion);
        break;
    case 2: // modificación
        $Tareas->Editar($Id, $Titulo, $Descripcion, "");
        $response = array('idTarea' => $Id, 'Titulo' => $Titulo, 'Descripcion' => $Descripcion);
        break;
    case 3: // baja
        $Tareas->Eliminar($Id);
        $response = array('idTarea' => $Id);
        break;
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
