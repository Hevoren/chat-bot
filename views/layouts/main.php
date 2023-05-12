<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <link rel="stylesheet" href="/public/assets/css/style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"/>
</head>

<body>
<header>
    <div class="header">
        <div class="header-title">
            <a href="/public/index.php?page=hello">Gabella Bot</a>
        </div>

        <div class="header-menu">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="/public/index.php?page=exit">Exit</a>
            <?php } else { ?>
                <a href="/public/index.php?page=login">Sign In</a>
            <?php } ?>
        </div>
    </div>
</header>
<?= $content ?? '' ?>
<footer>
    <div>
        <p>© 2023 - All rights reserved</p>
        <p>gabellabook@gmail.com</p>
    </div>
</footer>
</body>

</html>