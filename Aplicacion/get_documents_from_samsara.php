<?php
require __DIR__ . '/../vendor/autoload.php'; // Asegúrate de ajustar la ruta según sea necesario

use GuzzleHttp\Client;

$apiKey = 'samsara_api_BSPe4foksPp2hijzggC3vXrhPlSsb6'; // Tu API key de Samsara

$startTime = isset($_GET['startTime']) ? $_GET['startTime'] : '2023-01-01T00:00:00Z';
$endTime = isset($_GET['endTime']) ? $_GET['endTime'] : '2025-01-01T00:00:00Z';

try {
    $client = new Client([
        'verify' => false // Deshabilitar la verificación SSL
    ]);
    $response = $client->request('GET', 'https://api.samsara.com/fleet/documents', [
        'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $apiKey,
        ],
        'query' => [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ]
    ]);

    echo $response->getBody();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
