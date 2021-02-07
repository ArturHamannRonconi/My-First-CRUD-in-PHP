<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$id = intval(filter_input(INPUT_GET, "id"));

$usuarioDao = new UsuarioDaoMysql($pdo);
$usuario = $usuarioDao->findById($id);

if(!$usuario) {
  header("Location: index.php");
  exit;
}

?>

<h1>Editar Usuário</h1>

<form method="POST" action="editar_action.php">
  <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
  <label>
    Nome:<br>
    <input type="text" name="name" value="<?= $usuario->getNome() ?>" placeholder="Nome">
  </label><br><br>
  <label>
    E-mail:<br>
    <input type="email" name="email" value="<?= $usuario->getEmail() ?>" placeholder="Email">
  </label><br><br>
  <input type="submit" value="Salvar">
</form>
