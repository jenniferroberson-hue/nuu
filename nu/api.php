<?php
declare(strict_types=1);

ini_set('display_errors','0');
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['status'=>405,'erro'=>'metodo_invalido']);
    exit;
}

$cpf_bruto = $_GET['cpf'] ?? '';
$cpf = preg_replace('/\D/','',$cpf_bruto);

if (strlen($cpf) !== 11) {
    http_response_code(400);
    echo json_encode(['status'=>400,'erro'=>'cpf_invalido']);
    exit;
}

$user = 'f3321c2315589bf37dd6893a77bf037c';
$url = 'https://apela-api.tech/?user='.$user.'&cpf='.$cpf;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
$res = curl_exec($ch);
$err = curl_error($ch);
$code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($res === false || $code >= 400) {
    http_response_code(502);
    echo json_encode(['status'=>502,'erro'=>'falha_requisicao','detalhe'=>$err]);
    exit;
}

$data = json_decode($res, true);
if (!is_array($data)) {
    http_response_code(502);
    echo json_encode(['status'=>502,'erro'=>'resposta_invalida']);
    exit;
}

if (!isset($data['status']) || (int)$data['status'] !== 200) {
    http_response_code(404);
    echo json_encode(['status'=>404,'erro'=>'cpf_nao_encontrado']);
    exit;
}

$nome = (string)($data['nome'] ?? '');
$cpf_resp = (string)($data['cpf'] ?? '');
$nascimento = (string)($data['nascimento'] ?? '');
$sexo = (string)($data['sexo'] ?? '');
$mae = (string)($data['mae'] ?? '');

$saida = [
    'status' => 200,
    'nome' => $nome,
    'cpf' => $cpf_resp,
    'nascimento' => $nascimento,
    'sexo' => $sexo,
    'mae' => $mae,
    'NOME' => $nome,
    'CPF' => $cpf_resp,
    'NASCIMENTO' => $nascimento,
    'SEXO' => $sexo,
    'MAE' => $mae
];

echo json_encode($saida, JSON_UNESCAPED_UNICODE);
