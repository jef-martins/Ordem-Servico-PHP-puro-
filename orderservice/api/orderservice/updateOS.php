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
        $ordemServico->atualizarOS($ordemServicoID, $nomeCliente, $clienteId, $produtoId );
        $ultimoOS = $ordemServico->retornarOS($ordemServicoID);
        echo Response::json( 200, 'success', $ultimoOS );
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
