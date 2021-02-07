<?php

require '../config.php';
require '../models/User.php';
require '../dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$id = intval(filter_input(INPUT_GET, "id"));

$user = $userDao->findById($id);
$userDao->delete($user);

header("Location: ../index.php");
exit;
