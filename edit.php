<?php

require 'config.php';
require 'dao/UserDaoMysql.php';

$id = intval(filter_input(INPUT_GET, "id"));

$userDao = new UserDaoMysql($pdo);
$user = $userDao->findById($id);

if(!$user) {
  header("Location: index.php");
  exit;
}

?>

<h1>Edit User</h1>

<form method="POST" action="edit_action.php">
  <input type="hidden" name="id" value="<?= $user->getId() ?>">
  <label>
    Name:<br>
    <input type="text" name="name" value="<?= $user->getName() ?>" placeholder="Name">
  </label><br><br>
  <label>
    E-mail:<br>
    <input type="email" name="email" value="<?= $user->getEmail() ?>" placeholder="Email">
  </label><br><br>
  <input type="submit" value="save">
</form>
