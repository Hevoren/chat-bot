<?php
$user_id = $_SESSION['user_id'];
?>

<main>
    <div class="chat-flex">
        <div class="chat-flex-window">
            <div class="chat-flex-dialog">
                <?php
                for ($i = 0; $i < count($messages); $i++) { ?>
                    <div class="message">
                       <p><?= $messages[$i] ["message"] ?></p>
                    </div>
                    <div class="bot-message">
                        <p><?= $botmessages[$i] ["botmessage"] ?></p>
                    </div>
              <?php  } ?>
            </div>
            <div class="chat-flex-input">
                <form action="/handlers/controllers.php" method="post">
                    <label class="chat-flex-input-label">
                        <input class="input-message" name="message" type="text">

                        <input type="hidden" name="type" value="send">

                        <input type="hidden" name="user_id" value="<?= $user_id ?>">

                        <input class="input-submit-message" type="submit" value="&#10150;">
                    </label>
                </form>
            </div>
        </div>
    </div>
</main>