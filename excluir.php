<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_GET, "id");

$usuario = $usuarioDao->findById($id);
$usuarioDao->delete($usuario);
header("Location: index.php");
exit;
