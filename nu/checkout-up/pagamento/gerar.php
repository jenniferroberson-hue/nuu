<?php

$config = require_once 'config.php';

// Configurações de cabeçalhos
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: {$config['ALLOWED_ORIGINS']}");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");

// Responder imediatamente para requisições OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Inicializa o logger
$logger = new Logger($config['LOG_DIR']);

try {
    // Verifica se a requisição é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new ApiException('Método não permitido. Use POST.', 405);
    }

    // Verifica se o conteúdo é JSON
    if (empty($_SERVER['CONTENT_TYPE']) || stripos($_SERVER['CONTENT_TYPE'], 'application/json') === false) {
        throw new ApiException('Content-Type deve ser application/json', 400);
    }

    // Obtém e decodifica o JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new ApiException('JSON inválido: ' . json_last_error_msg(), 400);
    }

    // Valida os dados recebidos
    $validator = new DataValidator();
    $validator->validateRequiredFields($data, ['cpf', 'produto_id', 'valor', 'name', 'email']);
    $validator->validateCPF($data['cpf']);
    $validator->validateEmail($data['email']);
    $validator->validatePhone($data['phone'] ?? '');
    $validator->validateMonetaryValue($data['valor']);

    // Prepara os dados para envio
    $payloadBuilder = new PayloadBuilder($config);
    $payload = $payloadBuilder->build($data);

    // Envia os dados para o endpoint destino
    $apiClient = new ApiClient($config['TARGET_URL'], $config['TIMEOUT_CONNECT'], $config['TIMEOUT_TOTAL']);
    $response = $apiClient->sendRequest($payload);

    // Registra a transação
    $logger->logTransaction($payload, $response['data'], $response['http_code']);

    // Retorna a resposta ao cliente
    http_response_code($response['http_code']);
    echo json_encode($response['data']);

} catch (ApiException $e) {
    $errorData = [
        'status' => 'error',
        'message' => $e->getUserMessage(),
        'error_code' => $e->getErrorCode(),
        'timestamp' => date('c')
    ];
    
    $logger->logError($e, isset($data) ? $data : []);
    
    http_response_code($e->getHttpCode());
    echo json_encode($errorData);
} catch (Exception $e) {
    $errorData = [
        'status' => 'error',
        'message' => 'Erro interno do servidor',
        'error_code' => 'INTERNAL_SERVER_ERROR',
        'timestamp' => date('c')
    ];
    
    $logger->logError($e, isset($data) ? $data : []);
    
    http_response_code(500);
    echo json_encode($errorData);
}

/**
 * Classe para validação de dados
 */
class DataValidator {
    /**
     * Valida campos obrigatórios
     * 
     * @param array $data Dados a serem validados
     * @param array $requiredFields Lista de campos obrigatórios
     * @throws ApiException Se algum campo obrigatório estiver faltando
     */
    public function validateRequiredFields(array $data, array $requiredFields) {
        $missingFields = [];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            throw new ApiException(
                'Campos obrigatórios faltando: ' . implode(', ', $missingFields),
                400,
                'MISSING_REQUIRED_FIELDS',
                ['missing_fields' => $missingFields]
            );
        }
    }

    /**
     * Valida um CPF
     * 
     * @param string $cpf CPF a ser validado
     * @throws ApiException Se o CPF for inválido
     */
    public function validateCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            throw new ApiException('CPF inválido', 400, 'INVALID_CPF');
        }
        
        // Cálculo do primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }
        $remainder = $sum % 11;
        $digit1 = ($remainder < 2) ? 0 : 11 - $remainder;
        
        // Cálculo do segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }
        $sum += $digit1 * 2;
        $remainder = $sum % 11;
        $digit2 = ($remainder < 2) ? 0 : 11 - $remainder;
        
        // Verifica se os dígitos calculados são iguais aos dígitos informados
        if ($cpf[9] != $digit1 || $cpf[10] != $digit2) {
            throw new ApiException('CPF inválido', 400, 'INVALID_CPF');
        }
    }

    /**
     * Valida um endereço de e-mail
     * 
     * @param string $email E-mail a ser validado
     * @throws ApiException Se o e-mail for inválido
     */
    public function validateEmail($email) {
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ApiException('E-mail inválido', 400, 'INVALID_EMAIL');
        }
    }

    /**
     * Valida um número de telefone
     * 
     * @param string $phone Telefone a ser validado
     * @throws ApiException Se o telefone for inválido
     */
    public function validatePhone($phone) {
        if (!empty($phone)) {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            if (strlen($phone) < 10 || strlen($phone) > 11) {
                throw new ApiException('Telefone inválido', 400, 'INVALID_PHONE');
            }
        }
    }

    /**
     * Valida um valor monetário
     * 
     * @param string|float $value Valor a ser validado
     * @throws ApiException Se o valor for inválido
     */
    public function validateMonetaryValue($value) {
        $value = str_replace(['.', ','], ['', '.'], $value);
        if (!is_numeric($value) || $value <= 0) {
            throw new ApiException('Valor inválido', 400, 'INVALID_VALUE');
        }
    }
}

/**
 * Classe para construção do payload
 */
