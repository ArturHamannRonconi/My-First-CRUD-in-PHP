<?php

require 'config.php';
require 'models/User.php';
require 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);
$users = $userDao->findAll();

?>

<a href="addUser/add.php">Add User</a>

<table border="1" width="100%">
  <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>EMAIL</th>
    <th>ACTIONS</th>
  </tr>
  <?php foreach($users as $user): ?>
    <tr>  
      <td style="text-align:center;"><?= $user->getId() ?></td>
      <td style="text-align:center;"><?= $user->getName() ?></td>
      <td style="text-align:center;"><?= $user->getEmail() ?></td>
      <td style="text-align:center;">
        <a href="editUser/edit.php?id=<?= $user->getId() ?>">[Edit]</a>
        <a href="deleteUser/delete.php?id=<?= $user->getId() ?>" onclick="return alert('You want to delete the user <?= $user->getName() ?>')">[delete]</a>
      </td>
    </tr>
  <?php endforeach ?>

</table>
