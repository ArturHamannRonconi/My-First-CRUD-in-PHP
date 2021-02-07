<?php

require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);
$usuarios = $usuarioDao->findAll();

?>

<a href="adicionar.php">Adicionar usuário</a>

<table border="1" width="100%">
  <tr>
    <th>ID</th>
    <th>NOME</th>
    <th>EMAIL</th>
    <th>AÇÕES</th>
  </tr>
  <?php foreach($usuarios as $usuario): ?>
    <tr>  
      <td style="text-align:center;"><?= $usuario->getId() ?></td>
      <td style="text-align:center;"><?= $usuario->getNome() ?></td>
      <td style="text-align:center;"><?= $usuario->getEmail() ?></td>
      <td style="text-align:center;">
        <a href="editar.php?id=<?= $usuario->getId() ?>">[Editar]</a>
        <a href="excluir.php?id=<?= $usuario->getId() ?>" onclick="return alert('você deseja excluir o usuário <?= $usuario->getNome() ?>')">[Excluir]</a>
      </td>
    </tr>
  <?php endforeach ?>

</table>
