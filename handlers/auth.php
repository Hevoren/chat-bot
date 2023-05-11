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
        $url = "/index.php?page=register&errors=".urlencode(serialize($errors));
        header('Location: '.$url);
        exit;
    }
    header('Location: /index.php?page=register');
    exit;
}if($_POST['type'] === 'login'){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $isSuccess = $db->loginUser($login, $password);

    if($isSuccess['status'] === 'error') {
        $errors = $isSuccess['errors'];
        $url = "/index.php?page=login&errors=".urlencode(serialize($errors));
        header('Location: '.$url);
        exit;
    } else {
        session_start(); // начинаем сессию
        $_SESSION['user_id'] = $isSuccess['user']['user_id'];
        header('Location: /index.php?page=chat');
    }
}


