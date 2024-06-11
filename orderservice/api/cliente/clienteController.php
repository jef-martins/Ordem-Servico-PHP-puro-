<?php

require_once '../../core/conn.php';

class Cliente {
    private $db;

    public function __construct() {
        $this->db = ( new Database() )->getConnection();
    }

    public function inserirCliente( $nome, $cpf, $address ) {
        $sql = 'INSERT INTO cliente (nome, cpf, endereco) VALUES (?, ?, ?)';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $nome, $cpf, $address ] );
        return $ultimoID = $this->db->lastInsertId();
    }

    public function retornarCliente( $clienteId ) {
        $sql = 'SELECT * FROM cliente WHERE id = :clienteId';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindParam( ':clienteId', $clienteId, PDO::PARAM_INT );
        $stmt->execute();
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function listarClientes() {
        $sql = 'SELECT * FROM cliente';
        $stmt = $this->db->query( $sql );
        return $stmt->fetchAll( PDO::FETCH_ASSOC );
    }

    public function atualizarCliente( $id, $nome, $cpf, $address ) {
        $sql = 'UPDATE cliente SET nome = ?, cpf = ?, endereco = ? WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $nome, $cpf, $address, $id ] );
    }
    
    public function excluirCliente( $id ) {
        $sql = 'DELETE FROM cliente WHERE id = ?';
        $stmt = $this->db->prepare( $sql );
        $stmt->execute( [ $id ] );
    }
}
?>
