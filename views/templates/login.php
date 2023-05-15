<?php
    require (__DIR__ . '/../../config/path.php');
    $errors = isset($_GET['errors']) ? unserialize(urldecode($_GET['errors'])) : null;
?>

<main>
    <div class="main-form">
        <div class="form-block">
            <p class="form-block-title">Sign In</p>
            <?php if (!empty($errors)): ?>
                <div class="error-block">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li style="color: red; align-items: flex-start"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?= $pathes ?>handlers/controllers.php" method="post">
                <div class="input-wrapper">
                    <label class="input-type">
                        <input required class="input-type-item" type="text" placeholder="Login" name="login">
                    </label>

                    <label class="input-type">
                        <input required class="input-type-item" type="password" placeholder="Password"
                               name="password">
                    </label>

                    <input type="hidden" name="type" value="login">

                    <input class="input-submit" type="submit" value="submit">
                    <a class="offer-a" href="<?= $pathes ?>public/index.php?page=register"> Need an account?</a>
                </div>
            </form>

        </div>
    </div>
</main>