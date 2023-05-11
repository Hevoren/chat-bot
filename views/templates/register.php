<?php
    session_start();
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    unset($_SESSION['errors']);
?>
<main>
    <div class="main-form">
        <div class="form-block">
            <p class="form-block-title">Sign Up</p>
            <?php if (!empty($errors)): ?>
                <div class="error-block">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li style="color: red; align-items: flex-start"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/handlers/auth.php" method="post">
                <div class="input-wrapper">
                    <label class="input-type">
                        <input required class="input-type-item" type="text" placeholder="Name" name="name" id="name">
                    </label>

                    <label class="input-type">
                        <input required class="input-type-item" type="text" placeholder="Login" name="login" id="login">
                    </label>

                    <label class="input-type">
                        <input required class="input-type-item" type="password" placeholder="Password"
                               name="password" id="password">
                    </label>

                    <input type="hidden" name="type" value="register">

                    <input class="input-submit" type="submit" value="submit">
                    <a class="offer-a" href="index.php?page=login"> Already registered?</a>
                </div>
            </form>

        </div>
    </div>
</main>