<?php
session_start();
require_once __DIR__ . '/../core/TemplateRenderer.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../config/path.php';
include_once __DIR__ . '/../config/dbstart.php';

$renderer = new TemplateRenderer();
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page === "login") {
        if (!isset($_SESSION['user_id'])) {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/login.php');
        } else {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
        }
    }

    if ($page === 'hello') {
        if (!isset($_SESSION['user_id'])) {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
        } else {
            $messages = $db->getMessages();
            $botmessages = $db->getBotMessages();
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/chat.php', ['messages' => $messages, 'botmessages' => $botmessages]);
        }
    }

    if ($page === 'register') {
        if (!isset($_SESSION['user_id'])) {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/register.php');
        } else {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
        }
    }

    if ($page === 'chat') {
        if (isset($_SESSION['user_id'])) {
            $messages = $db->getMessages();
            $botmessages = $db->getBotMessages();
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/chat.php', ['messages' => $messages, 'botmessages' => $botmessages]);
        } else {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
        }
    }

    if ($page === 'exit') {
        if (isset($_SESSION['user_id'])) {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/exit.php');
        } else {
            $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
        }
    }
} else {
    $page_content = $renderer->renderTemplate($basepath . 'views/templates/hello.php');
}

$layout_content = $renderer->renderTemplate($basepath . 'views/layouts/main.php',
    ['content' => $page_content]);

print($layout_content);