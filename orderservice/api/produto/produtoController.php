<?php

require_once '../../core/conn.php';

class Produto {
    private $db;

    public function __construct() {
        $this->db = ( new Database() )->getConnection();
    }

    public function inserirProduto( $codigo, $descricao, $status, $garantia ) {
        $sql = 'INSERT INTO produto (Codigo, Descricao, Status, TempoGarantia) VALUES (?, ?, ?, ?)';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $codigo, $descricao, $status, $garantia ] );
        return $ultimoID = $this->db->lastInsertId();
    }

    public function retornarProduto( $produtoID ) {
        $sql = 'SELECT * FROM produto WHERE id = :produtoId';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':produtoId', $produtoID, PDO::PARAM_INT );
        $stmt->execute();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarProdutos() {
        $sql = 'SELECT * FROM produto';
        $stmt = $this->db->query( $sql );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function atualizarProduto( $id, $codigo, $descricao, $status, $garantia ) {
        $sql = 'UPDATE produto SET codigo = ?, descricao = ?, Status = ?, TempoGarantia = ? WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $codigo, $descricao, $status, $garantia, $id ] );
    }

    public function excluirProduto( $id ) {
        $sql = 'DELETE FROM produto WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $id ] );
    }
}
?>
