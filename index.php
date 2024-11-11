<?php
header("Content-Type: application/json");

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {
    case '/controller/empresas':
        require_once 'app/controller/prestadores.php';
        break;
    case '/controller/servico':
        require_once 'app/controller/servico.php';
        break;
    default:
        echo json_encode(["message" => "Endpoint não encontrado"]);
        break;
}
?>
