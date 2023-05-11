<?php
require_once('../core/Database.php');
include_once '../config/dbstart.php';

$errors = null;
if ($_POST['type'] === 'register'){
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $isSuccess = $db->registerUser($name, $login, $password);
    if($isSuccess['status'] === 'error') {
        $errors = $isSuccess['errors'];
        session_start(); // начинаем сессию
        $_SESSION['errors'] = $errors;
    }
    header('Location: /index.php?page=register');
    exit;
}if($_POST['type'] === 'login'){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $isSuccess = $db->loginUser($login, $password);

    if($isSuccess['status'] === 'error') {
        $errors = $isSuccess['errors'];
        session_start(); // начинаем сессию
        $_SESSION['errors'] = $errors;
    }
    header('Location: /index.php?page=login');
    exit;
}


