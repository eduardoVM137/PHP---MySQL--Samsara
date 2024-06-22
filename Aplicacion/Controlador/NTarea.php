<?php

 class  NTarea{
private $rutaBase = 'C:\\XAMPP\\htdocs\\Aplicacion\\Modelo\\DTarea.php';
    public function __construct() {
        require_once $this->rutaBase;
    }
        public function Mostrar(){
            
            $Tareas=new DTarea();
            $Tarea=$Tareas->Mostrar();
            return  $Tarea;
        }
        public function Buscar($MiTexto){
            
            $Tareas=new DTarea();
            return  $Tareas->Buscar($MiTexto);
        }

        public function Insertar($Titulo,$Descripcion){
            
            $Tareas=new DTarea();
            $Tareas->_strTitulo=$Titulo;
            $Tareas->_strDescripcion=$Descripcion;
            $Tareas->Insertar($Tareas);
        }
        public function Editar($Id,$Titulo,$Descripcion,$Fecha){
            
            $Tareas=new DTarea();
            
            $Tareas->_intIdTarea=$Id;
            $Tareas->_strTitulo=$Titulo;
            $Tareas->_strDescripcion=$Descripcion;
            $Tareas->_dtFecha=$Fecha;
            $Tareas->Editar($Tareas);
        }
        public function Eliminar($Id){
            
            $Tareas=new DTarea();
            $Tareas->_intIdTarea=$Id;
            
            $Tareas->Eliminar($Tareas);
        }

        }

?>