<?php

require_once 'OSController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $ordemServicoID = $input[ 'txtOrderServiceId' ] ?? null;
    
    if ( $ordemServicoID ) {
        
        $ordemServico = new OrdemServico();
        $ordemServico->excluirOS($ordemServicoID);
        echo Response::json( 204, 'success' );
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
