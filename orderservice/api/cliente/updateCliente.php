<?php

require_once 'clienteController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $clienteID = $input[ 'txtClienteId' ] ?? null;
    $nome = $input[ 'txtNome' ] ?? null;
    $cpf = $input[ 'txtCpf' ] ?? null;
    $endereco = $input[ 'txtEndereco' ] ?? null;

    if ( $nome && $cpf && $endereco ) {

        $cliente = new Cliente();
        $cliente->atualizarCliente($clienteID, $nome, $cpf, $endereco );
        $retornarCliente = $cliente->retornarCliente($clienteID);
        echo Response::json( 200, 'success', $ultimoCliente );
    } else {
        echo Response::json( 400, 'failed' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
