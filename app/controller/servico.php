<?php
require_once 'config/db.php';
require_once 'app/model/servicoModel.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$servicoModel = new servicoModel($pdo);

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($url == '/controller/servico' && $method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data && json_last_error() === JSON_ERROR_NONE) {
        $nome = $data['nome'] ?? null;
        $cpf = $data['cpf'] ?? null;
        $email = $data['email'] ?? null;
        $celular = $data['celular'] ?? null;
        $endereco = $data['endereco'] ?? null;
        $senha = $data['senha'] ?? null;
        $categoria = $data['categoria'] ?? null;
        $descricao = $data['descricao'] ?? null;
        $informacoesComplementares = $data['informacoesComplementares'] ?? null;
    } else {
        $nome = $_GET['nome'] ?? null;
        $cpf = $_GET['cpf'] ?? null;
        $email = $_GET['email'] ?? null;
        $celular = $_GET['celular'] ?? null;
        $endereco = $_GET['endereco'] ?? null;
        $senha = $_GET['senha'] ?? null;
        $categoria = $_GET['categoria'] ?? null;
        $descricao = $_GET['descricao'] ?? null;
        $informacoesComplementares = $_GET['informacoesComplementares'] ?? null;
    }

    if ($nome && $cpf && $email && $celular && $endereco && $senha && $categoria && $descricao && $informacoesComplementares) {
        $response = $servicoModel->salvarServico($nome, $cpf, $email, $celular, $endereco, $senha, $categoria, $descricao, $informacoesComplementares);
        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Parâmetros insuficientes']);
    }
} else {
    echo json_encode(['message' => 'Endpoint ou método não permitido']);
}
?>
