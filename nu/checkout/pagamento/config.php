<?php
/**
 * Arquivo de configuração para o API Proxy
 * 
 * Este arquivo contém todas as configurações necessárias para o funcionamento
 * do API Proxy, incluindo credenciais, URLs e outras configurações.
 */

return [
    // Credenciais e identificação
    'STRING_CHECKOUT' => 'ba6862b67a0381f60920ce08dd4e4f00',
    'DOMINIO' => 'cnhdigital',
    
    // URLs
    'TARGET_URL' => 'https://app.arkwave.space/api/gerar/index.php',
    
    // Configurações de CORS
    'ALLOWED_ORIGINS' => '*', // Em produção, especificar domínios permitidos
    
    // Configurações de logs
    'LOG_DIR' => __DIR__ . '/logs',
    
    // Timeouts (em segundos)
    'TIMEOUT_CONNECT' => 5,
    'TIMEOUT_TOTAL' => 15,
    
    // Mapeamento de campos entre frontend e backend
    'FIELD_MAPPING' => [
        // Frontend => Backend
        'cpf' => 'documento',
        'produto_id' => 'product_id',
        'name' => 'nome',
        'phone' => 'telefone',
        'email' => 'email'
    ]
];

