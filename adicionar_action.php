<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$verify = !$name || !$email || $usuarioDao->findByEmail($email);


if($verify){
  header("Location: adicionar.php");
  exit;
}

$novoUsuario = new Usuario($name, $email);
$usuarioDao->add($novoUsuario);
header("Location: index.php");
exit;