class PayloadBuilder {
    private $config;
    private $fieldMapping;
    
    /**
     * Construtor
     * 
     * @param array $config Configurações da aplicação
     */
    public function __construct(array $config) {
        $this->config = $config;
        $this->fieldMapping = $config['FIELD_MAPPING'] ?? [];
    }
    
    /**
     * Constrói o payload para envio
     * 
     * @param array $data Dados recebidos do cliente
     * @return array Payload formatado
     */
    public function build(array $data) {
        // Formata o valor
        $valor = str_replace(['.', ','], ['', '.'], $data['valor']);
        
        // Mapeia os campos do frontend para os nomes esperados pelo backend
        $mappedData = [];
        foreach ($this->fieldMapping as $frontendField => $backendField) {
            if (isset($data[$frontendField])) {
                $mappedData[$backendField] = $data[$frontendField];
            }
        }
        
        // Prepara os dados para repassar
        $payload = array_merge($mappedData, [
            'string_checkout' => $this->config['STRING_CHECKOUT'],
            'documento' => preg_replace('/[^0-9]/', '', $data['cpf']),
            'product_id' => $data['produto_id'],
            'valor' => $data['valor'],
            'dominio' => $this->config['DOMINIO'],
            'fbp' => $data['tracking']['fbp'] ?? null,
            'fbclid' => $data['tracking']['fbclid'] ?? null,
            'user_agent' => $data['tracking']['user_agent'] ?? $_SERVER['HTTP_USER_AGENT'] ?? null,
            'ip_address' => $this->getClientIP(),
            'timestamp' => date('c'),
            'gclid' => $data['tracking']['gclid'] ?? null,
            'utm_source' => $data['tracking']['utm_source'] ?? null,
            'utm_medium' => $data['tracking']['utm_medium'] ?? null,
            'utm_campaign' => $data['tracking']['utm_campaign'] ?? null,
            'utm_term' => $data['tracking']['utm_term'] ?? null,
            'utm_content' => $data['tracking']['utm_content'] ?? null,
            'referrer' => $data['tracking']['referrer'] ?? $_SERVER['HTTP_REFERER'] ?? null,
            'checkout_id' => $data['checkout_id'] ?? $this->generateCheckoutId(),
            'device_type' => $this->detectDeviceType(),
            'telefone' => $data['phone'] ? preg_replace('/[^0-9]/', '', $data['phone']) : null,
            'cep' => $data['cep'] ?? '04180112',
            'rua' => $data['rua'] ?? '19 de Agosto',
            'bairro' => $data['bairro'] ?? 'Centro',
            'cidade' => $data['cidade'] ?? 'São Paulo',
            'uf' => $data['uf'] ?? 'SP',
            'numero' => $data['numero'] ?? '11',
            'complemento' => $data['complemento'] ?? 'CASA',
            'pais' => 'BR'
        ]);

        // Remove campos nulos
        return array_filter($payload, function($value) {
            return $value !== null;
        });
    }
    
    /**
     * Obtém o IP do cliente
     * 
     * @return string IP do cliente
     */
    private function getClientIP() {
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = trim(current(explode(',', $_SERVER[$key])));
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
    
    /**
     * Gera um ID único para o checkout
     * 
     * @return string ID do checkout
     */
    private function generateCheckoutId() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
    
    /**
     * Detecta o tipo de dispositivo
     * 
     * @return string Tipo de dispositivo ('mobile' ou 'desktop')
     */
    private function detectDeviceType() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $mobileAgents = ['Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 'Windows Phone'];
        
        foreach ($mobileAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                return 'mobile';
            }
        }
        
        return 'desktop';
    }
}

/**
 * Classe para comunicação com a API externa
 */
class ApiClient {
    private $url;
    private $connectTimeout;
    private $totalTimeout;
    
    /**
     * Construtor
     * 
     * @param string $url URL da API
     * @param int $connectTimeout Timeout de conexão em segundos
     * @param int $totalTimeout Timeout total em segundos
     */
    public function __construct($url, $connectTimeout = 5, $totalTimeout = 15) {
        $this->url = $url;
        $this->connectTimeout = $connectTimeout;
        $this->totalTimeout = $totalTimeout;
    }
    
    /**
     * Envia uma requisição para a API
     * 
     * @param array $payload Dados a serem enviados
     * @return array Resposta da API
     * @throws ApiException Se ocorrer um erro na comunicação
     */
    public function sendRequest(array $payload) {
        $ch = curl_init();
        
        // Sanitiza o IP antes de usá-lo no cabeçalho
        $ip = isset($payload['ip_address']) ? filter_var($payload['ip_address'], FILTER_VALIDATE_IP) : null;
        $forwardedHeader = $ip ? "X-Forwarded-For: $ip" : '';
        
        curl_setopt_array($ch, [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array_filter([
                'Content-Type: application/json',
                'Accept: application/json',
                $forwardedHeader
            ]),
            CURLOPT_TIMEOUT => $this->totalTimeout,
            CURLOPT_CONNECTTIMEOUT => $this->connectTimeout
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        
        curl_close($ch);
        
        if ($errno) {
            throw new ApiException(
                "Erro na comunicação com o servidor de pagamento",
                500,
                'API_CONNECTION_ERROR',
                ['curl_error' => "$errno: $error"]
            );
        }
        
        $responseData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiException(
                "Resposta inválida do servidor de pagamento",
                500,
                'INVALID_API_RESPONSE',
                ['raw_response' => substr($response, 0, 200)]
            );
        }
        
        return [
            'data' => $responseData,
            'http_code' => $httpCode
        ];
    }
}

/**
 * Classe para registro de logs
 */
class Logger {
    private $logDir;
    
