<?php
$servername = "localhost";
$username = "admin"; // Reemplaza con tu usuario de MySQL
$password = "1234"; // Reemplaza con tu contraseña de MySQL
$dbname = "prueba"; // Reemplaza con el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM images";
$result = $conn->query($sql);

$images = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}

echo json_encode(array('success' => true, 'images' => $images));
$conn->close();
?>
