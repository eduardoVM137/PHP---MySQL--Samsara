<?php 
class ConexionMysql {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli('localhost', 'admin', '1234', 'prueba');
        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }

    public function get_connection() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
}

// Ejemplo de uso
$conexionMysql = new ConexionMysql();
$conexion = $conexionMysql->get_connection();
if ($conexion) {
    echo "Conexión exitosa";
    // Aquí puedes realizar tus operaciones con la base de datos
    $conexionMysql->cerrarConexion();
} else {
    echo "Error de conexión";
}
?>
