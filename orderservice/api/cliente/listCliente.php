<?php

require_once 'clienteController.php';
require_once '../../core/response.php';

$cliente = new Cliente();

$clientes = $cliente->listarClientes();
echo Response::json( 200, 'success', $clientes );

?>
