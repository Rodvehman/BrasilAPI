<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin *");
    header("Access-Control-Allow-Methods: GET");
    
    $cep = $_GET['cep'] ?? null;
    
?>