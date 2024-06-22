<?php
require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

$apiKey = 'samsara_api_BSPe4foksPp2hijzggC3vXrhPlSsb6'; // Tu API key de Samsara
$documentTypeId = '38cabaa4-3ce0-479e-98e1-53fa53a04d70';
$driverId = '43456830';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['vehicle_id'])) {
    $vehicleId = $_POST['vehicle_id'];
    $image = $_FILES['image'];

    // Crear el directorio de uploads si no existe
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $filePath)) {
        try {
            $client = new Client();

            // Leer el contenido de la imagen y convertirlo a base64
            $imageData = base64_encode(file_get_contents($filePath));

            // Enviar la imagen a la API de Samsara
            $response = $client->request('POST', 'https://api.samsara.com/fleet/documents', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Bearer ' . $apiKey,
                    'content-type' => 'application/json',
                ],
                'body' => json_encode([
                    'state' => 'required',
                    'documentTypeId' => $documentTypeId,
                    'driverId' => $driverId,
                    'name' => basename($image['name']),
                    'notes' => 'Subida desde la aplicación',
                    'fields' => [
                        [
                            'type' => 'photo',
                            'label' => 'Load weight',
                            'value' => [
                                'image' => $imageData,//valida que sea el tipo de dato correcto
                            ],
                        ],
                    ],
                ]),
                'verify' => false, // Desactiva la verificación SSL
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Eliminar el archivo temporal samsara_api_ogC6mQ3WfbqxOslreH2isrC6t3XlES
            unlink($filePath);

            if (isset($responseData['id'])) {
                echo json_encode(['success' => true, 'data' => $responseData]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al subir la imagen a Samsara.', 'response' => $responseData]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al mover el archivo subido.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Solicitud inválida.']);
}
?>
