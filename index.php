<?php
    require_once 'core/functions.php';
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $string = $path;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if ($page === "login") {
            $page_content = renderTemplate('views/templates/login.php');
        }

        if ($page === 'hello') {
            $page_content = renderTemplate('views/templates/hello.php');
        }

        if ($page === 'register') {
            $page_content = renderTemplate('views/templates/register.php');
        }
    }else{
        $page_content = renderTemplate('views/templates/hello.php');
    }

    $layout_content = renderTemplate('views/layouts/main.php',
        ['content' => $page_content]);

    print($layout_content);