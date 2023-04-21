<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <script defer src="scripts/script.js"></script>
</head>

<body>
    <div class="tabs">
        <input type="submit" value="Log In" onclick="showLoginForm()">
        <input type="submit" value="Sign In" onclick="showRegisterForm()">
    </div>
    <div class="forms">
        <div id="register-form">
            <h1>Sign Up</h1>
            <form class="register-form" action="" id="register-form-child">
                <div>
                    <input type="text" name="name" id="name" placeholder="Name" />
                    <input type="text" name="login" id="login" placeholder="Login" />
                    <input type="password" name="password" id="password" placeholder="Password" />
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div id="login-form">
            <h1>Log In</h1>
            <form class="login-form" id="login-form-child">
                <div>
                    <input type="text" name="login" id="login-reg" placeholder="Login" />
                    <input type="password" name="password" id="password-reg" placeholder="Password" />
                </div>
                <button type="submit">Log In</button>
            </form>
        </div>
    </div>

</body>

</html>