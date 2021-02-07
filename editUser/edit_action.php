<?php

require '../config.php';
require '../models/User.php';
require '../dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$id = intval(filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));

$verify = !$name || !$email || !$userDao->findById($id) || $userDao->checkEmail($email, $id);

if($verify) {
  header("Location: edit.php?id={$id}");
  exit;
} 

$editedUser = new User($name, $email, $id);
$userDao->update($editedUser);

header("Location: ../index.php");
exit;