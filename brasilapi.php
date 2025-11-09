<?php
// ============================
// API DE CONSULTA DE CEP
// 1 arquivo | PHP puro | Sem dependências
// ============================

// 1. Define que a resposta será JSON
header('Content-Type: application/json; charset=utf-8');

// 2. Pega o CEP da URL: ?cep=01001000
$cep = $_GET['cep'] ?? '';

// 3. Valida se o CEP foi enviado e tem 8 dígitos
$cepLimpo = preg_replace('/[^0-9]/', '', $cep);

if (strlen($cepLimpo) !== 8) {
    echo json_encode([
        'erro' => 'CEP inválido. Use 8 dígitos.',
        'sucesso' => false
    ]);
    exit;
}

// 4. Monta a URL do BrasilAPI
$url = "https://brasilapi.com.br/api/cep/v2/{$cepLimpo}";

// 5. Faz a requisição
$resposta = @file_get_contents($url);

if ($resposta === false) {
    echo json_encode([
        'erro' => 'Erro ao conectar com o BrasilAPI.',
        'sucesso' => false
    ]);
    exit;
}

// 6. Converte JSON → Array PHP
$dados = json_decode($resposta, true);

if (json_last_error() !== JSON_ERROR_NONE || isset($dados['error'])) {
    echo json_encode([
        'erro' => 'CEP não encontrado.',
        'sucesso' => false
    ]);
    exit;
}

// 7. Monta a resposta limpa e amigável
$respostaApi = [
    'cep' => $dados['cep'] ?? '',
    'rua' => $dados['street'] ?? '',
    'bairro' => $dados['neighborhood'] ?? '',
    'cidade' => $dados['city'] ?? '',
    'estado' => $dados['state'] ?? '',
    'sucesso' => true
];

// 8. Envia a resposta em JSON
echo json_encode($respostaApi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>