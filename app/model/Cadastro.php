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

        // Processar o arquivo de anexo
        $anexo = null;
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
            $anexo = file_get_contents($_FILES['attachment']['tmp_name']);
        }

        // Inserir o prestador na tabela Prestador
        $sql_prestador = "INSERT INTO Prestador (CPF, Senha, Nome, Email, Endereco, Telefone) 
                        VALUES (:cpf, :senha, :nome, :email, :endereco, :telefone)";
        $stmt_prestador = $conn->prepare($sql_prestador);
        $stmt_prestador->execute([
            ':cpf' => $cpf,
            ':senha' => $senha,
            ':nome' => $nome,
            ':email' => $email,
            ':endereco' => $endereco,
            ':telefone' => $telefone
        ]);

        // Inserir o serviço na tabela Servico
        $sql_servico = "INSERT INTO Servico (Data_cadastro, Descricao, CPF, InfoComplementares, Anexo, ID_categoria) 
                        VALUES (CURDATE(), :descricao, :cpf, :infoComplementares, :anexo, :id_categoria)";
        $stmt_servico = $conn->prepare($sql_servico);
        $stmt_servico->execute([
            ':descricao' => $descricao,
            ':cpf' => $cpf,
            ':infoComplementares' => $infoComplementares,
            ':anexo' => $anexo,
            ':id_categoria' => $categoria
        ]);

        echo "Cadastro realizado com sucesso!";
        header("location: ../../index.html");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
?>