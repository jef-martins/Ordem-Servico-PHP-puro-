<?php

require_once 'clienteController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $clienteID = $input[ 'txtClienteId' ] ?? null;

    if ( $clienteID ) {

        $cliente = new Cliente();
        $retornarCliente = $cliente->retornarCliente($clienteID);
        echo Response::json( 200, 'success', $retornarCliente );
    } else {
        echo Response::json( 400, 'failed' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
