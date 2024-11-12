<?php
session_start();
require_once 'Conexao.php';

try {
    // Conexão com o banco de dados
    $conn = new PDO('mysql:host=localhost;dbname=cadastro', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebe dados do formulário
    $cpf = $_POST['cpf'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['cep']; // Ajuste o campo conforme necessário
    $telefone = $_POST['telefone'];
    $categoria = $_POST['options'];
    $descricao = $_POST['descricao'];
    $infoComplementares = $_POST['informacoesComplementares'];
    $frequencia = $_POST['frequencia'];

    // Inserir o requerente na tabela Requerente
    $sql_requerente = "INSERT INTO Requerente (CPF, Senha, Nome, Email, Endereco, Telefone) 
                       VALUES (:cpf, :senha, :nome, :email, :endereco, :telefone)";
    $stmt_requerente = $conn->prepare($sql_requerente);
    $stmt_requerente->execute([
        ':cpf' => $cpf,
        ':senha' => $senha,
        ':nome' => $nome,
        ':email' => $email,
        ':endereco' => $endereco,
        ':telefone' => $telefone
    ]);

    // Inserir a requisição na tabela Requisicao
    $sql_requisicao = "INSERT INTO Requisicao (Data_cadastro, Descricao, CPF, InfoComplementares, Frequencia, ID_categoria) 
                       VALUES (CURDATE(), :descricao, :cpf, :infoComplementares, :frequencia, :id_categoria)";
    $stmt_requisicao = $conn->prepare($sql_requisicao);
    $stmt_requisicao->execute([
        ':descricao' => $descricao,
        ':cpf' => $cpf,
        ':infoComplementares' => $infoComplementares,
        ':frequencia' => $frequencia,
        ':id_categoria' => $categoria
    ]);

    echo "Cadastro e requisição realizados com sucesso!";
    header("location: ../../index.html");
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
