<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$nome = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$id = intval(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));

$verify = !$nome || !$email || !$usuarioDao->findById($id) || $usuarioDao->checkEmail($email, $id);

if($verify) {
  header("Location: editar.php?id={$id}");
  exit;
} 

$usuarioEditado = new Usuario($nome, $email, $id);
$usuarioDao->update($usuarioEditado);
header("Location: index.php");
exit;