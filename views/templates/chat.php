<?php
require (__DIR__ . '/../../config/path.php');
$user_id = $_SESSION['user_id'];
?>

<main>
    <div class="chat">
        <div class="switcher">
            <div class="mygpt-block">
                <button class="mygpt-button" id="button1" onclick="gabella()">Gabella</button>
            </div>
            <div class="gpt-block">
                <div class="gpt-block-button">
                    <button class="gpt-button" id="button2" onclick="gpt()">GPT</button>
                </div>
                <div class="gpt-block-img">
                    <img class="logo-gpt" src="<?= $pathes ?>public/assets/img/chatgpt-icon.svg" alt="gabella">
                </div>

            </div>
        </div>
        <div class="chat-flex">
            <div class="chat-flex-window">
                <div class="chat-flex-dialog">
                    <?php
                    for ($i = 0; $i < count($messages); $i++) { ?>
                        <div class="message">
                            <p class="message-item"><?= $messages[$i] ["message"] ?></p>
                            <p class="message-item2">you</p>
                        </div>
                        <div class="bot-message">
                            <p><?= $botmessages[$i] ["botmessage"] ?></p>
                        </div>

                    <?php } ?>
                    <div class="hiden-block" id="last-message">

                    </div>
                </div>
                <div class="chat-flex-input">
                    <form action="<?= $pathes ?>handlers/controllers.php" method="post" class="form-send-message">
                        <label class="chat-flex-input-label">
                            <input class="input-message" name="message" type="text">

                            <input type="hidden" name="type" value="send">

                            <input type="hidden" name="user_id" value="<?= $user_id ?>">

                            <button class="input-submit-message" type="submit" onclick="sendMes()">&#10150;</button>
                        </label>
                    </form>
                    <form action="<?= $pathes ?>handlers/controllers.php" method="post" class="form-clear-history">
                        <input type="hidden" name="type" value="clear">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <input type="submit" class="clear-history-button" value="Clear">
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
