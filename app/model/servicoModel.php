<?php

require_once 'config/db.php';

class servicoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function salvarServico($nome, $cpf, $email, $celular, $endereco, $senha, $categoria, $descricao, $informacoesComplementares) {
        try {
            
            $stmt = $this->pdo->prepare("INSERT INTO Prestador (CPF, Senha, Nome, Email, Endereco, Telefone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cpf, $senha, $nome, $email, $endereco, $celular]); 

            $stmt = $this->pdo->prepare("INSERT INTO Servico (Data_cadastro, Descricao, CPF, InfoComplementares, ID_categoria) VALUES (CURDATE(), ?, ?, ?, ?)");
            $stmt->execute([$descricao, $cpf, $informacoesComplementares, $categoria]); 

            return ['message' => 'Prestador salvo com sucesso!'];

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
