
<?php 
  class  DTarea
{
  public int $_intIdTarea;
    public   string $_strTitulo,$_strDescripcion ,$Texto;
    public string $_dtFecha; 
   

   public function  Mostrar()
   {
    require_once 'C:\XAMPP\htdocs\dashboard\Conexion.php';
       $conexion=new ConexionMysql();
       $consulta=mysqli_query($conexion->get_connection(),'call spMostrar_Tareas()'); 
       $conexion->CerrarConexion();
        return $consulta;
   }

    public function Buscar($MiTexto)
      { 
        require_once '../Conexion.php';
        $ClaseConexcion=new ConexionMysql();
        $MiConexcion=$ClaseConexcion->get_connection();
        // Preparar la sentencia SQL con el procedimiento almacenado y los parámetros
        $consulta = $MiConexcion->prepare("CALL spBuscar_Tarea_Descripcion(?)");
        // Vincular los parámetros a la sentencia preparada
        $consulta->bind_param("s", $MiTexto);
        // Ejecutar la consulta y almacenarla
        $consulta->execute();
        $result = $consulta->get_result();
        $ClaseConexcion->CerrarConexion();
        // $consulta->close();
        // $MiConexcion->close(); 

            
       return $result;
      }
      public function  Insertar(DTarea $Mitarea)
      {
        //Llamar a la Clase ConexcionMysql y crear una conexcion 
        require_once 'C:\XAMPP\htdocs\dashboard\Conexion.php';
        $ClaseConexcion=new ConexionMysql();
        $MiConexcion=$ClaseConexcion->get_connection();          
        //Preparar nuestro procedimiento con la conexion creada
        $consulta = $MiConexcion->prepare("CALL spInsertar_Tarea(?, ?, ?)");
        // Vincular los parámetros a la sentencia preparada
        $consulta->bind_param("sss", $Mitarea->_strTitulo, $Mitarea->_strDescripcion, $Mitarea->_dtFecha);

        // Ejecutar la consulta
        $consulta->execute();
        $ClaseConexcion->CerrarConexion();
        return "Se inserto de forma Correcta";
      }   
      public function  Editar(DTarea $Mitarea)
      {
        //Llamar a la Clase ConexcionMysql y crear una conexcion 
        require_once '.\Conexion.php';
        $ClaseConexcion=new ConexionMysql();
        $MiConexcion=$ClaseConexcion->get_connection();          
        //Preparar nuestro procedimiento con la conexion creada
        $consulta = $MiConexcion->prepare("CALL spEditar_Tarea(?,?, ?, ?)");
        // Vincular los parámetros a la sentencia preparada
        $consulta->bind_param("ssss", $Mitarea->_intIdTarea, $Mitarea->_strTitulo, $Mitarea->_strDescripcion, $Mitarea->_dtFecha);

        // Ejecutar la consulta
        $consulta->execute();
        $ClaseConexcion->CerrarConexion();
        return "Se Edito de forma Correcta";
      }   
      public function  Eliminar(DTarea $Mitarea)
      {
        //Llamar a la Clase ConexcionMysql y crear una conexcion 
        require_once 'C:\XAMPP\htdocs\dashboard\Conexion.php';
        $ClaseConexcion=new ConexionMysql();
        $MiConexcion=$ClaseConexcion->get_connection();          
        //Preparar nuestro procedimiento con la conexion creada
        $consulta = $MiConexcion->prepare("CALL spEliminar_Tarea(?)");
        // Vincular los parámetros a la sentencia preparada
        $consulta->bind_param("s", $Mitarea->_intIdTarea);

        // Ejecutar la consulta
        $consulta->execute();
        $ClaseConexcion->CerrarConexion();
        return "Se Elimino de forma Correcta";
      }


}

?>
