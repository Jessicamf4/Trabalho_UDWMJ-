// api/empresas.php
<?php
require_once 'config/db.php';

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($url == '/controller/empresas' && $method == 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Empresa");
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($empresas);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Endpoint ou método não permitido']);
}

if ($url == '/api/empresas/1' && $method == 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Empresa where ID_Empresa =1");
        $stmt->execute();
        $empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($empresas);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['message' => 'Endpoint ou método não permitido']);
}
?>
