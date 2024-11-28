<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Configuração do banco de dados
require_once 'config/db.php';

// Captura da URL e método
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Rotas da API
if ($url == '/controller/prestadores' && $method == 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM SERVICO S, PRESTADOR P WHERE P.CPF = S.CPF;");
        $stmt->execute();
        $prestadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($prestadores);
    } catch (PDOException $e) {
        http_response_code(500); // Erro interno do servidor
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit; // Finaliza a execução após a resposta
}

if ($url == '/api/empresas/1' && $method == 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Empresa WHERE ID_Empresa = 1");
        $stmt->execute();
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC); // Apenas um registro esperado
        echo json_encode($empresa);
    } catch (PDOException $e) {
        http_response_code(500); // Erro interno do servidor
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit; // Finaliza a execução após a resposta
}

// Caso nenhuma rota seja atendida
http_response_code(404); // Rota não encontrada
echo json_encode(['message' => 'Endpoint ou método não permitido']);
?>