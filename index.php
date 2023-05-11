<?php
session_start();
require_once 'core/functions.php';
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page === "login") {
        if (!isset($_SESSION['user_id'])) {
            $page_content = renderTemplate('views/templates/login.php');
        } else {
            $page_content = renderTemplate('views/templates/hello.php');
        }
    }

    if ($page === 'hello') {
        if (!isset($_SESSION['user_id'])) {
            $page_content = renderTemplate('views/templates/hello.php');
        } else {
            $page_content = renderTemplate('views/templates/chat.php');
        }
    }

    if ($page === 'register') {
        if (!isset($_SESSION['user_id'])) {
            $page_content = renderTemplate('views/templates/register.php');
        } else {
            $page_content = renderTemplate('views/templates/hello/php');
        }
    }

    if ($page === 'chat') {
        if (isset($_SESSION['user_id'])) {
            $page_content = renderTemplate('views/templates/chat.php');
        } else {
            $page_content = renderTemplate('views/templates/hello.php');
        }
    }

    if ($page === 'exit' && isset($_SESSION['user_id'])) {
        if (isset($_SESSION['user_id'])) {
            $page_content = renderTemplate('views/templates/exit.php');
        } else {
            $page_content = renderTemplate('views/templates/hello.php');
        }
    }
} else {
    $page_content = renderTemplate('views/templates/hello.php');
}

$layout_content = renderTemplate('views/layouts/main.php',
    ['content' => $page_content]);

print($layout_content);