    /**
     * Construtor
     * 
     * @param string $logDir Diretório de logs
     */
    public function __construct($logDir) {
        $this->logDir = rtrim($logDir, '/');
        $this->ensureLogDirectoryExists();
    }
    
    /**
     * Registra uma transação
     * 
     * @param array $request Dados da requisição
     * @param array $response Dados da resposta
     * @param int $statusCode Código de status HTTP
     */
    public function logTransaction(array $request, array $response, $statusCode) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'status_code' => $statusCode,
            'request' => $this->sanitizeData($request),
            'response' => $this->sanitizeData($response),
            'execution_time' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']
        ];
        
        $this->writeLog('transaction', $logData);
    }
    
    /**
     * Registra um erro
     * 
     * @param Exception $exception Exceção ocorrida
     * @param array $context Contexto do erro
     */
    public function logError(Exception $exception, array $context = []) {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'error' => get_class($exception),
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'context' => $this->sanitizeData($context)
        ];
        
        $this->writeLog('error', $logData);
    }
    
    /**
     * Sanitiza dados sensíveis antes de registrá-los
     * 
     * @param array $data Dados a serem sanitizados
     * @return array Dados sanitizados
     */
    private function sanitizeData(array $data) {
        $sensitiveFields = ['string_checkout', 'cpf', 'documento', 'email', 'telefone', 'phone'];
        $result = $data;
        
        foreach ($sensitiveFields as $field) {
            if (isset($result[$field])) {
                if ($field === 'cpf' || $field === 'documento') {
                    // Mantém apenas os primeiros 3 e últimos 2 dígitos
                    $cpf = preg_replace('/[^0-9]/', '', $result[$field]);
                    $result[$field] = substr($cpf, 0, 3) . '******' . substr($cpf, -2);
                } elseif ($field === 'email') {
                    // Oculta parte do email
                    $parts = explode('@', $result[$field]);
                    if (count($parts) === 2) {
                        $username = $parts[0];
                        $domain = $parts[1];
                        $result[$field] = substr($username, 0, 3) . '***@' . $domain;
                    }
                } elseif ($field === 'telefone' || $field === 'phone') {
                    // Mantém apenas os primeiros 2 e últimos 2 dígitos
                    $phone = preg_replace('/[^0-9]/', '', $result[$field]);
                    $result[$field] = substr($phone, 0, 2) . '******' . substr($phone, -2);
                } else {
                    // Oculta completamente outros campos sensíveis
                    $result[$field] = '********';
                }
            }
        }
        
        return $result;
    }
    
    /**
     * Escreve um log
     * 
     * @param string $type Tipo de log
     * @param array $data Dados a serem registrados
     */
    private function writeLog($type, array $data) {
        $filename = $this->logDir . '/' . $type . '_' . date('Y-m-d') . '.log';
        $logLine = json_encode($data) . PHP_EOL;
        
        file_put_contents($filename, $logLine, FILE_APPEND);
    }
    
    /**
     * Garante que o diretório de logs existe
     */
    private function ensureLogDirectoryExists() {
        if (!file_exists($this->logDir)) {
            mkdir($this->logDir, 0700, true);
        }
    }
}

/**
 * Classe para exceções da API
 */
class ApiException extends Exception {
    private $httpCode;
    private $errorCode;
    private $errorDetails;
    private $userMessage;
    
    /**
     * Construtor
     * 
     * @param string $message Mensagem de erro
     * @param int $httpCode Código HTTP
     * @param string $errorCode Código de erro
     * @param array $errorDetails Detalhes do erro
     */
    public function __construct($message, $httpCode = 400, $errorCode = 'BAD_REQUEST', array $errorDetails = []) {
        parent::__construct($message, 0);
        $this->httpCode = $httpCode;
        $this->errorCode = $errorCode;
        $this->errorDetails = $errorDetails;
        $this->userMessage = $message;
    }
    
    /**
     * Obtém o código HTTP
     * 
     * @return int Código HTTP
     */
    public function getHttpCode() {
        return $this->httpCode;
    }
    
    /**
     * Obtém o código de erro
     * 
     * @return string Código de erro
     */
    public function getErrorCode() {
        return $this->errorCode;
    }
    
    /**
     * Obtém os detalhes do erro
     * 
     * @return array Detalhes do erro
     */
    public function getErrorDetails() {
        return $this->errorDetails;
    }
    
    /**
     * Obtém a mensagem para o usuário
     * 
     * @return string Mensagem para o usuário
     */
    public function getUserMessage() {
        return $this->userMessage;
    }
}

