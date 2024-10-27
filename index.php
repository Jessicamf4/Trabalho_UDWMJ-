<?php
header("Content-Type: application/json");

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {
    case '/controller/empresas':
        require_once 'app/controller/prestadores.php';
        break;
    default:
        echo json_encode(["message" => "Endpoint não encontrado"]);
        break;
}
?>
