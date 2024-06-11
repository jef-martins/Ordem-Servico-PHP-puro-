<?php

require_once 'OSController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';

if ( json_last_error() === JSON_ERROR_NONE ) {

    $nomeCliente = $input[ 'txtNomeCliente' ] ?? null;
    $descricaoProduto = $input[ 'txtDescricaoProduto' ] ?? null;
    $clienteId = $input[ 'clienteSelect' ] ?? null;
    $produtoId = $input[ 'produtoSelect' ] ?? null;

    if ( $clienteId && $produtoId ) {

        $ordemServico = new OrdemServico();
        $ultimoID = $ordemServico->inserirOS( date('Y-m-d H:i:s'), $nomeCliente, $clienteId, $produtoId );
        $ultimoOS = $ordemServico->retornarOS( $ultimoID );
        echo Response::json( 201, 'success', $ultimoOS );
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}

?>
