<?php
class GeradorDadosPessoais {
    /**
     * Gera um CPF válido
     * @return string CPF formatado (xxx.xxx.xxx-xx)
     */
    public static function gerarCPF(): string {
        // Gera 9 dígitos aleatórios
        $digitos = [];
        for ($i = 0; $i < 9; $i++) {
            $digitos[] = rand(0, 9);
        }

        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $digitos[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digitos[9] = ($resto < 2) ? 0 : 11 - $resto;

        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $digitos[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digitos[10] = ($resto < 2) ? 0 : 11 - $resto;

        // Formata o CPF
        return sprintf(
            '%d%d%d.%d%d%d.%d%d%d-%d%d',
            ...$digitos
        );
    }

    /**
     * Gera um nome completo aleatório
     * @return string Nome e sobrenome
     */
    public static function gerarNomeCompleto(): string {
        $nomes = [
            'Ana', 'João', 'Maria', 'Pedro', 'Carlos', 'Lucia', 'Fernanda', 'Ricardo', 
            'Juliana', 'Marcos', 'Patricia', 'Lucas', 'Amanda', 'Rodrigo', 'Camila'
        ];
        
        $sobrenomes = [
            'Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves',
            'Pereira', 'Gomes', 'Martins', 'Ribeiro', 'Almeida', 'Carvalho', 'Lima'
        ];
        
        return $nomes[array_rand($nomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)] . ' ' . $sobrenomes[array_rand($sobrenomes)];
    }

    /**
     * Gera um email válido baseado no nome
     * @param string $nome Nome completo
     * @return string Email formatado
     */
    public static function gerarEmail(string $nome): string {
        $partes = explode(' ', strtolower($nome));
        $provedores = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com.br', 'icloud.com'];
        
        // Remove acentos
        $nomeSemAcentos = preg_replace('/[^a-z0-9]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $partes[0]));
        $sobrenomeSemAcentos = preg_replace('/[^a-z0-9]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $partes[1]));
        
        $formatos = [
            $nomeSemAcentos . '.' . $sobrenomeSemAcentos,
            $nomeSemAcentos[0] . $sobrenomeSemAcentos,
            $nomeSemAcentos . rand(1, 999),
            $nomeSemAcentos . '_' . $sobrenomeSemAcentos
        ];
        
        $username = $formatos[array_rand($formatos)];
        $provedor = $provedores[array_rand($provedores)];
        
        return $username . '@' . $provedor;
    }

    /**
     * Gera um número de telefone celular válido no Brasil
     * @return string Telefone formatado (xx) xxxxx-xxxx
     */
    public static function gerarTelefone(): string {
        $ddds = [
            '11', '12', '13', '14', '15', '16', '17', '18', '19',
            '21', '22', '24', '27', '28', '31', '32', '33', '34',
            '35', '37', '38', '41', '42', '43', '44', '45', '46',
            '47', '48', '49', '51', '53', '54', '55', '61', '62',
            '63', '64', '65', '66', '67', '68', '69', '71', '73',
            '74', '75', '77', '79', '81', '82', '83', '84', '85',
            '86', '87', '88', '89', '91', '92', '93', '94', '95',
            '96', '97', '98', '99'
        ];
        
        $ddd = $ddds[array_rand($ddds)];
        $prefixo = rand(6, 9) . rand(1000, 9999);
        $sufixo = rand(1000, 9999);
        
        return "($ddd) $prefixo-$sufixo";
    }

    /**
     * Gera todos os dados pessoais de uma vez
     * @return array Dados pessoais gerados
     */
    public static function gerarTodosDados(): array {
        $nome = self::gerarNomeCompleto();
        return [
            'cpf' => self::gerarCPF(),
            'nome_completo' => $nome,
            'email' => self::gerarEmail($nome),
            'telefone' => self::gerarTelefone()
        ];
    }
}


// Para usar como JSON:
// header('Content-Type: application/json');
// echo json_encode($dados);
?>