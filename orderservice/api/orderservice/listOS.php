<?php

require_once 'OSController.php';
require_once '../../core/response.php';

$ordemServico = new OrdemServico();

$OrdensServicos = $ordemServico->listarOS();
echo Response::json( 200, 'success', $OrdensServicos);
?>
