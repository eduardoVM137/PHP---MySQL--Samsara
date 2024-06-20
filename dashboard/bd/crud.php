<?php


include_once 'C:\xampp\htdocs\dashboard\Controlador\NTarea.php';

$Tareas=new NTarea(); 

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['id'])) ? $_POST['id'] : '';
$Titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
$Descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';




switch($opcion){
    case 1: //alta
        
                                                
                                                            
        $Tareas->Insertar($Titulo,$Descripcion,$Fecha);   
        
         
        break;
    case 2: //modificación
   
         
        $Tareas->Editar($Id,$Titulo,$Descripcion,$Fecha);   
        break;        
    case 3://baja
     
         
        $Tareas->Eliminar($Id);                          
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
?>
 
