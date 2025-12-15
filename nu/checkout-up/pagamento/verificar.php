<?php
/**
 * Proxy API para verificação de status de transação
 * 
 * Este script recebe um ID de transação via GET e consulta a API principal via POST
 * 
 * Exemplo de uso: verifica.php?id=cmbwtgdgv0im7g9bc1191f72g
 */

// Configurações
$apiEndpoint = 'https://app.arkwave.space/api/status/index.php';
$allowedMethods = ['GET'];
$requiredParam = 'id';

// Verificar método HTTP
if (!in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'Método não permitido', 
        'allowed_methods' => $allowedMethods
    ]);
    exit;
}

// Configurar cabeçalhos de resposta
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permite CORS - ajuste conforme necessário

// Verificar parâmetro obrigatório
if (!isset($_GET[$requiredParam]) || empty($_GET[$requiredParam])) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Parâmetro obrigatório faltando',
        'required_parameter' => $requiredParam,
        'example' => 'verifica.php?id=cmbwtgdgv0im7g9bc1191f72g'
    ]);
    exit;
}

$transactionId = trim($_GET[$requiredParam]);

// Função para fazer a requisição para a API principal
function callMainApi($endpoint, $transactionId) {
    $data = json_encode(['id_transaction' => $transactionId]);
    
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Importante para produção
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout de 10 segundos
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    return [
        'http_code' => $httpCode,
        'response' => $response,
        'error' => $error
    ];
}

// Chamar a API principal
$apiResponse = callMainApi($apiEndpoint, $transactionId);

// Tratar a resposta
if ($apiResponse['error']) {
    http_response_code(502); // Bad Gateway
    echo json_encode([
        'error' => 'Erro ao conectar com a API principal',
        'detail' => $apiResponse['error']
    ]);
} else {
    // Repassar o status code e resposta da API principal
    http_response_code($apiResponse['http_code']);
    echo $apiResponse['response'];
}

// Log opcional (descomente se necessário)
/*
$logData = [
    'date' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'],
    'transaction_id' => $transactionId,
    'api_response' => json_decode($apiResponse['response'], true),
    'http_code' => $apiResponse['http_code']
];
file_put_contents('api_proxy.log', json_encode($logData) . PHP_EOL, FILE_APPEND);
*/
?>