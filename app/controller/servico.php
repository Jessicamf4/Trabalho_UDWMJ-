<?php
require_once 'config/db.php';
require_once 'model/servicoModel.php';

$servicoModel = new servicoModel($pdo);

// Verifica a URL e o método
$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($url == '/app/api/empresas' && $method == 'GET') {
    $empresas = $servicoModel->buscarEmpresas();
    echo json_encode($empresas);
} elseif ($url == '/app/api/empresas' && $method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $nome = $data['nome'];
    $cpf = $data['cpf'];
    $email = $data['email'];
    $celular = $data['celular'];
    $endereco = $data['cep'];
    $senha = $data['senha'];
    $categoria = $data['categoria'];
    $descricao = $data['descricao'];
    $informacoesComplementares = $data['informacoesComplementares'];


    $response = $servicoModel->salvarServico($nome, $cpf, $email, $celular, $endereco, $senha, $categoria, $descricao, $informacoesComplementares);
    echo json_encode($response);
} else {
    echo json_encode(['message' => 'Endpoint ou método não permitido']);
}
