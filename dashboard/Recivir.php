<?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $accion = $_POST['accion'];
//modal-title.TXTO DEL MOLDAL ==INSERTAR
   if ($accion === 'insertar') {
       
   $archivo = 'C:\XAMMP\htdocs\dashboard\bd\Errores.txts';
   $texto = "Se ha insertado el registro con nombre.";
   file_put_contents($archivo, $texto);
   $contenido = file_get_contents($archivo);
   echo $contenido;
   file_put_contents($archivo, $texto);
   $contenido = file_get_contents($archivo);
   
   echo $contenido;
    
     } 
    if ($accion === 'editar') {
    
   


   $archivo = 'C:\XAMPP\htdocs\dashboard\bd\Errores.txts';
   $texto = "Se ha editado el registro con nombre.";
   file_put_contents($archivo, $texto);
   $contenido = file_get_contents($archivo);
   echo $contenido;
   file_put_contents($archivo, $texto);
   $contenido = file_get_contents($archivo);
   
   echo $contenido;
   
}}


?>
