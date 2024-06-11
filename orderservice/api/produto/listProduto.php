<?php

require_once 'produtoController.php';
require_once '../../core/response.php';

$produto = new Produto();

$produtos = $produto->listarProdutos();
echo Response::json( 200, 'success', $produtos);
?>
