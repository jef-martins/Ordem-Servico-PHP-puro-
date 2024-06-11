<?php

require_once 'ClienteController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $clienteID = $input[ 'txtClienteId' ] ?? null;
    
    if ( $clienteID ) {
        
        $cliente = new Cliente();
        $cliente->excluirCliente($clienteID);
        echo Response::json( 204, 'success');
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>

