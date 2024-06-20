<?php

 class  NTarea{

public function Mostrar(){
    
require_once 'C:\XAMPP\htdocs\dashboard\Modelo\DTarea.php';
    $Tareas=new DTarea();
    $Tarea=$Tareas->Mostrar();
    return  $Tarea;
}
public function Buscar($MiTexto){
    
require_once 'C:\XAMPP\htdocs\dashboard\Modelo\DTarea.php';
    $Tareas=new DTarea();
    return  $Tareas->Buscar($MiTexto);
}

public function Insertar($Titulo,$Descripcion,$Fecha){
    
require_once 'C:\XAMPP\htdocs\dashboard\Modelo\DTarea.php';
    $Tareas=new DTarea();
    $Tareas->_strTitulo=$Titulo;
    $Tareas->_strDescripcion=$Descripcion;
    $Tareas->_dtFecha=$Fecha;
     $Tareas->Insertar($Tareas);
}
public function Editar($Id,$Titulo,$Descripcion,$Fecha){
    
require_once 'C:\XAMPP\htdocs\dashboard\Modelo\DTarea.php';
    $Tareas=new DTarea();
    
    $Tareas->_intIdTarea=$Id;
    $Tareas->_strTitulo=$Titulo;
    $Tareas->_strDescripcion=$Descripcion;
    $Tareas->_dtFecha=$Fecha;
     $Tareas->Editar($Tareas);
}
public function Eliminar($Id){
    
require_once 'C:\XAMPP\htdocs\dashboard\Modelo\DTarea.php';
    $Tareas=new DTarea();
    $Tareas->_intIdTarea=$Id;
    
    $Tareas->Eliminar($Tareas);
}

}

?>