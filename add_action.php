<?php

require 'config.php';
require 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$verify = !$name || !$email || $userDao->findByEmail($email);


if($verify){
  header("Location: add.php");
  exit;
}

$newUser = new User($name, $email);
$userDao->add($newUser);
header("Location: index.php");
exit;