<?php

require_once 'produtoController.php';
require_once '../../core/response.php';
require_once '../../core/header.php';


if ( json_last_error() === JSON_ERROR_NONE ) {

    $produtoID = $input[ 'txtProdutoId' ] ?? null;

    if ( $produtoID ) {

        $produto = new Produto();
        $retornarProduto = $produto->retornarProduto($produtoID);
        echo Response::json( 200, 'success', $retornarProduto);
    } else {
        echo Response::json( 400, 'failed - campos vazio' );
    }
} else {
    echo Response::json( 400, 'Erro ao decodificar Json' );
}
?>
