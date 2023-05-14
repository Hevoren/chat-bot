<?php
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../config/path.php';
include_once __DIR__ . '/../config/dbstart.php';

$errors = null;
if ($_POST['type'] === 'register') {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $isSuccess = $db->registerUser($name, $login, $password);
    if ($isSuccess['status'] === 'error') {
        $errors = $isSuccess['errors'];
        $url = "/public/index.php?page=register&errors=" . urlencode(serialize($errors));
        header('Location: ' . $url);
        exit;
    }
    header('Location: /public/index.php?page=register');
    exit;
}

if ($_POST['type'] === 'login') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $isSuccess = $db->loginUser($login, $password);

    if ($isSuccess['status'] === 'error') {
        $errors = $isSuccess['errors'];
        $url = "/public/index.php?page=login&errors=" . urlencode(serialize($errors));
        header('Location: ' . $url);
        exit;
    } else {
        session_start(); // начинаем сессию
        $_SESSION['user_id'] = $isSuccess['user']['user_id'];
        header('Location: /public/index.php?page=chat');
    }
}

if ($_POST['type'] === 'send') {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
    $ifSuccess = $db->sendMessage($user_id, $message);
    header('Location: /public/index.php?page=chat');
    exit;
}

if ($_POST['type'] === 'clear') {
    $user_id = $_POST['user_id'];
    $ifSuccess = $db->clearHistory($user_id);
    header('Location: /public/index.php?page=chat');
    exit;
}


