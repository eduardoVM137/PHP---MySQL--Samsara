
<?php 
class ConexionMysql{ //automatizar para siempre tene la conexion abierta cuando tienes un constructo
private $conexion;
public function __construct(){
    $this->conexion = new mysqli('localhost','admin','1234','prueba');
      if(!$this->conexion){
          die('Error de  coenxion: '.mysqli_connect_error());
      
      }
  
}


public function get_connection(){
    return $this->conexion;
}

public function CerrarConexion(){

    mysqli_close($this->conexion);

}



}
?>