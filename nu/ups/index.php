<?php
declare(strict_types=1);

$segredo = 'chave_super_secreta_aleatoria_948372';
$cookieNome = 'contador_upsell';

$basePath = '/nu';

$upsells = [
    $basePath . '/upsell1',
    $basePath . '/upsell2',
    $basePath . '/upsell3',
    $basePath . '/upsell4'
];

$contador = 0;

if (isset($_COOKIE[$cookieNome])) {
    $dados = json_decode(base64_decode($_COOKIE[$cookieNome]), true);
    if (is_array($dados) && isset($dados['qtd'], $dados['hash'])) {
        $hashValido = hash_hmac('sha256', (string)$dados['qtd'], $segredo);
        if (hash_equals($hashValido, $dados['hash'])) {
            $contador = (int)$dados['qtd'];
        }
    }
}

$contador++;

if ($contador > count($upsells)) {
    $contador = count($upsells);
}

$novoCookie = [
    'qtd' => $contador,
    'hash' => hash_hmac('sha256', (string)$contador, $segredo)
];

setcookie(
    $cookieNome,
    base64_encode(json_encode($novoCookie)),
    [
        'expires' => time() + 60 * 60 * 24 * 30,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

$destino = $upsells[$contador - 1];

$query = $_SERVER['QUERY_STRING'];
$parametros = $query ? '?' . $query : '';

header('Location: ' . $destino . '/' . $parametros);
exit;
