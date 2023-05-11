<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
</head>

<body>
<header>
    <div class="header">
        <div class="header-title">
            <a href="index.php?page=hello">Gabella Chat</a>
        </div>
        <div class="header-menu">
            <a href="index.php?page=login">Sign In</a>
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