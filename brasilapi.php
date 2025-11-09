<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin *");
    header("Access-Control-Allow-Methods: GET");

     $url = "https://brasilapi.com.br/api/cep/v1/".$cep;

    $dados = file_get_contents($url);
    
    $cep = $_GET['cep'] ?? null;
    
    function consultarCEP($cep){
        $cepCorrigido = preg_replace('/[^0-9]', '', $cep);
        if (strlen($cepCorrigido) > 8){
            echo "CEP informado inválido. Somente poderá possuir 8 dígitos.";
        }
    }
?>