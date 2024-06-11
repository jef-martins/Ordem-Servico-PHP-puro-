<?php

require_once 'OSController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $ordemServicoID = $input[ 'txtOsId' ] ?? null;

    if ( $ordemServicoID ) {

        $ordemServico = new OrdemServico();
        $ordensServicos = $ordemServico->retornarOS($ordemServicoID);
        echo Response::json( 200, 'success', $ordensServicos );
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
