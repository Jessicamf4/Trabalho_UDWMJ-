<?php

require_once 'config/db.php';

class servicoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function salvarServico($nome, $cpf, $email, $celular, $endereco, $senha, $categoria, $descricao, $informacoesComplementares) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Empresa (CPF, Senha, Nome, Email, Endereco, Telefone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cpf, $nome, $senha, $email, $endereco, $celular, $categoria, $descricao, $informacoesComplementares]);
            $stmt = $this->pdo->prepare("INSERT INTO Empresa (Data_cadastro, Descricao, CPF, InfoComplementares, ID_categoria) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([CURDATE(),  $descricao, $cpf, $informacoesComplementares, $categoria]);
            return ['message' => 'Empresa salva com sucesso!'];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // Método para buscar todas as empresas
    public function buscarEmpresas() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Empresa");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
