<?php

require_once '../../core/conn.php';

class OrdemServico {
    private $db;

    public function __construct() {
        $this->db = ( new Database() )->getConnection();
    }

    public function inserirOS( $codigo, $descricao, $status, $garantia ) {
        $sql = 'INSERT INTO ordem_de_servico (DataAbertura, NomeConsumidor, ClienteId, ProdutoId) VALUES (?, ?, ?, ?)';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $codigo, $descricao, $status, $garantia ] );
        return $ultimoID = $this->db->lastInsertId();
    }

    public function retornarOS( $ordemServicoID ) {
        $sql = '
            SELECT 
                OS.id,
                OS.DataAbertura,
                cliente.nome AS Nome,
                produto.Descricao
            FROM ordem_de_servico OS 
            INNER JOIN cliente ON OS.ClienteID = cliente.id 
            INNER JOIN produto ON OS.ProdutoID = produto.id
            WHERE OS.id = :ordemServicoID
        ';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':ordemServicoID', $ordemServicoID, PDO::PARAM_INT );
        $stmt->execute();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarOS() {
        $sql = '
            SELECT 
                OS.id,
                OS.DataAbertura,
                cliente.nome AS Nome,
                produto.Descricao
            FROM ordem_de_servico OS 
            INNER JOIN cliente ON OS.ClienteID = cliente.id 
            INNER JOIN produto ON OS.ProdutoID = produto.id
        ';
        $stmt = $this->db->query( $sql );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function atualizarOS( $id, $nomeConsumidor, $ClienteID, $produtoID ) {
        $sql = 'UPDATE ordem_de_servico SET nomeConsumidor = ?, ClienteID = ?, produtoID = ? WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $nomeConsumidor, $ClienteID, $produtoID, $id ] );
    }

    public function excluirOS( $id ) {
        $sql = 'DELETE FROM ordem_de_servico WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $id ] );
    }
}
?>
